<?php

require "./mysqlConnection.php";
$pdo = mysqlConnect();

$name = $_POST["name"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$phone = $_POST["phone"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$hashpassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();

    //Verifica se o anunciante já é cadastrado
    $selectSql = <<<SQL
                    SELECT Email, CPF FROM anunciante
                    WHERE Email = ? OR Cpf = ?
                SQL;
    $stmt = $pdo->prepare($selectSql);
    $stmt->execute([$email, $cpf]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        if ($row['Email'] === $email || $row['CPF'] === $cpf) {
            echo "Usuário existente!";
            http_response_code(400);
            exit;
        }
    }

    //Cadastra um novo anunciante
    $sql = <<<SQL
            INSERT INTO anunciante (Nome, CPF, Email, SenhaHash, Telefone)
            VALUES (?, ?, ?, ?, ?)
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $cpf, $email, $hashpassword, $phone]);
    $userid = $pdo->lastInsertId();
    $affectedRows = $stmt->rowCount();
    if ($affectedRows != 1) {
        throw new Exception("Falha ao cadastrar os dados!");
    }

    $pdo->commit();
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $name;
    $_SESSION['email'] = $email;
    http_response_code(200);

    header("location: ../dashboard.php");
    exit();
} catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === 23000) {
        http_response_code(400);
        exit('Dados duplicados: ' . $e->getMessage());
    } else {
        http_response_code(400);
        exit('Falha ao cadastrar os dadosab: ' . $e->getMessage());
    }
}

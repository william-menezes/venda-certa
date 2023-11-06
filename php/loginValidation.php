<?php

require "./mysqlConnection.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

function checkLogin($pdo, $email, $password)
{
    $sql = <<<SQL
        SELECT SenhaHash 
        FROM Anunciante
        WHERE email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return false;

        return password_verify($password, $row['SenhaHash']);
    } catch (Exception $e) {
        exit("Falha inesperada: " . $e->getMessage());
    }
}

function getUserName($pdo, $email) {
    $sql = <<<SQL
        SELECT Nome
        FROM Anunciante
        WHERE email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return false;

        return $row['Nome'];
    } catch (Exception $e) {
        exit("Falha inesperada: " . $e->getMessage());
    }
}


if (checkLogin($pdo, $email, $password)) {
    session_start();

    $user = getUserName($pdo, $email);
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['email'] = $email;
    http_response_code(200);
    header("location: ../dashboard.php");
    exit();
} else {
    header("location: ../login.php?error=1");
}

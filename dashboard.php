<?php
    require "./php/sessionVerification.php";

    session_start();
    exitWhenNotLoggedIn();
    $userName = $_SESSION['nome'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        echo "<h1>Dashboard</h1>";    
        echo "Bem-vindo, $userName";
        echo "Seu email é $email";
    ?>


</body>

</html>
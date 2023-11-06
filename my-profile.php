<?php
require('./php/mysqlConnection.php');
require "./php/sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$userName = $_SESSION['user'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css" />
    <link rel="stylesheet" href="./style/navbar.css" />
    <link rel="stylesheet" href="./style/footer.css" />

    <link rel="shortcut icon" href="./assets/logo/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Minha conta</title>
</head>

<body>
    <header>
    <nav class="container d-flex justify-content-between">
            <a href="dashboard.php" class="navbar__logo m-0">
                <img src="./assets/logo/logo-default.svg" alt="Venda Certa logo" height="50" />
            </a>

            <div class="dropdown navbar__cta m-0">
                <button class="button--md button--transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i> <?php echo "$userName"?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header"><?php echo "$email"; ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="./dashboard.php#my-announcements">Meus anúncios</a></li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="./dashboard.php#my-messages">Mensagens</a></li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="./my-profile.php">Meu perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="navbar__link">
                        <?php echo <<<HTML
                            <a class="dropdown-item link--no-underline" href="./php/logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
                        HTML ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <nav class="container ">
            <ul class="breadcrumb list--none list--inline">
                <li class="breadcrumb__link">
                    <a class="link--no-underline" href="dashboard.php">Home</a>
                </li>

                <li class="breadcrumb__link breadcrumb__link--active">
                    <a class="link--no-underline" href="#">Meu perfil</a>
                </li>
            </ul>
        </nav>

        <section class="container pt-0">
            <div id="my-profile" class="">

                <h2 class="section__title mt-0">Meu perfil</h2>

                <form class="w-100 card p-3" name="formMyProfile" action="php/myProfileValidation.php" method="post" novalidate>
                    <div class="form-field col-12">
                        <label for="name">Nome</label>
                        <input class="input--md" type="text" id="name" name="name" required />
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="cpf">CPF</label>
                        <input class="input--md" type="text" id="cpf" name="cpf" required />
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="phone">Telefone</label>
                        <input class="input--md" type="text" id="phone" name="phone" required />
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="password">Senha</label>
                        <input class="input--md" type="password" id="password" name="password" required />
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>

                    <button class="button--md button--primary ms-auto" type="submit">Salvar alterações</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer--secundary">
        <div class="footer__content container">
            <a href="dashboard.php" class="footer__logo">
                <img src="./assets/logo/logo-default.svg" alt="Venda Certa logo" height="50" />
            </a>

            <p class="footer__copyright--secundary m-0">
                © 2023 Venda Certa Ltda. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="./js/my-profile-form-validation.js"></script>
    <script src="./js/input-masks.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
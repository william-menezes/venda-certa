<?php
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
    <title>Dashboard</title>
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
                <li class="breadcrumb__link breadcrumb__link--active">
                    <a class="link--no-underline" href="dashboard.php">Home</a>
                </li>
            </ul>
        </nav>

        <section class="container pt-0">
            <h2 class="section__title">Meus anúncios</h2>

            <div id="my-announcements" class="card p-4">
                <a class="ms-auto link-as-button button--md button--primary button-icon--let" href="./new-announcement.php">
                    <i class="bi bi-plus"></i> Novo anúncio
                </a>
                <div class="table-responsive">

                    <table class="table table-hover mt-4">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <!-- <th scope="col">Descrição</th> -->
                                <th scope="col">Preço</th>
                                <th scope="col">Data/Hora</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Monitor de 22 Full HD</td>
                                <!-- <th>Vendo um monitor Full HD de 22 polegadas, black piano, com 6 meses de uso, marca X, sem detalhes.</th> -->
                                <td>650.00</td>
                                <td>2023-11-03 20:29:06</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Monitor de 22 Full HD</td>
                                <!-- <th>Vendo um monitor Full HD de 22 polegadas, black piano, com 6 meses de uso, marca X, sem detalhes.</th> -->
                                <td>650.00</td>
                                <td>2023-11-03 20:29:06</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Monitor de 22 Full HD</td>
                                <!-- <th>Vendo um monitor Full HD de 22 polegadas, black piano, com 6 meses de uso, marca X, sem detalhes.</th> -->
                                <td>650.00</td>
                                <td>2023-11-03 20:29:06</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Monitor de 22 Full HD</td>
                                <!-- <th>Vendo um monitor Full HD de 22 polegadas, black piano, com 6 meses de uso, marca X, sem detalhes.</th> -->
                                <td>650.00</td>
                                <td>2023-11-03 20:29:06</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
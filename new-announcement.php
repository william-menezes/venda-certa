<?php
require('./php/mysqlConnection.php');

$pdo = mysqlConnect();

/* $warning = <<<WARNING
    <span class="hint--error" aria-live="polite">Usuário ou senha inválidos</span>
    WARNING; */

try {
    $sql = <<<SQL
            SELECT codigo, nome FROM categoria
        SQL;

    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
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
    <title>Novo anúncio</title>
</head>

<body>
    <header>
        <nav class="navbar container">
            <a href="dashboard.php" class="navbar__logo">
                <img src="./assets/logo/logo-default.svg" alt="Venda Certa logo" height="50" />
            </a>

            <div class="dropdown navbar__cta">
                <button class="fab fab--md dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header"><?php echo "$email"; ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="#">Meus anúncios</a></li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="#">Mensagens</a></li>
                    <li class="navbar__link"><a class="dropdown-item link--no-underline" href="#">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="navbar__link">
                        <?php echo <<<HTML
                            <a class="dropdown-item link--no-underline" href="./php/logout.php">Sair</a>
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
                    <a class="link--no-underline" href="#">Criar anúncio</a>
                </li>
            </ul>
        </nav>

        <section class="container pt-0">
            <div id="new-announcement" class="">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="section__title mt-0">Criar anúncio</h2>
                </div>

                <form 
                    class="w-100 card p-3"
                    name="formNewAnnouncement"
                    action="php/newAnnouncementValidation.php"
                    enctype="multipart/form-data"
                    method="post"
                    novalidate>

                    <div class="form-field col-12">
                        <label for="title">Título</label>
                        <input class="input--md" type="text" id="title" name="title" required />
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>

                    <div class="form-field col-12">
                        <label for="description">Descrição</label>
                        <textarea class="input--md" name="description" id="description" cols="30" rows="10" required></textarea>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>


                    <div class="form-field">
                        <label for="category">Categoria</label>
                        <select class="input--md" name="category" id="category">
                            <option value="">Todas as categorias</option>

                            <?php
                            foreach ($categories as $category) {
                                echo <<<HTML
                                            <option value="$category->codigo">$category->nome</option>
                                        HTML;
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-field col-12">
                        <label for="price">Preço (R$)</label>
                        <input class="input--md" type="text" id="price" name="price" required>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>

                    <div class="form-field">
                        <label for="pictures">Fotos</label>
                        <input class="form-control" type="file" id="pictures" accept="image/*" multiple>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>

                    <div class="form-field col-12">
                        <label for="cep">CEP</label>
                        <input class="input--md" type="text" id="cep" name="cep" maxlength="9" required>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="district">Bairro</label>
                        <input class="input--md" type="text" id="district" name="district" required>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="city">Cidade</label>
                        <input class="input--md" type="text" id="city" name="city" required>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>
                    <div class="form-field col-12">
                        <label for="state">Estado</label>
                        <input class="input--md" type="text" id="state" name="state" required>
                        <span class="hint hint--error" aria-live="polite"></span>
                    </div>

                    <button class="button--md button--primary ms-auto" type="submit">Anunciar</button>
                </form>
            </div>
        </section>

    </main>

    <script src="./js/input-masks.js"></script>
    <script src="./js/new-announcement-validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
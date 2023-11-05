<?php
require('./php/mysqlConnection.php');

$pdo = mysqlConnect();

$warning = <<<WARNING
    <span class="hint--error" aria-live="polite">Usuário ou senha inválidos</span>
    WARNING;

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/main.css" />
    <link rel="stylesheet" href="./style/navbar.css" />
    <link rel="stylesheet" href="./style/footer.css" />

    <link rel="shortcut icon" href="./assets/logo/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <title>Venda Certa</title>
</head>

<body>
    <header>
        <nav class="navbar container">
            <a href="index.php" class="navbar__logo">
                <img src="./assets/logo/logo-default.svg" alt="Venda Certa logo" height="50" />
            </a>

            <ul class="navbar__links list--none list--inline">
                <li class="navbar__link">
                    <a href="#recent-announcements" class="link--no-underline">Anúncios recentes</a>
                </li>
                <li class="navbar__link">
                    <a href="#categories" class="link--no-underline">Categorias</a>
                </li>
            </ul>

            <ul class="navbar__cta list--none list--inline">
                <li>
                    <button class="fab fab--md" onclick="modalSearchbar()">
                        <i class="bi bi-search"></i>
                    </button>
                </li>

                <li class="navbar__link">
                    <a href="#" class="link--no-underline"><i class="bi bi-bag"></i></a>
                </li>
                <li class="navbar__link">
                    <a href="login.html" class="link--no-underline"><i class="bi bi-person-circle"></i></a>
                </li>

                <li>
                    <button class="fab fab--md navbar__toggle" onclick="openHamburgerMenu()">
                        <i class="bi bi-list"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div id="searchbar" class="search-wrapper">
            <form name="formSearch" action=".php/search-validation.php"  method="post" novalidate>
                <div class="container search-wrapper__button--close">
                    <!-- CLOSE MODAL BUTTON -->
                    <button type="button" class="fab fab--white fab--xl" onclick="closeModalSearchbar()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="container search-wrapper__dropdown">
                    <div class="search-wrapper__fields">
                        <!-- FILTER BUTTON -->
                        <button type="button" class="search-wrapper__button--filter button--md button-icon--right" onclick="openSearchDrowpdown()">
                            Filtrar <i class="bi bi-filter"></i>
                        </button>

                        <!-- FILTER INPUT -->
                        <input class="input--md search-wrapper__input" type="text" name="search-input" id="search-input" placeholder="Procurar por..." />

                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="search-wrapper__button--submit button--primary button--md fab--sm">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- DROPDOWN -->
                    <div id="searchbar-dropdown" class="search-wrapper__filters">
                        <h3 class="section__title">Filtrar por:</h3>
                        <section>
                            <h4 class="section__subtitle">Palavra chave</h4>

                            <div class="radio-inputs">
                                <label class="radio">
                                    <input type="radio" id="title" name="key-word" value="title" checked="" />
                                    <span class="name">Título</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" id="description" name="key-word" value="description" />
                                    <span class="name">Descrição</span>
                                </label>
                            </div>
                        </section>

                        <section>
                            <h4 class="section__subtitle">Valor</h4>

                            <div class="form-field--inline">
                                <div class="form-field">
                                    <label for="min-value">Mínimo</label>
                                    <input class="input--md" type="text" name="min-value" id="min-value" />
                                    <span class="hint hint--error" aria-live="polite"></span>
                                </div>
                                <div class="form-field">
                                    <label for="max-value">Máximo</label>
                                    <input class="input--md" type="text" name="max-value" id="max-value" />
                                    <span class="hint hint--error" aria-live="polite"></span>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h4 class="section__subtitle">Categoria</h4>

                            <div class="form-field">
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
                        </section>
                    </div>
                </div>
            </form>
        </div>

        <section class="container">
            <div class="hero">
                <h1 class="hero__title">Venda Certa</h1>
                <p class="hero__subtitle">
                    A plataforma que facilita a vida de compradores e vendedores em um
                    único lugar.
                </p>
            </div>
        </section>

        <section class="container">
            <div id="categories" class="category">
                <h2 class="section__title">Categorias</h2>

                <ul class="category__list list--none list--inline">
                    <?php
                    foreach ($categories as $category)
                        echo <<<HTML
                            <li class="badge badge--orange">$category->nome</li>
                        HTML;
                    ?>
                </ul>
            </div>
        </section>

        <section class="container">
            <div id="recent-announcements" class="recent-announcements">
                <h2 class="section__title">Anúncios recentes</h2>

                <div class="recent-announcements__list">
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                    <a href="announcement.html" class="product-card link--no-underline">
                        <div class="product-card__thumbnail-wrap">
                            <div class="product-card__image">
                                <img src="./assets/images/products/macbook.jpg" alt="" />
                            </div>
                        </div>

                        <div class="product-card__body">
                            <h3 class="product-card__title">Macbook Pro 14"</h3>
                            <p class="product-card__description">
                                Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Porro tempora neque delectus
                                nulla sequi nisi repellendus quos harum nesciunt ad eum illum
                                atque blanditiis obcaecati enim, quas amet, eveniet deleniti!
                            </p>
                            <h3 class="product-card__price">R$ 7.499,99</h3>

                            <!-- <button class="button--md button--outline">Comprar</button> -->
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer container">
            <a href="index.php" class="footer__logo">
                <img src="./assets/logo/logo-dark.svg" alt="Venda Certa logo" height="75" />
            </a>

            <p class="footer__copyright">
                © 2023 Venda Certa Ltda. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="./js/searchbar-modal.js"></script>
    <script src="./js/searchbar-dropdown.js"></script>
    <script src="./js/search-validation.js"></script>
    <script src="./js/hamburger-menu.js"></script>
    <script src="./js/input-masks.js"></script>
</body>

</html>
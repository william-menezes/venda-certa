<?php
require('./php/mysqlConnection.php');

$pdo = mysqlConnect();

try {
  $sql = <<<SQL
            SELECT Codigo, Nome FROM Categoria
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
  <link rel="stylesheet" href="./style/announcement.css" />
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
          <a href="index.php#recent-announcements" class="link--no-underline">Anúncios recentes</a>
        </li>
        <li class="navbar__link">
          <a href="index.php#categories" class="link--no-underline">Categorias</a>
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
          <a href="login.php" class="link--no-underline"><i class="bi bi-person-circle"></i></a>
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
      <form name="formSearch" action=".php/search-validation.php" method="post" novalidate>
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
                                            <option value="$category->Codigo">$category->Nome</option>
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

    <nav class="container">
      <ul class="breadcrumb list--none list--inline">
        <li class="breadcrumb__link">
          <a class="link--no-underline" href="index.php">Home</a>
        </li>
        <li class="breadcrumb__link">
          <a class="link--no-underline" href="index.php#recent-announcements">Anúncios recentes</a>
        </li>
        <li class="breadcrumb__link breadcrumb__link--active">
          <a class="link--no-underline" href="#">Macbook</a>
        </li>
      </ul>
    </nav>

    <section class="container">
      <div class="announcement">
        <div class="announcement__wrapper">
          <div class="gallery__main-img">
            <div class="mySlides">
              <img src="assets/images/products/macbook.jpg" />
            </div>

            <div class="mySlides">
              <img src="assets/images/products/iphone.jpg" />
            </div>

            <div class="mySlides">
              <img src="assets/images/products/ipad-pro.jpeg" />
            </div>

            <div class="mySlides">
              <img src="assets/images/products/macbook.jpg" />
            </div>

            <div class="mySlides">
              <img src="assets/images/products/iphone.jpg" />
            </div>

            <div class="mySlides">
              <img src="assets/images/products/ipad-pro.jpeg" />
            </div>
          </div>

          <ul class="gallery__miniatures-wrapper list--none">
            <li class="gallery__miniatures cursor" onclick="currentSlide(1)">
              <img class="demo" src="assets/images/products/macbook.jpg" alt="" />
            </li>
            <li class="gallery__miniatures cursor" onclick="currentSlide(2)">
              <img class="demo cursor" src="assets/images/products/iphone.jpg" alt="" />
            </li>
            <li class="gallery__miniatures cursor" onclick="currentSlide(3)">
              <img class="demo" src="assets/images/products/ipad-pro.jpeg" alt="" />
            </li>
            <li class="gallery__miniatures cursor" onclick="currentSlide(4)">
              <img class="demo" src="assets/images/products/macbook.jpg" alt="" />
            </li>
            <li class="gallery__miniatures cursor" onclick="currentSlide(5)">
              <img class="demo" src="assets/images/products/iphone.jpg" alt="" />
            </li>
            <li class="gallery__miniatures cursor" onclick="currentSlide(6)">
              <img class="demo" src="assets/images/products/ipad-pro.jpeg" alt="" />
            </li>
          </ul>
        </div>

        <div class="announcement__info">
          <div class="announcement__header">
            <h2 class="announcement__title">Macbook Pro 14"</h2>
            <h2 class="announcement__price">R$ 7.499,99</h2>
            <p class="announcement__description">
              Macbook Pro 8GB RAM 256GB SSD Lorem ipsum dolor sit amet,
              consectetur adipisicing elit. Id laudantium praesentium,
              ratione, repellat, suscipit temporibus ad voluptatem corrupti
              deleniti esse velit explicabo nemo doloribus porro voluptatibus
              possimus doloremque repudiandae adipisci!
            </p>
          </div>

          <!-- <button class="button--md button--primary">Comprar</button> -->

          <hr />

          <div class="announcement__location-wrapper">
            <h3 class="announcement__location">Localização</h3>

            <div class="announcement__location-column">
              <h4 class="announcement__postal-code-title">CEP</h4>
              <p class="announcement__postal-code">38400-000</p>
            </div>
            <div class="announcement__location-column">
              <h4 class="announcement__city-title">Cidade</h4>
              <p class="announcement__city">Uberlândia</p>
            </div>
            <div class="announcement__location-column">
              <h4 class="announcement__neighborhood-title">Bairro</h4>
              <p class="announcement__neighborhood">Centro</p>
            </div>
          </div>

          <div class="announcement__seller-wrapper">
            <hr />
            <h3 class="announcement__seller">Vendedor</h3>
            <p class="announcement__seller">Fulano de Tal</p>
          </div>
          <div class="chat">
            <hr />
            <h3>Pergunte ao vendedor</h3>
            <form method="post">
              <input class="input--md" type="text" name="message" id="message" placeholder="Escreva sua pergunta..." />
              <input class="input--md" type="text" name="contact" id="contact" placeholder="Contato" />
              <button type="submit" class="button--md button--primary button-icon--left">
                <i class="bi bi-chat"></i>Enviar
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="container"></section>
  </main>
  <footer class="footer--primary">
    <div class="footer__content container">
      <a href="index.php" class="footer__logo">
        <img src="./assets/logo/logo-dark.svg" alt="Venda Certa logo" height="75" />
      </a>

      <p class="footer__copyright--primary">
        © 2023 Venda Certa Ltda. Todos os direitos reservados.
      </p>
    </div>
  </footer>

  <script src="./js/searchbar-modal.js"></script>
  <script src="./js/searchbar-dropdown.js"></script>
  <script src="./js/hamburger-menu.js"></script>
  <script src="./js/gallery.js"></script>
</body>

</html>
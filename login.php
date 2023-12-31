<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./style/main.css" />
    <link rel="stylesheet" href="./style/login.css" />

    <link
      rel="shortcut icon"
      href="./assets/logo/favicon.ico"
      type="image/x-icon"
    />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <title>Login - Venda Certa</title>
  </head>
  <body>
    <main>
      <section class="container--left">
        <div class="form-wrapper w-100">
          <a href="./index.php" class="return__link"
            ><img
              src="assets/logo/logo-default.svg"
              alt="Logo do Venda Certa"
              height="62"
          /></a>

          <h2 class="form-wrapper__title">Acesse sua conta</h2>
          <p class="form-wrapper__subtitle">
            Bem-vindo de volta! Entre com os seus dados
          </p>
          <form
            class="w-100"
            name="formLogin"
            action="php/loginValidation.php"
            method="post"
            novalidate
          >
            <div class="form-field">
              <label for="email">E-mail</label>
              <input
                class="input--md"
                type="email"
                id="email"
                name="email"
                required
              />
              <span class="hint hint--error" aria-live="polite"></span>
            </div>
            <div class="form-field">
              <label for="password">Senha</label>
              <input
                class="input--md"
                type="password"
                id="password"
                name="password"
                required
              />
              <span class="hint hint--error" aria-live="polite"></span>
            </div>
            <button class="button--md button--primary w-100" type="submit">
              Entrar
            </button>
          </form>
          <p class="form-wrapper__link">
            Não tem uma conta? <a href="./signup.html">Cadastre-se</a>
          </p>

          <?php if(isset($_GET['error']) && $_GET['error']){ ?>

          <span class="message message--warning">
            <p class="message__text">Usuário ou senha inválidos!</p>
            <button
              class="fab--warning fab--sm fab"
              onclick="this.parentElement.style.display='none';"
            >
              <i class="bi bi-x"></i>
            </button>
          </span>

          <?php } ?>
        </div>
      </section>
      <section class="container--right"></section>
    </main>

    <script src="./js/login-form-validation.js"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/login-responsive.css" />
  </head>
  <body>
    
    <?php
      session_start();
      
      // Verifique se a variável de sessão de mensagem de sucesso está definida
      if (isset($_SESSION['mensagemSucesso'])) {
          echo '<div class="alert alert-success">' . $_SESSION['mensagemSucesso'] . '</div>';
          
          // Após exibir a mensagem, você pode removê-la para que ela não apareça novamente
          unset($_SESSION['mensagemSucesso']);
      }
    ?>

    <header>
      <div class="button-back">
        <a id="botaoVoltar" href="#">
          <img src="assets/voltar.png" alt="Botão de voltar" />
        </a>
      </div>
    </header>

    <div class="center">
      <h1>Bem vindo!</h1>
      <h3>Entre com seu nome e sua senha</h3>
      <form action="">
        <div class="txt_field">
          <input type="text" required />
          <label>Nome de usuário</label>
          <span></span>
        </div>
        <div class="txt_field">
          <div class="senha">
            <input type="password" required />
            <label class="senha">Senha</label>
            <span></span>
          </div>
        </div>
        <div class="sub">
          <input type="submit" value="login" />
        </div>
        <a href="esqueceu-senha.html"><div class="pass">Esqueceu sua senha?</div></a>
        <div class="signup-link">
          <a href="cadastrar.html">Ou crie uma nova conta</a>
        </div>
      </form>
    </div>

    <script src="js/page-back.js"></script>
  </body>
</html>
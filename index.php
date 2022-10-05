<?php
 include_once("config/conexao.php");
 // check to see if user is logging out
 if(isset($_GET['out'])) {
   // destroy session
   session_unset();
   $_SESSION = array();
   unset($_SESSION['user'],$_SESSION['access']);
   @session_destroy();
 }
  
 // check to see if login form has been submitted
 
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Dashboard Infra | Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/coplan.min.css">

  <script type="text/javascript" src="dist/js/particles.js"></script>
</head>



<body id="dadosForm" class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div id="particles-js"></div> <!-- particulas do Fabricio em Gradient -->
  <div class="lockscreen-wrapper">

    <div class="lockscreen-logo">
      <a href="index.php"><b>Dashboard</b>Infra</a>
    </div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="dist/img/photo2.png" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->
      <!-- lockscreen credentials (contains the form) -->


      <form id="login-usuario-form" class="lockscreen-credentials" action="" name="form" method="post"
        onsubmit="return validarLogin()">
        <span id="msg-alert-erro-login"></span>
        <div class="input-group mb-3">
          <input type="name" id="userLogin" name="userLogin" class="form-control" placeholder="Digite seu Usuário..."
            minlength="9" maxlength="30">
        </div>
        <script>
        //Função para validar o campo de login
        function validarLogin() {
          var login = document.getElementById("userLogin").value;
          let senha = document.getElementById("userPassword").value;
          if (login == "") {
            document.getElementById("msg-alert-erro-login").innerHTML =
              "<div class='alert alert-danger' role='alert'>Por favor, digite seu Usuário!</div>";
            return false;
          } else if (senha == "") {
            document.getElementById("msg-alert-erro-login").innerHTML =
              "<div class='alert alert-danger' role='alert'>Por favor, digite sua Senha!</div>";
            return false;
          }
        }
        </script>

        <div id="dados-usuario">
          <div class="input-group mb-3">
            <input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="password">
            <div class="input-group-append">
              <button id="refresh" type="submit" value="Entrar" name="Entrar" class="btn" id="btn">
                <i class="fas fa-arrow-right text-muted"></i>
              </button>
            </div>
          </div>
      </form>
      <?php
        include_once('config/conexao.php');
      //Método de acesso a ação negada
        if(isset($_GET['acao'])){
          $acao = $_GET['acao'];
        if($acao == 'negado'){
          echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Erro ao Acessar o sistema!</strong> Efetue o login ;(</div>';
           header("Refresh: 2, index.php");
          
          "<script>
            var btn = document.querySelector('#refresh');

            btn.addEventListener('click', function(e){
              e.preventDefault();
              location.reload();
            });
          </script>";
      
        }else if($acao == 'sair'){
          echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Você saiu da Agenda Eletrônica!</strong> Esperamos que você volte ;(</div>';
          header("Refresh: 0, index.php");
          
        }
      } 
       //Criação da seção de login
       ob_start();
        session_start();
        if(isset($_POST['userLogin'])){
          // run information through authenticator
          if(authenticate($_POST['userLogin'],$_POST['userPassword']))
          {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Logado com sucesso!</strong> Você será redirecionado para a agenda :)</div>';
            // authentication passed
            header("Refresh: 0, paginas/home.php?acao=bemvindo");
            exit;
            die();
          } else {
            // authentication failed
            $error = 1;
          }
        }
  
 // output error to user
 if(isset($error))
            echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Erro!</strong> login ou senha incorretos, mande um pombo correio para Infra<img src="img/pombo.png" width="50px" height="50px"/> </div>';
            header("index.php");

// output logout success
if(isset($_GET['out'])) echo "Logout successful";
         
?>
    </div>
  </div>
  <?php
    /*  <!-- /.lockscreen-item -->
      <!-- <div class="text-center">
          <a href="login.html">Ou faça login como um usuário diferente</a>

          </div> -->
    */ 
  ?>

  <div class="lockscreen-name">
    <div class="help-block text-center">
      Para acessar entre com Usuário e Senha
    </div>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2022 <b><a href="index.php" title=" Informação sobre os donos. "
        class="text-black">Antonio</a></b><br>
    Todos os direitos reservados
  </div>
  </div>


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/chart.min.js"></script>
  <script type="text/javascript" src="dist/js/app.js"></script>



</body>

</html>
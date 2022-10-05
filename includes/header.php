<?php

  ob_start();
  session_start();
  if(!isset($_SESSION['user'])&&(!isset($_SESSION['access'])&&(!isset($_SESSION['grupo'])))) {
    header("Location: ../index.php?acao=negado");
    exit;
  }
  include_once('sair.php');
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Infra Dashboard</title>
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="../plugins/bootstrap/js/bootstrap.min.js">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/coplan.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Esse Chart precisa ser carregado sempre primeiro se não ele não define os produtos -->
  <script rel="javascript" src="../plugins/chart.js/chart.min.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <link rel="stylesheet" href="../dist/css/estilo.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" title="Perfil e Saída">
            <i class="fas fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="dropdown-divider"></div>
            <a href="home.php?acao=profile" class="dropdown-item">
              <i class="fas fa-user-alt mr-2"></i></i> Alterar Senha

            </a>
            <div class="dropdown-divider"></div>
            <a href="?sair" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Sair da Dashboard

            </a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home.php?acao=bemvindo" class="brand-link">
        <span class="brand-text font-weight-light">Infra Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../img/Puto.gif" class="img-circle elevation-2"
              style="width:35px; height:35px; border-radius:50%;" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['user'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- <li class="nav-item">
              <a href="home.php?acao=bemvindo" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Principal

                </p>
              </a>
            </li> -->




            <?php
            /* Quebrando a string em Array e seletando qual array preciso acessar */
             $str = str_replace(' ','',$_SESSION["grupo"]);
             $attr = explode(',', $str);
             /* print_r($attr); */
             // Verificando se o usuário tem acesso ao menu de cadastro de usuários e Dados de Usúarios
            if(in_array('TI',$attr) || in_array('GerenciaDev',$attr)){
            ?>

            <li class="nav-item">
              <a href="home.php?acao=bemvindo" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Dados de Usúarios
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="home.php?acao=add" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                  Cadastrar Usuário
                </p>
              </a>
            </li>
            <?php
            }
            //Finalizando a verificação
            ?>

            <li class="nav-item">
              <a href="home.php?acao=report_tel" class="nav-link">
                <i class="nav-icon fas fa-solid fa-chart-area"></i>
                <p>
                  Gráfico de Telefone
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="home.php?acao=report_ethernet" class="nav-link">
                <i class="nav-icon fas fa-solid fa-chart-bar"></i>
                <p>
                  Gráfico de Ethernet
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="home.php?acao=blog" class="nav-link">
                <i class="nav-icon fa-solid fas fa-globe"></i>
                <p>
                  Blog Status
                </p>
              </a>
            </li> -->
            <!-- 
          <li class="nav-item">
            <a href="home.php?acao=kaban" class="nav-link">
              <i class="nav-icon fa-solid fas fa-globe"></i>
              <ion-icon name="push-outline"></ion-icon>
              <p>
                Kaban                
              </p>
            </a>
          </li> -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
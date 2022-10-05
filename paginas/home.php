<?php
  include_once('../includes/header.php');
    if(isset($_GET['acao'])){
      $acao = $_GET['acao'];
      if($acao == 'bemvindo'){
        include_once('../paginas/conteudo/relatorio.php');
      }elseif ($acao == 'add'){
        include_once('../paginas/conteudo/cadastro_contato.php');
      }elseif ($acao == 'profile'){
        include_once('../paginas/conteudo/perfil.php');
      }elseif ($acao == 'report_tel'){
        include_once('../paginas/conteudo/grafico_telefone.php');
      }elseif ($acao == 'report_ethernet'){
        include_once('../paginas/conteudo/grafico_ethernet.php');
      }elseif ($acao == 'blog'){
        include_once('../paginas/conteudo/blog_status.php');
       }
    }else{
      include_once('../paginas/conteudo/cadastro_contato.php');
    }
  
  include_once('../includes/footer.php');
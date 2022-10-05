<?php

if(isset($_REQUEST['sair'])){
    session_start();
session_destroy();
    header("Location: ../index.php?acao=sair");
}
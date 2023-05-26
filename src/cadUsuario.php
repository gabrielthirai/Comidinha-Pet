<?php
  session_start();
  include("../config/config.php");
  include("../classes/Db.php");
  include("../classes/Usuario.php");

  $logado = false;
  if( isset($_SESSION['logado']) ){
    if($_SESSION['logado'] == true){
        $logado = true;
    }
  }
  if ($logado == false){
      header("Location: ../index.php");
  }

  $banco = new Db();
  $banco->conectar();
  $banco->setTabela("usuarios");

  $usuario = new Usuario();

  $pagina = file_get_contents("../html/cadUsuario.html");

  if (isset($_REQUEST['bsalvar'])){
      $usuario->setCpf($_REQUEST['cpf']);
      $usuario->setSenha(md5($_REQUEST['senha']));
      $usuario->setEmail($_REQUEST['email']);
      $usuario->gravar($banco);
      $pagina = str_replace("#mensagem", 
                          "Dados Salvos!", 
                          $pagina);
  }
  header("Location: login.php");
?>

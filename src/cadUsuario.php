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

  if (!isset($_REQUEST['operacao'])){
    $pagina = str_replace("#mensagem", "", $pagina);
  }


  // no lugar de bsumit coloque o nome do seu botão
  if (isset($_REQUEST['bsalvar'])){
      $usuario->setCpf($_REQUEST['cpf']);
      $usuario->setSenha(md5($_REQUEST['senha']));
      $usuario->setEmail($_REQUEST['email']);
      $usuario->gravar($banco);
      $pagina = str_replace("#mensagem", 
                          "Dados Salvos!", 
                          $pagina);
  }

  $menu = file_get_contents("../html/menu.html");
  $pagina = str_replace("#conteudo",
                          $pagina,
                          $menu);

  echo $pagina;
?>
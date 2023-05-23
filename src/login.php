<?php

// tem que ser o primeiro comando do
// programa - prepara o ambiente sessão
session_start();

include("../config/config.php");
include("../classes/Db.php");
include("../classes/Usuario.php");

$cpf		= $_REQUEST['cpf'];
$senha	= $_REQUEST['senha'];

// abaixo junta senha com meu conteúdo forte
$senha    = $senha . $parteForte;
$senha    = md5($senha);
// echo $senha;

$banco = new Db();
$banco -> conectar();
$banco -> setTabela("usuarios"); 

$usuario = new Usuario();
$campos = "senha";
$where = "login '" . $cpf . "'";
$registro = $usuario -> consultar(
  $banco, $campos, $where
);

$existe = 0;
foreach($registro as $linha){
  if($senha == $linha["senha"]){
    $existe = 1;
  } 
}
if($existe == 1){
  $_SESSION['logado']  = true;
  $_SESSION['cpf']     = $cpf;
  header("Location: menu.php");
}else{
   header("Location: ../index.php?mensagem=Erro, tente novamente!");
}

?>
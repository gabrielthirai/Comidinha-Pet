<?php
session_start();

include("../config/config.php");
include("../classes/Db.php");
include("../classes/Usuario.php");

if (isset($_POST['cpf']) && isset($_POST['senha'])){
  $cpf		= $_POST['cpf'];
  $senha	= $_POST['senha'];
}

$senha    = md5($senha);
// echo $senha;

$banco = new Db();
$banco -> conectar();
$banco -> setTabela("usuarios"); 

$usuario = new Usuario();
$campos = "senha";
$where ="cpf = '" . $cpf . "'";
$registro = $usuario->consultar(
  $banco, $campos, $where
);
$existe = 0;
foreach($registro as $linha){
  if($senha == $linha["senha"]){
    $existe = 1;
  } 
}
if($existe == 1){
  $_SESSION['cpf']     = $cpf;
  $_SESSION['logado']  = true;
  
  header("Location: menu.php");
  exit;
}else{
   header("Location: ../index.php?mensagem=Erro, tente novamente!");
}

?>
<?php
  session_start();
  $fezLogin = false;

  if(isset($_SESSION['logado'] )){
    if($_SESSION['logado'] == true){
          $fezLogin = true;
    }
  }
  if($fezLogin == false){
    header("Location: ../index.php");
  }
  $menu = "Não foi possivel achar o menu.";
  if(file_exists("../html/menu.html")){
   $menu = file_get_contents("../html/menu.html");
   }
   echo $menu;
?>
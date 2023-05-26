<?php

  class Db {
     private $host;
     private $porta;
     private $usudb;
     private $nomedb;
     private $senhadb;
     private $conexao;
     private $tabela;


     function __construct($host="localhost",
                          $porta="3306",
                          $usudb="root",
                          $nomedb="comidinhapet",
                          $senhadb=""){
     	$this->host     = $host;
     	$this->porta    = $porta;
      $this->nomedb   = $nomedb;
     	$this->usudb    = $usudb;
     	$this->senhadb  = $senhadb;

     }

	 
 public function conectar(){
 $dados = "mysql:host="       . $this->host;
 $dados = $dados . ";port="   . $this->porta;
 $dados = $dados . ";dbname=" . $this->nomedb;
 $this->conexao = null;
 try {
	$this->conexao = new PDO($dados,
							 $this->usudb,
							 $this->senhadb);
 }
 catch(PDOException $e) {
    $mensagem  = "DB class conectar() = " . $e->getMessage();
    file_put_contents("erro.log", $mensagem, FILE_APPEND);	 
   }
}

  public function setTabela($tabela = null){
    $this->tabela = $tabela;
  }

  public function consultar($campos = null,$where = null){
    $campos = is_null($campos)?'':$campos;

    $where  = is_null($where)?'':'WHERE '.$where;

    $query = "SELECT * FROM $this->tabela $campos $where";
    return $this->executaSQL($query);

  }


  public function totalRegistros(){
      $sql = "SELECT count(*) as totalReg FROM " . $this->tabela;
      return $this->executaSQL($sql);
  }
  

  public function executaSQL($query){
	$dados = array();
    $query = trim($query);
	$resultado="";
    try{
			$this->conexao->beginTransaction();
			$resultado  = $this->conexao->query($query);
			$this->conexao->commit();
		}catch (PDOException $e) {
    		$this->conexao->rollBack();
			$resultado = null;
			$mensagem  = "db class executaSQL = " . $e->getMessage();
//file_put_contents("erro.log", $mensagem, FILE_APPEND);
    }
	if ($resultado){
	while($row=$resultado->fetch(PDO::FETCH_ASSOC))
		{
			$dados[] = $row;
		}
	}
    return $dados;

  }


  public function gravar($dados = null){
    $campos   = implode(",",array_keys($dados));
    $valores  = implode("','",array_values($dados));
    $query = "INSERT INTO ".$this->tabela." (" .
              $campos.") VALUES ('".$valores."')";
//    echo "$query<br>";
    return $this->executaSQL($query);
  }  


  public function alterar($where = null,$dados = null){

  if(!is_null($where)){
      $valores = array();
      foreach($dados as $key=>$value){
        $valores[] = $key."='".$value."'";
      }
      $valores = implode(',',$valores);
      $query = "UPDATE ".$this->tabela." SET ".
                $valores." WHERE ".$where;
//      echo "$query<br>";
//      file_put_contents("log.log", $query, FILE_APPEND);
      return $this->executaSQL($query);
  } 
  else {
         return false;
       }

  }
  
  public function excluir($where = null){
    if(!is_null($where)){
      $query = "DELETE FROM ".$this->tabela." WHERE ".$where;
//      echo "$query<br>";
      return $this->executaSQL($query);
     }
     else{
      return false;
    }
  } 
}

?>
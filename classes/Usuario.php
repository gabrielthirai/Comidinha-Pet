<?php

	class Usuario
	{
       private $idUsuario;
       private $cpf;
       private $nome;
       private $celular;
       private $email;
       private $login;
       private $senha;

 	   public function setCpf($cpf)
 	   {
 	   	  $this->cpf = $cpf;
 	   }
 	   public function setNome($nome)
 	   {
 	   	  $this->nome = $nome;
 	   }
 	   public function setCelular($celular)
 	   {
 	   	  $this->celular = $celular;
 	   }
       public function setEmail($email)
       {
          $this->email= $email;
       }
       public function setLogin($login)
       {
          $this->login = $login;
       }

       
       public function setSenha($senha)
       {
          $this->senha = $senha;
       }

       public function gravar(Db $banco)
       {
         $dados=[];
         $dados["cpf"]     = $this->cpf;
         $dados["nome"]    = $this->nome;
         $dados["celular"] = $this->celular;
         $dados["email"]   = $this->email;
         $dados["login"]   = $this->login;
         $dados["senha"]   = $this->senha;
         $retorno = $banco->gravar($dados);

       }

       public function consultar(Db $banco,
                                 $campos="*",
                                 $where)
       {
         $registros = $banco->consultar($campos, 
                                        $where);
         return $registros;
       }

       public function alterar(Db $banco, 
                                  $where, 
                                  $dados)
       {
         $retorno = $banco->alterar($where,
                                    $dados);
         return $retorno;
       }

       public function excluir(Db $banco, $where)
       {
         $retorno = $banco->excluir($where);
         return $retorno;
       }

	}

?>
<?php
    class Conexao{
        
        public function conecta($host, $usuario, $senha, $banco, $porta){
           
            $conecta = new mysqli($host, $usuario, $senha, $banco, $porta);
            
            if(mysqli_connect_errno())
            {
               echo"falha na conexão";
            }
            else 
            {  
                //echo"conectado com sucesso";
                return $conecta;
            }
        }
    }
?>
<?php
//validando a sessão 
include_once("Classes/validacao.php");

$sql = ("SELECT * from tbl_usuario where CodigoUsuario = '$idUsuario'");

if ($query = $conexao->query($sql)) {
    $linha = $query->fetch_array();
    $imagemUsuario = $linha['ImagemPerfil'];
    $nome = $linha['Nome'];
    $sobrenome = $linha['Sobrenome'];
} else {
    echo "errado";
}



if(isset($_POST['btnPublicar'])){
    $formatosPermitidos = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
    $extensao = pathinfo($_FILES['EnviarFotos']['name'], PATHINFO_EXTENSION);

   

    if(in_array($extensao, $formatosPermitidos)){
        $pasta = "usuarios/".$idUsuario."/publicacaoes";

        if(!file_exists($pasta)){
            mkdir($pasta,0777);
        }

        $temporario = $_FILES['EnviarFotos']['tmp_name'];
        $novoNome = uniqid().".$extensao";
        $diretorioFinal =  $pasta."/".$novoNome;

        if(move_uploaded_file($temporario, $diretorioFinal)){
            $sql = "Insert into tbl_publicacao (ImgemPubli, CodigoUsuario) Values('$diretorioFinal', '$idUsuario')";
            if($conexao->query($sql)){
                                                                                 
                $fotoPerfilAceita = true;


                unset($_POST["btnPublicar"]);
            }
            else{
                $mensagem = "Falha";
            }
        }
        else{
            $mensagem = "Erro no upload";
        }
    }
    else{
        $mensagem = "Extensão não aceitavel";
    }
    
}


$nome_pagina = 'Home';
include_once("layout/topo.php");
?>

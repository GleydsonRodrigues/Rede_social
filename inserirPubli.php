<?php
//validando a sessão 
session_start();
if (!isset($_SESSION['usuPubli'])) {
    header('location: home.php');
    exit();
}else{
    $idUsuario = $_SESSION['usuPubli'];
    include_once("Classes/Conecta.php");
    $conectar = new Conexao;
    $conexao = $conectar->conecta('localhost', 'root', '', 'rede_social', '3306');
}

$diretorioFinal = $_SESSION['imgPubli'];

if(isset($_POST["confirmar"])){
    $sql = "Insert into tbl_publicacao (ImgemPubli, CodigoUsuario) Values('$diretorioFinal', '$idUsuario')";
    if($conexao->query($sql)){
                                                                         
        header('Location: home.php');
        unset($_SESSION['usuPubli']);
        exit();
    }
    else{ 
        $mensagem = "Falha";
    }
}


$nome_pagina = 'confirmar';
include_once("layout/topo.php");


echo"

 ";

?>
<div class='container'>
    <div class="row">

        <div class="col-6">
            <div class='publicacoes'>
                <div class='imagemPost'>
                    <img src='<?php echo "$diretorioFinal";?>' alt='teste' width=100%>
                </div>
            </div>
        </div>
        <div class="col-6">
            <form action="" method="post">
                <input type="submit" name="confirmar" value="Confirmar">
            </form>
        </div>
    </div>
</div>   

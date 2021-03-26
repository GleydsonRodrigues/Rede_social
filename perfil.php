<?php
include("Classes/validacao.php");
$usuarioPesquisado = $_GET['UsuarioPesquisado'];


$sql = $conexao->query("SELECT * from tbl_usuario where CodigoUsuario = '$usuarioPesquisado'");

while ($linha = $sql->fetch_array()) {
    $nomePerfil = $linha['Nome'];
    $sobrenomePerfil = $linha['Sobrenome'];
    $imagemPerfil = $linha['ImagemPerfil'];
    $imagemCapa = $linha['ImagemCapa'];

}
$nome_pagina = "$nomePerfil";
include_once('layout/topo.php');
?>

<div class="container card bg-tranparent capa-perfil">
    <img class="card-img capa-perfil" src="<?php echo "usuarios/$usuarioPesquisado/$imagemCapa"; ?>" alt="Card image">
    <div class="imagem-perfil">
        <div>
<img src="<?php echo "usuarios/$usuarioPesquisado/$imagemPerfil"; ?>" alt="" class="perfil-pesquisado">
        </div>
        <div class="nome-perfil">
            <?php echo "$nomePerfil $sobrenomePerfil"; ?>
        </div>
        
    </div>
</div>
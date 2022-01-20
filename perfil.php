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
echo "";
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
            <?php echo "<p style='margin-top: 5px;'>$nomePerfil $sobrenomePerfil</p>"; ?>
        </div>
        
    </div>
</div>

<div class="container">
<div class="col-12 publicacao col-sm-7">


<?php

$sqlPubli = $conexao->query("SELECT a.CodigoUsuario, a.ImagemPerfil, a.Nome, a.Sobrenome, b.ImgemPubli  from tbl_usuario a, tbl_publicacao b where a.CodigoUsuario = b.CodigoUsuario");

while ($linha = $sqlPubli->fetch_array()) {               
    $codigoUsuPubli = $linha['CodigoUsuario'];
    $imagemPerfilPost = $linha['ImagemPerfil'];
    $imagemPubli = $linha['ImgemPubli'];
    $nome = $linha['Nome'];
    $sobrenome = $linha['Sobrenome'];

echo"
<div class='row'>
    <div class='publicacoes' style='padding: 0px;'>

        <a href='perfil.php?UsuarioPesquisado=$codigoUsuPubli'><img style='margin: 10px;' class='imagem-perfil-home' src='usuarios/$codigoUsuPubli/$imagemPerfilPost' alt='imagem Perfil' height='50px'></a>
        $nome $sobrenome
        <div class='imagemPost'>
            <img src='$imagemPubli' alt='imagem Publicação' width='100%'>

        </div>
    </div>
</div>";

}


?>

</div>
</div>

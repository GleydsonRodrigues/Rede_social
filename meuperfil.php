<?php
include("Classes/validacao.php");



$sql = $conexao->query("SELECT * from tbl_usuario where CodigoUsuario = '$idUsuario'");

while ($linha = $sql->fetch_array()) {
    $nomePerfil = $linha['Nome'];
    $sobrenomePerfil = $linha['Sobrenome'];
    $imagemPerfil = $linha['ImagemPerfil'];
    $imagemCapa = $linha['ImagemCapa'];

}

if(isset($_POST['btnCapa'])){
    $formatosPermitidos = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
    $extensao = pathinfo($_FILES['edtCapa']['name'], PATHINFO_EXTENSION);

    
    if(in_array($extensao, $formatosPermitidos)){
        $pasta = "usuarios/".$idUsuario;
        $temporario = $_FILES['edtCapa']['tmp_name'];
        $novoNome = uniqid().".$extensao";

        if(move_uploaded_file($temporario, $pasta."/".$novoNome)){
            $sql = ("UPDATE tbl_usuario SET ImagemCapa = '$novoNome' WHERE CodigoUsuario = '$idUsuario'");
            if($conexao->query($sql)){
                
                $mensagem = "Feito com sucesso, volte para a pagina de login clicando <a href='index.php'>aqui</a>";
                
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
$nome_pagina = "$nomePerfil";
include_once('layout/topo.php');
?>

<div class="container card bg-tranparent capa-perfil">
    <img class="card-img capa-perfil" src="<?php echo "usuarios/$idUsuario/$imagemCapa"; ?>" alt="Card image">
    <div class="editar-foto-capa">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="edtCapa" id="">
            <button name="btnCapa">Enviar</button>
        </form>
</div>
    <div class="imagem-perfil">
        <div>
        <img src="<?php echo "usuarios/$idUsuario/$imagemPerfil"; ?>" alt="" class="perfil-pesquisado">
        </div>
        <div class="nome-perfil">
            <?php echo "$nomePerfil $sobrenomePerfil"; ?>
        </div>
        
    </div>
</div>

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


$nome_pagina = 'Home';
include_once("layout/topo.php");
?>

<div class="container-fluid conteudo-pagina">
    <div class="row">

        <div class="col-3">
            <a href="meuperfil.php">
                <div class="side-bar">
                    <img src="<?php echo "usuarios/$idUsuario/$imagemUsuario"; ?>" alt="" class="imagem-perfil-home">
                    <?php echo "$nome $sobrenome"; ?>
                </div>
            </a>
        </div>

        <div class="col-6">

            <div class="container">
                <div class="row">
                    <div class="publicacoes">
                        <form action="">
                            <textarea name="txtPublicidade" id="" class="textoPubli" placeholder="Digite o texto da sua publicação aqui"></textarea>
                            <div class="row">
                                <div class="col-4 ">
                                    <label for="EnviarFotos" class="botao-publi">Fotos</label>
                                    <input type="file" name="EnviarFotos" id="EnviarFotos" >
                                </div>
                                <div class="col-4">
                                    <label for="EnviarVideos" class="botao-publi">Videos</label>
                                    <input type="file" name="EnviarVideos" id="EnviarVideos">
                                </div>
                                <div class="col-4">
                                    <input type="submit" name="btnPublicar" value="Publicar" class="botao-publi">
                                </div>
                        
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="publicacoes">
                            <div class="imagemPost">
                                <img src="<?php echo "usuarios/$idUsuario/$imagemUsuario"; ?>" alt="teste" width=100%>
                            </div>
                    </div>
                </div>    
            </div>
        <div class="col-3">
            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
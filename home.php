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
    $mensagemPost = $_POST['txtPublicidade'];
   

    if(in_array($extensao, $formatosPermitidos)){
        $pasta = "usuarios/".$idUsuario."/publicacaoes";

        if(!file_exists($pasta)){
            mkdir($pasta,0777);
        }

        $temporario = $_FILES['EnviarFotos']['tmp_name'];
        $novoNome = uniqid().".$extensao";
        $diretorioFinal =  $pasta."/".$novoNome;
 
        if(move_uploaded_file($temporario, $diretorioFinal)){
            $_SESSION['imgPubli'] = $diretorioFinal;
            $_SESSION['usuPubli'] = $idUsuario;
            $_SESSION['mensagemPost'] = $mensagemPost;
            header('Location: inserirPubli.php');
            exit();
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

            <div class="container" style='padding: 0px 90px;'>
                <div class="row">
                    <div class="publicacoes">
                        <form method="post" enctype="multipart/form-data">
                            <textarea name="txtPublicidade" id="" class="textoPubli" placeholder="Digite o texto da sua publicação aqui"></textarea>
                            <div class="row">
                                <div class="col">
                                    <label for="EnviarFotos" class="botao-publi">Fotos</label>
                                    <input type="file" name="EnviarFotos" id="EnviarFotos" >
                                </div>
                                <div class="col" >
                                    <input type="submit" name="btnPublicar" value="Publicar" class="botao-publi">
                                </div>
                        
                            </div>
                        </form>
                    </div>
                </div>

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
        <div class="col-3">
            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
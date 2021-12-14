<?php

session_start();
if($_SESSION['verificarFoto'] == "validado"){
    $idUsuario = $_SESSION['idusuario'];
    include("Classes/Conecta.php");
    $conectar = new Conexao;
    $conexao = $conectar->conecta("localhost", "root", "", "rede_social", "3306");
    $fotoPerfilAceita = false;
    $fotoCapaAceita = false;
    
    if(isset($_POST['enviarFotoPerfil'])){
        $formatosPermitidos = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
        $extensao = pathinfo($_FILES['foto-perfil']['name'], PATHINFO_EXTENSION);
    
       

        if(in_array($extensao, $formatosPermitidos)){
            $pasta = "usuarios/".$idUsuario;

            if(!file_exists($pasta)){
                mkdir($pasta,0777);
            }

            $temporario = $_FILES['foto-perfil']['tmp_name'];
            $novoNome = uniqid().".$extensao";

            if(move_uploaded_file($temporario, $pasta."/".$novoNome)){
                $sql = ("UPDATE tbl_usuario SET ImagemPerfil = '$novoNome' WHERE CodigoUsuario = '$idUsuario'");
                if($conexao->query($sql)){
                    
                    $fotoPerfilAceita = true;


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
    if(isset($_POST['enviarFotoCapa'])){
        $formatosPermitidos = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
        $extensao = pathinfo($_FILES['foto-capa']['name'], PATHINFO_EXTENSION);
    
        
        if(in_array($extensao, $formatosPermitidos)){
            $pasta = "usuarios/".$idUsuario;
           
            $temporario = $_FILES['foto-capa']['tmp_name'];
            $novoNomeC = uniqid().".$extensao";
    
            if(move_uploaded_file($temporario, $pasta."/".$novoNomeC)){
                $sql = ("UPDATE tbl_usuario SET ImagemCapa = '$novoNomeC' WHERE CodigoUsuario = '$idUsuario'");
                if($conexao->query($sql)){

                    $fotoCapaAceita = true;
                    echo "Feito com sucesso, volte para a pagina de login clicando <a href='index.php'>aqui</a>";
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




}else{
    header('location: Cadastro.php');
}
//incluair a função que conecta com o banco de dados


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro</title>
</head>

<body>
    
    <div class="container">
        <div class="conteudo">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="foto-de-perfil">foto Perfil</label>
                <input type="file" name="foto-perfil" id="foto-de-perfil">
                <button type="submit" name="enviarFotoPerfil">Enviar</button>
            </form>
            <div class="img-previewPerfil" >
                <?php 
                
                if($fotoPerfilAceita){
                    echo "<img src='usuarios/$idUsuario/$novoNome' class='imgPerfil-preview' style='border-color: black 1px;
                    height: 300px;
                    width: 300px;'>";
                }
                
                ?>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="foto-capa">foto Capa</label>
                <input type="file" name="foto-capa" id="foto-capa">
                <button type="submit" name="enviarFotoCapa">Enviar</button>
            </form>
            <div class="img-previewCapa" >
                <?php 
                
                if($fotoCapaAceita){
                    echo "<img src='usuarios/$idUsuario/$novoNomeC' class='imgCapa-preview' style='border-color: black 1px;
                    height: 300px;
                    width: 300px;'>";
                }
                
                ?>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
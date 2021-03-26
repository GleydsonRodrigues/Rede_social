
<?php 
//validando a sessão
session_start();
if ($_SESSION['validacao'] == "Validado") {
    //conectando com o banco de dados
    $idUsuario = $_SESSION['usuario'];
    include_once("Conecta.php");
    $conectar = new Conexao;
    $conexao = $conectar->conecta('localhost', 'root', '', 'rede_social', '3306');
} 

else {
    //caso o usuario não possua a validação da sessão, envia-lo para a pagina de login
    header('location: index.php');
}

//sair da sessão
if (isset($_GET['btnSair'])) {
    $_SESSION['validacao'] = 'invalido';
    header('location: index.php');
}
?>

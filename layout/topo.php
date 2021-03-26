<?php
//fazer a pesquisa
if (isset($_POST['btnPesquisa'])) {
    $pesquisa = $_POST['pesquisa'];

    $sql = $conexao->query("SELECT * from tbl_usuario where Nome like '%$pesquisa%' or sobrenome like '%$pesquisa%'");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $nome_pagina; ?></title>
</head>

<body>
    <nav class="navbar menu-principal">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="home.php">GR</a>
            <form class="form-inline" method="POST" action="pesquisa.php">
                <div class="row">
                    <div class="col-8"><input class="form-control" name="pesquisa" type="search" placeholder="Pesquisar" aria-label="Pesquisar"></div>
                    <div class="col-4"><button class="btn botao-home" name="btnPesquisa" value="pesquisar" type="submit">Pesquisar</button></div>
                </div>
            </form>
            <form class="form-inline">
                <button class="btn botao-home" type="submit" name="btnSair">Sair</button>

            </form>
        </div>

    </nav>
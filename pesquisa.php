<?php
//validando a sessão 
include_once("Classes/validacao.php");
$nome_pagina = 'Pesquisa';
include_once("layout/topo.php");
?>
<div class="container-fluid conteudo-pagina">
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-7">
            <form action="perfil.php" method="GET">
                <?php
                //fazendo uma lista com a pesquisa feita pelo usuario
                while ($linha = $sql->fetch_array()) {
                    $idPerfilUsuario = $linha['CodigoUsuario'];
                    $imagemPerfil = $linha['ImagemPerfil'];
                    $nome = $linha['Nome'];
                    $sobrenome = $linha['Sobrenome']; ?>
                    
                    <button name="UsuarioPesquisado" value="<?php echo $idPerfilUsuario; ?>" class="usuario-pesquisado">
                        <div class="caixa-de-pesquisa">
                            <img src="<?php echo "usuarios/$idPerfilUsuario/$imagemPerfil";
                            $_SESSION['usuarioPesquisado'] = $idPerfilUsuario; ?>" alt="" class="imagens-em-pesquisa">
                            <?php echo "$nome $sobrenome"; ?>
                        </div>
                    </button> <?php } ?>
            </form>
        </div>
        
        <div class="col">

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
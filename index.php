<?php
//fazer a conexão com o banco de dados
include("Classes/Conecta.php");
$conectar = new Conexao;
$conexao = $conectar->conecta("localhost", "root", "", "rede_social", "3306");


if (isset($_POST["email"])) {

    //pegar os valores passados no banco de dados
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    //fazer a consulta no banco de dados onde o email passado pelo usuario seja igual ao tinha no banco de dados
    $pegaEmail = $conexao->query("SELECT * FROM tbl_usuario WHERE email = '$email'");

    //transformando o email encontrado no banco de dados e array
    if ($linha = $pegaEmail->fetch_array()) {
        //pegando a senha onde o email seja o mesmo informado pelo usuario
        $senhaVerificar = $linha["Senha"];
        //verificando a senha informada pelo usuario com aquela encontrada no banco dedados
        if ($senha == $senhaVerificar) {
            //echo "tudo certo";

            //transferindo o usuario para zona restrita validando a sessão
            $idUsuario = $linha["CodigoUsuario"];
            session_start();
            $_SESSION['validacao'] = "Validado";
            $_SESSION['usuario'] = $idUsuario;
            header('Location: home.php');
            exit();
        } else {
            $mensagem = "Email ou senha incorretos";
        }
    } else {
        $mensagem = "Email ou senha incorretos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleLoginCadastro.css">
    <title>Login</title>
</head>

<body>
   
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="imagem-principal">
                    <img src="img/imagem-modelo.png" alt="">
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form">
                    <div>
                        <div class="texto-login">
                            <p class="h2">Login</p>
                        </div>
                        <form action="" method="post">

                            <div class="form-group row coluna-form">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control input" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group row coluna-form">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control input" placeholder="Senha" name="senha">
                                </div>
                            </div>
                            <div class="row botoes-login">
                                <div class="col-12">
                                    <button class="btn botao" type="submit" nome="entrar">Entrar</button>
                                </div>
                                <div class="col-12 texto-cadastre-se">
                                    Caso não possua uma conta: <a href="Cadastro.php">Cadastre-se</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
        
            <?php 
            if (isset($_POST["email"])){

                echo "
                <div class='alert alert-danger' role='alert'>
                $mensagem
                </div> 
                ";
            }
            ?>
       
    </div>





    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
<?php
//incluair a função que conecta com o banco de dados
include("Classes/Conecta.php");
$conectar = new Conexao;
$conexao = $conectar->conecta("localhost", "root", "", "rede_social", "3306");

if (isset($_POST["nome"])) {
    if(!empty($_POST['nome']) && !empty($_POST['sobrenome']) && !empty($_POST['email']) && !empty($_POST['senha'])){
    //pegar os valores passados pelo formulario
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);
    $confSenha = md5($_POST["confsenha"]);

    $mensagemAcao = "verdade";
    //conferir se a senha e o confirmar senha são iguais
    if ($senha == $confSenha) {

        //fazer a consulta no banco onde o email passado seja igual a algum que tenha nos registros
        $pegaEmail = $conexao->query("SELECT * FROM tbl_usuario WHERE email = '$email'");


        //vendo se já existe email cadastrado
        if (mysqli_num_rows($pegaEmail) != null) {
            $mensagem = " <div class='alert alert-danger' > Email já existe cadastrado </div>";
        }

        //se não existir nenhum email cadastrado
        else {
            //inserir no banco de dados
            $sql = "INSERT INTO tbl_usuario (Nome, Sobrenome, Email, Senha) Values ('$nome','$sobrenome','$email','$senha')";

            if ($conexao->query($sql)) {
                session_start();
                $_SESSION['verificarFoto'] = "validado";
                $levandoId = $conexao->query("SELECT * FROM tbl_usuario WHERE email = '$email'");

                $linha = $levandoId->fetch_array();
                $_SESSION['idusuario'] = $linha['CodigoUsuario'];
               
                header('location: cadastrofoto.php');
                //echo"<iframe src='cadastrofoto.php' frameborder='0' width='100%' height='100%'></iframe>";
                //$mensagem = " <div class='alert alert-success' > Cadastrado com sucesso <a href='index.php'> Clique aqui para Logar </a> </div>";
            } else {

                $mensagem = " <div class='alert alert-danger' > Falha no cadastro </div>";
            }
        }
    } else {
        $mensagem = " <div class='alert alert-danger' > Senha e confirmar senha estão diferentes </div>";
    }


    }else{
        $mensagem = " <div class='alert alert-danger' > Todos os campos tem que estar preenchidos </div>";
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
    <link rel="stylesheet" href="css/styleLogin.css">
    <title>Cadastro</title>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="form">
                <div class="form-no-meio-da-tela">
                    <div class="">
                        <p class="h2">Cadastro</p>
                    </div>
                    <form action="Cadastro.php" method="post">
                        <div class="col-9">

                            <div class="form-group row coluna-form">
                                <div class="col-6">
                                    <input type="text" class="form-control input" placeholder="Nome" name="nome">
                                </div>


                                <div class="col-6">
                                    <input type="text" class="form-control input" placeholder="Sobrenome" name="sobrenome">
                                </div>

                            </div>
                            <div class="form-group row coluna-form">
                                <div class="col-12">
                                    <input type="email" class="form-control input" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group row coluna-form">
                                <div class="col-6">
                                    <input type="password" class="form-control input" placeholder="Senha" name="senha">
                                </div>
                                <div class="col-6">
                                    <input type="password" class="form-control input" placeholder="Confirmar Senha" name="confsenha">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn botao" type="submit" value="cadastrar" name="btnCadastrar">Entrar</button>
                            </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["nome"])) {
            echo $mensagem;
        }

        ?>


    </div>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
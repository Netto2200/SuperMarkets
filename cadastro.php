<?php
session_start();
//conexão
require_once('conexao.php');

$erros = array();
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING );
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING );
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING );
$confirmasenha = filter_input(INPUT_POST, 'confirma_senha', FILTER_SANITIZE_STRING);
$senha = md5($senha);
$confirmasenha = md5($confirmasenha);
//echo "Nome: $nome<br>";
//echo "Email: $login<br>";
//echo "Senha: $senha<br>";

if(empty($nome) or empty($login) or empty($senha) or empty($confirmasenha)):
    $erros[] = "<p> Prencha todos os campos</p>";
elseif($senha != $confirmasenha):
    $erros[] = "<p>Senhas não conferem</p>";
else:
    $sql = "INSERT INTO usuarios (nome, login, senha, confirma_senha) VALUES ('$nome', '$login' ,'$senha', '$confirmasenha')"; 
    $resultado = mysqli_query($conexao, $sql);
    endif;
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Meta tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="_css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Titulo -->
    <title>Cadastro | SuperMarkets</title>
</head>

<body>
    <main>
        <header>
            <picture>
                <img src="_img/logowhite.png" class="rounded mx-auto d-block" id="logo">
            </picture>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <img src="_img/cadastro.png" id="ilustracao-cadastro">
                </div>
                <div class="col-md-auto">

                </div>
                <div class="col-4 rounded" id="login">
                    <div class="card-title">
                        <h2 class="mx-auto">Cadastre-se para fazer suas compras</h2>
                        <?php
                          if(!empty($erros)):  
                            foreach($erros as $erros):
                                echo $erros;
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <form id="cadastro" action = "<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <div class="form-group mx-auto">
                            <input type="name" class="form-control" id="inputName" placeholder="Nome" name="nome">
                        </div>
                        <div class="form-group mx-auto">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="login">
                        </div>
                        <div class="form-group mx-auto">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Crie uma senha" name="senha">
                        </div>
                        <div class="form-group mx-auto">
                            <input type="password" class="form-control" id="inputCPassword" placeholder="Confirme a senha" name="senha_confirma">
                        </div>
                        <div class="form-group mx-auto">
                            <button type="submit" class="mx-auto btn btn-danger" name="btn-cadastro">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

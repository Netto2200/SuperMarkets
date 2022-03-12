<?php
//conexão
require_once('conexao.php');
//sessão 
session_start();
//botao
    if(isset($_POST['btn-entrar'])):
        $erros = array();
        $login = mysqli_escape_string($conexao, $_POST['login']);
        $senha = mysqli_escape_string($conexao, $_POST['senha']);

        if(isset($_POST['lembrar-senha'])):

            setcookie('login', $login, time()+3600);
            setcookie('senha', md5($senha), time()+3600);
        endif;

        if(empty($login) or empty($senha)):
            $erros[] = "<p> O campo login/senha precisa ser preenchido!<p>";
        
            else:   
                $sql = "SELECT login FROM usuarios WHERE login = '$login'";
                $resultado = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($resultado) > 0):
                $senha = md5($senha);
                $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";

                $resultado = mysqli_query($conexao, $sql);

                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($conexao);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario']  = $dados['id'];
                    header('Location: home.php');
                    else:
                        $erros[] = "<p>Usuario e senha não conferem</p>";    
                endif;
                else:
                    $erros[] = "<p> Usuario inexistente </p>";
            endif;
        endif;
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
    <title>Login | SuperMarkets</title>
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
                    <img src="_img/Ilustration.png" id="ilustracao">
                </div>
                <div class="col-md-auto">

                </div>
                <div class="col-4 rounded" id="login">
                    <div class="card-title">
                        <h2 class="mx-auto">Logue para fazer suas compras</h2>
                        <?php
                          if(!empty($erros)):  
                            foreach($erros as $erros):
                                echo $erros;
                            endforeach;
                        endif;
                        ?>
                    </div> 
                    
                    <form action"<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <div class="form-group mx-auto">
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Email" name="login">
                        </div>
                        <div class="form-group mx-auto">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Senha" name="senha">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="Lembrar">
                            <label class="form-check-label" for="Lembrar">Lembrar senha</label>
                        </div>
                        <div class="form-group mx-auto">
                            <button type="submit" name="btn-entrar" class="mx-auto btn btn-danger">Logar</button>
                        </div>
                    </form>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            <span>Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="Recuperacao.html">Esqueceu sua senha?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
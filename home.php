<?php
require_once('conexao.php');
session_start();
//verificação
if(!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;
//dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ola <?php echo $dados ['nome'];?></h1>
    <a href="logout.php">Sair</a>
</body>
</html>

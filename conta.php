<?php
session_start();
if (!isset($_SESSION["id_cliente"])) {
   die("Você não está logado. Por favor faça login antes de prosseguir: <p><a href=\"login.php\">Login</a></p>");
}
if (isset($_POST['sair'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
    die; 
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da conta</title>
</head>

<body>
    <link rel="stylesheet" href="css/conta.css">
<header>
    <div class="logo">
        <img src="/img/logo.png" alt="">
    </div>
    <p>Kids store</p>
 </header>

<div class="main-content">
     <h1>Olá <?php echo $_SESSION["nome"];?>, tudo bem?</h1>
    <div class="info">
      <h3>Informações de cadastro:</h3>
      <p>CPF:  <?php echo $_SESSION["cpf"];?></p>
      <p>email:  <?php echo $_SESSION["email"];?></p>
    </div>
   
    <form method="POST">
        <button name="sair" id="sair">Sair</button>
        

    </form>
    <a href="javascript:history.back()"><button id="voltar">Continuar Comprando </button></a>
</div>
   
</body>
</html>
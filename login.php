<?php
include_once "conexao.php";

if(isset($_POST['entrar'])){
    if ($_POST['email'] == null || $_POST['senha'] == null) {
       echo "<script>alert('preencha os campos corretamente');</script>";
    // echo "PREENCHA OS CAMPOS CORRETAMENTE";
    }else {
        $email = htmlspecialchars($_POST['email']);
        $senha = htmlspecialchars($_POST['senha']);
        $sql = "SELECT * FROM clientes WHERE email = '".$email."' AND senha = '".$senha."'";

        
        $comando = $pdo->prepare($sql);
        $comando->execute();

        
    
        $cliente = $comando->fetch();
        if($cliente){
            session_start();
            $_SESSION['nome'] = $cliente['nome'];
            $_SESSION['email'] = $cliente['email'];
            $_SESSION['cpf'] = $cliente['cpf'];
            $_SESSION['id_cliente'] = $cliente['id_cliente'];
    
            //teste
            $procura_carrinho = "SELECT * FROM venda WHERE id_cliente = :id_cliente ;";
            $comando = $pdo->prepare($procura_carrinho);
            $comando->bindParam(":id_cliente", $_SESSION['id_cliente']);
            $comando->execute();
            $teste= $comando->fetch();
            if (!$teste) {
                // cria carrinho
                $inserir_carrinho = "INSERT INTO venda(id_cliente) VALUES (:id_cliente)";
                $comando2 = $pdo->prepare($inserir_carrinho);
                $comando2->bindParam(":id_cliente", $_SESSION['id_cliente']);
                $comando2->execute();
            }
            
            
            header("Location: home.php");
            exit;
        }else{
            // echo "EMAIL OU SENHA INCORRETOS";
            echo "<style>#erroLogin{display:block !important; text-decoration: underline;
    color: red; }</style>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINKS -->
     <link rel="stylesheet" href="/css/login.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Yeseva+One&display=swap" rel="stylesheet">
     <link rel="icon" type="image/x-icon" href="/img/logo.png">
     <!-- FIM DOS LINKS -->
    <title>Login page</title>
</head>
<body>
    <main class="container">
        <form method="POST" >
            <header>
                <img src="/img/dog.png" alt="">
                <h1>Login</h1>
            </header>
            
              <div class="input-box">
                <input placeholder="Email" id="email" name="email" type="email" required>
                   <i class="bi bi-person-fill"></i>
              </div>

              <div class="input-box">
                <input placeholder="Senha" id="senha" name="senha" type="password" required>
                  <i class="bi bi-lock-fill"></i>
              </div>

             <div class="remerber-forgot">
                <label>
                    <input type="checkbox">
                    Lembrar a senha
                </label>
                    <p id="erroLogin">EMAIL OU SENHA INCORRETOS</p>
                
                 
             </div>

                <button name="entrar" type="submit" class="login"><a class="logi">Entrar</a></button>

                <div class="register-link">
                    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a> </p>
                </div>
        </form>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script></body>
</html>

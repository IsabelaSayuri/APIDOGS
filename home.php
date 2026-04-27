<?php 
require_once "conexao.php";
session_start();
$sql_produto="SELECT produto.*, fornecedores.nome AS nome_fornecedor, categorias.nome AS nome_categoria FROM produto 
   INNER JOIN fornecedores ON produto.id_fornecedor = fornecedores.id_fornecedor
   INNER JOIN categorias ON produto.id_categoria = categorias.id_categoria"
   ;
   $comando = $pdo->prepare($sql_produto);
   $comando->execute();
if (!isset($_SESSION["id_cliente"])) {
   die("Você não está logado. Por favor faça login antes de prosseguir: <p><a href=\"login.php\">Login</a></p>");

}
?>
    <form method="POST"></form>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
    <title>Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" src="/img/LogoPreto.svg\" >
</head>

<body class="categorias">
    <header>
         <div class="logo">
            <img src="/img/logo.png" alt="">
        </div>
           <p>PetsMog</p>

           <div class="search">
             <!-- <img src="/img/pesquisa.png" alt="pesquisa"> -->
             <a href="carrinho.php">Cadastrar<img src="/img/dog.png"></a>
             <a href=".php">Entrar</a>
           </div>
    </header>

    <nav>
        <ul>
            <li>
               <div class="aSelecionado"><a href="home.php">Home
               </a></div>
                <a href="doar.php">Doar</a>
            </li>
        </ul>
    </nav>

        <div class="banner">
            <div class="titulo">
                <h1>Adote com amor, ele vem com patas</h1>
                <p>Encontre agora mesmo seu melhor amigo</p>
            </div>
            
            <img src="/img/dog.jpg" alt="" srcset="">
            <!-- https://www.hm.com.br/_next/image?url=https%3A%2F%2F
             hmbrasil.vtexassets.com%2Farquivos%2Fids%2F5196339%2F113
             9368008-1.jpg%3Fv%3D638978524490830000&w=1440&q=80 -->
             <!-- <img src=""> -->
        </div>

     <h2>Dê o primeiro passo para um novo laço...</h2>

    <div class="container">


        <!-- <div><img src="/img/short.webp" alt="short"></div>  -->
        <!-- https://www.hm.com.br/_next/image?url=https%3A%2F%2Fhmbrasil
        .vtexassets.com%2Farquivos%2Fids%2F3219550%2F1272332002-1.j
        pg%3Fv%3D638937422826770000&w=1440&q=80 -->
        
         <!-- <div><img src="/img/macacao.webp" alt="macacao"></div>  -->
        <?php 
        $contagem = 0;
        while($produto = $comando->fetch()){
            if ($contagem == 0) {
               echo "<div class=\"linha\">";

            }
        ?>
    <a href="page_produto.php?id=<?php echo $produto['id_produto'];?>" >
        <div class="card">
            
                <img src="<?php echo $produto["imagemurl"]; ?>" alt="">
                <p><?php echo $produto ["nome"]; ?></p>
                <p class="preco"> R$<?php echo number_format($produto["preco_produto"], 2, ',', '.');?></p>
        </div>
    </a>
        <p><?php $contagem ?></p>
        <?php
        $contagem+=1;
            if ($contagem == 3) {
                echo "</div>";
                $contagem = 0;
            }
        ?>
        <?php }?>
        
    </div>

</body>
</html>
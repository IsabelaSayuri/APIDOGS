<?php
require_once "conexao.php";
$sql_fornecedor ="SELECT * FROM fornecedores";
$comando1 = $pdo->prepare($sql_fornecedor);
$comando1->execute();

$sql_categoria ="SELECT * FROM categorias";
$comando2 = $pdo->prepare($sql_categoria);
$comando2->execute();

$sql_produto="SELECT produto.*, fornecedores.nome AS nome_fornecedor, categorias.nome AS nome_categoria FROM produto 
INNER JOIN fornecedores ON produto.id_fornecedor = fornecedores.id_fornecedor
INNER JOIN categorias ON produto.id_categoria = categorias.id_categoria"
;
$comando = $pdo->prepare($sql_produto);
$comando->execute();
if(isset($_POST['deletar'])){
    $id_deletar = intval($_POST['id_deletar']);

    $testar_del = "SELECT * FROM produto WHERE id_produto = '$id_deletar'" ;
    $testar_del = $pdo->prepare($testar_del);
    $testar_del->execute();
    $apagar = $testar_del->fetch();
    if(!$apagar){
        echo "<h1>Esse Produto não existe</h1>";
    
    }else {
        $sql_deletar = "DELETE FROM produto WHERE id_produto = '$id_deletar'";
        $deletar = $pdo->prepare($sql_deletar);
        $deletar->execute();
        header("Location: cadastrar_produto.php");
        exit;
    }
};

if (isset($_POST['cadastrar'])) {
//passando form pras variaveis 
    $nome = strtoupper(htmlspecialchars($_POST['nomeanimal']));
    $fornecedor_id = intval(htmlspecialchars($_POST['especie']));
    $categoria_id = intval(htmlspecialchars($_POST['sexo']));
    $descricao = htmlspecialchars($_POST['idade']);
    $tamanho = strtoupper($_POST['estado']);
    $imagemurl = htmlspecialchars($_POST['cidade']);
     $comando2->bindParam(":imagemurl", $imagemurl);

//testar se produto já existe
    $teste = "SELECT * FROM produto WHERE nome = '$nome'" ;
    $testar = $pdo->prepare($teste);
    $testar->execute();
    $produto = $testar->fetch();
    if($produto){
        echo "<h1>Esse Produto já foi cadastrado</h1>";
    }else{

        $sql = "INSERT INTO produto (nomeanimal, especie, sexo, idade, estado, cidade, imageurl)" .
        "VALUES (:nomeanimal, :especie, :sexo, :idade, :estado, :cidade, :imagemurl);";

        $comando2 = $pdo->prepare($sql);
        $comando2->bindParam(":nomeanimal", $nomeanimal);
        $comando2->bindParam(":especie", $especie);
        $comando2->bindParam(":sexo", $sexo);
        $comando2->bindParam(":idade", $idade);
        $comando2->bindParam(":estado", $estado);
        $comando2->bindParam(":cidade", $cidade);
        $comando2->bindParam(":imagemurl", $imagemurl);

        $comando2->execute();

        header("Location: cadastropet.php");
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <link rel="stylesheet" href="css/cadastropet.css">
    <title>Cadastro de pets</title>
    <style>
        img{
            height:100px;
        }
    </style>
</head>
<body>
<a href="funcionario_home.php">voltar</a>
    <h1 class="title">Adicionar Pet</h1>
    <form method="POST">
        
        <div class="container">

        
        <label for="nomeanimal">NOME:</label>
        <input type="text" name="nomeanimal" id="nomeanimal" require>

        <br>

        <label for="descricao">ESPÉCIE:</label>
        <textarea name="especie" id="despecie" require></textarea>

        <br>

        <label for="tamanho">SEXO:</label>
        <br>
        <label for="F">FÊMEA</label>
        <input type="radio" name="tamanho" value="F" id="F">
        <br>
        <label for="M">MACHO</label>
        <input type="radio" name="tamanho" value="M" id="M">
        <br>
       
        <br>
        <label for="estoque">IDADE:</label>
        <input type="number" name="idade" id="idade" min="0" max="100" require>
        <br>

        <label for="estado">ESTADO:</label>
        <select name="estado" id="estado" required>
             <option value="" disabled selected></option>
         
             <option value="AC">ACRE</option>
             <option value="AL">ALAGOAS</option>
             <option value="AP">AMAPÁ</option>
             <option value="AM">AMAZONAS</option>
             <option value="BA">BAHIA</option>
             <option value="CE">CEARÁ</option>
             <option value="DF">DISTRITO FEDERAL</option>
             <option value="ES">ESPÍRITO SANTO</option>
             <option value="GO">GOIÁS</option>
             <option value="MA">MARANHÃO</option>
             <option value="MT">MATO GROSSO</option>
             <option value="MS">MATO GROSSO DO SUL</option>
             <option value="MG">MINAS GERAIS</option>
             <option value="PA">PARÁ</option>
             <option value="PB">PARAÍBA</option>
             <option value="PR">PARANÁ</option>
             <option value="PE">PERNAMBUCO</option>
             <option value="PI">PIAUÍ</option>
             <option value="RJ">RIO DE JANEIRO</option>
             <option value="RN">RIO GRANDE DO NORTE</option>
             <option value="RS">RIO GRANDE DO SUL</option>
             <option value="RO">RONDÔNIA</option>
             <option value="RR">RORAIMA</option>
             <option value="SC">SANTA CATARINA</option>
             <option value="SP">SÃO PAULO</option>
             <option value="SE">SERGIPE</option>
             <option value="TO">TOCANTINS</option>
             </select>

         <br>
        <label for="estoque">CIDADE:</label>
        <input type="number" name="cidade" id="cidade" require>
        <br>
        <label for="imagem">IMAGEM:</label>
        <input type="url" name="imagem" id="imagem" require>
        <br>
        <br>
        <button type="submit" name="cadastrar">CADASTRAR</button>
        </div>
 </form>
    
    
        <h1>REMOVER PET ADOTADO</h1>
    <div class="gomi">
    <form method="POST">
        <label for="id_deletar">ID:</label>
        <input type="number" name="id_deletar" id="id_deletar" required>
        <button name="deletar" type="submit">REMOVER PET</button>
    </form>
    </div>
    
    <h1>PETS CADASTRADOS:</h1>
    <table border="1" id="tabelinha">
        <tr>
            <th>ID</th>
            <th>NOME PET</th>
            <th>ESPÉCIE</th>
            <th>SEXO</th>
            <th>IDADE</th>
            <th>ESTADO</th>
            <th>CIDADE</th>
            <th>IMAGEM</th>
        </tr>
        <?php 
        
        while($produto = $comando->fetch()){
        ?>
        <tr>
            <td><?= $produto["id"] ?></td>
            <td><?= $produto["nomeanimal"] ?></td>
            <td><?= $produto["especie"] ?></td>
            <td><?= $produto["sexo"] ?></td>
            <td><?= $produto["idade"] ?></td>
            <td><?= $produto["estado"] ?></td>
            <td><?= $produto["cidade"] ?></td>
            <td><img src="<?php echo $produto["imagemurl"] ?>" alt=""></td>
        </tr>
    </table>
</body>
</html>
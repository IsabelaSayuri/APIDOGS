<?php

try {
    $pdo = NEW PDO('sqlite:fateckids.sqlite3');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOexception $erro) {
    echo $erro->getMessage();
    exit;
}
$comando1 = "CREATE TABLE IF NOT EXISTS clientes (" . 
"id_cliente INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL," .
"nome TEXT," .
"cpf TEXT," .
"email TEXT," .
"senha TEXT )";
$pdo->exec($comando1);
$comando1 = "CREATE TABLE IF NOT EXISTS fornecedores(" .
"id_fornecedor INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, " .
"nome TEXT NOT NULL,  " .
"contato TEXT NOT NULL ); ";
$pdo->exec($comando1);

$comando1 = "CREATE TABLE IF NOT EXISTS funcionarios(" .
"id_funcionario INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, " .
"nome TEXT NOT NULL, cargo CHAR(50),".
"usuario TEXT NOT NULL, ".
"senha TEXT NOT NULL ); ";
$pdo->exec($comando1);
$master ="INSERT OR IGNORE INTO funcionarios (nome, usuario, senha) VALUES ('master', 'master', 'master');";
$pdo->exec($master);
$comando1 = "CREATE TABLE IF NOT EXISTS categorias (".
"id_categoria INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ".
"nome TEXT NOT NULL ); ";
$pdo->exec($comando1);

$comando1 = "CREATE TABLE IF NOT EXISTS produto(" . 
"id_produto INTEGER PRIMARY KEY AUTOINCREMENT," .
"id_fornecedor INTEGER,".
"id_categoria INTEGER,".
"nome TEXT NOT NULL,".
"descricao TEXT,".
"tamanho TEXT NOT NULL, ".
"imagemurl TEXT,".
"cor TEXT,".
"estoque INTEGER DEFAULT 0 NOT NULL,".
"preco_produto DECIMAL NOT NULL,".
"genero TEXT CHECK (genero IN ('Masculino', 'Feminino', 'Unissex')),".
"FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id_fornecedor),".
"FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) );";

$pdo->exec($comando1);

$comando1 = "CREATE TABLE IF NOT EXISTS venda ( ".  
"id_venda INTEGER PRIMARY KEY AUTOINCREMENT,  ".
"id_cliente INT, " .
"data_venda DATE,".  
"preco_final DECIMAL,". 
"FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)) ; ";

$pdo->exec($comando1);

$comando1 = "CREATE TABLE IF NOT EXISTS item_pedido ( ". 
"id_itempedido INTEGER PRIMARY KEY AUTOINCREMENT," .
"id_venda INT, ".
"id_produto INT," . 
"quantidade INT NOT NULL, " .
"preco_pedido DECIMAL NOT NULL," .
"FOREIGN KEY (id_venda) REFERENCES Venda(id_venda)," .
"FOREIGN KEY (id_produto) REFERENCES Produto(id_produto) );";

$pdo->exec($comando1);

$inserir = "INSERT INTO clientes (nome, cpf, email, senha) " .
" VALUES ('auto', '11111', 'auto@auto', '1234')";


;
?>

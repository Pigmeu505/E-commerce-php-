<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "login_db";    

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

$cart = json_decode($_POST['cart']);  
$nome_cliente = $_POST['nome_cliente']; 
$cep = $_POST['cep'];  
$total_price = $_POST['total_price']; 

$sql = "INSERT INTO compras (nome_cliente, data_compra, total_price) 
        VALUES ('$nome_cliente', NOW(), '$total_price')";

if ($conn->query($sql) === FALSE) {
  echo "Erro ao inserir dados: " . $conn->error;
  exit();
}

$compra_id = $conn->insert_id;

foreach ($cart as $produto) {
  $produto_id = $produto->id;
  $nome_produto = $produto->name;
  $quantidade = $produto->quantity;
  $preco = $produto->new_price;

  $sql_produto = "INSERT INTO produtos_comprados (compra_id, produto_id, nome_produto, quantidade, preco) 
                  VALUES ('$compra_id', '$produto_id', '$nome_produto', '$quantidade', '$preco')";

  if (!$conn->query($sql_produto)) {
    echo "Erro ao inserir dados: " . $conn->error;
    exit();
  }
}

$conn->close();

echo "Compra processada com sucesso!";
?>

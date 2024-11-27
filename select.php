<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "compras"; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produtos'])) {
    foreach ($_POST['produtos'] as $idProduto => $vendedor) {
        // Verifique se o cookie já existe para o produto
        if (isset($_COOKIE[$idProduto])) {
            // Adiciona o valor ao total atual do cookie
            $novoValor = $_COOKIE[$idProduto] + 1;
            setcookie($idProduto, $novoValor, time() + (86400 * 30), "/"); // 30 dias de expiração
        } else {
            // Se não existir, cria o cookie com o valor inicial
            setcookie($idProduto, 1, time() + (86400 * 30), "/"); // Produto no carrinho com quantidade 1
        }
    }
}

// Consulta para buscar os produtos disponíveis
$sql = "SELECT id, descricao, vendedor, imagem, valor FROM vendas";
$result = $conn->query($sql);

if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="assets/logo.png" alt="">
            </div>
            <h1>Printe</h1>
        </div>
    </nav>
    
    <main>
        <h1>Selecione os Produtos</h1>
        
        <form method="POST" action="select.php">
            <div id="produtos">
                <?php
                if ($result->num_rows > 0) {
                    // Exibe os produtos
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="produto">
                            <img src="assets/<?php echo htmlspecialchars($row['imagem']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['descricao']); ?>" width="100" height="100">
                            <p><?php echo htmlspecialchars($row['descricao']); ?></p>
                            <p>R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?></p>
                            <input type="checkbox" 
                                   name="produtos[<?php echo htmlspecialchars($row['id']); ?>]" 
                                   value="<?php echo htmlspecialchars($row['vendedor']); ?>">
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Nenhum produto encontrado.</p>";
                }
                ?>
            </div>

            <div class="button-container">
                <button type="submit">Adicionar ao Carrinho</button>
            </div>
        </form>
    </main>
    
    <footer>
        <p>Sobre nós</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

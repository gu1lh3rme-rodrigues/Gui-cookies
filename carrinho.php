<!DOCTYPE html>
<html lang="pt-br">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Carrinho</title>
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="assets/logo.png" alt="">
            </div>
            <h1>IRON FIT</h1>
        </div>
    </nav>
    <main>
        <h1>Seu Carrinho de Compras</h1>
        <table border="3">
            <tr>
                <th>Imagem</th>
                <th>Produto</th>
                <th>Valor (R$)</th>
            </tr>
            <?php
            // Conexão com o banco de dados
            $conn = new mysqli("localhost", "root", "", "compras");

            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }

            $total = 0;

           
            foreach ($_COOKIE as $idProduto => $valor) {
                if (is_numeric($idProduto)) {
                    




                    $stmt = $conn->prepare("SELECT descricao, imagem, valor FROM vendas WHERE id = ?");
                    $stmt->bind_param("i", $idProduto);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $produto = $result->fetch_assoc();
                        echo "<tr>";
                        echo "<td><img src='assets/" . htmlspecialchars($produto['imagem']) . "' alt='" . htmlspecialchars($produto['descricao']) . "' width='100' height='100'></td>";
                        echo "<td>" . htmlspecialchars($produto['descricao']) . "</td>";
                        echo "<td>R$ " . number_format($produto['valor'] * $valor, 2, ',', '.') . "</td>";
                        echo "</tr>";
                        $total += $produto['valor'] * $valor;
                    }
                }
            }

            $conn->close();
            ?>

            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
            </tr>
        </table>
        <div class="button-container">
            <a href="select.php"><button>Voltar para Produtos</button></a>
        </div>
    </main>
    <footer>
        <p>Printe</p>
        <p>Sobre nós</p>
    </footer>
</body>

</html>


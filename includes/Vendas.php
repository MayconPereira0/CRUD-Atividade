<?php
require '../Entity/Cliente.php';
require '../Entity/Produto.php';
require '../Entity/Venda.php';

$clientes = Cliente::listar()->fetchAll(PDO::FETCH_ASSOC);
$produtos = Produto::listarProdutos()->fetchAll(PDO::FETCH_ASSOC);

// Verifica se houve envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalizar_venda'])) {
    $cliente_id = $_POST['cliente_id'];
    $itens = $_POST['itens']; // Array de itens (produto_id e quantidade)

    // Criação da instância de Venda
    $venda = new Venda([
        'cliente_id' => $cliente_id,
        'produtos' => json_encode($itens) // Passa os itens como JSON
    ]);

    // Registra a venda
    $resultado = $venda->registrar();

    if ($resultado === true) {
        echo "<script>alert('Venda registrada com sucesso!');</script>";
        echo "<script>window.location.href='?pagina=listar_vendas';</script>";
    } else {
        echo "<script>alert('Erro ao registrar venda: {$resultado}');</script>";
    }
}
?>

<main>
    <section id="registrar-venda">
        <h1>Registrar Venda</h1>
        <form method="POST">
            <div class="mb-3">
                <label>Cliente:</label>
                <select name="cliente_id" class="form-control" required>
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?= $cliente['id']; ?>"><?= $cliente['nome_completo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Produto:</label>
                <select id="produto" class="form-control">
                    <option value="">Selecione um produto</option>
                    <?php foreach ($produtos as $produto) : ?>
                        <option value="<?= $produto['id']; ?>" data-preco="<?= $produto['preco']; ?>">
                            <?= $produto['nome']; ?> - R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Quantidade:</label>
                <input type="number" id="quantidade" class="form-control" min="1">
            </div>

            <button type="button" onclick="adicionarItem()" class="btn btn-primary">Adicionar ao Carrinho</button>

            <h2>Itens no Carrinho</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="carrinho"></tbody>
            </table>

            <input type="hidden" name="itens" id="itensVenda">
            <button type="submit" name="finalizar_venda" class="btn btn-success">Finalizar Venda</button>
        </form>
    </section>
</main>

<script>
let carrinho = [];

function adicionarItem() {
    let produtoSelect = document.getElementById("produto");
    let quantidade = document.getElementById("quantidade").value;
    let produtoId = produtoSelect.value;
    let produtoNome = produtoSelect.options[produtoSelect.selectedIndex].text;
    let preco = parseFloat(produtoSelect.options[produtoSelect.selectedIndex].dataset.preco);
    let total = quantidade * preco;

    if (produtoId && quantidade > 0) {
        carrinho.push({ produto_id: produtoId, nome: produtoNome, quantidade, preco, total });

        atualizarCarrinho();
    }
}

function atualizarCarrinho() {
    let tabela = document.getElementById("carrinho");
    tabela.innerHTML = "";
    let itensVenda = [];

    carrinho.forEach((item, index) => {
        tabela.innerHTML += `
            <tr>
                <td>${item.nome}</td>
                <td>${item.quantidade}</td>
                <td>R$ ${item.preco.toFixed(2)}</td>
                <td>R$ ${item.total.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removerItem(${index})">Remover</button></td>
            </tr>
        `;
        itensVenda.push({ produto_id: item.produto_id, quantidade: item.quantidade });
    });

    document.getElementById("itensVenda").value = JSON.stringify(itensVenda);
}

function removerItem(index) {
    carrinho.splice(index, 1);
    atualizarCarrinho();
}
</script>

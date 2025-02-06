<?php
require '../Entity/Produto.php'; // ALTERE SEU DIRETÓRIO CONFORME ESTIVER SALVO NO SEU LOCAL

// Verifica se o id foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $produto = Produto::buscarPorId($id);
    
    // Verifica se o produto foi encontrado
    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID não fornecido ou inválido!";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'preco' => $_POST['preco'],
        'estoque' => $_POST['estoque'],
    ];

    // Atualiza os dados no banco de dados
    $atualizado = Produto::atualizarProduto($id, $dados);
    if ($atualizado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados!";
    }
}
?>

<main>
    <section id="editar-produto">
        <h1>Editar Produto</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="card-cadastro">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="labelInput">Nome do Produto:</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="<?= $produto['nome']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="labelInput">Descrição:</label>
                            <input type="text" id="descricao" name="descricao" class="form-control" value="<?= $produto['descricao']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="labelInput">Preço:</label>
                            <input type="number" step="0.01" id="preco" name="preco" class="form-control" value="<?= $produto['preco']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="estoque" class="labelInput">Estoque:</label>
                            <input type="number" id="estoque" name="estoque" class="form-control" value="<?= $produto['estoque']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
    require '../Entity/Produto.php'; // ALTERE O DIRETÓRIO CONFORME NECESSÁRIO

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => $_POST['preco'],
            'estoque' => $_POST['estoque']
        ];

        $produto = new Produto($dados);

        if ($produto->cadastrarProduto()) {
            echo '<script>alert("Produto cadastrado com sucesso!");</script>';
            echo "<meta http-equiv='refresh' content='0.5;url=painel.php?pagina=cadastro_produto' />"; 
        } else {
            echo '<script>alert("Erro ao cadastrar produto.");</script>';
            echo "<meta http-equiv='refresh' content='0.5;url=cadastro_produto.php' />"; 
        }

        exit;
    }
?>
<main>
    <section id="cadastro-produto">
        <h1>Cadastrar Produto</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="card-cadastro">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="labelInput">Nome do Produto:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="labelInput">Descrição:</label>
                            <textarea id="descricao" name="descricao" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="labelInput">Preço:</label>
                            <input type="number" id="preco" name="preco" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="estoque" class="labelInput">Quantidade em Estoque:</label>
                            <input type="number" id="estoque" name="estoque" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

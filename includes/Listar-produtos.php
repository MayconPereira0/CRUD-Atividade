<?php

require '../Entity/Produto.php'; // ALTERE OS DIRETÓRIOS CONFORME ESTIVER SALVO NO SEU LOCAL

$produtos = Produto::listarProdutos(); // Chama o método listarProdutos para pegar os produtos

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_produto'])) {
    $id = $_POST['id_produto']; // Captura o ID do produto

    if (Produto::excluirProduto($id)) {
        echo "<script>alert('Produto excluído com sucesso!');</script>";
        echo "<script>window.location.href='?pagina=listar_produto';</script>";
    } else {
        echo "<script>alert('Erro ao excluir produto!');</script>";
    }
}
?>

<section id="listar-produtos">
    <div class="card-listar">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($produtos as $produto) {
                    echo '
                    <tr>
                        <td>' . $produto['id'] . '</td>
                        <td>' . $produto['nome'] . '</td>
                        <td>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</td>
                        <td>' . $produto['estoque'] . '</td>
                        <td> 
                            <a href="?pagina=Editar-produto&id=' . $produto['id'] . '" class="btn btn-success btn-sm">Editar</a>
                            <form action="?pagina=listar_produto" method="POST" class="d-inline" onsubmit="return confirmarExclusao(this);">
                                <input type="hidden" name="id_produto" value="' . $produto['id'] . '">
                                <button type="submit" name="delete_produto" class="btn btn-danger btn-sm">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
            ?>
            </tbody>
        </table>
    </div> 
</section>

<script>
function confirmarExclusao(form) {
    return confirm("Tem certeza que deseja excluir este produto?");
}
</script>

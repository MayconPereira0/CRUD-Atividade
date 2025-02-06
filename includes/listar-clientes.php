<?php

require '../Entity/Cliente.php'; //ALTERE OS DIRETORIOS CONFORME ESTIVER SALVO NO SEU LOCAL

$clientes = Cliente::listar()->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cliente'])) {
    $id = $_POST['id_cliente']; // Captura o ID do cliente

    if (Cliente::excluir($id)) {
        echo "<script>alert('Cliente excluído com sucesso!');</script>";
        echo "<script>window.location.href='?pagina=listar_clientes';</script>";
    } else {
        echo "<script>alert('Erro ao excluir cliente!');</script>";
    }
}
?>

<section id="listar-cliente">
    <div class="card-listar">
        <!-- Tabela com classes do Bootstrap -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID  </th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <!-- <a href="ver_cliente.php?id=' . $cliente['id'] . '" class="btn btn-secondary btn-sm">Ver mais</a> -->
            <?php
                foreach ($clientes as $cliente) {
                    echo '
                    <tr>
                        <td>' . $cliente['id'] . '</td>
                        <td>' . $cliente['nome_completo'] . '</td>
                        <td>' . $cliente['email'] . '</td>
                        <td> 
                            <a href="?pagina=Editar-cliente&id=' . $cliente['id'] . '" class="btn btn-success btn-sm">Editar</a>
                            <form action="?pagina=listar_clientes" method="POST" class="d-inline" onsubmit="return confirmarExclusao(this);">
                                <input type="hidden" name="id_cliente" value="' . $cliente['id'] . '">
                                <button type="submit" name="delete_cliente" class="btn btn-danger btn-sm">
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
    return confirm("Tem certeza que deseja excluir este cliente?");
}
</script>



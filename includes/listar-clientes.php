<?php
    require '../Entity/Cliente.php'; //ALTERE OS DIRETORIOS CONFORME ESTIVER SALVO NO SEU LOCAL

    $usuarios = Usuario::listar()->fetchAll(PDO::FETCH_ASSOC);


?>
<section id="listar-cliente">
    <div class="card-listar">
        <!-- Tabela com classes do Bootstrap -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($usuarios as $usuario){
                        echo '
                        <tr>
                            <td>'.$usuario['id'].'</td>
                            <td>'.$usuario['nome'].'</td>
                            <td>'.$usuario['email'].'</td>
                            <td> 
                            
                            <a href="" class="btn btn-secondary btn-sm">Ver mais</a>

                            <a href="" class="btn btn-success btn-sm">Editar</a>
                            <form action="" method="POST" class="d-inline">

                            <form action="" method="POST" class="d-inline">
                                <button type="submit" name="delete_cliente" value="1" class="btn btn-danger btn-sm">
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


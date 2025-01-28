<?php
    require '../Entity/Cliente.php'; // ALTERE O DIRETORIO CONFORME SALVO NO SEU LOCAL

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'genero' => $_POST['genero'],
            'data_nascimento' => $_POST['data_nascimento'],
            'rg' => $_POST['rg'],
        ];
    
        $usuario = new Usuario($dados);
    
        if ($usuario->cadastrar()) {
            echo '<script>alert("Usuário cadastrado com sucesso!");</script>';
            echo "<meta http-equiv='refresh' content='0.5;url=painel.php?pagina=cadastro_cliente' />"; 
        } else {
            echo '<script>alert("Erro ao cadastrar usuário.");</script>';
            echo "<meta http-equiv='refresh' content='0.5;url=cadastro.php' />"; 

        }

        exit;
    }
?>
<main>
    <section id="cadastro-cliente">
        <h1>Cadastrar Cliente</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="card-cadastro">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="labelInput">Nome completo:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="rg" class="labelInput">RG:</label>
                            <input type="text" id="rg" name="rg" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="labelInput">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="labelInput">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <p>Sexo:</p>
                            <label for="feminino">Feminino</label>
                            <input type="radio" id="feminino" name="genero" value="feminino" required>
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="masculino" name="genero" value="masculino" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento">Data de nascimento:</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
    require '../Entity/Cliente.php'; // ALTERE O DIRETORIO CONFORME SALVO NO SEU LOCAL

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = [
            'nome_completo' => $_POST['nome'],
            'endereco_completo' => $_POST['endereco_completo'],
            'profissao' => $_POST['profissao'],
            'cpf' => $_POST['cpf'],
            'cnpj' => $_POST['cnpj'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'rg' => $_POST['rg'],
            'genero' => $_POST['genero'],
            'data_nascimento' => $_POST['data_nascimento'],
        ];
    
        $cliente = new Cliente($dados);
    
        if ($cliente->cadastrar()) {
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
                            <input type="text" id="nome" name="nome" class="form-control"required>
                        </div>
                        <div class="mb-3">
                            <label for="rg" class="labelInput">RG:</label>
                            <input type="text" id="rg" name="rg" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="labelInput">CPF:</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="cnpj" class="labelInput">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="labelInput">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="labelInput">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" class="form-control"required>
                        </div>
                        <div class="mb-3">
                            <label for="endereco_completo" class="labelInput">Endereço completo:</label>
                            <input type="text" id="endereco_completo" name="endereco_completo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="profissao" class="labelInput">Profissão:</label>
                            <input type="text" id="profissao" name="profissao" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <p>Sexo:</p>
                            <label for="feminino">Feminino</label>
                            <input type="radio" id="feminino" name="genero" required>
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="masculino" name="genero" required>
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

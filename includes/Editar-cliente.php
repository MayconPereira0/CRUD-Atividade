<?php
require '../Entity/Cliente.php'; // ALTERE SEU DIRETORIO CONFORME SALVO NO SEU LOCAL

// Verifica se o id foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $cliente = Cliente::buscarPorId($id);
    
    // Verifica se o usuário foi encontrado
    if (!$cliente) {
        echo "Usuário não encontrado!";
        exit;
    }
} else {
    echo "ID não fornecido ou inválido!";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = [
        'nome_completo' => $_POST['nome'],
        'rg' => $_POST['rg'],
        'cpf' => $_POST['cpf'],
        'cnpj' => $_POST['cnpj'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'genero' => $_POST['genero'],
        'data_nascimento' => $_POST['data_nascimento'],
        'endereco_completo' => $_POST['endereco_completo'],
        'profissao' => $_POST['profissao'],
    ];

    // Atualiza os dados no banco de dados
    $atualizado = cliente::atualizar($id, $dados);
    if ($atualizado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados!";
    }
}
?>


<main>
    <section id="editar-cliente">
        <h1>Editar Cliente</h1>
        <div class="container">
            <div class="col-md-12">
                <div class="card-cadastro">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="labelInput">Nome completo:</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="<?= $cliente['nome_completo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="rg" class="labelInput">RG:</label>
                            <input type="text" id="rg" name="rg" class="form-control" value="<?= $cliente['rg']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="labelInput">CPF:</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" value="<?= $cliente['cpf']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cnpj" class="labelInput">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control" value="<?= $cliente['cnpj']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="labelInput">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $cliente['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="labelInput">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" class="form-control" value="<?= $cliente['telefone']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="endereco_completo" class="labelInput">Endereço completo:</label>
                            <input type="text" id="endereco_completo" name="endereco_completo" class="form-control" value="<?= $cliente['endereco_completo']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="profissao" class="labelInput">Profissão:</label>
                            <input type="text" id="profissao" name="profissao" class="form-control" value="<?= $cliente['profissao']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <p>Sexo:</p>
                            <label for="feminino">Feminino</label>
                            <input type="radio" id="feminino" name="genero" value="<?= $cliente['genero']; ?>" required>
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="masculino" name="genero" value="<?= $cliente['genero']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento">Data de nascimento:</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?= $cliente['data_nascimento']; ?>" required>
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
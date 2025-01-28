<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/painel.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="headnav">
            <img src="" alt="">
            <h1>GESTÃO PEÇAS</h1>
        </div>
    </header>
    <nav class="gerenciamento-menu">
        <div class="container-menu">
            <div class="btn-expandir">
                <i class="bi bi-caret-left-fill" id="icon-seta"></i>
            </div>
            <ul>
                <li class="item-menu">
                    <a href="?pagina=cadastro_cliente">
                        <span class="icon-menu"><i class="bi bi-people"></i></span>
                        <span class="txt-link">Cliente<img src="" alt="" class=""></span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="?pagina=cadastro_cliente">
                        <span class="icon-menu"><i class="bi bi-table"></i></span>
                        <span class="txt-link">Estoque<img src="" alt="" class=""></span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <span class="icon-menu"><i class="bi bi-receipt"></i></span>
                        <span class="txt-link">Vendas<img src="" alt="" class=""></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="cadastro-cliente">
            <?php
            // Captura o parâmetro `pagina` da URL ou define "home" como padrão
            $pagina = $_GET['pagina'] ?? 'home';

            // Inclui a página correspondente com base no valor do parâmetro
            if ($pagina === 'cadastro_cliente') {
                include '../includes/formulario.php';
            } elseif ($pagina === 'listar_clientes') {
                include '../includes/listar-clientes.php';
            } else {
                echo "<h2>Bem-vindo ao sistema de Gestão de Peças</h2>";
            }
            ?>
        </div>
    </main>
    <script src="../public/js/menu.js"></script>
</body>
</html>
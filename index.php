<?php
// Configurações do banco de dados
$host = 'localhost';
$usuario = 'root'; 
$senha = '';       
$banco = 'romenno';

// Criar conexão
$conn = new mysqli(hostname: $host, username: $usuario, password: $senha, database: $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $mensagem = $conn->real_escape_string($_POST['mensagem'] ?? '');

    $sql = "INSERT INTO formulario (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";
    if ($conn->query($sql) === TRUE) {
        $statusMsg = "Mensagem enviada com sucesso!";
    } else {
        $statusMsg = "Erro ao enviar: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Romenno - Magias e Simpatias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Romenno</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#magias">Magias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#simpatias">Simpatias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#avaliacoes">Avaliações</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Apresentação em tela cheia -->
    <header class="d-flex align-items-center justify-content-center vh-100 vw-100 mb-5" style="min-height: 100vh;">
        <div class="container">
            <div class="p-4 p-md-5 rounded bg-light text-center">
                <h1 class="display-4">Bem-vindo ao Romenno</h1>
                <p class="lead my-3">Divulgue e adquira magias e simpatias para diversas áreas da sua vida. Consulte
                    valores
                    e entre em contato para adquirir a sua!</p>
                <a href="#magias" class="btn btn-primary btn-lg mt-3">Ver Magias</a>
            </div>
        </div>
    </header>

    <!-- Magias -->
    <section id="magias" class="container mb-5">
        <h2 class="mb-4">Magias</h2>
        <div class="row" id="magias-list"></div>
    </section>

    <!-- Simpatias -->
    <section id="simpatias" class="container mb-5">
        <h2 class="mb-4">Simpatias</h2>
        <div class="row" id="simpatias-list"></div>
    </section>

    <!-- Avaliações -->
    <section id="avaliacoes" class="container mb-5">
        <h2 class="mb-4">Avaliações</h2>
        <div class="row" id="avaliacoes-list"></div>
    </section>

    <!-- Contato -->
    <section id="contato" class="container mb-5">
        <h2 class="mb-4">Contato</h2>
        <div class="row">
            <div class="col-md-6">
                <?php if (isset($statusMsg)): ?>
                    <div class="alert alert-info"><?php echo $statusMsg; ?></div>
                <?php endif; ?>
                <form id="contato-form" action="" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <div id="contato-status" class="mt-3"></div>
                </form>
            </div>
            <div class="col-md-6">
                <p>Entre em contato para adquirir magias ou simpatias, tirar dúvidas ou solicitar informações:</p>
                <ul class="list-unstyled">
                    <li><strong>E-mail:</strong> contato@romenno.com</li>
                    <li><strong>WhatsApp:</strong> (99) 99999-9999</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3">
        &copy; 2024 Romenno. Todos os direitos reservados.
    </footer>

    <script>
        // Magias e preços
        const magias = [
            { titulo: "Magia da Prosperidade", preco: "R$ 50,00" },
            { titulo: "Magia do Amor", preco: "R$ 60,00" },
            { titulo: "Magia de Proteção", preco: "R$ 55,00" },
            { titulo: "Magia de Limpeza Espiritual", preco: "R$ 70,00" },
            { titulo: "Magia de Abertura de Caminhos", preco: "R$ 65,00" },
            { titulo: "Magia para Harmonia Familiar", preco: "R$ 58,00" },
            { titulo: "Magia de Energia Positiva", preco: "R$ 62,00" }
        ];
        // Simpatias e preços
        const simpatias = [
            { titulo: "Simpatia para Boa Sorte", preco: "R$ 30,00" },
            { titulo: "Simpatia para Saúde", preco: "R$ 35,00" },
            { titulo: "Simpatia para Atrair Dinheiro", preco: "R$ 40,00" },
            { titulo: "Simpatia para Amor Correspondido", preco: "R$ 45,00" },
            { titulo: "Simpatia para Proteção Familiar", preco: "R$ 38,00" },
            { titulo: "Simpatia para Novo Emprego", preco: "R$ 42,00" },
            { titulo: "Simpatia para Paz no Lar", preco: "R$ 36,00" }
        ];
        // Avaliações
        const avaliacoes = [
            { nome: "Maria S.", texto: "Adorei a magia da prosperidade! Funcionou muito bem para mim.", estrelas: 5 },
            { nome: "João P.", texto: "Simpatia para saúde trouxe ótimos resultados. Recomendo!", estrelas: 4 },
            { nome: "Ana L.", texto: "Atendimento excelente e resultados rápidos.", estrelas: 5 }
        ];

        function renderCards(lista, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            lista.forEach(item => {
                const col = document.createElement('div');
                col.className = 'col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">${item.titulo}</h5>
                            <p class="card-text">Valor: <strong>${item.preco}</strong></p>
                        </div>
                    </div>
                `;
                container.appendChild(col);
            });
        }

        function renderAvaliacoes(lista, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            lista.forEach(avaliacao => {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';
                col.innerHTML = `
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">${avaliacao.nome}</h5>
                            <p class="card-text">${avaliacao.texto}</p>
                            <p class="mb-0">
                                ${'★'.repeat(avaliacao.estrelas)}${'☆'.repeat(5 - avaliacao.estrelas)}
                            </p>
                        </div>
                    </div>
                `;
                container.appendChild(col);
            });
        }

        renderCards(magias, 'magias-list');
        renderCards(simpatias, 'simpatias-list');
        renderAvaliacoes(avaliacoes, 'avaliacoes-list');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

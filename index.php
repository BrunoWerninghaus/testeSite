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

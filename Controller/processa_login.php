<?php

?>

<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$requestData = json_decode(file_get_contents('php://input'), true);
$login = $requestData['no_usuario'];
$senha = $requestData['ds_senha'];

$conn = new MySQLi('LOCALHOST', 'root', '', 'clinica');

$query = "SELECT * FROM tb_usuarios WHERE
no_usuario = '$login' and
ds_senha = '$senha'; ";

$result = $conn->query($query);
session_start();
if ($result->num_rows > 0) {
    $_SESSION['logado'] = true;
    echo json_encode(['success' => true]);
} else {
    $_SESSION['logado'] = false;
    echo json_encode(['success' => false, 'mensagem' => 'Nome de Usuário ou senha incorretos']);
}
?>
<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
class Usuario
{

    private $no_usuario;
    private $ds_senha;
    private $ds_email;
    private $in_ativo;
    private $ds_tipo_usuario;

    public function __construct($data)
    {
        $this->no_usuario = $data['no_usuario'] ?? null;
        $this->ds_senha = $data['ds_senha'] ?? null;
        $this->ds_email = $data['ds_email'] ?? null;
        $this->in_ativo = $data['in_ativo'] ?? null;
        $this->ds_tipo_usuario = $data['ds_tipo_usuario'] ?? null;
    }
    public function login()
    {


        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();

        $query = "SELECT * FROM tb_usuarios WHERE
        no_usuario = '$this->no_usuario' and
        ds_senha = '$this->ds_senha'; ";

        $result = $conn->query($query);
        session_start();
        if ($result->num_rows > 0) {
            $_SESSION['logado'] = true;
            echo json_encode(['success' => true]);
        } else {
            $_SESSION['logado'] = false;
            echo json_encode(['success' => false, 'mensagem' => 'Nome de Usuário ou senha incorretos']);
        }
    }
};

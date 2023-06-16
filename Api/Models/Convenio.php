<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
class Convenio
{
    public $id_convenio;
    public $no_convenio;
    public $nu_convenio;

    public function __construct($data = [])
    {
        $this->id_convenio = $data['id_convenio'] ?? null;
        $this->no_convenio = $data['no_convenio'] ?? null;
        $this->nu_convenio = $data['nu_convenio'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_convenios(no_convenio,nu_convenio)
        VALUES(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ss",
            $this->no_convenio,
            $this->nu_convenio
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Convênio Cadastrado!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }

    public function validateNumero($value)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT * FROM tb_convenios where nu_convenio = $value and in_especial";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo json_encode(['success'=>true,'data'=>$result->fetch_assoc()]);
        } else {
            echo json_encode(['success'=>false]);
        }

        $conn->close();
    }
}

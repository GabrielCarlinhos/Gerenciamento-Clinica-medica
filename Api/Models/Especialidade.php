<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
class Especialidade
{

    public $co_especialidade;
    public $ds_especialidade;
    public $vl_consulta;

    public function __construct($data = [])
    {
        $this->ds_especialidade = $data['ds_especialidade'] ?? null;
        $this->vl_consulta = $data['vl_consulta'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_especialidades(ds_especialidade,vl_consulta)
        VALUES('$this->ds_especialidade','$this->vl_consulta');";
        if ($conn->query($query)) {
            echo json_encode(['success' => true, 'mensagem' => 'Especialidade Cadastrada!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }

    public static function findAll()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT * FROM tb_especialidades;";
        $result = $conn->query($query);
        $especialidades = [];
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                array_push($especialidades, $data);
            }
            echo json_encode(['success' => true, 'data' => $especialidades]);
        }
    }
}

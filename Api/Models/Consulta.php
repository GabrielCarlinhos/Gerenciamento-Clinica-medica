<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');
class Consulta
{
    public $co_consulta;
    public $dt_consulta;
    public $vl_consulta;
    public $ds_convenio;
    public $id_paciente;
    public $nu_crm_doutor;
    public $paciente;

    public function __construct($data = [])
    {
        $this->co_consulta = $data['co_consulta'] ?? null;
        $this->dt_consulta = $data['dt_consulta'] ?? null;
        $this->vl_consulta = $data['vl_consulta'] ?? null;
        $this->ds_convenio = $data['ds_convenio'] ?? null;
        $this->id_paciente = $data['id_paciente'] ?? null;
        $this->nu_crm_doutor = $data['nu_crm_doutor'] ?? null;
        $this->paciente = $data['paciente'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_consultas(dt_consulta,vl_consulta,ds_convenio,id_paciente,nu_crm_doutor)
        VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssss",
            $this->dt_consulta,
            $this->vl_consulta,
            $this->ds_convenio,
            $this->id_paciente,
            $this->nu_crm_doutor
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Consulta Gerada!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }

    public static function findAll()
    {
        require 'Connection.php';
        require 'Paciente.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT c.*,p.* FROM tb_consultas as c JOIN tb_pacientes as p on p.id_paciente = c.id_paciente";
        $result = $conn->query($query);
        $consultas = [];
        while ($data = $result->fetch_assoc()) {
            $paciente = new Paciente($data);
            $consulta = new Consulta($data);
            $consulta->paciente = $paciente;
            array_push($consultas, $consulta);
        }
        echo json_encode(['success' => true, 'data' => $consultas]);
        $conn->close();
    }
}

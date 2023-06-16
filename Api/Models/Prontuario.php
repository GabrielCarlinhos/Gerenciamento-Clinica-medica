<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

class Prontuario
{
    public $id_prontuario;
    public $nu_peso;
    public $nu_altura;
    public $nu_imc;
    public $ds_exame_fisico;
    public $ds_solicitacao_exame;
    public $tp_sanguineo;
    public $ds_alergias;
    public $co_consulta;
    public $nu_crm_doutor;
    public $paciente;
    public $doutor;

    public function __construct($data = [])
    {
        $this->id_prontuario = $data['id_prontuario'] ?? null;
        $this->nu_peso = $data['nu_peso'] ?? null;
        $this->nu_altura = $data['nu_altura'] ?? null;
        $this->nu_imc = $data['nu_imc'] ?? null;
        $this->ds_exame_fisico = $data['ds_exame_fisico'] ?? null;
        $this->ds_solicitacao_exame = $data['ds_solicitacao_exame'] ?? null;
        $this->tp_sanguineo = $data['tp_sanguineo'] ?? null;
        $this->ds_alergias = $data['ds_alergias'] ?? null;
        $this->co_consulta = $data['co_consulta'] ?? null;
        $this->nu_crm_doutor = $data['nu_crm_doutor'] ?? null;
        $this->paciente = $data['paciente'] ?? null;
        $this->doutor = $data['doutor'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_prontuarios(nu_peso,nu_altura,nu_imc,ds_exame_fisico,ds_solicitacao_exame,tp_sanguineo,ds_alergias,co_consulta)
        VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssssssss",
            $this->nu_peso,
            $this->nu_altura,
            $this->nu_imc,
            $this->ds_exame_fisico,
            $this->ds_solicitacao_exame,
            $this->tp_sanguineo,
            $this->ds_alergias,
            $this->co_consulta,
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Prontuário Cadastrado!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }
    public static function get($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT * from tb_prontuarios where id_prontuario = '$id'";
        $result = $conn->query($query);
        while ($data = $result->fetch_assoc()) {
            $prontuario = $data;
        }
        echo json_encode(['success' => true, 'data' => $prontuario]);
        $conn->close();
    }

    public function update($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "UPDATE tb_prontuarios SET nu_peso=?, nu_altura=?, nu_imc=?, ds_exame_fisico=?, ds_solicitacao_exame=?, tp_sanguineo=?, ds_alergias=? WHERE id_prontuario=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssssssi",
            $this->nu_peso,
            $this->nu_altura,
            $this->nu_imc,
            $this->ds_exame_fisico,
            $this->ds_solicitacao_exame,
            $this->tp_sanguineo,
            $this->ds_alergias,
            $id
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Prontuário Atualizado!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }
}

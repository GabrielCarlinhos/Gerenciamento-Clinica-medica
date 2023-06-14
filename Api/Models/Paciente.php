<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

class Paciente
{
    public $id_paciente;
    public $no_paciente;
    public $nu_cpf;
    public $nu_telefone;
    public $ds_email;
    public $ds_genero;
    public $ds_logradouro;
    public $nu_paciente;
    public $ds_bairro;
    public $ds_cidade;
    public $co_estado;
    public $nu_cep;
    public $dt_nascimento;
    public $in_ativo;
    public $no_mae;
    public $nu_rg;
    public $id_convenio;
    public $convenio;
    public $acompanhante;
    public $prontuario;

    public function __construct($data = [])
    {
        $this->id_paciente = $data['id_paciente'] ?? null;
        $this->no_paciente = $data['no_paciente'] ?? null;
        $this->nu_cpf = $data['nu_cpf'] ?? null;
        $this->nu_telefone = $data['nu_telefone'] ?? null;
        $this->ds_email = $data['ds_email'] ?? null;
        $this->ds_genero = $data['ds_genero'] ?? null;
        $this->ds_logradouro = $data['ds_logradouro'] ?? null;
        $this->nu_paciente = $data['nu_paciente'] ?? null;
        $this->ds_bairro = $data['ds_bairro'] ?? null;
        $this->ds_cidade = $data['ds_cidade'] ?? null;
        $this->co_estado = $data['co_estado'] ?? null;
        $this->nu_cep = $data['nu_cep'] ?? null;
        $this->dt_nascimento = $data['dt_nascimento'] ?? null;
        $this->in_ativo = $data['in_ativo'] ?? null;
        $this->no_mae = $data['no_mae'] ?? null;
        $this->nu_rg = $data['nu_rg'] ?? null;
        $this->id_convenio = $data['id_convenio'] ?? null;
        $this->convenio = $data['convenio'] ?? null;
        $this->acompanhante = $data['acompanhante'] ?? null;
        $this->prontuario = $data['prontuario'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();


        $query = "INSERT INTO tb_pacientes (no_paciente, nu_cpf, nu_rg, dt_nascimento, ds_genero, nu_telefone, nu_cep, nu_paciente, ds_logradouro, ds_bairro, ds_cidade, co_estado, no_mae, id_convenio)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssssssssssssss",
            $this->no_paciente,
            $this->nu_cpf,
            $this->nu_rg,
            $this->dt_nascimento,
            $this->ds_genero,
            $this->nu_telefone,
            $this->nu_cep,
            $this->nu_paciente,
            $this->ds_logradouro,
            $this->ds_bairro,
            $this->ds_cidade,
            $this->co_estado,
            $this->no_mae,
            $this->id_convenio
        );

        if ($stmt->execute()) {
            if ($this->acompanhante != null) {
                require 'Acompanhante.php';
                $acompanhante = new Acompanhante($this->acompanhante);
                $acompanhante->id_paciente = $conn->getInsertId();
                $acompanhante->create();
            }
            echo json_encode(['success' => true, 'mensagem' => 'Paciente Cadastrado!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }

        $conn->close();
    }

    public static function validateDuplicate($key, $value)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT $key FROM tb_pacientes where $key = '$value'";
        echo json_encode(['success' => $conn->query($query)->num_rows <= 0]);
        $conn->close();
    }

    public static function findAll()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT * from tb_pacientes";
        $pacientes = [];
        $result = $conn->query($query);
        while ($data = $result->fetch_assoc()) {
            array_push($pacientes, $data);
        }
        echo json_encode(['success' => true, 'data' => $pacientes]);
        $conn->close();
    }

    public static function delete($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "DELETE FROM tb_acompanhantes where id_paciente = '$id'";
        if (!$conn->query($query)) {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $query =  "DELETE FROM tb_pacientes where id_paciente = '$id'";
        if ($conn->query($query)) {
            echo json_encode(['success' => true, 'mensagem' => 'Paciente Removido!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
    }

    public function update($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "UPDATE tb_pacientes SET no_paciente = ?, nu_cpf = ?, nu_rg = ?, dt_nascimento = ?, ds_genero = ?, nu_telefone = ?, nu_cep = ?, nu_paciente = ?, ds_logradouro = ?, ds_bairro = ?, ds_cidade = ?, co_estado = ?, no_mae = ?, id_convenio = ? WHERE id_paciente = '$id'";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssssssssssssssi",
            $this->no_paciente,
            $this->nu_cpf,
            $this->nu_rg,
            $this->dt_nascimento,
            $this->ds_genero,
            $this->nu_telefone,
            $this->nu_cep,
            $this->nu_paciente,
            $this->ds_logradouro,
            $this->ds_bairro,
            $this->ds_cidade,
            $this->co_estado,
            $this->no_mae,
            $this->id_convenio,
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Paciente Atualizado!']);
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
        $query = "SELECT * from tb_pacientes where id_paciente = '$id'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                
                echo json_encode(['success' => true, 'data' => $data]);
            }
        } else {
            echo json_encode(['success' => false, 'mensagem' => 'Não Encontrado!']);
        }
        $conn->close();
    }
}

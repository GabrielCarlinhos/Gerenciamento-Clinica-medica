<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
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
        if (empty($this->ds_especialidade) || empty($this->vl_consulta)) {
            echo json_encode(['success' => false, 'mensagem' => 'Campos obrigatórios não preenchidos.']);
            return;
        }

        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_especialidades(ds_especialidade, vl_consulta)
    VALUES(?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $this->ds_especialidade, $this->vl_consulta);
        if ($stmt->execute()) {
            $this->co_especialidade = $conn->getInsertId();
            echo json_encode(['success' => true, 'mensagem' => 'Especialidade Cadastrada!', 'data' => $this]);
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
        $conn->close();
    }

    public static function delete($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT nu_doutor from tb_doutores where co_especialidade = '$id'";
        if ($conn->query($query)->num_rows > 0) {
            echo json_encode(['success' => false, 'mensagem' => 'Não é possível remover uma especialidade atribuída a algum doutor!']);
            $conn->close();
            return;
        }
        $query = "DELETE FROM tb_especialidades where co_especialidade = '$id'";
        if ($conn->query($query)) {
            echo json_encode(['success' => true, 'mensagem' => "Especialidade Removida!"]);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }

    public function update($id)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "UPDATE tb_especialidades set ds_especialidade = ?, vl_consulta = ? WHERE co_especialidade='$id'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ss",
            $this->ds_especialidade,
            $this->vl_consulta
        );
        if ($stmt->execute()) {
            $this->co_especialidade = $conn->getInsertId();
            echo json_encode(['success' => true, 'mensagem' => 'Especialidade Atualizada!', 'data' => $this]);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }
}

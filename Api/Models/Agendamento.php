<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');
class Agendamento
{
    public $co_agendamento;
    public $dt_agendamento;
    public $hr_agendamento;
    public $id_paciente;
    public $nu_crm_doutor;
    public $in_cancelado;
    public $ds_motivo_cancelamento;
    public $paciente;
    public $doutor;

    public function __construct($data = [])
    {
        $this->co_agendamento = $data['co_agendamento'] ?? null;
        $this->dt_agendamento = $data['dt_agendamento'] ?? null;
        $this->hr_agendamento = $data['hr_agendamento'] ?? null;
        $this->id_paciente = $data['id_paciente'] ?? null;
        $this->nu_crm_doutor = $data['nu_crm_doutor'] ?? null;
        $this->in_cancelado = $data['in_cancelado'] ?? null;
        $this->ds_motivo_cancelamento = $data['ds_motivo_cancelamento'] ?? null;
        $this->paciente = $data['paciente'] ?? null;
        $this->doutor = $data['doutor'] ?? null;
    }

    public static function agendamento()
    {
        require 'Connection.php';
        require 'Especialidade.php';
        require 'Paciente.php';
        require 'Doutor.php';
        $conn = new Connection();
        $conn->connect();
        $query = "SELECT * FROM view_agenda";
        $result = $conn->query($query);
        $especialidades = [];
        $doutores = [];
        $agendas = [];

        while ($data = $result->fetch_assoc()) {
            $especialidade = new Especialidade($data);
            if (!in_array($especialidade, $especialidades)) {
                $especialidades[] = $especialidade;
            }

            $doutor = new Doutor($data);
            if (!in_array($doutor, $doutores)) {
                $doutores[] = $doutor;
            }

            $agenda = new Agendamento($data);

            if ($agenda->dt_agendamento != null) {
                $agenda->dt_agendamento = date_format(DateTime::createFromFormat('Y-m-d', $agenda->dt_agendamento), 'dmY');
            }

            $agenda->hr_agendamento = substr_replace($agenda->hr_agendamento, '', 2, 1);
            $agenda->paciente = new Paciente(['id_paciente' => $data['id_paciente'], 'no_paciente' => $data['no_paciente'], 'nu_cpf' => $data['nu_cpf'], 'id_convenio' => $data['id_convenio']]);
            if (!in_array($agenda, $agendas) && !$agenda->in_cancelado) {
                $agendas[] = $agenda;
            }
        }

        foreach ($doutores as $doutor) {
            $doutor->agendamentos = [];
            foreach ($agendas as $agenda) {
                if ($agenda->nu_crm_doutor == $doutor->nu_crm && !in_array($agenda, $doutor->agendamentos)) {
                    $doutor->agendamentos[] = $agenda;
                }
            }
        }

        foreach ($especialidades as $especialidade) {
            $especialidade->doutores = [];
            foreach ($doutores as $doutor) {
                if ($doutor->co_especialidade === $especialidade->co_especialidade && !in_array($doutor, $especialidade->doutores)) {
                    $especialidade->doutores[] = $doutor;
                }
            }
        }

        echo json_encode(['success' => true, 'data' => $especialidades]);
        $conn->close();
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_agendamentos(dt_agendamento,hr_agendamento,id_paciente,nu_crm_doutor) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssss",
            $this->dt_agendamento,
            $this->hr_agendamento,
            $this->id_paciente,
            $this->nu_crm_doutor
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => "Consulta Agendada"]);
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
        $query = "UPDATE tb_agendamentos set dt_agendamento = ?,hr_agendamento = ? where co_agendamento='$id'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ss",
            $this->dt_agendamento,
            $this->hr_agendamento
        );
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Consulta Reagendada']);
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
        $query = "SELECT * FROM tb_agendamentos where co_agendamento = '$id'";
        $result = $conn->query($query);
        while ($data = $result->fetch_assoc()) {
            $agendamento = $data;
        }
        echo json_encode(['success' => true, 'data' => $agendamento]);
        $conn->close();
    }

    public static function delete($id, $motivo)
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();
        $query = "UPDATE tb_agendamentos set in_cancelado = TRUE,ds_motivo_cancelamento = '$motivo' where co_agendamento = '$id'";
        if ($conn->query($query)) {
            echo json_encode(['success' => true, 'mensagem' => 'Consulta Cancelada!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }
        $conn->close();
    }
}

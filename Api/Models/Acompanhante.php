<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
class Acompanhante
{
    public $id_acompanhante;
    public $no_acompanhante;
    public $nu_cpf;
    public $nu_telefone;
    public $ds_email;
    public $id_paciente;
    public $paciente;

    public function __construct($data)
    {
        $this->id_acompanhante = $data['id_acompanhante'] ?? null;
        $this->no_acompanhante = $data['no_acompanhante'] ?? null;
        $this->nu_cpf = $data['nu_cpf'] ?? null;
        $this->nu_telefone = $data['nu_telefone'] ?? null;
        $this->ds_email = $data['ds_email'] ?? null;
        $this->id_paciente = $data['id_paciente'] ?? null;
        $this->paciente = $data['paciente'] ?? null;
    }

    public function create()
    {
        $conn = new Connection();
        $conn->connect();
        $query = "INSERT INTO tb_acompanhantes(no_acompanhante,nu_cpf,nu_telefone,ds_email,id_paciente) VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssss",
            $this->no_acompanhante,
            $this->nu_cpf,
            $this->nu_telefone,
            $this->ds_email,
            $this->id_paciente
        );
        $stmt->execute();
        $conn->close();
    }
}

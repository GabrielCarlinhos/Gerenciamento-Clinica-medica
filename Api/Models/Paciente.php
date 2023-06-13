<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
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
    public $acompanhantes;
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
        $this->acompanhantes = $data['acompanhantes'] ?? null;
        $this->prontuario = $data['prontuario'] ?? null;
    }

    public function create()
    {
        require 'Connection.php';
        $conn = new Connection();
        $conn->connect();

        $query = "INSERT INTO tb_pacientes (no_paciente, nu_cpf, nu_rg, dt_nascimento, ds_genero, nu_telefone, nu_cep, nu_paciente, ds_logradouro, ds_bairro, ds_cidade, co_estado, id_convenio)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $exec = $conn->prepare($query);
        $exec->bind_param(
            "sssssssssssss",
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
            $this->id_convenio
        );

        if ($exec->execute()) {
            echo json_encode(['success' => true, 'mensagem' => 'Paciente Cadastrado!']);
        } else {
            echo json_encode(['success' => false, 'mensagem' => $conn->getError()]);
        }

        $conn->close();
    }
}

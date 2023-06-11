<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
class Doutor
{
    public $nu_crm;
    public $no_doutor;
    public $nu_cpf;
    public $nu_rg;
    public $nu_telefone;
    public $nu_cep;
    public $nu_doutor;
    public $ds_logradouro;
    public $ds_bairro;
    public $ds_cidade;
    public $co_estado;
    public $co_especialidade;
    public $id_usuario;
    public $usuario;
    public $especialidade;

    public function __construct($data = [])
    {
        $this->nu_crm = $data['nu_crm'] ?? null;
        $this->no_doutor = $data['no_doutor'] ?? null;
        $this->nu_cpf = $data['nu_cpf'] ?? null;
        $this->nu_rg = $data['nu_rg'] ?? null;
        $this->nu_telefone = $data['nu_telefone'] ?? null;
        $this->nu_cep = $data['nu_cep'] ?? null;
        $this->nu_doutor = $data['nu_doutor'] ?? null;
        $this->ds_logradouro = $data['ds_logradouro'] ?? null;
        $this->ds_bairro = $data['ds_bairro'] ?? null;
        $this->ds_cidade = $data['ds_cidade'] ?? null;
        $this->co_estado = $data['co_estado'] ?? null;
        $this->co_especialidade = $data['co_especialidade'] ?? null;
        $this->id_usuario = $data['id_usuario'] ?? null;
        $this->usuario = $data['usuario'] ?? null;
        $this->especialidade = $data['especialidade'] ?? null;
    }
}

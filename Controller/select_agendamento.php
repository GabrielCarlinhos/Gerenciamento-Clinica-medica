<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$codigo = $_GET['codigo'];
$query = "SELECT a.*,p.nome_paciente,c.nome_convenio as convenio,p.id_paciente,p.cpf_paciente,d.nome_doutor,e.valor_consulta FROM tb_agendamentos as a inner join tb_pacientes as p on(a.id_paciente = p.id_paciente) inner join tb_doutores as d on(d.crm_doutor = a.crm_doutor) inner join tb_especialidades as e on(e.codigo_especialidade = d.codigo_especialidade) left join tb_convenios as c on(c.id_convenio = p.id_convenio) where codigo_agendamento = $codigo;";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    $data = $rows['data_agendamento'];
    $horario = $rows['horario_agendamento'];
    $paciente = $rows['nome_paciente'];
    $doutor = $rows['nome_doutor'];
    $cpf_paciente = $rows['cpf_paciente'];
    $id_paciente = $rows['id_paciente'];
    $crm_doutor = $rows['crm_doutor'];
    $valor_consulta = $rows['valor_consulta'];
    if($rows['convenio'] == ""){
        $convenio = "";
    }else{
        $convenio = $rows['convenio'];
    }

}
$desconto30Dias = "SELECT data_consulta from tb_consultas where crm_doutor = $crm_doutor and id_paciente = $id_paciente;";
$resultDesconto = $conn->query($desconto30Dias);
if($resultDesconto->num_rows>0){
while($rows = $resultDesconto->fetch_assoc()){
    $data_ultima_consulta = $rows['data_consulta'];
    $dataInicial = new DateTime($data);
    $dataFinal = new DateTime($data_ultima_consulta);
    $intervalo = $dataInicial->diff($dataFinal);
    
}
if($intervalo->days<30){
    $valor_consulta = "0,00";
}
}

header("Content-Type: application/json");    
$agendamento = array('data' => $data,'horario' => $horario,'paciente' => $paciente,'doutor' => $doutor,'cpf_paciente' => $cpf_paciente,'id_paciente' => $id_paciente,'crm_doutor' => $crm_doutor,'valor_consulta' => $valor_consulta,'convenio' => $convenio);

echo json_encode($agendamento);
exit();
?>
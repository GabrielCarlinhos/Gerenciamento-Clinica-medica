<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$crm = $_POST['doutor_agenda'];
$paciente = $_POST['paciente_agenda'];
$data = $_POST['data_agenda'];
$horario = $_POST['horario_agenda'];

if(isset($_POST['codigo_agendamento'])){
    $codigo = $_POST['codigo_agendamento'];
    $update = "UPDATE tb_agendamentos set horario_agendamento='$horario',data_agendamento='$data' where codigo_agendamento = $codigo;";
    $conn->query($update);
    header("Location:../View/agendamentos.php?crm='$crm'");
}else{
    


$query_paciente = "SELECT id_paciente FROM tb_pacientes where cpf_paciente = '$paciente';";
$result = $conn->query($query_paciente);
while($rows = $result->fetch_assoc()){
    $id_paciente = $rows['id_paciente'];
}

$query = "INSERT into tb_agendamentos(horario_agendamento,data_agendamento,id_paciente,crm_doutor)
values('$horario','$data','$id_paciente','$crm');";
$conn->query($query);
header("Location:../View/agenda.php");
}

?>
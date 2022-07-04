<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$horario = $_POST['horario_consulta'];
$data = $_POST['data_consulta'];
$valor_consulta = str_replace(array(',','R$'),array('.',''),$_POST['valor_consulta']);
$convenio = $_POST['convenio_consulta'];
$paciente = $_POST['id_paciente_consulta'];
$doutor = $_POST['crm_doutor_consulta'];
$agendamento = $_POST['codigo_agendamento_consulta'];
$query = "INSERT into tb_consultas(horario_consulta,data_consulta,valor_consulta,convenio_consulta,id_paciente,crm_doutor)
values('$horario','$data','$valor_consulta','$convenio',$paciente,$doutor);";
$conn->query($query);
$delete = "DELETE from tb_agendamentos where codigo_agendamento = $agendamento;";
$conn->query($delete);
header("Location:../View/agendamentos.php?crm=$doutor");
?>
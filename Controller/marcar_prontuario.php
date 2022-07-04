<?php
$conn = new MySQLi("LOCALHOST","root","","clinica");
$peso = str_replace(",",".",$_POST['peso_paciente']);
$altura = str_replace(",",".",$_POST['altura_paciente']);
$imc = str_replace(",",".",$_POST['imc_paciente']);
$tipo_sanguineo = $_POST['tipo_sanguineo_paciente'];
$exame_fisico = $_POST['exame_fisico_paciente'];
$solicitacao_exame = $_POST['solicitacao_exame_paciente'];
$alergias = $_POST['alergias_paciente'];
$id_paciente = $_POST['id_paciente_prontuario'];
$crm_doutor = $_POST['crm_doutor_prontuario'];

if($conn->query("SELECT id_prontuario from tb_prontuarios where id_paciente = $id_paciente")->num_rows == 0){
$query = "INSERT INTO tb_prontuarios(peso_paciente,altura_paciente,imc_paciente,descricaoExameFisico_paciente,solicitacaoExame_paciente,tipoSanguineo_paciente,alergias_paciente,id_paciente,crm_doutor)
values('$peso','$altura','$imc','$exame_fisico','$solicitacao_exame','$tipo_sanguineo','$alergias',$id_paciente,$crm_doutor);";
}else{
    $query = "UPDATE tb_prontuarios set peso_paciente = '$peso', altura_paciente = '$altura',imc_paciente = '$imc',descricaoExameFisico_paciente = '$exame_fisico',solicitacaoExame_paciente = '$solicitacao_exame',tipoSanguineo_paciente = '$tipo_sanguineo',alergias_paciente = '$alergias' where id_paciente = $id_paciente;";
}

$conn->query($query);
header("Location:../View/consultas.php");
?>
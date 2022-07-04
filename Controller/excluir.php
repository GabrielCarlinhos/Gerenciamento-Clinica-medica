<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$codigo = $_GET['codigo'];
if(isset($_GET['especialidade'])){
    $verificacao = "SELECT crm_doutor from tb_doutores where codigo_especialidade = $codigo";
    if($conn->query($verificacao)->num_rows >0){
    echo "não é possível excluir pois existem doutores cadastrados com essa especialidade";
    }else{
$query = "DELETE FROM tb_especialidades where codigo_especialidade = $codigo;";
$conn->query($query);
    }
}else if(isset($_GET['doutor'])){
$query = "DELETE FROM tb_doutores where crm_doutor = $codigo;";
$conn->query($query);
header("Location:pesquisa_doutores.php");
}else if(isset($_GET['paciente'])){
    $alteracao = "DELETE FROM tb_agendamentos where id_paciente = $codigo;";
    $conn->query($alteracao);
    $query = "DELETE FROM tb_pacientes where id_paciente = $codigo;";
    $conn->query($query);
    header("Location:pesquisa_pacientes.php");
}else if(isset($_GET['convenio'])){
    $alteracao = "UPDATE tb_pacientes set id_convenio =null where id_convenio ='$codigo';";
    $conn->query($alteracao);
    $query = "DELETE FROM tb_convenios where id_convenio = $codigo;";
    $conn->query($query);
}else if(isset($_GET['agendamento'])){
    $query = "DELETE from tb_agendamentos where codigo_agendamento = '$codigo';";
    $select = "SELECT id_paciente,crm_doutor,data_agendamento from tb_agendamentos where codigo_agendamento = '$codigo';";
    $result = $conn->query($select);
    while($rows = $result->fetch_assoc()){
        $paciente = $rows['id_paciente'];
        $doutor = $rows['crm_doutor'];
        $data = $rows['data_agendamento'];
        $motivo = $_GET['motivo'];
    }
    $insert = "INSERT into tb_agendamentosCancelados(id_paciente,crm_doutor,motivo_cancelamento,data_agendamento)
    values($paciente,'$doutor','$motivo','$data');";
    
    $conn->query($insert);
    $conn->query($query);
}
?>
<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');
$cpf = $_GET['cpf'];
if(isset($_GET['paciente'])){
    
    $query = "SELECT cpf_paciente FROM tb_pacientes where cpf_paciente = '$cpf';";
    $result=$conn->query($query);
    if($result->num_rows>0){
        echo "0";
    }else if($result->num_rows == 0){
        echo "1";
    }
}else if(isset($_GET['doutor'])){
    $query = "SELECT cpf_doutor from tb_doutores where cpf_doutor = '$cpf';";
    $result = $conn->query($query);
    if($result->num_rows>0){
        echo "0";
    }else if($result->num_rows == 0){
        echo "1";
    }
}
?>
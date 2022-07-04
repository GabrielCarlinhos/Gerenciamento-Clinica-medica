<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');
$cpf = $_GET['cpf'];
$query = "SELECT DISTINCT * FROM tb_pacientes where cpf_paciente ='$cpf';";
$result = $conn->query($query);
if($result->num_rows > 0){
    echo "1";
}else{
    echo "0";
}
?>
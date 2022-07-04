<?php
$numero = $_GET['numero_convenio'];
$conn = new MySQLi('LOCALHOST','root','','clinica');
$query = "SELECT * FROM tb_convenios where numero_convenio = '$numero';";
$result = $conn->query($query);
if($result->num_rows > 0){
    echo "1";
}else{
    echo "0";
}
?>
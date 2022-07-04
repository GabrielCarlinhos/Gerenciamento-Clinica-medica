<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');
$crm = $_GET['crm'];
$query = "SELECT crm_doutor from tb_doutores where crm_doutor = '$crm';";
$result = $conn->query($query);
if($result -> num_rows > 0){
    echo '1';
}else{
    echo '0';
}
?>
<?php
$descricao = $_GET['descricao'];
$conn = new MySQLi('LOCALHOST','root','','clinica');
$query = "SELECT * FROM tb_especialidades 
where descricao_especialidade = '$descricao';";
$result = $conn->query($query);
if($result->num_rows>0){
    echo '1';
}else{
    echo '0';
}
?>
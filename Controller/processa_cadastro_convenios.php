<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$nome_convenio = $_POST['nome_convenio'];
$numero_convenio = $_POST['numero_convenio'];
$id_convenio = $_POST['id_convenio'];

$query_select = "SELECT id_convenio from tb_convenios where id_convenio = '$id_convenio';";
if($conn->query($query_select)->num_rows>0){
    $query = "UPDATE tb_convenios set nome_convenio ='$nome_convenio',numero_convenio='$numero_convenio' where id_convenio = '$id_convenio';";
    $conn->query($query);
    header("Location:../View/pesquisa_convenios.php");
}else{
$query = "INSERT into tb_convenios(nome_convenio,numero_convenio)
values('$nome_convenio',$numero_convenio);";
$conn->query($query);
header("Location:../View/cadastro_convenios.php");
}
?>
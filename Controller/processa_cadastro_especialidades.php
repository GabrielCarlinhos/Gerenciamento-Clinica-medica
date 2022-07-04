<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$descricao = $_POST['nome_especialidade'];
$valor = str_replace(",",".",$_POST['valor_consulta_especialidade']);
$conn = new MySQLi('LOCALHOST','root','','clinica');
if(isset($_POST['codigo_especialidade'])){
    $id = $_POST['codigo_especialidade'];
$query = "UPDATE tb_especialidades set descricao_especialidade = '$descricao',valor_consulta='$valor' where codigo_especialidade = $id;";
$conn->query($query);
header('Location:../View/ pesquisa_especialidades.php');
}else{
$query = "INSERT INTO tb_especialidades(descricao_especialidade,valor_consulta)
values('$descricao','$valor');";
$conn->query($query);
header('Location:../View/cadastro_especialidades.php');
}
?>
    
</body>
</html>
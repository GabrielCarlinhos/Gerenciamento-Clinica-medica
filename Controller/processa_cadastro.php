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
$login = $_POST['nome_cadastro'];
$senha = $_POST['senha_cadastro'];
$email = $_POST['email_cadastro'];
$tipo = $_POST['tipo_cadastro'];
$conn = new MySQLi('LOCALHOST','root','','clinica');



$query = "INSERT INTO tb_usuarios(senha_usuario,login_usuario,situacao_usuario,tipo_usuario,email_usuario)
values('$senha','$login','ativo','$tipo','$email');";
$conn->query($query);

if(isset($_POST['crm_usuario'])){
    $crm = $_POST['crm_usuario'];
    $query = "SELECT id_usuario from tb_usuarios where email_usuario = '$email';";
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
        $id = $rows['id_usuario'];
$update_doutor = "UPDATE tb_doutores set id_usuario = $id where crm_doutor = $crm;";
$conn->query($update_doutor);
    }
}
header("Location:../View/cadastro_usuarios.php");

?>
</body>
</html>
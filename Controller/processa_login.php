<?php
$login = $_POST['usuario_login'];
$senha = $_POST['senha_login'];

$conn = new MySQLi('LOCALHOST','root','','clinica');

$query = "SELECT * FROM tb_usuarios WHERE
login_usuario = '$login' and
senha_usuario = '$senha'; ";

$result = $conn->query($query);
if($result->num_rows >0){
   session_start();
   $_SESSION['logado'] = true;
   while($rows = $result->fetch_assoc())
   {
       if ($rows['tipo_usuario'] == 'master'){
           $_SESSION['tipo'] = 'master';
       }else if($rows['tipo_usuario'] == 'admin'){
           $_SESSION['tipo'] = 'admin';
       }else if($rows['tipo_usuario'] == 'doutor'){
           $_SESSION['tipo'] = 'doutor';
           $_SESSION['id_doutor'] = $rows['id_usuario'];
       }
   }
   echo "<script>window.location = '../View/tela_principal.php'</script>";
}else{
    $_SESSION['logado'] = false;
    echo "<script>window.location = 'index.php?erro=true&login=$login'</script>";
}
?>
<?php
if(isset($_GET['nome_usuario'])){
    $nome_usuario = $_GET['nome_usuario'];
    $conn = new MySQLi('LOCALHOST','root','','clinica');
    $query = "SELECT * FROM tb_usuarios where login_usuario = '$nome_usuario';";
    $result = $conn->query($query);
    if($result->num_rows>0){
        echo '1';
    }else{
        echo '0';
    }
}if(isset($_GET['email_usuario'])){
    $email_usuario = $_GET['email_usuario'];
    $conn = new MySQLi('LOCALHOST','root','','clinica');
    $query = "SELECT * FROM tb_usuarios where email_usuario = '$email_usuario';";
    $result = $conn->query($query);
    if($result->num_rows>0){
        echo '1';
    }else{
        echo '0';
    }
}

?>
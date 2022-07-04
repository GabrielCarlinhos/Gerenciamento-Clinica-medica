<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='../jQuery/jquery.js'></script>
    <link rel="stylesheet" href="css.css">
</head>
<body id="body_titulo">


    <div id="container_login">
    <h1><img src="../imagens/Segclinic.png" width="100%" height="450%"  id="titulo_login"></h1>
    <form id='form_login' method="post" action = '../Controller/processa_login.php'>
       
    <label for = "usuario_login" id="label_usuario">Usuário</label>
    <input type="text" maxlength="16" placeholder = "Nome de usuário" id='usuario_login' class="input_login" name='usuario_login' value=<?php if(isset($_GET['login'])){echo $_GET['login'];}?>>
    <label for = "senha_login" id="label_senha">Senha</label>
    <input type="password" placeholder="Senha" id = 'senha_login' class="input_login" name='senha_login'>
    <input type="submit" id= 'botao_acessar' value="Acessar">
    <div id = 'erro_login' class = "erros">Dados incorretos</div>

   
</form>
</div>
</body>
<?php
if(isset($_GET['erro'])==true){
    echo "<script>$('#erro_login').show();</script>";
    unset($_GET['erro']);
}else{
    echo "<script>$('#erro_login').hide();</script>";
}
?>

</html>
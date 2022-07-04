<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
$nome_paciente = $_POST['nome_paciente'];
$cpf_paciente = $_POST['cpf_paciente'];
$telefone_paciente = $_POST['telefone_paciente'];
$email_paciente = $_POST['email_paciente'];
$genero_paciente = $_POST['genero_paciente'];
$rua_paciente = $_POST['rua_paciente'];
$numero_paciente = $_POST['numero_paciente'];
$bairro_paciente = $_POST['bairro_paciente'];
$cidade_paciente = $_POST['cidade_paciente'];
$estado_paciente = $_POST['estado_paciente'];
$cep_paciente = $_POST['cep_paciente'];
$dataNascimento_paciente = $_POST['dataNascimento_paciente'];
$nomeMae_paciente = $_POST['nomeMae_paciente'];
$rg_paciente = $_POST['rg_paciente'];
$convenio_paciente = $_POST['convenio_paciente'];
if($convenio_paciente == ""){
    $convenio_paciente = 'null';
}
$nome_acompanhante = $_POST['nome_acompanhante'];
$cpf_acompanhante = $_POST['cpf_acompanhante'];
$rg_acompanhante = $_POST['rg_acompanhante'];
$telefone_acompanhante = $_POST['telefone_acompanhante'];
$email_acompanhante = $_POST['email_acompanhante'];




$conn = new MySQLi('LOCALHOST','root','','clinica');

if(isset($_POST['id_paciente'])){
    $id = $_POST['id_paciente'];
$query = "UPDATE tb_pacientes set nome_paciente='$nome_paciente',cpf_paciente='$cpf_paciente',rg_paciente='$rg_paciente',telefone_paciente='$telefone_paciente',email_paciente='$email_paciente',genero_paciente='$genero_paciente',logradouro_paciente='$rua_paciente',numero_paciente='$numero_paciente',bairro_paciente='$bairro_paciente',cidade_paciente='$cidade_paciente',uf_paciente='$estado_paciente',cep_paciente='$cep_paciente',dataNascimento_paciente = '$dataNascimento_paciente',nomeMae_paciente = '$nomeMae_paciente',id_convenio=$convenio_paciente where id_paciente=$id;";
$conn->query($query);
if(trim($nome_acompanhante)!= ""){
    $updateAcompanhante = "UPDATE tb_acompanhantes set nome_acompanhante='$nome_acompanhante',cpf_acompanhante='$cpf_acompanhante',rg_acompanhante='$rg_acompanhante',telefone_acompanhante='$telefone_acompanhante',email_acompanhante='$email_acompanhante' where id_paciente=$id;";
    $conn->query($updateAcompanhante);
}
header("Location:../View/pesquisa_pacientes.php");
}else{
$query = "INSERT INTO tb_pacientes(nome_paciente,cpf_paciente,telefone_paciente,email_paciente,genero_paciente,logradouro_paciente,numero_paciente,bairro_paciente,cidade_paciente,uf_paciente,cep_paciente,dataNascimento_paciente,situacao_paciente,nomeMae_paciente,rg_paciente,id_convenio)
values('$nome_paciente','$cpf_paciente','$telefone_paciente','$email_paciente','$genero_paciente','$rua_paciente','$numero_paciente','$bairro_paciente','$cidade_paciente','$estado_paciente','$cep_paciente','$dataNascimento_paciente','ativo','$nomeMae_paciente','$rg_paciente',$convenio_paciente);";
$conn->query($query);
if(trim($nome_acompanhante) != ""){
    $query = "SELECT id_paciente FROM tb_pacientes where cpf_paciente = '$cpf_paciente';";
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
        $id = $rows['id_paciente'];
    }
    $query = "INSERT INTO tb_acompanhantes(nome_acompanhante,cpf_acompanhante,rg_acompanhante,telefone_acompanhante,id_paciente,email_acompanhante)
    values('$nome_acompanhante','$cpf_acompanhante','$rg_acompanhante','$telefone_acompanhante',$id,'$email_acompanhante');";
    $conn->query($query);
}
header("Location:../View/cadastro_pacientes.php");
}
    ?>


</head>
<body>
    
</body>
</html>
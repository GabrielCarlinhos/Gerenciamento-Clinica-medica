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
$crm_doutor = $_POST['crm_doutor'];
$nome_doutor = $_POST['nome_doutor'];
$cpf_doutor = $_POST['cpf_doutor'];
$rg_doutor = $_POST['rg_doutor'];
$telefone_doutor = $_POST['telefone_doutor'];
$cep_doutor = $_POST['cep_doutor'];
$rua_doutor = $_POST['rua_doutor'];
$bairro_doutor = $_POST['bairro_doutor'];
$cidade_doutor = $_POST['cidade_doutor'];
$estado_doutor = $_POST['estado_doutor'];
$numero_doutor = $_POST['numero_doutor'];
$especialidade_doutor = $_POST['especialidade_doutor'];

$conn = new MySQLi('LOCALHOST','root','','clinica');
$query_select = "SELECT * FROM tb_doutores where crm_doutor = '$crm_doutor';";
if($conn->query($query_select)->num_rows>0){
$query = "UPDATE tb_doutores set nome_doutor = '$nome_doutor',cpf_doutor = '$cpf_doutor',rg_doutor = '$rg_doutor',telefone_doutor = '$telefone_doutor',cep_doutor='$cep_doutor',logradouro_doutor = '$rua_doutor',bairro_doutor = '$bairro_doutor',cidade_doutor = '$cidade_doutor',estado_doutor = '$estado_doutor',numero_doutor='$numero_doutor',codigo_especialidade = '$especialidade_doutor' where crm_doutor='$crm_doutor';";
$conn->query($query);
header("Location:../View/pesquisa_doutores.php");

}else{
$query = "INSERT INTO tb_doutores(crm_doutor,nome_doutor,cpf_doutor,rg_doutor,telefone_doutor,cep_doutor,logradouro_doutor,bairro_doutor,cidade_doutor,estado_doutor,numero_doutor,codigo_especialidade)
values($crm_doutor,'$nome_doutor','$cpf_doutor','$rg_doutor','$telefone_doutor','$cep_doutor','$rua_doutor','$bairro_doutor','$cidade_doutor','$estado_doutor','$numero_doutor',$especialidade_doutor);";
echo $query;
$conn->query($query);
header("Location:../View/cadastro_doutores.php");
}
    ?>
    
</body>
</html>
<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$nome = $_GET['nome'];
$filtro = $_GET['filtro'];
$query = "SELECT p.*,date_format(dataNascimento_paciente,'%d/%m/%Y') as 'data',nome_convenio as 'convenio' FROM tb_pacientes as p left join tb_convenios as c on p.id_convenio = c.id_convenio where $filtro"."_paciente like '$nome%' order by(nome_paciente);";
$result = $conn->query($query);

$html = "<table id='tabela_pesquisa' border='1' width=250%>
<tr>
    <td width=180px height=40px>ID</td>
    <td width=180px height=40px>Nome</td>
    <td width=180px height=40px>CPF</td>
    <td width=180px height=40px>RG</td>
    <td width=180px height=40px>Telefone</td>
    <td width=180px height=40px>E-mail</td>
    <td width=180px height=40px>Gênero</td>
    <td width=180px height=40px>CEP</td>
    <td width=180px height=40px>Endereço</td>
    <td width=180px height=40px>Data de nascimento</td>
    <td width=180px height=40px>Situação</td>
    <td width=180px height=40px>Nome da Mãe</td>
    <td width=180px height=40px>Convênio</td>
    <td width=180px height=40px>Alterar</td>
    <td width=180px height=40px>Excluir</td>
</tr>";
while($rows = $result->fetch_assoc()){
    $id = $rows['id_paciente'];
$nome = $rows['nome_paciente'];
$cpf = $rows['cpf_paciente'];
$rg = $rows['rg_paciente'];
$telefone = $rows['telefone_paciente'];
$email = $rows['email_paciente'];
$genero = $rows['genero_paciente'];
$endereco = $rows['logradouro_paciente']." ".$rows['numero_paciente']." ".$rows['bairro_paciente']." ".$rows['cidade_paciente']." ".$rows['uf_paciente'];
$cep = $rows['cep_paciente'];
$dataNascimento = $rows['data'];
$situacao = $rows['situacao_paciente'];
$nomeMae = $rows['nomeMae_paciente'];
$convenio = $rows['convenio'];
if($convenio == ""){
    $convenio = "Não Possui";
}

$html = $html."<tr>
<td width=180px height=40px>$id</td>
<td width=180px height=40px>$nome</td>
<td width=180px height=40px>$cpf</td>
<td width=180px height=40px>$rg</td>
<td width=180px height=40px>$telefone</td>
<td width=180px height=40px>$email</td>
<td width=180px height=40px>$genero</td>
<td width=180px height=40px>$cep</td>
<td width=180px height=40px>$endereco</td>
<td width=180px height=40px>$dataNascimento</td>
<td width=180px height=40px>$situacao</td>
<td width=180px height=40px>$nomeMae</td>
<td width=180px height=40px>$convenio</td>
<td width=180px height=40px class='td_button' onclick='editar_paciente($id)' data-bs-toggle='modal' data-bs-target='#exampleModalToggle'><img src='../imagens/alterar.png' width='20%' height='90%'></td>
<td width=180px height=40px class='td_button' onclick='excluir_paciente($id)'><img src='../imagens/lixo.png' width='20%' height='90%'></td>



</tr>";
}
if($result->num_rows>0){
echo $html."</table>";
}else{
    echo "Não encontramos nada";
}


?>
<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$nome = $_GET['nome'];
$filtro = $_GET['filtro'];
$query = "SELECT d.*,
e.descricao_especialidade as especialidade from tb_doutores as d inner join tb_especialidades as e where(d.codigo_especialidade = e.codigo_especialidade) and $filtro"."_doutor like '$nome%' order by(d.nome_doutor);";
$result = $conn->query($query);

$html = "<table id='tabela_pesquisa' class='table-responsive' border=1 width=180%>
<tr>
    <td width=150px height=40px>CRM</td>
    <td width=150px height=40px>Nome</td>
    <td width=150px height=40px>Especialidade</td>
    <td width=150px height=40px>CPF</td>
    <td width=150px height=40px>RG</td>
    <td width=150px height=40px>Telefone</td>
    <td width=150px height=40px>CEP</td>
    <td width=150px height=40px>Endereço</td>
    <td width=150px height=40px>Alterar</td>
    <td width=150px height=40px>Excluir</td>
    
</tr>";
while($rows = $result->fetch_assoc()){
    $id = $rows['crm_doutor'];
$nome = $rows['nome_doutor'];
$especialidade = $rows['especialidade'];
$cpf = $rows['cpf_doutor'];
$rg = $rows['rg_doutor'];
$telefone = $rows['telefone_doutor'];
$cep = $rows['cep_doutor'];
$endereco = $rows['logradouro_doutor']." ".$rows['numero_doutor']." ".$rows['bairro_doutor']." ".$rows['cidade_doutor']." ".$rows['estado_doutor'];

$html = $html."<tr>
<td width=150px height=40px>$id</td>
<td width=150px height=40px>$nome</td>
<td width=150px height=40px>$especialidade</td>
<td width=150px height=40px>$cpf</td>
<td width=150px height=40px>$rg</td>
<td width=150px height=40px>$telefone</td>
<td width=150px height=40px>$cep</td>
<td width=150px height=40px>$endereco</td>
<td width=150px height=40px class='td_button' data-bs-toggle='modal' data-bs-target='#staticBackdrop'
onclick='editar_doutor($id)'><img src='../imagens/alterar.png' width='15%' height='90%'></td>
<td width=150px height=40px class='td_button' onclick='excluir_doutor($id)'><img src='../imagens/lixo.png' width='20%' height='90%'></td>
</tr>";
}
if($result->num_rows>0){
echo $html."</table>";
}else{
    echo "Não encontramos nada";
}


?>

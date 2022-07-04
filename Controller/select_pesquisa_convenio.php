<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$descricao = $_GET['descricao'];
$filtro = $_GET['filtro'];
$query = "SELECT * FROM tb_convenios where $filtro"."_convenio like '$descricao%' order by(nome_convenio);";
$result = $conn->query($query);

$html = "<table border=1px id='tabela_pesquisa' width=100%>
<tr>
    <td width=150px height=40px>ID</td>
    <td width=150px height=40px>Nome</td>
    <td width=150px height=40px>Número</td>
    <td width=150px height=40px>Alterar</td>
    <td width=150px height=40px>Excluir</td>
</tr>";
while($rows = $result->fetch_assoc()){
   $id = $rows['id_convenio'];
   $nome = $rows['nome_convenio'];
   $numero = $rows['numero_convenio'];
    $html = $html."<tr>
    <td width=150px height=40px>$id</td>
    <td width=150px height=40px>$nome</td>
    <td width=150px height=40px>$numero</td>
    <td onclick = 'editar_convenio($id)' class='td_button' width=150px height=40px data-bs-toggle='modal' data-bs-target='#exampleModal'><img src='../imagens/alterar.png' width='15%' height='80%'</td>
    <td onclick = 'excluir_convenio($id)' class='td_button' width=150px height=40px><img src='../imagens/lixo.png' width='15%' height ='80%'></td>
   
    </tr>";
}
if($result->num_rows>0){
echo $html."</table>";
}else{
    echo "<p id='mensagem_buscaZerada'>Não encontramos nada</p>";
}


?>
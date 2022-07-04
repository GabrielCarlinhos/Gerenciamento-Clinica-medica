<?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$descricao = $_GET['descricao'];
$filtro = $_GET['filtro'];
$query = "SELECT * FROM tb_especialidades where $filtro"."_especialidade like '$descricao%' order by(descricao_especialidade);";
$result = $conn->query($query);

$html = "<table border=1px id='tabela_pesquisa' class='table table-bordered' width=100%>
<tr>
    <td width=150px height=40px>Código</td>
    <td width=150px height=40px>Especialidade</td>
    <td width=150px height=40px>Valor da consulta</td>
    <td width=150px height=40px>Alterar</td>
    <td width=150px height=40px>Excluir</td>
</tr>";
while($rows = $result->fetch_assoc()){
   $codigo = $rows['codigo_especialidade'];
   $nome = $rows['descricao_especialidade'];
   $valor = "R$".str_replace(".",",",$rows['valor_consulta']);
    $html = $html."<tr>
    <td width=150px height=40px>$codigo</td>
    <td width=150px height=40px>$nome</td>
    <td width=150px height=40px>$valor</td>
    <td onclick = 'editar_especialidade($codigo)' class='td_button' data-bs-toggle='modal' data-bs-target='#exampleModal' width=150px height=40px><img src='../imagens/alterar.png' width='15%' height='110%'</td>
    <td onclick = 'excluir_especialidade($codigo)' class='td_button' width=150px height=40px><img src='../imagens/lixo.png' width='20%' height ='110%'></td>
   
    </tr>";
}
if($result->num_rows>0){
echo $html."</table>";
}else{
    echo "<p id='mensagem_buscaZerada'>Não encontramos nada</p>";
}


?>
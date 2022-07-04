<?php
for($a = 2022;$a <2030;$a++){
$conn = new MySQLi("Localhost","root","","clinica");
$query = "SELECT sum(valor_consulta), case month(data_consulta) when '1' then 'Janeiro' when '2' then 'Fevereiro' when '3' then 'Março' when '4' then 'Abril' when '5' then 'Maio' when '6' then 'Junho' when '7' then 'Julho' when '8' then 'Agosto' when '9' then 'Setembro' when '10' then 'Outubro' when '11' then 'Novembro' when '12' then 'Dezembro' end GroupId from tb_consultas where year(data_consulta) = '$a' group by month(data_consulta) ;";
$result = $conn->query($query);
$rows = [];
while($row = mysqli_fetch_all($result)){
    $rows = $row;
}
$valor = "";
$months = "";
 for($i = 0;$i<sizeof($rows);$i++){
    $months = $months."<td>".$rows[$i][1]."</td>";
 $valor = $valor."<td>R$".number_format($rows[$i][0],2,',',"")."</td>";
 }
 $query_total = "SELECT sum(valor_consulta) as 'total' from tb_consultas where year(data_consulta) = '$a';";
 $result_total = $conn->query($query_total);
 while($rows_total = $result_total->fetch_assoc()){
    $total = number_format($rows_total['total'],2,',',"");
 }

 echo "<div class=table-responsive id='details_tabela_relatorio'><details><summary>$a</summary><table class='table table-bordered'><tr>".$months."</tr>"."<tr>".$valor."</tr><tr><td>Total</td><td>R$$total</td></tr></table></details></div>";
}
?>
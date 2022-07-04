<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');



for($a = 2022;$a<2030;$a++){
    $query = "SELECT
 case month(data_consulta) when '1' then 'Janeiro' when '2' then 'Fevereiro' when '3' then 'Março' when '4' then 'Abril' when '5' then 'Maio' when '6' then 'Junho' when '7' then 'Julho' when '8' then 'Agosto' when '9' then 'Setembro' when '10' then 'Outubro' when '11' then 'Novembro' when '12' then 'Dezembro' end GroupId
 from tb_consultas where year(data_consulta) = '$a' group by month(data_consulta);";
    $rows = [];
    $result = $conn->query($query);
    while($row = mysqli_fetch_all($result)){
        $rows = $row;
    }
    
    
    echo "<details><summary>$a</summary>";
    for($i=0;$i<sizeof($rows);$i++){
       
        $mesAtual = $rows[$i][0];
        require_once '../Model/traduzirAno.php';
        $mesAtual = traduzirAno($mesAtual);
        

        
        $query_count = "SELECT e.descricao_especialidade as especialidade,count(*) as count from tb_consultas inner join tb_doutores as d on(tb_consultas.crm_doutor = d.crm_doutor) inner join tb_especialidades as e on(d.codigo_especialidade = e.codigo_especialidade) where monthname(data_consulta) = '$mesAtual' group by e.descricao_especialidade;";
        $result_count = $conn->query($query_count);
        echo "<details class='details_meses'><summary>".$rows[$i][0]."</summary><div id='details_tabela_relatorio' class='table-responsive'><table class = table table-bordered><tr><td>Especialidade</td><td>Total de consultas</td></tr>";
        while($row_count = $result_count->fetch_assoc()){
            
            $total = $row_count['count'];
            $especialidade = $row_count['especialidade'];
            echo "<tr><td>$especialidade</td><td>$total</td><td></td></tr>";
        }
        echo "</div></table></details>";
    }
    echo "</details>";
}
?>
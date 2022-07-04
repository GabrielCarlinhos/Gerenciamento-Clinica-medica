<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');



for($a = 2022;$a<2030;$a++){
    $query = "SELECT count(codigo_agendamento) as 'total',
 case month(data_agendamento) when '1' then 'Janeiro' when '2' then 'Fevereiro' when '3' then 'Março' when '4' then 'Abril' when '5' then 'Maio' when '6' then 'Junho' when '7' then 'Julho' when '8' then 'Agosto' when '9' then 'Setembro' when '10' then 'Outubro' when '11' then 'Novembro' when '12' then 'Dezembro' end GroupId
 from tb_agendamentosCancelados as a inner join tb_doutores as d on(a.crm_doutor = d.crm_doutor) inner join tb_pacientes as p on(a.id_paciente = p.id_paciente) where year(data_agendamento) = '$a' group by month(data_agendamento);";
    $rows = [];
    $result = $conn->query($query);
    while($row = mysqli_fetch_all($result)){
        $rows = $row;
    }
    
    
    echo "<details><summary>$a</summary>";
    for($i=0;$i<sizeof($rows);$i++){
        $total = $rows[$i][0];
        $mesAtual = $rows[$i][1];
        require_once '../Model/traduzirAno.php';
        $mesAtual = traduzirAno($mesAtual);
        

        
        $query_count = "SELECT motivo_cancelamento,count(*) as count from tb_agendamentosCancelados  where MONTHNAME(data_agendamento) = '$mesAtual' group by motivo_cancelamento;";
        $result_count = $conn->query($query_count);
        echo "<details class='details_meses'><summary>".$rows[$i][1]."</summary><div id='details_tabela_relatorio' class='table-responsive'><table class = table table-bordered><tr><td>Motivo</td><td>Quantidade</td><td>Total</td></tr>";
        while($row_count = $result_count->fetch_assoc()){
            
            $mensal = $row_count['count'];
            $motivo = $row_count['motivo_cancelamento'];
            echo "<tr><td>$motivo</td><td>$mensal</td><td></td></tr>";
        }
        echo "<tr><td></td><td></td><td>$total</td></tr></div></table></details>";
    }
    echo "</details>";
}
?>
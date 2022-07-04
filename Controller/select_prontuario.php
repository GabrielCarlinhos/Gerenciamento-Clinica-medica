<?php
$conn = new MySQLi("Localhost",'root','','clinica');
$id = $_GET['id'];
$query = "SELECT * from tb_prontuarios where id_paciente = $id;";
$result = $conn->query($query);
if($result->num_rows >0){
    while($rows = $result->fetch_assoc()){
        $peso = str_replace(".",",",$rows['peso_paciente']);
        $altura = str_replace(".",",",$rows['altura_paciente']);
        $imc = str_replace(".",",",$rows['imc_paciente']);
        $tipo_sanguineo = $rows['tipoSanguineo_paciente'];
        $exameFisico = $rows['descricaoExameFisico_paciente'];
        $solicitacaoExame = $rows['solicitacaoExame_paciente'];
        $alergias = $rows['alergias_paciente'];

    }
}else{
    $peso = "";
    $altura = "";
    $imc = "";
    $tipo_sanguineo = "";
    $exameFisico = "";
    $solicitacaoExame = "";
    $alergias = "";
}
header("Content-Type: application/json");
$array = array('peso' => "$peso", 'altura' => "$altura", 'imc' => "$imc", 'tipo_sanguineo' => $tipo_sanguineo, 'exameFisico' => $exameFisico, 'solicitacaoExame' => $solicitacaoExame, 'alergias' => $alergias);

echo json_encode($array);
?>
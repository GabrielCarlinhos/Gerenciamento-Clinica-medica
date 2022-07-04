<?php
$conn = new MySQLi("LOCALHOST",'root','','clinica');
$id = $_GET['id'];


header("Content-Type: application/json");
if($_GET['conteudo'] == "especialidade"){
$query = "SELECT * FROM tb_especialidades where codigo_especialidade = '$id';";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    $descricao = $rows['descricao_especialidade'];
    $valor = $rows['valor_consulta'];
    $array = array('descricao' => $descricao,'valor' => $valor);
}
}else if($_GET['conteudo'] == "doutor"){
$query = "SELECT * FROM tb_doutores where crm_doutor = '$id';";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){

$nome = $rows['nome_doutor'];
$cpf = $rows['cpf_doutor'];
$rg = $rows['rg_doutor'];
$telefone = $rows['telefone_doutor'];
$cep = $rows['cep_doutor'];
$numero = $rows['numero_doutor'];
$especialidade = $rows['codigo_especialidade'];

$array = array('nome' => $nome, 'cpf' => $cpf,'rg' => $rg,'telefone' => $telefone, 'cep' => $cep, 'numero' => $numero,'especialidade' => $especialidade);

}
}else if($_GET['conteudo'] == "paciente"){
    $query = "SELECT p.*,a.* FROM tb_pacientes as p left join tb_acompanhantes as a on(p.id_paciente = a.id_paciente) where p.id_paciente = '$id';";
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
        $nome = $rows['nome_paciente'];
        $cpf = $rows['cpf_paciente'];
        $rg = $rows['rg_paciente'];
        $telefone = $rows['telefone_paciente'];
        $cep = $rows['cep_paciente'];
        $numero = $rows['numero_paciente'];
        $email = $rows['email_paciente'];
        $dataNascimento = $rows['dataNascimento_paciente'];
        $genero = $rows['genero_paciente'];
        $nomeMae = $rows['nomeMae_paciente'];
        $convenio = $rows['id_convenio'];
        $nomeAcompanhante = $rows['nome_acompanhante'];
        $cpfAcompanhante = $rows['cpf_acompanhante'];
        $rgAcompanhante = $rows['rg_acompanhante'];
        $telefoneAcompanhante = $rows['telefone_acompanhante'];
        $email_acompanhante = $rows['email_acompanhante'];
        
        $array = array('nome' => $nome, 'cpf' => $cpf,'rg' => $rg,'telefone' => $telefone,'cep' => $cep, 'numero' => $numero,'dataNascimento' => $dataNascimento,'email' => $email,'genero' => $genero,'nomeMae' => $nomeMae,'convenio' => $convenio,'nomeAcompanhante' => $nomeAcompanhante,'cpfAcompanhante' => $cpfAcompanhante,'rgAcompanhante' => $rgAcompanhante,'telefoneAcompanhante' => $telefoneAcompanhante,'emailAcompanhante' => $email_acompanhante);

    }
}else if($_GET['conteudo'] == "convenio"){
    $query = "SELECT * from tb_convenios where id_convenio = '$id';";
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
        $nome = $rows['nome_convenio'];
        $numero = $rows['numero_convenio'];
        
        $array = array('nome' => $nome,'numero' => $numero);
    }
}

echo json_encode($array);
exit();
?>
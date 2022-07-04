<!DOCTYPE html>


<?php
session_start();
if($_SESSION['logado'] == false){
    header("Location:telaLogin.php");
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='../jQuery/jquery.js'></script>
    <script src='../Model/validacaoDados.js'></script>
    <script src='../Controller/formatacaoCampos.js'></script>
    <script src="../Controller/atalhos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel = 'stylesheet' href = 'css.css'>

</head>
<body>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Marcar Prontuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="../Controller/marcar_prontuario.php">
      <div id="input_prontuarios">
        <input type="hidden" id="id_paciente_prontuario" name="id_paciente_prontuario">
        <input type="hidden" id="crm_doutor_prontuario" name="crm_doutor_prontuario">
      <div><label for="peso_paciente">Peso:</label>
      <input type="text" class="input_cadastro" id="peso_paciente" name="peso_paciente" placeholder='Peso' maxlength='6'>
</div><div><label for="altura_paciente">Altura:</label>
      <input type="text" class="input_cadastro" id="altura_paciente" name="altura_paciente" placeholder='Altura' maxlength='3'>
</div><div><label for="imc_paciente">IMC:</label>
      <input type="text" class="input_cadastro" id="imc_paciente" name="imc_paciente" readonly placeholder='IMC'>
</div>
<div><label for="tipo_sanguineo_paciente">Tipo Sanguíneo</label>
<select class="input_cadastro" id="tipo_sanguineo_paciente" name="tipo_sanguineo_paciente">
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
</select>
</div><div><label for="exame_fisico_paciente">Exame físico:</label>
      <textarea rows='10' cols='35' id="exame_fisico_paciente" name="exame_fisico_paciente"></textarea>
</div><div><label for="solicitacao_exame_paciente">Solicitação de exame:</label>
<textarea rows='10' cols='35' id="solicitacao_exame_paciente" name="solicitacao_exame_paciente"></textarea>
</div><div><label for="alergias_paciente">Alergias:</label>
<textarea rows='10' cols='35' id="alergias_paciente" name="alergias_paciente"></textarea>
</div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="content">
<div id="tab_titulo">
    <a href="tela_principal.php"><h1 id ='titulo_paginaPrincipal'><img src="../imagens/Segclinic.PNG" width="20%" height="450%"></img></h1></a>
</div>
<a href="telaLogin.php"><img id="sair" src="../imagens/sair.png" width="7%"></img></a>
<div id="content2">
<div id="paginaPrincipal_selecoes">
    <ul id="ul_cadastro" class = "ul_principal"><article>Cadastro</article>
    <li class="li_cadastro" onclick="window.location = 'cadastro_usuarios.php'">Usuários (Alt+c)</li>
    <li class="li_cadastro" onclick="window.location = 'cadastro_especialidades.php'">Especialidades (Alt+e)</li>
    <li class="li_cadastro" onclick="window.location = 'cadastro_doutores.php'">Doutores (Alt+d)</li>
    <li class="li_cadastro" onclick="window.location = 'cadastro_pacientes.php'">Pacientes (Alt+p)</li>
    </ul>
    <ul id="ul_agendas" class = ul_principal><article>Agenda</ul></article>
    <ul id="ul_consultas" class = ul_principal><article>Consultas</ul></article>
    <ul id="ul_pacientes" class = ul_principal><article>Pacientes</ul></article>
    <ul id="ul_convenios" class = ul_principal><article>Convênios</ul></article>
    <ul id="ul_doutores" class = ul_principal><article>Doutores</ul></article>
    <ul id="ul_relatorios" class = ul_principal><article>Relatórios</article>
    <li class="li_relatorios" onclick="window.location ='relatorio_financeiro.php'">Financeiro</li>
    <li class="li_relatorios" onclick="window.location ='relatorio_operacional.php'">Operacional</li>
</ul>
    <ul id="ul_especialidades" class = ul_principal><article>Especialidades</ul></article>
</div>



<div id="content_agenda">
  
<h2 class="titulo_cadastro">Consultas</h2>

<h3 class="titulo_cadastro"><?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
if($_SESSION['tipo'] == "doutor"){
    $id = $_SESSION['id_doutor'];
    $query = "SELECT nome_doutor,crm_doutor from tb_doutores where id_usuario=$id;";
}else{
    $query = "SELECT nome_doutor,crm_doutor from tb_doutores;";
}

$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    $crm = $rows['crm_doutor'];
    if($_SESSION['tipo'] == "doutor"){
    echo $rows['nome_doutor'];
    }
}
if($result->num_rows <1){
    $crm = "";
}
?></h3>


 <div id='agendamento_content'>
   
<?php
$query = "SELECT distinct date_format(data_consulta,'%d/%m/%Y') as 'data' from tb_consultas where crm_doutor like '%$crm' order by data_consulta;";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    $data = $rows['data'];
    $query = "SELECT c.*,p.nome_paciente as 'paciente' FROM tb_consultas as c inner join tb_pacientes as p on(c.id_paciente = p.id_paciente) where date_format(data_consulta,'%d/%m/%Y') = '$data' and crm_doutor=$crm;";
    $result_data = $conn->query($query);
    echo "<details><summary>$data</summary>
     <div class='tabela_agenda'><div class='div_agenda'><strong>Hórario</strong></div><div class='div_agenda'><strong>Paciente</strong></div><div class='div_agenda'><strong>Prontuário</strong></div></div>";
    while($row = $result_data->fetch_assoc()){
        $codigo = $row['codigo_consulta'];
        $horario = $row['horario_consulta'];
        $id_paciente = $row['id_paciente'];
        $paciente = $row['paciente'];
        echo "<div  class='content_tabela_agenda'><div class='tabela_agenda' id='agenda_$codigo'><div class='div_agenda'>$horario</div><div class ='div_agenda'>$paciente</div><div class='div_agenda'><button type='button' onclick='marcar_prontuario($id_paciente,$crm)' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Marcar prontuário</button></div>
      </div></div>";
    }
    echo "</details>";
}
?>


  </div>
      </div>
   
        </div>
        </div>
    
</body>
</html>
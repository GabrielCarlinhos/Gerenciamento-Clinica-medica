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





<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Gerar Consulta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class='input_agenda'>
        <form method="post" action="../Controller/gerar_consulta.php">
          <input type="hidden" id="codigo_agendamento_consulta" name="codigo_agendamento_consulta">
      <div><label for="data_consulta">Data:</label>
      <input type="date" class="input_cadastro" id="data_consulta" name="data_consulta" readonly>
</div><div><label for="horario_consulta">Horário:</label>
      <input type="time" class="input_cadastro" id="horario_consulta" name="horario_consulta" readonly  maxlength = '5'>
</div><div><label for="valor_consulta">Valor:</label>
      <input type="text" class="input_cadastro" id="valor_consulta" name="valor_consulta" readonly>
      <input type="hidden" id="valor_consulta_hidden">
</div><div><label for="convenio_consulta">Convênio:</label>
     <select class = "input_cadastro" id="convenio_consulta" name="convenio_consulta">
     <option value = "particular">Particular</option>
     <option value = "social">Social</option>

</select>  
</div><div><label for="paciente_consulta">Paciente:</label>
      <input type="text" class="input_cadastro" id="paciente_consulta" name="paciente_consulta" readonly>
      <input type="hidden" id="id_paciente_consulta" name="id_paciente_consulta">
      </div>
      <div><label for="doutor_consulta">Doutor:</label>
      <input type="text" class="input_cadastro" id="doutor_consulta" name="doutor_consulta" readonly>
      <input type="hidden" id="crm_doutor_consulta" name="crm_doutor_consulta">
</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
</form>
</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Remarcar consulta</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class='input_agenda'>
          <form method='post' action='../Controller/processa_agendamento.php' onSubmit='return validaDados_agenda(true)'>
          <div>
              <label for='codigo_agendamento'>Código:</label>
              <input type='text' class='input_cadastro' id='codigo_agendamento' name='codigo_agendamento' readonly>
          <label for='doutor_agenda'>Doutor:</label>
          <input class='input_cadastro' id='doutor_agenda_mascara' disabled></input>
          <input type='hidden' id='doutor_agenda' name='doutor_agenda'>
</div><div><label for='paciente_agenda'>Paciente:</label>
         <input type="hidden" id="paciente_agenda" name='paciente_agenda'>
         <input type="text" class='input_cadastro' id='nome_paciente_agenda' disabled>
            </div><div><label for ='data_agenda'>Data:</label>
        <input type='date' class='input_cadastro' id='data_agenda' name='data_agenda'>
            </div><div><label for='horario_agenda'>Horário:</label>
        <input type='time' class='input_cadastro' id='horario_agenda' name='horario_agenda'>
            </div></div>
      </div>
      <div class="modal-footer">
      <div id="erro_agenda" class='erros'></div>
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Remarcar Consulta</button>
            </form>
      </div>
    </div>
  </div>
</div>
<div id="content_agenda">
<h2 class="titulo_cadastro"><?php
$conn = new MySQLi('LOCALHOST','root','','clinica');
$crm = $_GET['crm'];
$query = "SELECT nome_doutor from tb_doutores where crm_doutor = $crm;";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    echo $rows['nome_doutor'];
}
?></h2>


 <div id='agendamento_content'>
<?php
$query = "SELECT distinct date_format(data_agendamento,'%d/%m/%Y') as 'data' from tb_agendamentos where crm_doutor = $crm order by data_agendamento;";
$result = $conn->query($query);
while($rows = $result->fetch_assoc()){
    $data = $rows['data'];
    $query = "SELECT a.*,p.nome_paciente as 'paciente' FROM tb_agendamentos as a inner join tb_pacientes as p on(a.id_paciente = p.id_paciente) inner join tb_doutores as d on(a.crm_doutor = d.crm_doutor) where date_format(data_agendamento,'%d/%m/%Y') = '$data' and d.crm_doutor = '$crm';";
    $result_data = $conn->query($query);
    echo "<details><summary>$data</summary>
     <div class='tabela_agenda'><div class='div_agenda'><strong>Hórario</strong></div><div class='div_agenda'><strong>Paciente</strong></div><div class='div_agenda'><strong>Gerar Consulta</strong></div></div>";
    while($row = $result_data->fetch_assoc()){
        $codigo = $row['codigo_agendamento'];
        $horario = $row['horario_agendamento'];
        $paciente = $row['paciente'];
        echo "<div  class='content_tabela_agenda'><div class='tabela_agenda' id='agenda_$codigo'><div class='div_agenda'>$horario</div><div class='div_agenda'>$paciente</div><div class='div_agenda'><button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='gerarConsulta($codigo)'>Gerar Consulta</button></div><div class='div_agenda'><button type='button' onclick='editar_agendamento($codigo)' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
        Remarcar
      </button>
      </div><div class='div_agenda'><button onclick='cancelar_agendamento($codigo)' type='button' class='btn btn-danger'>Cancelar</button></div></div></div>";
    }
    echo "</details>";
}
?>
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Deseja cancelar a consulta?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_agendamento">
        <select id="motivo_cancelamento" name="motivo_cancelamento" value="">
          <option value="">Motivo do cancelamento</option>
          <option value="naoCompareceu">Paciente não exclareceu</option>
          <option value="esquecimento">Paciente esqueceu da consulta</option>
          <option value="atraso">Paciente se atrasou para a consulta</option>
          <option value="imprevisto">Paciente não compareceu por imprevisto</option>
          <option value="erro">Erro operacional</option>
          <option value="outros">Outros</option>
        </select>
        <input type="text" id="texto_motivo" name="texto_motivo" placeholder="Digite o motivo do cancelamento">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="cancelar_agendamento_confirma($('#id_agendamento').val())">Cancelar consulta</button>
      </div>
    </div>
  </div>

  </div>
      </div>
   
        </div>
        </div>
    
</body>
</html>
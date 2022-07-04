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
<div id="content_agenda">
<h2 class="titulo_cadastro">Agenda</h2>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Agendar consulta</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class='input_agenda'>
          <form method='post' action='../Controller/processa_agendamento.php' onSubmit='return validaDados_agenda(false)'>
          <div>
          <label for='doutor_agenda'>Doutor:</label>
          <input class='input_cadastro' id='doutor_agenda_mascara' disabled></input>
          <input type='hidden' id='doutor_agenda' name='doutor_agenda'>
</div><div><label for='paciente_agenda'>Cpf do Paciente:</label>
        <input type='text' class='input_cadastro' id='paciente_agenda' name='paciente_agenda' maxlength='14' placeholder='ddd.ddd.ddd-dd'>
            </div><div><label for ='data_agenda'>Data:</label>
        <input type='date' class='input_cadastro' id='data_agenda' name='data_agenda'>
            </div><div><label for='horario_agenda'>Horário:</label>
        <input type='time' class='input_cadastro' id='horario_agenda' name='horario_agenda'>
            </div></div>
      </div>
      <div class="modal-footer">
        <div id="erro_agenda" class='erros'></div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Agendar consulta</button>
            </form>
      </div>
    </div>
  </div>
</div>

 <div id='agenda_content'>
   
<div class='div_agenda'><strong>Nome</strong></div><div class='div_agenda'><strong>Especialidade</strong></div><div class='div_agenda'><strong>Agendar consulta</strong></div>

    <?php
    
    $conn = new MySQLi('LOCALHOST','root','','clinica');
    $query = "SELECT d.nome_doutor as doutor,d.crm_doutor as crm,e.descricao_especialidade as especialidade from tb_doutores as d inner join tb_especialidades as e where(d.codigo_especialidade = e.codigo_especialidade);";
    $result = $conn->query($query);
    
    while($rows = $result->fetch_assoc()){
        $doutor = $rows['doutor'];
        $especialidade = $rows['especialidade'];
        $crm = $rows['crm'];
        $query_agendamentos = "SELECT time_format(a.horario_agendamento,'%H:%i') as horario,date_format(a.data_agendamento,'%d/%m/%Y') as 'data', p.nome_paciente as paciente from tb_agendamentos as a inner join tb_pacientes as p where(a.id_paciente = p.id_paciente) and a.crm_doutor = $crm;";
        $result_agendamento = $conn->query($query_agendamentos);
        
        echo "<a href='agendamentos.php?crm=$crm'><div><div class='div_agenda'>$doutor</a></div><div class='div_agenda'>$especialidade</div><div class='div_agenda'><button type='button' onclick='fill_doutor(`$doutor`,$crm)' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
        Agendar Consulta
      </button></div>";
     
    }
    ?>

  </div>
      </div>
   
        </div>
        </div>
    
</body>
</html>
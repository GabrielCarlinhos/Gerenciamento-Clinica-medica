<?php
session_start();
if($_SESSION['logado'] == false){
    header('Location:telaLogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale = 1.0"/>
    <title>Document</title>
    <script src='../jQuery/jquery.js'></script>
    <script src='../Model/validacaoDados.js'></script>
    <script src='../Controller/formatacaoCampos.js'></script>
    <script src="../Controller/atalhos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">  
    
</head>
<body id="body_pesquisa">

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Alterar Doutor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="../Controller/processa_cadastro_doutores.php" onSubmit ="return validaDados_doutores()">
    <div id="input_doutores">
        <div><label for="crm_doutor">CRM:</label>
        <input type="text" class="input_cadastro" id="crm_doutor" name="crm_doutor" maxlength = "6" placeholder = "CRM" readonly>
</div><div><label for="nome_doutor">Nome Completo:</label>
<input type="text" class="input_cadastro" id="nome_doutor" name="nome_doutor" minlength = "3" maxlength = "45" placeholder = "Nome Completo">
</div><div><label for="cpf_doutor">CPF:</label>
<input type="text" class="input_cadastro" id="cpf_doutor" name="cpf_doutor" maxlength = "14" placeholder="xxx.xxx.xxx-xx" >
</div><div><label for="rg_doutor">RG:</label>
<input type="text" class="input_cadastro" id="rg_doutor" name="rg_doutor" maxlength="9" placeholder="x.xxx.xxx">
</div><div><label for="telefone_doutor">Telefone:</label>
<input type="text" class="input_cadastro" id="telefone_doutor" name="telefone_doutor" maxlength="13" placeholder="(XX)xxxxx-xxxx">
</div><div><label for="cep_doutor">CEP:</label>
<input type="text" class="input_cadastro" id="cep_doutor" name="cep_doutor" placeholder="CEP" maxlength = "9">
</div><div><label for="rua_doutor">Número:</label>
<input type="text" class="input_cadastro" id="numero_doutor" name="numero_doutor" placeholder="Número" maxlength="5">
</div><div><label for="rua_doutor">Rua:</label>
<input type="text" class="input_cadastro" id="rua_doutor" name="rua_doutor" placeholder="Rua" maxlength="45">
</div><div><label for="rua_doutor">Bairro:</label>
<input type="text" class="input_cadastro" id="bairro_doutor" name="bairro_doutor" placeholder="Bairro" maxlength="45">
</div><div><label for="estado_doutor">Estado:</label>
<input class="input_cadastro" id="estado_doutor" name="estado_doutor" placeholder="Estado">
</div><div><label for="rua_doutor">Cidade:</label>
<input value = "" class="input_cadastro" id="cidade_doutor" name="cidade_doutor" placeholder="Cidade">
</div><div><label for="especialidade_doutor">Especialidade:</label>
    <select class="input_cadastro" id="especialidade_doutor" name="especialidade_doutor" value="">
    <option value="">Selecione a Especialidade</option>
    <?php
    $conn = new MySQLi('LOCALHOST','root','','clinica');
    $query = "SELECT * FROM tb_especialidades;";
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
    ?><option value=<?php echo $rows['codigo_especialidade']?>><?php echo $rows['descricao_especialidade']?></option><?php
    }
    ?>
</select></div>
</div>
      </div>
      <div class="modal-footer">
      <div class="erros" id="erro_doutores"></div>
<div id="form_confirm_especialidade">
<button id="button_cancela" data-bs-dismiss="modal" type="reset" class = "button_confirm">Cancelar</button>
    <input  id= "button_confirm" class = "button_confirm" value = Salvar type = 'submit'>
    
</div>
      </div>
</form>
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
<div id="content_pesquisa">
<h2 class="titulo_cadastro">Pesquisar Doutores</h2>
    <div id="botoes_cadastro_especialidade">
    <button class='button_pesquisa' id="button_pesquisar_doutores">Pesquisar</button>
    <button class='button_incluir' onclick="window.location ='cadastro_doutores.php'" id="button_incluir_doutores">Incluir</button>
</div>


<div id="container_pesquisa">

<input type = "text" id="filtro_doutor" placeholder="Pesquisar">
<select id="selecao_filtro_doutor">
<option value ="nome">Filtrar por Nome</option>
<option value ="crm">Filtrar por CRM</option>
</select>
<div class="content_pesquisa" id="content_pesquisa_doutor">



    </div>
</div>
</div>
</div>
        </div>


</body>
</html>
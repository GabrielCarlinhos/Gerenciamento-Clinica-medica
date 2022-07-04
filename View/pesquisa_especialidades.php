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
<body id="body_pesquisa>">
    
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Especialidade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method = "POST" action = "../Controller/processa_cadastro_especialidades.php" onSubmit="return validaDados_especialidades($('#nome_especialidade_mascara').val())">
              <div id='input_especialidades'>
<label for="codigo_especialidade">Código:</label>
<div><input type= 'text' readonly class="input_cadastro" id="codigo_especialidade" name="codigo_especialidade">
<input type="hidden" id="nome_especialidade_mascara">
</div><div><label for="nome_especialidade" id="nome_especialidade_label">Descrição:</label>
    <input type = 'text' class = "input_cadastro" id='nome_especialidade' name='nome_especialidade' placeholder='Descrição' maxlength = '45'>
    </div><div><label for="valor_consulta_especialidade">Valor da Consulta:</label>
    <input type = 'text' class = "input_cadastro" id='valor_consulta_especialidade' name='valor_consulta_especialidade' placeholder='Valor da consulta'>
</div>
              </div>
      </div>
      <div class="modal-footer">
    <div id="erro_especialidade" class = "erros"></div>
    <div id="form_confirm_especialidade">
    <button id="button_cancela" type="reset" class = "button_confirm" data-bs-dismiss="modal">Cancelar</button>
    <input  id= "button_confirm" class = "button_confirm" value = Salvar type = 'submit'>
    

</div>
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
<div id="pagina_cadastro_especialidades">
    <div id="content_pesquisa">
<div class="content_cadastro" id="content_especialidade">
    <h2 class="titulo_cadastro">Pesquisar Especialidades</h2>
    <div id="botoes_cadastro_especialidade">
    <button class='button_pesquisa' id="button_pesquisar_especialidades">Pesquisar</button>
    <button class='button_incluir' onclick ="window.location='cadastro_especialidades.php'" id="button_incluir_especialidades">Incluir</button>
</div>

<div id="container_pesquisa">
<input type = "text" id="filtro_especialidade" placeholder="Pesquisar">
<select id="selecao_filtro_especialidade">
<option value ="descricao">Filtrar por descrição</option>
<option value ="codigo">Filtrar por código</option>
</select>
<div class="content_pesquisa" id="content_pesquisa_especialidade">

    </div>
</div>
</div>
</div>
        </div>

</div>
</body>
</html>
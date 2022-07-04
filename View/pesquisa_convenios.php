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
        <h5 class="modal-title" id="exampleModalLabel">Alterar Convênio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post" action="../Controller/processa_cadastro_convenios.php" onSubmit = "return validaDados_convenio($('#numero_convenio_validado').val())">
          <div id="input_convenios">
               <div><label for="id_convenio">ID:</label>
            <input type='text' class="input_cadastro" id="id_convenio" name="id_convenio" readonly></div>
               <div><label for="nome_convenio">Nome do convênio:</label>
            <input type="text" class="input_cadastro" id="nome_convenio" name="nome_convenio" maxlength='24'></div>
            <div><label for="numero_convenio">Número do convênio</label>
        <input type="text" class="input_cadastro" id="numero_convenio" name="numero_convenio" maxlength='12'></div>
        <input type="hidden" id="numero_convenio_validado">
         

<div class="erros" id="erro_convenios"></div>
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
<div id="content_pesquisa">
<div id="pagina_cadastro_especialidades">
<div class="content_cadastro" id="content_especialidade">
    <h2 class="titulo_cadastro">Pesquisar Convênios</h2>
    <div id="botoes_cadastro_especialidade">
    <button class='button_pesquisa' id="button_pesquisar_especialidades">Pesquisar</button>
    <button class='button_incluir' onclick ="window.location='cadastro_convenios.php'" id="button_incluir_especialidades">Incluir</button>
</div>

<div id="container_pesquisa">
<input type = "text" id="filtro_convenio" placeholder="Pesquisar">
<select id="selecao_filtro_convenio">
<option value ="nome">Filtrar por nome</option>
<option value ="numero">Filtrar por número</option>
</select>
<div class="content_pesquisa" id="content_pesquisa_convenio">

    </div>
</div>
<div id='content_alterar'>

</div>
</div>
        </div></div>
</body>
</html>
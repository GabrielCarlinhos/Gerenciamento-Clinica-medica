<!DOCTYPE html>


<?php
session_start();
if($_SESSION['logado'] == false){
    header("Location:telaLogin.php");
}
if($_SESSION['tipo'] !="master"){
    echo "<script>window.location='tela_principal.php'
    alert('você não tem acesso a essa área')</script>";
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
       

       <div class="content_cadastro" id="content_cadastro">
       <h2 class="titulo_cadastro">Cadastro de convênios</h2>
       <div id="botoes_cadastro_especialidade">
      
    <button class='button_pesquisa' onclick="window.location = 'pesquisa_convenios.php'" id="button_pesquisar_usuarios">Pesquisar</button>
    <button class='button_incluir' id="button_incluir_usuarios">Incluir</button>
</div>

    
       
       <form method = "post" action="../Controller/processa_cadastro_convenios.php" onSubmit = "return validaDados_convenio()">
           <div id="input_convenios">
               <div><label for="nome_convenio">Nome do convênio:</label>
            <input type="text" class="input_cadastro" id="nome_convenio" name="nome_convenio" maxlength='24'></div>
            <div><label for="numero_convenio">Número do convênio</label>
        <input type="text" class="input_cadastro" id="numero_convenio" name="numero_convenio" maxlength='12'></div>
         

<div class="erros" id="erro_convenios"></div>
</div>
       <div id="form_confirm_especialidade">
    <input  id= "button_confirm" class = "button_confirm" value = Salvar type = 'submit'>
    <button id="button_cancela" type="reset" class = "button_confirm">Cancelar</button>
</div>
</form>
   </div>
        </div>
        </div>
    
</body>
</html>
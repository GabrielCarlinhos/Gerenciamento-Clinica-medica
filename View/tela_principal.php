
<!DOCTYPE html>
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
    <link rel ='stylesheet' href = 'css.css'>
</head>
<body >
    

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

<div id="content_selecoes"> 
<h2 id="titulo">Bem vindo ao sistema de gestão para clínicas</h2>
<div id="images">

    <a href="cadastro_usuarios.php"><div><img src="../imagens/Cadastro.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Cadastro</figcaption></div></a>
    <a href="consultas.php"><div><img src="../imagens/Consultas.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Consultas</figcaption></div></a>
    <a href="cadastro_convenios.php"><div><img src="../imagens/Convenio.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Convênios</figcaption></div></a>
    <a href="cadastro_doutores.php"><div><img src="../imagens/Doutores.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Doutores</figcaption></div></a>
    <a href="cadastro_especialidades.php"><div><img src="../imagens/Especialidade.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Especialidades</figcaption></div></a>
    <a href="cadastro_pacientes.php"><div><img src="../imagens/Paciente.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Pacientes</figcaption></div></a>
    <a href="agenda.php"><div><img src="../imagens/Agenda.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Agendamentos</figcaption></div></a>
    <a href="relatorio_financeiro.php"><div><img src="../imagens/Relatório.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Relatórios</figcaption></div></a>
    <a href="telaLogin.php"><div><img src="../imagens/sair2.png" class="imagens_tela_principal" width = "80px;" height = "80px"><figcaption>Sair</figcaption></div></a>
</div>
</div>
</div>
</div>
</body>
</html>

<?php
session_start();
if($_SESSION['logado'] == false){
    
    echo "<script>window.location = 'telaLogin.html'</script>";
}

?>
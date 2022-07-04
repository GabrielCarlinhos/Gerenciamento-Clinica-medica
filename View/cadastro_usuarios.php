<!DOCTYPE html>


<?php
session_start();
if($_SESSION['logado'] == false){
    header("Location:./telaLogin.php");
}
if($_SESSION['tipo'] !="master"){
    echo "<script>window.location='./tela_principal.php'
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
       <h2 class="titulo_cadastro">Cadastro de usuários</h2>
       <div id="botoes_cadastro_especialidade">
      
    <button class='button_pesquisa' id="button_pesquisar_usuarios">Pesquisar</button>
    <button class='button_incluir' id="button_incluir_usuarios">Incluir</button>
</div>

    
       <div id="form_usuarios">
       <form method = "post" action="../Controller/processa_cadastro.php" onSubmit="return validaDados_usuarios()">
           <div id="input_cadastro">
           <div><label for= "nome_cadastro">Nome de usuário:</label>
           <input class="input_cadastro" type="text" id="nome_cadastro" name="nome_cadastro" placeholder = "Usuário 3-16 caracteres" minlength = "3" maxlength = "16">
</div><div><label for= "senha_cadastro" >Senha:</label>
           <input class="input_cadastro" type="password" id="senha_cadastro" name="senha_cadastro" placeholder= "Senha" minlength = "3" maxlength = "24">
</div><div><label for= "confirmacao_senha_cadastro">Confirme a senha:</label>
           <input class="input_cadastro" type="password" id="confirmacao_senha_cadastro" name="confirmacao_senha_cadastro" placeholder="Confirme a senha" maxlength="24">
</div><div><label for= "email_cadastro">E-mail:</label>
           <input class="input_cadastro" type="text" id="email_cadastro" name="email_cadastro" placeholder = "E-mail">
           </div><div><label for="tipo_cadastro">Função:</label>
<select class="input_cadastro" id="tipo_cadastro" width="500px" value="" name="tipo_cadastro">
               <option value="">Selecione a função do usuário</option>
               <option value="admin">Admin</option>
               <option value="doutor">Doutor</option>
               <option value="master">Gerente</option>
           </select>
</div>
<div id="div_crm_usuario"><label for="crm_usuario">CRM:</label>
    <input type="text" class="input_cadastro" id="crm_usuario" name="crm_usuario" placeholder="CRM" maxlength='6' title="Deve ser preenchido caso o usuário seja um doutor" disabled>
</div>

<div id="form_confirm_especialidade">
    <input  id= "button_confirm" class = "button_confirm" value = Salvar type = 'submit'>
    <button id="button_cancela" type="reset" class = "button_confirm">Cancelar</button>
</div>
<div class="erros" id="erro_usuarios"></div>
</div>
           

       </div>
    
</form>
   </div>
   </div>
        </div>
    
</body>
</html>
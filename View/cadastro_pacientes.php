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
<body>
    <div id="outside_area">
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
    <h2 class="titulo_cadastro">Cadastro de Pacientes</h2>
    <div id="botoes_cadastro_especialidade">
    <button class='button_pesquisa' onclick = "window.location ='pesquisa_pacientes.php'" id="button_pesquisar_pacientes">Pesquisar</button>
    <button class='button_incluir' id="button_incluir_pacientes">Incluir</button>
</div>
<form method="post" action="../Controller/processa_cadastro_pacientes.php" onSubmit = 'return validaDados_pacientes()'>
    <div id="input_pacientes">
    <div><label for="id_paciente">Código:</label>
    <input type="text" class="input_cadastro" readonly>
</div><div><label for="nome_paciente">Nome completo:</label>
    <input type="text" class="input_cadastro" id="nome_paciente" name="nome_paciente" placeholder="Nome" minlength = "3" maxlength = "45">
    </div><div><label for="cpf_paciente">CPF:</label>
    <input type="text" class="input_cadastro" id="cpf_paciente" name="cpf_paciente" placeholder="xxx.xxx.xxx-xx" maxlength="14">
    </div><div><label for="rg_paciente">RG:</label>
    <input type="text" class="input_cadastro" id="rg_paciente" name="rg_paciente" placeholder="x.xxx.xxx" maxlength="9">
    </div><div><label for="dataNascimento_paciente">Data de nascimento:</label>
    <input type="date" class="input_cadastro" id="dataNascimento_paciente" name="dataNascimento_paciente" maxlength = "10" minlength = "10">
</div><div><label for="idade_paciente">Idade:</label>    
<input type="text" class="input_cadastro" id="idade_paciente" name="idade_paciente" placeholder="Idade" readonly>
</div><div><label for="genero_paciente">Gênero:</label>
    <select class="input_cadastro" id="genero_paciente" name="genero_paciente" value="">
        <option value="">Selecione o gênero</option> 
        <option value="masculino">Masculino</option>
        <option value="feminino">Feminino</option>
        <option value="outros">Outros</option>
    </select>
    </div><div><label for="cep_paciente">CEP:</label>
<input type="text" class="input_cadastro" id="cep_paciente" name="cep_paciente" placeholder="CEP" maxlength = "9">
</div><div><label for="rua_paciente">Número:</label>
<input type="text" class="input_cadastro" id="numero_paciente" name="numero_paciente" placeholder="Número">
</div><div><label for="rua_paciente">Rua:</label>
<input type="text" class="input_cadastro" id="rua_paciente" name="rua_paciente" placeholder="Rua" maxlength = "45">
</div><div><label for="rua_paciente">Bairro:</label>
<input type="text" class="input_cadastro" id="bairro_paciente" name="bairro_paciente" placeholder="Bairro">
</div><div><label for="cidade_paciente">Cidade:</label>
<input type="text" class="input_cadastro" id="cidade_paciente" name="cidade_paciente" placeholder="Cidade">
</div><div><label for="estado_paciente">Estado:</label>
<input type="text" class="input_cadastro" id="estado_paciente" name="estado_paciente" placeholder="Estado">

</div><div><label for="telefone_paciente">Telefone:</label>
<input type="text" class="input_cadastro" id="telefone_paciente" name="telefone_paciente" placeholder="(XX)xxxxx-xxxx" maxlength = "13"> 
</div><div><label for="email_paciente">E-mail:</label>
<input type="text" class="input_cadastro" id="email_paciente" name="email_paciente" placeholder="E-mail" maxlength = "100">
</div><div><label for="nomeMae_paciente">Nome da mãe:</label>
<input type="text" class="input_cadastro" id="nomeMae_paciente" name="nomeMae_paciente" placeholder="Nome da mãe" maxlength = "45">
</div>
<div><label for="convenio_paciente">Convênio:</label>
<select value="" class="input_cadastro" id="convenio_paciente" name="convenio_paciente">
    <option value="">Selecione o convênio</option>
    <?php
    $conn = new MySQLi("LOCALHOST","root",'','clinica');
    $query="SELECT * FROM tb_convenios;";
    
    $result = $conn->query($query);
    while($rows = $result->fetch_assoc()){
      ?><option value=<?php echo $rows['id_convenio'];?>><?php echo $rows['nome_convenio'];?></option><?php  
    }
    ?>
</select>
</div>
<div id="mostrar_cadastro_acompanhante">
    <label for='botao_acompanhantes'>Acompanhante:</label>
    <button type ="button" class="btn btn-info" id="botao_mostrar_cadastro_acompanhante" name='botao_acompanhantes' data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar acompanhante</button>
</div>
<div class="erro_pacientes erros" >
    
</div>


<div id="form_confirm_especialidade">
    <input  id= "button_confirm" class = "button_confirm" value = Salvar type = 'submit'>
    <button id="button_cancela" type="reset" class = "button_confirm">Cancelar</button>
</div>
</div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar acompanhante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="input_acompanhantes">
<div><label for="nome_acompanhante">Nome do Acompanhante:</label>
<input type="text" class="input_cadastro" id="nome_acompanhante" name="nome_acompanhante" placeholder="Nome do acompanhante" maxlength = "45">
</div><div><label for="cpf_acompanhante">Cpf do acompanhante:</label>
<input type="text" class="input_cadastro" id="cpf_acompanhante" name="cpf_acompanhante" placeholder="ddd.ddd.ddd-dd" maxlength="14">
</div><div><label for="rg_acompanhante">RG do acompanhante:</label>
<input type="text" class="input_cadastro" id="rg_acompanhante" name="rg_acompanhante" placeholder = "d.ddd.ddd" maxlength="9">
</div><div><label for="telefone_acompanhante">Telefone do acompanhante:</label>
<input type="text" class="input_cadastro" id="telefone_acompanhante" name="telefone_acompanhante" placeholder="(DD)ddddd-dddd" maxlength="13">
</div><div><label for="email_acompanhante">Email do acompanhante:</label>
<input type="text" class="input_cadastro" id="email_acompanhante" name="email_acompanhante" placeholder="E-mail do acompanhante" maxlength = "100">
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
  </div>
</form>

</div>
        </div>

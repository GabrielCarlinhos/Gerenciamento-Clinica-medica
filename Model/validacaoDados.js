

var crm_validado = false;
var descricaoRepetida = false;
var usuarioRepetido;
var emailRepetido;
var numero_convenioRepetido;
var cepValidado = false;
var cpfValidado = false;


function valida_cep(){
    function limpa_formulario_cep(){
        $('#rua_doutor,#rua_paciente').val("");
        $('#bairro_doutor,#bairro_paciente').val("");
        $('#cidade_doutor,#cidade_paciente').val("");
        $('#estado_doutor,#estado_paciente').val("");
    }
    
    var cep = $('#cep_doutor,#cep_paciente').val().replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $("#rua_doutor,#rua_paciente").val("...");
            $("#bairro_doutor,#bairro_paciente").val("...");
            $("#cidade_doutor,#cidade_paciente").val("...");
            $("#estado_doutor,#estado_paciente").val("...");
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(data) {

                if (!("erro" in data)) {
                    cepValidado = true;
                    $("#rua_doutor,#rua_paciente").val(data.logradouro);
                    $("#bairro_doutor,#bairro_paciente").val(data.bairro);
                    $("#cidade_doutor,#cidade_paciente").val(data.localidade);
                    $("#estado_doutor,#estado_paciente").val(data.uf);
                  
                } 
                else {
                    cepValidado = false;
                    limpa_formulario_cep();
                    $('#erro_doutores,.erro_pacientes').text("CEP não encontrado");
                }
            });
        } 
        else {
            cepValidado = false;
            limpa_formulario_cep();
            $('#erro_doutores,.erro_pacientes').text("CEP inválido");
        }
    }
    else {
        limpa_formulario_cep();
    }
}


$(document).ready(function(){
    $('#crm_usuario').blur(function(){
        $.get("../Model/select_crm_doutor.php?crm="+$('#crm_usuario').val(),function(data){
            if(data == "1"){
                crm_validado = true;
            }else if(data == "0"){
                crm_validado = false;
            }
        })
    })
    $('#paciente_agenda').blur(function(){
        $.get("../Model/valida_agenda.php?cpf="+$('#paciente_agenda').val(),function(data){
            if(data == "0"){
                cpfValidado = false;
            }else if(data == "1"){
                cpfValidado = true;
            }
        })
    })


$('#nome_especialidade').blur(function(){
    $.getJSON("../Model/valida_especialidade.php?descricao="+$('#nome_especialidade').val(),function(data){
    if(data == '1'){
        descricaoRepetida = true;
    }else{
        descricaoRepetida = false;
    }
    })
})


$('#nome_cadastro').blur(function(){
    $.getJSON("../Model/valida_usuario.php?nome_usuario="+$('#nome_cadastro').val(),function(dataUsuario){
        if(dataUsuario == '1'){
            $('#erro_usuarios').text("Nome de usuário já utilizado");
            usuarioRepetido = true;
        }else{
            $('#erro_usuarios').text("");
            usuarioRepetido = false;
        }
    })
})
$('#email_cadastro').blur(function(){
    $.getJSON("../Model/valida_usuario.php?email_usuario="+$('#email_cadastro').val(),function(dataEmail){
        if(dataEmail == '1'){
            $('#erro_usuarios').text("E-mail já cadastrado");
            emailRepetido = true;
        }else{
            $('#erro_usuarios').text("");
            emailRepetido = false;
        }
    })
})
$('#cep_doutor,#cep_paciente').blur(function(){
valida_cep();
})
$('#cep_doutor,#cep_paciente').ready(function(){
    valida_cep();
})
$('#numero_convenio').blur(function(){
    $.getJSON("../Model/valida_convenio.php?numero_convenio="+$('#numero_convenio').val(),function(data){
        if(data == 1){
            $('#erro_convenios').text("Número já cadastrado");
            numero_convenioRepetido = true;
        }else{
            $('#erro_convenios').text("");
            numero_convenioRepetido = false;
        }
    })
})
})
function validaDados_convenio(validado){
    if($('#nome_convenio').val().trim() == ""){
        $('#erro_convenios').text("Digite o nome do convênio");
        $('#nome_convenio').focus();
        return false;
    }else if($('#numero_convenio').val().trim() == ""){
        $('#erro_convenios').text("Digite o número do convênio");
        $('#numero_convenio').focus();
        return false;
    }
    else if(numero_convenioRepetido){
        if($('#numero_convenio').val() != validado){
        $('#erro_convenios').text("Número já cadastrado");
        $('#numero_convenio').focus();
        return false;
    }
    }else{
        return true;
    }
}
function validaDados_especialidades(descricaoValidada){
   if(descricaoRepetida && !($('#nome_especialidade').val() == descricaoValidada)){
       $('#erro_especialidade').text("Descrição já utilizada");
       $('#nome_especialidade').focus();
   return false;
   }
   else if($('#nome_especialidade').val().trim() == ""){
       $('#erro_especialidade').text("Informe a descrição");
       $('#nome_especialidade').focus();
       return false;
   }
   else if($('#valor_consulta_especialidade').val().trim() == ""){
       $('#erro_especialidade').text("Informe o valor");
       $('#valor_consulta_especialidade').focus();
   return false;
   }else{
   return true;
   }
}
function validaDados_usuarios(){

    if($('#nome_cadastro').val().trim() == ""){
        $('#erro_usuarios').text("Digite um nome de usuário");
        $('#nome_cadastro').focus();
        return false;
    }else if(usuarioRepetido){
        $('#nome_cadastro').focus();
        return false;
    }
    else if($('#senha_cadastro').val().trim()==""){
        $('#erro_usuarios').text("Digite uma senha");
        $('#senha_cadastro').focus()
        return false;

    }
    else if($('#senha_cadastro').val()!=$("#confirmacao_senha_cadastro").val()){  
        $('#erro_usuarios').text("Senhas diferentes");
        $('#senha_cadastro').focus();  
        return false;
    }
    else if($('#email_cadastro').val().length<10 || $('#email_cadastro').val().indexOf('@') == -1 || $('#email_cadastro').val().indexOf('.') == -1){
        $('#erro_usuarios').text("Digite um E-mail válido");
        $('#email_cadastro').focus();
        return false;
    }
    else if(emailRepetido){
        $('#email_cadastro').focus();
        return false;
    }
    else if($('#tipo_cadastro').val() == ""){
        $('#erro_usuarios').text("atribua uma função ao usuário");
        $('#tipo_cadastro').focus();
        return false;
    }else if($('#tipo_cadastro').val() == "doutor"){
        if(!crm_validado){
            $('#erro_usuarios').text("Digite o CRM do doutor")
            $('#crm_usuario').focus();
            return false;
        }
    }
    
    else{
        return true;
    }
}
function validaDados_doutores(){
    if($('#crm_doutor').val().length<6){
        
        $('#erro_doutores').text("Digite um CRM válido");
        $('#crm_doutor').focus();
        return false;
    }
    else if($('#nome_doutor').val().trim() == ""){
        $('#erro_doutores').text("Digite um nome");
        $('#nome_doutor').focus();
        return false;
    }
    else if($('#cpf_doutor').val().length <14){
        $('#erro_doutores').text("Digite um cpf válido");
        $('#cpf_doutor').focus();
        return false;
    }
    else if($('#rg_doutor').val().length <7){
        $('#erro_doutores').text("Digite um RG válido");
        $('#rg_doutor').focus();
        return false;
    }
    else if($('#telefone_doutor').val().length <12){
        $('#erro_doutores').text("Digite um número de telefone válido");
        $('#telefone_doutor').focus();
        return false;
    }
    else if(!cepValidado){
        $('#erro_doutores').text("CEP inválido");
        $('#cep_doutor').focus();
        return false;
    }
    else if($('#rua_doutor').val().trim() == ""){
        $('#erro_doutores').text("Digite o nome da rua");
        $('#rua_doutor').focus();
        return false;
    }else if($('#rua_doutor').val() == "..."){
        $('#erro_doutores').text("CEP inválido");
        return false;
    }
    else if($('#numero_doutor').val().trim() == ""){
        $('#erro_doutores').text("Digite o número do endereço")
        $('#numero_doutor').focus();
        return false;
    }
    else if($('#bairro_doutor').val().trim() == ""){
        $('#erro_doutores').text("Digite o nome do bairro");
        $('#bairro_doutor').focus();
        return false;
    }
    else if($('#cidade_doutor').val().trim() == ""){
        $('#erro_doutores').text("Digite o nome da cidade");
        $('#cidade_doutor').focus();
        return false;
    }
    else if($('#estado_doutor').val() == ""){
        $('#erro_doutores').text("Insira um estado");
        return false;
    }
   
    else if($('#especialidade_doutor').val() == ""){
        $('#erro_doutores').text("Atribua uma especialidade a o doutor");
        return false;
    }else{
        return true;
    }
}
function validaDados_pacientes(){

    dataAtual = new Date();
    
    var dataNascimento = new Date($('#dataNascimento_paciente').val());

    if(dataNascimento > dataAtual || $('#dataNascimento_paciente').val().trim() == "" || $('#dataNascimento_paciente').val().length < 10 || dataNascimento.getFullYear() < 1900){
        $('.erro_pacientes').text("Insira uma data válida");
        $('#dataNascimento_paciente').focus();
        return false;
    }
    
    else if($('#nome_paciente').val().trim() == ""){
        $('.erro_pacientes').text("Digite um nome");
        $('#nome_paciente').focus();
        return false;
    }
    else if($('#cpf_paciente').val().length<14){
        $('.erro_pacientes').text("Digite um cpf válido");
        $('#cpf_paciente').focus();
        return false;
    }
   
    else if($('#rg_paciente').val().length<7){
        $('.erro_pacientes').text("Digite um RG válido");
        $('#rg_paciente').focus();
        return false;
    }
    else if($('#genero_paciente').val() == ""){
        $('.erro_pacientes').text("Coloque o genêro do paciente");
        return false;
    }
    else if($('#rua_paciente').val().trim() == ""){
        $('.erro_pacientes').text("Digite o nome da rua");
        $('#rua_paciente').focus();
        return false;
    }
    else if($('#numero_paciente').val() == ""){
        $('.erro_pacientes').text("Digite o número do endereço");
        $('#numero_paciente').focus();
        return false;
    }
    else if($('#bairro_paciente').val().trim() ==""){
        $('.erro_pacientes').text("Digite o nome do bairro");
        $('#bairro_paciente').focus();
        return false;
    }
    else if($('#cidade_paciente').val().trim() == ""){
        $('.erro_pacientes').text("Digite o nome da cidade");
        $('#cidade_paciente').focus();
        return false;
    }
    else if($('#estado_paciente').val() == ""){
        $('.erro_pacientes').text("Insira um estado");
        return false;
    }
    else if($('#cep_paciente').val().length < 9){
        $('.erro_pacientes').text("Insira um CEP válido");
        $('#cep_paciente').focus();
        return false;
    }
    else if($('#telefone_paciente').val().length <12){
        $('.erro_pacientes').text("Digite um número de telefone válido");
        $('#telefone_paciente').focus();
        return false;
    }
    else if($('#email_paciente').val().length < 10 || $('#email_paciente').val().indexOf('@') == -1 || $('#email_paciente').val().indexOf('.') == -1){
        $('.erro_pacientes').text("Digite um E-mail válido");
        $('#email_paciente').focus();
        return false;
    }
    else if($('#nomeMae_paciente').val().trim() == ""){
        $('.erro_pacientes').text("Digite o nome da mãe do paciente");
        $('#nomeMae_paciente').focus();
        return false;
    }else if($('#idade_paciente').val()<18 && $('#nome_acompanhante').val().trim() == ""){
        $('.erro_pacientes').text("Paciente menor de idade deve ter um acompanhante");
        return false;
    }else if($('#nome_acompanhante').val().trim()!=""){
        if($('#cpf_acompanhante').val().length < 14){
            $('.erro_pacientes').text("Acompanhante com cpf inválido");
            return false;
        }else if($('#rg_acompanhante').val().length < 9){
            $('.erro_pacientes').text("Acompanhante com RG inválido");
            return false;
        }else if($('#telefone_paciente').val().length < 12){
            $('.erro_pacientes').text("Acompanhante com telefone inválido");
            return false;
        }else if($('#email_paciente').val().length < 10 || $('#email_paciente').val().indexOf('@') == -1 || $('#email_paciente').val().indexOf('.') == -1){
            $('.erro_pacientes').text("Acompanhante com E-mail inválido");
            return false;
        }
        
    }else{
        return true;
    }
    
}
function validaDados_agenda(validado){
    if(validado){
        cpfValidado = true;
    }
    var dataAtual = new Date();
    var data = new Date($('#data_agenda').val()+" "+$('#horario_agenda').val());
    if(dataAtual > data){
        $('#erro_agenda').text("Data inválida");
        $('#data_agenda').focus();
        return false;
    }else if(!cpfValidado){
      $('#erro_agenda').text("Cpf inválido");
      $('#paciente_agenda').focus();
      return false;
    }

}

function filtra_cep(){
    
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
                    $("#rua_doutor,#rua_paciente").val(data.logradouro);
                    $("#bairro_doutor,#bairro_paciente").val(data.bairro);
                    $("#cidade_doutor,#cidade_paciente").val(data.localidade);
                    $("#estado_doutor,#estado_paciente").val(data.uf);
                  
                } 
                else {
                    
                    limpa_formulario_cep();
                    $('#erro_doutores,#erro_pacientes').text("CEP não encontrado");
                }
            });
        } 
        else {
            limpa_formulario_cep();
            $('#erro_doutores,#erro_pacientes').text("CEP inválido");
        }
    }
    else {
        
        limpa_formulario_cep();
    }
}

function formataIdade(){
    var data = new Date($('#dataNascimento_paciente').val().replace(/-/g, '\/'))
    var dataAtual = new Date();
    var idade_paciente = dataAtual.getFullYear() - data.getFullYear();
    if(dataAtual.getMonth() < data.getMonth()){
    idade_paciente-=1;
    }else if(dataAtual.getMonth() == data.getMonth()){
        if(dataAtual.getDate() < data.getDate()){
            idade_paciente-=1;
        }
    }
    $('#idade_paciente').val(idade_paciente);
}

function filtrar_especialidade(){
    $.post("../Controller/select_pesquisa_especialidade.php?descricao="+$('#filtro_especialidade').val()+"&filtro="+$('#selecao_filtro_especialidade').val(),function(data){
        $('#content_pesquisa_especialidade').html(data);
    })
}

function filtrar_paciente(){
    $.post("../Controller/select_pesquisa_paciente.php?nome="+$('#filtro_paciente').val()+"&filtro="+$('#selecao_filtro_paciente').val(),function(data){
        $('#content_pesquisa_paciente').html(data);
    })
    }

function filtrar_doutor(){
    $.post("../Controller/select_pesquisa_doutor.php?nome="+$('#filtro_doutor').val()+"&filtro="+$('#selecao_filtro_doutor').val(),function(data){
        $('#content_pesquisa_doutor').html(data);
})
}
function filtrar_convenio(){
    $.post("../Controller/select_pesquisa_convenio.php?descricao="+$('#filtro_convenio').val()+"&filtro="+$('#selecao_filtro_convenio').val(),function(data){
        $('#content_pesquisa_convenio').html(data);
    })
}

function excluir_especialidade(id){
    var confirma = confirm("Deseja Excluir a especialidade?");
    if(confirma == true){
        $.post("excluir.php?especialidade=true&codigo="+id,function(data){
            filtrar_especialidade();
            if(data != ""){
               alert(data);
            }
        });
        
    }
    
}
function excluir_paciente(id){
    var confirma = confirm("Deseja excluir o paciente?")
    if(confirma == true){
        $.post("excluir.php?paciente=true&codigo="+id,function(data){
            filtrar_paciente(); 
        });
        
        
    }
    
}
function excluir_doutor(id){
    var confirma = confirm("Deseja excluir o doutor?");
    if(confirma == true){
        $.post("excluir.php?doutor=true&codigo="+id,function(data){
        filtrar_doutor();
        })
    }
}

function excluir_convenio(id){
    var confirma = confirm("Deseja excluir o convênio?");
    if(confirma == true){
        $.post("excluir.php?convenio=true&codigo="+id,function(data){
            filtrar_convenio();
        })
    }
}

function cancelar_agendamento(codigo){
    $('#id_agendamento').val(codigo);
    $('#texto_motivo').hide();
    $('#modal2').modal('toggle');
}
function cancelar_agendamento_confirma(codigo){
     var motivo;
     if($('#motivo_cancelamento').val() == "outros"){
        motivo = $('#texto_motivo');
     }else{
        motivo = $('#motivo_cancelamento').val();
     }
     $.post("../Controller/excluir.php?agendamento=true&codigo="+codigo+"&motivo="+motivo,function(data){
            $('#agenda_'+codigo).remove();
        })
}

function editar_especialidade(id){
    $.getJSON("../Controller/select.php?conteudo=especialidade&id="+id,function(data){
    $('#codigo_especialidade').val(id);
    $('#nome_especialidade').val(data.descricao);
    $('#nome_especialidade_mascara').val(data.descricao);
    $('#valor_consulta_especialidade').val(data.valor);
    })
}
function editar_doutor(crm){
    $.getJSON("../Controller/select.php?conteudo=doutor&id="+crm,function(data){
        $('#crm_doutor').val(crm);
        $('#nome_doutor').val(data.nome);
        $('#cpf_doutor').val(data.cpf);
        $('#rg_doutor').val(data.rg);
        $('#telefone_doutor').val(data.telefone);
        $('#cep_doutor').val(data.cep);
        filtra_cep();
        $('#numero_doutor').val(data.numero);
        $('#especialidade_doutor').val(data.especialidade);
    })
}
function editar_paciente(id){
   $.getJSON("../Controller/select.php?conteudo=paciente&id="+id,function(data){
       $('#id_paciente').val(id);
       $('#nome_paciente').val(data.nome);
       $('#cpf_paciente').val(data.cpf);
       $('#rg_paciente').val(data.rg);
       $('#dataNascimento_paciente').val(data.dataNascimento);
       formataIdade();
       $('#genero_paciente').val(data.genero);
       $('#cep_paciente').val(data.cep);
       filtra_cep();
       $('#numero_paciente').val(data.numero);
       $('#telefone_paciente').val(data.telefone);
       $('#email_paciente').val(data.email);
       $('#nomeMae_paciente').val(data.nomeMae);
       $('#convenio_paciente').val(data.convenio);
       $('#nome_acompanhante').val(data.nomeAcompanhante);
       $('#cpf_acompanhante').val(data.cpfAcompanhante);
       $('#rg_acompanhante').val(data.rgAcompanhante);
       $('#telefone_acompanhante').val(data.telefoneAcompanhante);
       $('#email_acompanhante').val(data.emailAcompanhante);
   })
}
function editar_convenio(id){
  $.getJSON("../Controller/select.php?conteudo=convenio&id="+id,function(data){
    $('#id_convenio').val(id);
    $('#nome_convenio').val(data.nome);
    $('#numero_convenio').val(data.numero);
    $('#numero_convenio_validado').val(data.numero);
  })
}
function editar_agendamento(codigo){
    $.getJSON("../Controller/select_agendamento.php?codigo="+codigo,function(data){
       $('#horario_agenda').val(data.horario);
       $('#data_agenda').val(data.data);
       $('#nome_paciente_agenda').val(data.paciente);
       $('#doutor_agenda_mascara').val(data.doutor);
       $('#paciente_agenda').val(data.cpf_paciente);
       $('#doutor_agenda').val(data.crm_doutor);
       $('#codigo_agendamento').val(codigo);
    }).fail(function(){
        alert("Algo deu errado");
    })
}
function gerarConsulta(codigo){
 
    $.getJSON("../Controller/select_agendamento.php?codigo="+codigo,function(data){
        $('#codigo_agendamento_consulta').val(codigo);
        $('#data_consulta').val(new Date().toLocaleDateString('en-CA'));
        $('#horario_consulta').val(new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
        $('#valor_consulta').val("R$"+data.valor_consulta.replace(".",","))
        $('#valor_consulta_hidden').val(data.valor_consulta);
        $('#paciente_consulta').val(data.paciente);
        $('#id_paciente_consulta').val(data.id_paciente);
        $('#doutor_consulta').val(data.doutor);
        $('#crm_doutor_consulta').val(data.crm_doutor);
        $('#convenio_consulta').html("<option value='particular'>Particular</option><option value='social'>Social</option>")
        if(data.convenio != ""){
            $('#convenio_consulta').append("<option value='convenio'>"+data.convenio+"</option>");
        }
       
        
    })
}

function marcar_prontuario(id,crm){
    $.getJSON("../Controller/select_prontuario.php?id="+id,function(data){
        $('#peso_paciente').val(data.peso);
        $('#altura_paciente').val(data.altura);
        $('#imc_paciente').val(data.imc);
        $('#tipoSanguineo_paciente').val(data.tipo_sanguineo);
        $('#exame_fisico_paciente').val(data.exameFisico);
        $('#solicitacao_exame_paciente').val(data.solicitacaoExame);
        $('#alergias_paciente').val(data.alergias);
    })
    $('#id_paciente_prontuario').val(id);
    $('#crm_doutor_prontuario').val(crm);
}


$(document).ready(function(){
   
    $('#motivo_cancelamento').click(function(){
        if($('#motivo_cancelamento').val() == "outros"){
            $('#texto_motivo').toggle();
        }else{
            $('#texto_motivo').hide();
        }
    })

    $('#peso_paciente,#altura_paciente').blur(function(){
        if($('#peso_paciente').val().trim()!="" && $('#altura_paciente').val().trim()!=""){
            $('#imc_paciente').val(($('#peso_paciente').val().replace(",",".")/Math.pow(($('#altura_paciente').val()/100),2)).toFixed(2))
        }
    })

    $('#convenio_consulta').click(function(){
        var valor_consulta = $('#valor_consulta_hidden').val();
    if($('#convenio_consulta').val() == "social" && valor_consulta != "0,00"){
        valor_consulta = valor_consulta-(valor_consulta * 20)/100;
    $('#valor_consulta').val(("R$"+valor_consulta.toFixed(2).replace(".",",")));
    }else if($('#convenio_consulta').val() == "particular"){
        $('#valor_consulta').val("R$"+valor_consulta.replace(".",","));
    }else if($('#convenio_consulta').val() == "convenio"){
        $('#valor_consulta').val("R$0,00");
    }
    })

    $('#tipo_cadastro').on("click",function(){
        if($('#tipo_cadastro').val() == "doutor"){
        $('#crm_usuario').prop('disabled',false);
        $('#div_crm_usuario').css("visibility","visible");
        }else{
            $('#div_crm_usuario').css("visibility","hidden");
            $('#crm_usuario').prop('disabled',true)
        }
    })

$('#filtro_paciente').on('keyup',function(){
    filtrar_paciente();
})
$('#content_pesquisa_paciente').ready(function(){
    filtrar_paciente();
})

$('#filtro_doutor').on('keyup',function(){
    filtrar_doutor();
})
$('#content_pesquisa_doutor').ready(function(){
    filtrar_doutor();
})

$('#filtro_especialidade').keyup(function(e){
    filtrar_especialidade();
})
$('#content_pesquisa_especialidade').ready(function(){
    filtrar_especialidade();
})
$('#filtro_convenio').keyup(function(e){
    filtrar_convenio();
})
$('#content_pesquisa_convenio').ready(function(){
    filtrar_convenio();
})



$('#dataNascimento_paciente').blur(function(){
    formataIdade();
    })

    $('#dataNascimento_paciente').keypress(function(){
        if($('#dataNascimento_paciente').val().length == 2){
        $('#dataNascimento_paciente').val($('#dataNascimento_paciente').val()+"/")
        }
        if($('#dataNascimento_paciente').val().length == 5){
            $('#dataNascimento_paciente').val($('#dataNascimento_paciente').val()+"/")
        }
    })

$('#nome_especialidade,#nome_doutor,#nome_paciente,#nomeMae_paciente,#nome_acompanhante,#nome_convenio').keypress(function(e){
if(!checkFormat(e,'[a-zA-ZÁ-Úá-ú- -]')){
    e.preventDefault();
}
})

$('#crm_doutor,#numero_doutor,#numero_paciente,#numero_convenio').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
})
$('#cep_doutor,#cep_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9--]')){
        e.preventDefault();
    }
})
$('#rua_doutor,#bairro_doutor,#cidade_doutor,#rua_paciente,#bairro_paciente,#cidade_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9a-zA-Zá-úÁ-Ú  ]')){
        e.preventDefault();
    }
})

$('#valor_consulta_especialidade,#peso_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9,,]')){
        e.preventDefault();
    }
})
$('#altura_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
})

$('#cpf_doutor,#cpf_paciente,#paciente_agenda').keypress(function(e){
 
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
    formatCPF('#cpf_doutor,#cpf_paciente,#paciente_agenda');
 
})
$('#cpf_acompanhante').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
    formatCPF('#cpf_acompanhante');

})
function formatCPF(cpf){
    if($(cpf).val().length == 3 || $(cpf).val().length == 7){
        $(cpf).val($(cpf).val()+'.');

    }
    if($(cpf).val().length == 11){
        $(cpf).val($(cpf).val()+'-');
    }
}

$('#cep_paciente,#cep_doutor').keypress(function(e){
    if($('#cep_paciente,#cep_doutor').val().length== 5)
    $('#cep_paciente,#cep_doutor').val($('#cep_paciente,#cep_doutor').val()+ '-');
})


$('#rg_doutor,#rg_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
   formatRG('#rg_doutor,#rg_paciente');
})

$('#telefone_doutor,#telefone_paciente').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
    formatTelefone('#telefone_doutor,#telefone_paciente');
})
$('#telefone_acompanhante').keypress(function(e){
    if(!checkFormat(e,'[0-9]')){
        e.preventDefault();
    }
    formatTelefone('#telefone_acompanhante');
})
function formatTelefone(telefone){
    if($(telefone).val().length == 0){
        $(telefone).val($(telefone).val()+'(')
    }
    if($(telefone).val().length == 3){
        $(telefone).val($(telefone).val()+')');
    }

}

});



function checkFormat(e,format){
    char = String.fromCharCode(e.charCode);
    return char.match(format);
}




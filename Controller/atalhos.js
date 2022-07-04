

    function fill_doutor(doutor,crm){
        $('#erro_agenda').text("");
        $('#doutor_agenda').val(crm);
        $('#doutor_agenda_mascara').val(doutor);
    }

$(document).ready(function(){
    var data = new Date()
    var ano = data.getFullYear();
    var mes = ('0'+(data.getMonth()+1)).slice(-2);
    var dia = ('0'+data.getDate()).slice(-2);
    var dataAtual = `${ano}-${mes}-${dia}`;
    $('#data_agenda').val(dataAtual);

    var hora = ('0'+data.getHours()).slice(-2);
    var minuto = ('0'+data.getMinutes()).slice(-2);
    
    horaAtual = `${hora}:${minuto}`;

    $('#horario_agenda').val(horaAtual)

    $(document).keydown(function(e){
 
        if(e.which == 80 && e.altKey){
            window.location = "../View/cadastro_pacientes.php";
        }
        if(e.which == 68 && e.altKey){
            window.location = "../View/cadastro_doutores.php";
        }
        if(e.which == 69 && e.altKey){
            window.location = "../View/cadastro_especialidades.php";
        }
        if(e.which == 67 && e.altKey){
            window.location = "../View/cadastro_usuarios.php";
        }
    })
    $('#ul_especialidades').click(function(e){
        window.location = "../View/pesquisa_especialidades.php";
    })
    $('#ul_doutores').click(function(e){
        window.location = "../View/pesquisa_doutores.php";
    })
    $('#ul_pacientes').click(function(e){
        window.location = "../View/pesquisa_pacientes.php";
    })
    $('#ul_convenios').click(function(e){
        window.location = "../View/pesquisa_convenios.php";
    })
    $('#ul_agendas').click(function(){
        window.location = "../View/agenda.php";
    })
    $('#ul_consultas').click(function(){
        window.location = "../View/consultas.php";
    })
 
})
function gerarRelatorioOperacionalCancelamentos(){
   $.get("../Controller/gerarRelatorioOperacionalCancelamentos.php",function(data){
    $('#tabelas_relatorios').html(data);
   })
}
function gerarRelatorioOperacionalConvenioConsultas(){
    $.get("../Controller/gerarRelatorioOperacionalConvenioConsultas.php",function(data){
        $('#tabelas_relatorios').html(data);
    })
}
function gerarRelatorioOperacionalEspecialidadesConsultas(){
    $.get("../Controller/gerarRelatorioOperacionalEspecialidadesConsultas.php",function(data){
        $('#tabelas_relatorios').html(data);
    })
}
$(document).ready(function(){
    var atual;
    if($('#seletor_relatorio').val() == "convenios"){
        gerarRelatorioOperacionalConvenioConsultas();
        atual = "convenios";
    }else if($('#seletor_relatorio').val() == "cancelamentos"){
        gerarRelatorioOperacionalCancelamentos();
        atual = "cancelamentos";
    }else if($('#seletor_relatorio').val() == "especialidades"){
        gerarRelatorioOperacionalEspecialidadesConsultas();
        atual = "especialidades";
    }
    $('#seletor_relatorio').click(function(){
        if($('#seletor_relatorio').val() != atual){
            if($('#seletor_relatorio').val() == "convenios"){
            gerarRelatorioOperacionalConvenioConsultas()
            atual = "convenios";
            }else if($('#seletor_relatorio').val() == "cancelamentos"){
            gerarRelatorioOperacionalCancelamentos();
            atual = "cancelamentos";
            }else if($('#seletor_relatorio').val() == "especialidades"){
                gerarRelatorioOperacionalEspecialidadesConsultas();
                atual = "especialidades";
            }
        }
    })
})
function gerarRelatorioFinanceiro(){
$.get("../Controller/gerarRelatorioFinanceiro.php",function(data){
    $('#tabelas_relatorios').html($('#tabelas_relatorios').html()+data);
})
}
$(document).ready(function(){
        gerarRelatorioFinanceiro();
})
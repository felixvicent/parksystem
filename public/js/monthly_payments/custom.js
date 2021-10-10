$(document).ready(function () {

    /*Select2*/
    $('.select2').select2();

    /*Ao carregar a página, já inputa o valor vindo do banco*/
    $(".monthly_value").val($(".pricing").val().split(' ')[1]);
    $(".expiration").val($(".monthly").val().split(' ')[1]);
    
    /*Ao carregar a página, já inputa o valor vindo do banco no hidden inputs*/
    $(".monthly_id").val($(".monthly").val().split(' ')[0]);
    $(".pricing_id").val($(".pricing").val().split(' ')[0]);


    $("select.pricing").change(function () {

        var categoria_selecionada = $(this).children("option:selected").val();

        $(".monthly_value").val(categoria_selecionada.split(' ')[1]);
        $(".pricing_id").val(categoria_selecionada.split(' ')[0]);

    });

    $("select.monthly").change(function () {

        var mensalista_selecionado = $(this).children("option:selected").val();

        $(".expiration").val(mensalista_selecionado.split(' ')[1]);
        $(".monthly_id").val(mensalista_selecionado.split(' ')[0]);
        
        console.log(mensalista_selecionado.split(' ')[1]);

    });

});
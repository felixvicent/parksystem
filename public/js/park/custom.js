$(document).ready(function () {

    $("select.pricing").change(function () {

        var category = $(this).children("option:selected").val();

        $(".value_hour").val(category.substring(1, 6));        

    });

});
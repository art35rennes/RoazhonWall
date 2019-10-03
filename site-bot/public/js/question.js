$(".tQ").change(function () {
    console.log($(this).val());
    switch ($(this).val()) {
        case "q":
            $("#ouverte").attr('required', true);
            $("[name=reponseRadio]").each(function () {
                $(this).attr('required', false);
            });
            // $(".rmQ").each(function () {
            //     $(this).attr('required', false);
            // });
            $(".custom-file-input").each(function () {
                $(this).attr('required', false);
            });
            $("#reponse_multiple, #reponse_image").addClass("d-none");
            $("#reponse_ouverte").removeClass("d-none");
            break;
        case "m":
            $("#ouverte").attr('required', false);
            $("[name=reponseRadio]").each(function () {
                $(this).attr('required', true);
            });
            // $(".rmQ").each(function () {
            //     $(this).attr('required', true);
            // });
            $(".custom-file-input").each(function () {
                $(this).attr('required', false);
            });
            $("#reponse_ouverte, #reponse_image").addClass("d-none");
            $("#reponse_multiple").removeClass("d-none");
            break;
        case "i":
            $("#ouverte").attr('required', false);
            $("[name=reponseRadio]").each(function () {
                $(this).attr('required', false);
            });
            // $(".rmQ").each(function () {
            //     $(this).attr('required', false);
            // });
            $(".custom-file-input").each(function () {
                $(this).attr('required', true);
            });
            $("#reponse_multiple, #reponse_ouverte").addClass("d-none");
            $("#reponse_image").removeClass("d-none");
            break;
    }
    $(".aQ").attr("disabled", false);
});

$(".fa-eye").click(function () {
   $id = $(this).parent().parent().children(":first-child").html();
   window.open('/question/view/'+$id, '_parent');
});

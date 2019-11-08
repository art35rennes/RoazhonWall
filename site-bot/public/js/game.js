$("#nolimit").change(function () {
    // console.log("coucou");
    $("#nolimit")[0].checked?$("#gamer").attr('disabled', true):$("#gamer").attr('disabled', false);
});

$("#gameModal").length?$("#gameModal").toggle():null;


$(".fa-forward+.fa-times-circle").hide();
$(".fa-forward").mouseover(function () {
   $(this).hide();
   $(this).next().show();
});
$(".fa-forward").mouseout(function () {
   $(this).show();
   $(this).next().hide();
});

$(".fa-forward+.fa-times-circle").hide();
$(".fa-forward").mouseover(function () {
   $(this).hide();
   $(this).next().show();
});
$(".fa-forward").mouseout(function () {
   $(this).show();
   $(this).next().hide();
});

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        if ($(this).parent().parent()[0].id === "Tab2"){
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        }
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#Tab2 a[href="' + activeTab + '"]').tab('show');
    }
});

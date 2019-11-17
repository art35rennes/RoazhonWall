function sendAjax($url, $datas = null, $id='#server-results') {

    if ($datas != null) {
        //ajout du token CSRF
        $datas.unshift({_token: $('input[name=_token]').val()})
        // console.log($datas);

        var post_url = $url; //get form action url
        var request_method = 'POST'; //get form GET/POST method
        var form_data = JSON.stringify($datas, null, 1);

        // console.log($('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: post_url,
            type: request_method,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false
        }).done(function (response) {
            $json = JSON.parse(response);
            console.log($json);
            // $($id).html(alerteInfo($json[0].alert,$json[1]));
        });
    }
    else {
        // console.log("else");
        // $($id).html(alerteInfo('info',"Aucune donnée à envoyer.",));
    }
}

$(".fa-crown").click(function () {
    sendAjax("/game/player/upstate", [{id:$(this).parent().children(':last-child').val()}]);
});
$(".fa-ban").click(function () {
    sendAjax("/game/player/ban", [{id:$(this).parent().children(':last-child').val()}]);
});
$(".fa-level-down-alt").click(function () {
    sendAjax("/game/player/downstate", [{id:$(this).parent().children(':last-child').val()}]);
});
$(".fa-times-circle").click(function () {
    sendAjax("/game/state/dismiss", [{id:$(this).parent().children(':last-child').val()}]);
});
$(".fa-play-circle").click(function () {
    sendAjax("/game/state/play", [{id:$(this).parent().children(':last-child').val()}]);
});

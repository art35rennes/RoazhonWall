function sendAjax($url, $datas = null, methode="POST",$id='#server-results') {

    if ($datas != null) {
        //ajout du token CSRF
        $datas.unshift({_token: $('input[name=_token]').val()})
        // console.log($datas);

        var post_url = $url; //get form action url
        var request_method = methode; //get form GET/POST method
        var form_data = JSON.stringify($datas, null, 1);

        // console.log(form_data);

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: post_url,
            type: request_method,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false
        }).done(function (response) {
            console.log(response);
            // $json = JSON.parse(response);
            // console.log($json);
            window.location.reload();
            //TODO toast & dynamic reload

            // $($id).html(alerteInfo($json[0].alert,$json[1]));
        });
    }
    else {
        console.log("else");
        // $($id).html(alerteInfo('info',"Aucune donnée à envoyer.",));
    }
}

$(".fa-crown").click(function () {
    sendAjax("/game/player/upstate/"+$(this).parent().children(':last-child').val(), [], 'GET');
});
$(".fa-ban").click(function () {
    sendAjax("/game/player/ban/"+$(this).parent().children(':last-child').val(), [], 'GET');
});
$(".fa-level-down-alt").click(function () {
    sendAjax("/game/player/downstate/"+$(this).parent().children(':last-child').val(), [], 'GET');
});
$(".fa-times-circle").click(function () {
    sendAjax("/game/state/dismiss/"+$(this).parent().children(':last-child').val(), [], 'GET');
});
$(".fa-play-circle").click(function () {
    sendAjax("/game/state/play/"+$(this).parent().children(':last-child').val(), [], 'GET');
});
$("#giveAnswer").click(function () {
    sendAjax("/game/question/reply", [], 'GET');
});
$("#nextQuestion").click(function () {
    sendAjax("/game/question/next", [], 'GET');
});
$("#randomChallenger").click(function () {
    sendAjax("/game/player/random", [], 'GET');
});
$("#randomQuestion").click(function () {
    sendAjax("/game/question/random", [], 'GET');
});



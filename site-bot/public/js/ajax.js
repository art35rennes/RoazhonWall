function sendAjax($url, $datas = null, $id='#server-results') {

    if ($datas != null) {
        //ajout du token CSRF
        $datas.unshift({_token: $('input[name=_token]').val()})
        // console.log($datas);

        var post_url = $url; //get form action url
        var request_method = 'POST'; //get form GET/POST method
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
    sendAjax("/game/player/upstate"+$(this).parent().children(':last-child').val(), []);
});
$(".fa-ban").click(function () {
    sendAjax("/game/player/ban"+$(this).parent().children(':last-child').val(), []);
});
$(".fa-level-down-alt").click(function () {
    sendAjax("/game/player/downstate"+$(this).parent().children(':last-child').val(), []);
});
$(".fa-times-circle").click(function () {
    sendAjax("/game/state/dismiss"+$(this).parent().children(':last-child').val(), []);
});
$(".fa-play-circle").click(function () {
    sendAjax("/game/state/play"+$(this).parent().children(':last-child').val(), []);
});
$("#giveAnswer").click(function () {
    sendAjax("/game/question/reply", []);
});
$("#nextQuestion").click(function () {
    sendAjax("/game/question/next", []);
});
$("#randomChallenger").click(function () {
    sendAjax("/game/player/random", []);
});
$("#randomQuestion").click(function () {
    sendAjax("/game/question/random", []);
});



//              //
//  MySQL Init  //
//              //
const mysqlQueryTimeout = 500;
const laravel = "rck";
const http = require('http');
var botParameters = null;
http.get('http://'+laravel+'/bot/init', (resp) => {
    let data = '';

    // A chunk of data has been recieved.
    resp.on('data', (chunk) => {
        data += chunk;
    });

    // The whole response has been received. Print out the result.
    resp.on('end', () => {
        // console.log(JSON.parse(data)[0]);
        console.log("Parametre bot reçu");
        botParameters = JSON.parse(data)[0];
    });

}).on("error", (err) => {
    console.log("Error: " + err.message);
});


setTimeout( function () {
//              //
//  TMI INIT    //
//              //
const tmi = require('tmi.js');
const options = {
    options: {
        debug: true,
    },
    connection: {
        cluster: botParameters.cluster,
        reconnect: true,
    },
    identity: {

        username: botParameters.username,
        password: botParameters.token,
    },
    channels: [botParameters.channel],
};
const prefix = "!";

function commandParser(message){
    let prefixEscaped = prefix.replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
    let regex = new RegExp("^" + prefixEscaped + "([a-zA-Z]+)\s?(.*)");
    return regex.exec(message);
}

function getChatters(channel, callback){
    client.api({
        url: "http://tmi.twitch.tv/group/user/" + channel + "/chatters",
        method: "GET"
    }, function(err, res, body) {
        callback(body);
    });
}

const client = new tmi.client(options);

client.connect();

client.on('connected', (address, port) => {
    console.log(client.getUsername() + " s'est connecté sur : " + address + ", port : " + port);
    // client.say(botParameters.channel, "Hello Twitch ! I'm a real human Kappa");

//	client.action('Youtopie', 'Hello there ! Le bot est en ligne ;)');
});
client.on('chat', (channel, user, message, isSelf) => {
        if (isSelf) return;

        function addPlayer(player){
            http.get('http://'+laravel+'/bot/player/'+player, (resp) => {
                let data = '';

                // A chunk of data has been recieved.
                resp.on('data', (chunk) => {
                    data += chunk;
                });

                // The whole response has been received. Print out the result.
                resp.on('end', () => {
                    // console.log(JSON.parse(data));
                    if (JSON.parse(data) === "success"){
                        console.log("Joueur ajouté");
                        client.say(channel, "Participation pris en compte" + user['display-name'])
                    }else{
                        if (JSON.parse(data) ==="full"){
                            console.log("Partie full");
                            client.say(channel, "Partie complete" + user['display-name'])
                            playerCanJoin = false;
                        }else{
                            if(JSON.parse(data) === "already_in"){
                                client.say(channel, "Déjà inscrit" + user['display-name'])
                                console.log("already_in")
                            }
                        }
                    }
                });

            }).on("error", (err) => {
                console.log("Error: " + err.message);
            });
        }
        function addAnswer(player, answer){
            console.log("|"+answer+"|");
            if (answer!==""){
                answer = answer.toLowerCase();
                answer = answer.replace(/ /g,"_");
                console.log('http://'+laravel+'/bot/answer/'+player+"/"+answer);
                http.get('http://'+laravel+'/bot/answer/'+player+"/"+answer, (resp) => {
                    let data = '';

                    // A chunk of data has been recieved.
                    resp.on('data', (chunk) => {
                        data += chunk;
                    });

                    // The whole response has been received. Print out the result.
                    resp.on('end', () => {
                        console.log(JSON.parse(data));

                        if (JSON.parse(data) === "good"){
                            console.log("Bonne réponse");
                            $name =user['display-name'];
                            playerAnswersList+={$name:true};
                            client.say(channel, "Réponse enregistré " + user['display-name']);
                        }else{
                            if (JSON.parse(data) ==="wrong"){
                                console.log("Mauvaise réponse");
                                $name =user['display-name'];
                                playerAnswersList+={$name:false};
                                client.say(channel, "Réponse enregistré " + user['display-name']);
                            }else{
                                if(JSON.parse(data) === "already_answer"){
                                    client.say(channel, "Déjà répondu " + user['display-name']);
                                    console.log("already_answer")
                                }else{
                                    if(JSON.parse(data) === "don't_play"){
                                        client.say(channel, "Vous ne participer pas à cette partie " + user['display-name']);
                                        console.log("don't_play")
                                    }else{
                                        if(JSON.parse(data) === "out"){
                                            client.say(channel, "Vous êtes éliminé de cette partie " + user['display-name']);
                                            console.log("out")
                                        }
                                    }
                                }
                            }
                        }
                    });

                }).on("error", (err) => {
                    console.log("Error: " + err.message);
                });
            }else{
                client.say(channel, "!rep {réponse} " + user['display-name']);
            }

        }

        let fullCommand = commandParser(message);

        if(fullCommand){
            let command = fullCommand[1];
            let param = fullCommand[2].replace(" ", "");

            switch(command){
                case "bonjour":
                    client.say(channel, "Bonjour à toi " + user['display-name']);
                    break;
                case "play":
                    if (currentGame!== null){
                        if (playerCanJoin){
                            addPlayer(user['display-name']);
                        }
                        else{
                            //TODO replace by MP
                            client.say(channel, "Désolé, la partie est déjà commencé :/")
                        }
                    }else{
                        client.say(channel, "Aucune partie en cours :/")
                    }


                    break;
                case "rep":
                    // console.log(param);
                    if (playerCanAnswer){
                        addAnswer(user['display-name'], param);
                    }else{
                        client.say(channel, "Aucune réponse n'est demandé à ce moment.")
                    }
                    break;
                case "score":
                    break;
                case "help":
                    break;
                default:
                    client.say(channel, "Commande '" + command + "'' non reconnue. Tapez " + prefix + "help pour la liste des commandes de " + user['display-name']);
            }
        }
    });

    var currentGame = null;
    var playerCanJoin = false;
    var playerCanAnswer = false;
    var playerAnswersList = [];
    var currentQuestion = null;
    var currentAnswers = null;
    var currentPlayer = [];
    var tmpPlayerList = [];
    var updateInterval = null;

    function gameUpdate(){
        http.get('http://'+laravel+'/bot/game', (resp) => {
            let data = '';
            // A chunk of data has been recieved.
            resp.on('data', (chunk) => {
                data += chunk;
            });

            // The whole response has been received. Print out the result.
            resp.on('end', () => {
                // console.log(data);
                game = JSON.parse(data);
                if (game === false && currentGame !== null){
                    client.say(botParameters.channel, "Partie terminé !");
                    currentGame = null;
                    playerCanJoin = false;
                    playerCanAnswer = false;
                    playerAnswersList = [];
                    currentQuestion = null;
                    currentAnswers = null;
                    currentPlayer = [];
                    tmpPlayerList = [];
                    //TODO add publish result
                    // clearInterval(updateInterval);
                    return
                }
                //TODO crash on end game
                if (currentGame == null && game !== false){
                    if (game.hasOwnProperty('id') || game.id !== currentGame.id){
                        console.log("update current game !");
                        currentGame = JSON.parse(data);
                        currentQuestion = null;
                        playerCanJoin = true;
                        currentAnswers = null;
                        currentPlayer = [];
                        tmpPlayerList = [];

                        client.say(botParameters.channel, "Une nouvelle partie va commencer !");
                        client.say(botParameters.channel, "Tapez la commande !play pour participer");
                    }
                }
                else{
                    // console.log("no update required");
                }
            });

        }).on("error", (err) => {
            console.log("Game Update Error: " + err.message);
        });
    }

    function questionUpadte(){
        http.get('http://'+laravel+'/bot/question', (resp) => {
            let data = '';
            // A chunk of data has been recieved.
            resp.on('data', (chunk) => {
                data += chunk;
            });

            // The whole response has been received. Print out the result.
            resp.on('end', () => {
                // console.log(JSON.parse(data));
                question = JSON.parse(data);
                if (currentGame !== null && question !== null){
                    if (currentQuestion == null || question.id !== currentQuestion.id){
                        playerCanJoin = false;
                        console.log("question has been updated");
                        currentQuestion = JSON.parse(data);
                        answerUpdate();
                    }
                    if(question.state !== currentQuestion.state && question.state > currentQuestion.state){
                        console.log("question state has been updated");
                        currentQuestion.state = question.state;
                        let rep = "";
                        for (i=0; i<currentAnswers.length;i++){
                            if (currentAnswers[i].true){
                                rep = currentAnswers[i].text;
                            }
                        }
                        client.say(botParameters.channel, "La bonne réponse était: "+rep)
                    }
                }
            });

        }).on("error", (err) => {
            console.log(" Question Update Error: " + err.message);
        });
    }
    function answerUpdate() {
        http.get('http://'+laravel+'/bot/answer', (resp) => {
            let data = '';
            // A chunk of data has been recieved.
            resp.on('data', (chunk) => {
                data += chunk;
            });

            // The whole response has been received. Print out the result.
            resp.on('end', () => {
                // console.log(JSON.parse(data));
                currentAnswers = JSON.parse(data);
                console.log("answer has been updated");
                if(currentQuestion === null || currentQuestion.state === 2){
                    playerCanAnswer = false;
                    return
                }
                playerCanAnswer = true;
                switch(questionType()){
                    case 0:
                        client.say(botParameters.channel, "Question à choix multiple:");
                        client.say(botParameters.channel, currentQuestion.text);
                        client.say(botParameters.channel, "Choisissez la bonne réponse parmit les propositions suivante (ex: !rep 1):");
                        for(let i=1; i<=currentAnswers.length; i++){
                            client.say(botParameters.channel, i+" - "+currentAnswers[i-1].text);
                        }
                        break;
                    case 1:
                        client.say(botParameters.channel, "Question ouverte:");
                        client.say(botParameters.channel, currentQuestion.text);
                        client.say(botParameters.channel, "Ecrivez la bonne réponse, l'orthogrpahe compte (ex: !rep rennes -> ok, !rep Rennes -> ok, !rep Renes -> pas ok, !rep Rénnes -> pas ok)");
                        break;
                    case 2:
                        client.say(botParameters.channel, "Image mystère:");
                        client.say(botParameters.channel, currentQuestion.text);
                        client.say(botParameters.channel, "Ecrivez la bonne réponse, l'orthogrpahe compte (ex: !rep rennes -> ok, !rep Rennes -> ok, !rep Renes -> pas ok)");
                        break;
                }
            });

        }).on("error", (err) => {
            console.log("Answer Update Error: " + err.message);
        });
    }

    function questionType(){
        if (currentQuestion != null && currentQuestion.hasOwnProperty('id')){
            if (currentQuestion.image == null){
                if(currentAnswers.length>1){
                    return 0
                }
                else{
                    return 1
                }
            }else{
                return 2
            }
        }
    }

    function update(){
        // console.log("////////////// UPDATE /////////////");
        if (currentGame !== null){
            questionUpadte();
        }
        gameUpdate();
    }
    if (botParameters !== null){
        updateInterval = setInterval(update, 2000);
    }else{
        console.log("Echec de synchronisation. Fin du processus");
        process.exit(1);
    }

}, mysqlQueryTimeout);

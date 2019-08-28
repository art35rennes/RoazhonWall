const tmi = require('tmi.js');

const options = {
	options: {
		debug: true,
	},
	connection: {
		cluster: 'aws',
	reconnect: true,
	},
	identity: {
		username: 'DevBot',
		password: 'oauth:d47f2m79j5bl05d7yx3xogdfjnb32q'
	},
	channels: ['Youtopie'],
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
	client.say("Youtopie", "Hello Twitch ! I'm a real human Kappa");

//	client.action('Youtopie', 'Hello there ! Le bot est en ligne ;)');
});

client.on('chat', (channel, user, message, isSelf) => {
    if (isSelf) return;

    let fullCommand = commandParser(message);

    if(fullCommand){
        let command = fullCommand[1];
        let param = fullCommand[2];

        switch(command){
            case "bonjour":
                client.say(channel, "Bonjour à toi " + user['display-name']);
                break;
            default:
                client.say(channel, "Commande '" + command + "'' non reconnue. Tapez " + prefix + "help pour la liste des commandes de " + client.getUsername());
        }
    }
});

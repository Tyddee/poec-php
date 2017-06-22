//alert('salut');
console.log('JS ok');

var list    = document.getElementById('list');
/*la variable list renvoie au pointeur id*/
var reset   = document.getElementById('reset');
var ajax   = document.getElementById('ajax');
var message = "Bonjour à tous";
var nbClics = 0; //visiblité max


function test (){ console.log(message); }

function addLi (){
    if (nbClics < 5) {
        //.createElement génère une balise html
        var li = document.createElement('li');
        li.innerText = message;
        list.appendChild(li);
        nbClics++; //incrémentation du nombre de clics;
    }
}

function addLi2(text){
    if (nbClics < 5) {
        //.createElement génère une balise html
        var li = document.createElement('li');
        li.innerText = text;
        list.appendChild(li);
        nbClics++; //incrémentation du nombre de clics;
    }
}

function emptyList () {
    //list.innerHTML = '';
    // ou :
    while (list.firstChild) { //tant que la liste a un enfant
        list.removeChild(list.firstChild);
    }
    nbClics = 0; //réinitialisation du compteur;
}

function getData () {// ds le corps de cette fct on va mettre AJAX
    //console.log('Requête ajax');
    var url = 'http://localhost/projet/php/ajax.php';
    var req = new XMLHttpRequest();
    req.open('GET', url, false);
    req.send(null);//aucune donnée supplémentaire n'est envoyée au serveur.

    if (req.status == 200) {
        //instruction à éxécuter en cas de succès
        //console.log('Réponse du serveur: ' + req.responseText);
        var res = req.responseText;
        console.log(typeof res); //renvoie string
        console.log(res[0]); //ne renvoie pas "Chiellini" mais "[";
        
//précieux à savoir, JSON.parse transforme la chaîne JSON en objet/tableau JS
        var resArray = JSON.parse(res);
        console.log(resArray);
        console.log(typeof resArray);//renvoie object (structure objet JS)
        console.log(resArray[0]);//renvoie Chiellini

        addLi2(resArray[1]);
    } else {

    }
}

// *** écouteurs d'évènements ***
document.getElementById('btn').addEventListener('click', addLi);
/*équivalent en JQuery $('btn').click(test);*/

reset.addEventListener('click', emptyList);
ajax.addEventListener('click', getData);
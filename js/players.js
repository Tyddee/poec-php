// *** Variables globales ***

var players = null; //source de données globale (ttes les fct y ont accès)
var ageAsc = false; //booléen permet de savoir si les joueurs sont triés par age ascendant
var nomAsc = true;
var filterAge = null;//au départ, aucun filtre sur l'âge, variable globale comme les autres ci-dessus

//****************************************************************************************

//*** Fonctions ***

function getPlayers() {
    var url = 'http://localhost/projet/php/ajax2.php';
/*requête ajax ASYNCHRONE. Javascript n'attend pas la réponse du 
serveur pour continuer l'execution du script*/
    $.get(url, function(data){
        // data contiendra les données envoyées par le serveur
        //console.log(data);
        players = JSON.parse(data);
        displayTable(players);/*fonction responsable de l'affichage d'un 
        tableau de joueurs*/
    });
}

//Création d'une ligne html
function displayTable(players){
    var table = '<table class="table table-striped">';
    //entête
    table += '<tr><th id="nomHeader">Nom</th><th>Prenom</th><th id="ageHeader">Age</th><th>Numéro</th>'
    +'<th>Equipe</th></tr>';

    var oldest = _.max(getAges(players));//récupère l'âge le plus élevé
    //console.log(oldest);

    //boucle
    players.forEach(function(player){
        table += '<tr>';
        table += '<td>'+ player.nom + '</td>';
        table += '<td>'+ player.prenom + '</td>';

        if (player.age == oldest) {
            table += '<td class="oldest">'+ player.age + '</td>';
        } else {
            table += '<td>'+ player.age + '</td>';
        }

        table += '<td>'+ player.maillot + '</td>';

        if (player.equipe_nom == null) {
            table += '<td>Sans équipe</td>';
        } else {
        table += '<td>'+ player.equipe_nom + '</td>';
        }
        table += '</tr>';
    });

    table += '</table>';

    $('#listPlayers').html(table);
}

function hidePlayers(ageLimit){
    var nbResults = 0;
    var rows = $('table tr'); //on récupère les lignes du tableau
    $.each(rows, function(index, row){
        /*On cible la ligne par zepto afin "d'envelopper" 
        l'élément de nouvelles capacités(propriétés et méthodes)*/
        var r = $(row); //r est "plus riche" en fonctionnalités que row
        //récupération de l'age du joueur
        var age = r.children().eq(2).text();

        //if (age > ageLimit && age != 'Age') {   ou
        if (age > ageLimit && index != 0) {
            r.hide();
        } else {
            r.show();
            nbResults++;
        }
    });
    //on affiche le réultat dans le DOM
    $('#nbResults').html(nbResults - 1); //-1 pr ne pas compter la ligne d'en-tête
}

function getAges(players){
    var ages = []; //on initialise un tableau vide
    players.forEach(function(player){
        ages.push(player.age); //push ajoute un élément ds le tableau
    });

    return ages;// on retourne le tableau des ages
}

function getFormValues(form){
    //récupère tous les inputs placés ds le formulaire fourni en entrée de la fonction
    var inputs  = form.children('input');
    var nom     = inputs.eq(0).val(); //valeur du 1er input trouvé (nom)
    var prenom  = inputs.eq(1).val();
    var age     = inputs.eq(2).val();

    //renvoie un tableau de deux balises select
    var selects = form.children('select');
    var maillot = selects.eq(0).val();
    var equipe  = selects.eq(1).val();

    //console.log(nom + ' ' + prenom + ' ' + maillot);

    /*création d'un objet values permettant de stocker ttes les valeurs
    à transmettre au serveur*/
    var values = {
        nom: nom,
        prenom: prenom,
        age: age,
        maillot: maillot,
        equipe: equipe
    };
    //console.log(values);
    return values;
}

function checkValues(player){
    //player est un objet
    var conditions = 
        player.nom.length > 1 &&
        player.prenom.length > 1 &&
        player.age.length > 1;

    return conditions;
}

function clearMessage(timer){
    var message = $('#message');
    setTimeout(function(){
        //efface le texte situé ds l'élément #message ainsi que les classes css
        message.text('').removeClass();
    }, timer);
}

//$('#btn').on('click', test);          KDO zepto
/*équivalent JS : document.getElementById('btn')*/

//***************************************************************************************

//*** Ecouteurs d'évènement (event Listenners) ***

$('#selectAge').on('change', function(){
    //val récupère la valeur de l'élément de formulaire (select et input)
    filterAge = $(this).val();
    //console.log('age sélectionné : ' + age);
    hidePlayers(filterAge);
});


/*Lorsque l'élément #ageHeader EXISTERA ds le dom, 
JS placera un écouteur d'évènement click dessus*/
$(document).on('click', '#ageHeader',function(){
    //console.log('ok');
    if (ageAsc) {
        var sortedPlayers = _.reverse(_.sortBy(players, ['age']));
    } else {
        var sortedPlayers = _.sortBy(players, ['age']);
    }
    ageAsc = !ageAsc; //true devient false ou false devient true
    displayTable(sortedPlayers);
    if (filterAge) { //si variable filterAge différent de null, false ou undefined
        hidePlayers(filterAge); // on masque les joueurs dont l'âge est supérieur à la valeur stockée ds filterAge
    }
});


$(document).on('click', '#nomHeader',function(){
    //console.log('ok');
    if (nomAsc) {
        var sortedPlayers = _.reverse(_.sortBy(players, ['nom']));
    } else {
        var sortedPlayers = _.sortBy(players, ['nom']);
    }
    nomAsc = !nomAsc; //true devient false ou false devient true
    displayTable(sortedPlayers);
    if (filterAge) {
        hidePlayers(filterAge);
    }
});

$('#displayFormPlayer').on('click', function(){
    var text = ' le formulaire pour ajouter un joueur';
    //console.log('ok');
    //$('#formPlayer').show();   ou
    //$('#formPlayer').toggle();   ciblage absolu
    var form = $(this).next(); //ciblage relatif, moins couteux en w d'exploration par le javascript
    form.toggle();

    //changer le texte du lien en fonction de la visibilité du formulaire
    //console.log(form.css('display'));
    var status = form.css('display');
    if (status == 'none') {
        $(this).text('Afficher' + text)
    } else {
        $(this).text('Masquer' + text)
    }
});

$('#formPlayer button').on('click', function(){
    //console.log('ok');
    var form    = $('#formPlayer');
    //création d'un objet player à partir des valeurs récupérées ds le formulaire
    var player  = getFormValues(form);
    //console.log(player);
    var check = checkValues(player);
    //console.log(check);

    if (check) {
        //si conditions remplies => requête en ajax en post.
        //requête AJAX en POST
        var url = 'http://localhost/projet/php/ajaxAddPlayer.php';
        $.post(url, player, function(data){

        //console.log(data);
        //si php a renvoyé 1 (requête sql éxecutée avc succès)
            if (data == 1) {
                getPlayers(); //recharge la liste des joueurs
                $('#message')
                    .text('L\'enregistrement a réussi')
                    .removeClass()
                    .addClass('bg-success text-success');
            } else {
                $('#message')
                    .text('L\'enregistrement a échoué')
                    .removeClass()
                    .addClass('bg-danger text-danger');
            }
        });
    } else {
        //afficher le message d'erreur si les conditions de validation non remplies
        $('#message')
            .text('Formulaire non valide')
            .removeClass()
            .addClass('bg-danger text-danger');
    }
    clearMessage(5000);
});

//*****************************************************************************************

//Chargement de la liste des joueurs, c'est ce qui est exécuté en tout 1er ici.
getPlayers(); //appel de la fonction au chargement du script.

//Lodash exemples
/*var notes = [7, 56, 12, 74, 30];

var max = _.max(notes);
var min = _.min(notes);

console.log(max);
console.log(min);*/
// .module(argument 1, arg2)
//arg1 : nom du module
//arg2 : tableau des dépendances (autres modules chargés)
var app = angular.module('introApp', []);

app.controller('mainCtrl', function($scope, $http){
    var url_serveur = "http://localhost/projet/php/poo/ajax.php";

    //$scope.updateMode est un indicateur permettant de savoir si le formulaire 
    //doit être géré en mode insertion ou bien en mode mise à jour
    $scope.updateMode = false; //Mode insertion par défaut
    $scope.visibleForm = false;//formulaire masqué par défaut, car on initialise son état
    $scope.nb_clicks = 0;
    $scope.orderKey = "age";//critère de tri initial
    $scope.reverse = false; //par défaut, tri croissant (pas d'inversion)
    $scope.message = "coucou"; //ajout d'une propriété "message" à l'objet $scope
    //(espace d'échange entre la vue et le controller).
    $scope.maillot_range = [];//tableau destiné à alimenter le menu select 
    //dans le formulaire d'ajout d'un joueur

    //variable équipes non accessible à la vue écrit en DUR
    var equipes = [ //création d'un tableau d'objet, déclaration en local
        {name: 'Benfica'},//1 objet avec une propriété
        {name: 'Camacha'},
        {name: 'Juventus'},
        {name: 'PSG'},
        {name: 'Strasbourg'},
        {name: 'FC Barcelona'},
        {name: 'Real Madrid'}
    ];

    function getPlayers(){
        //requête ajax via le service $http
        var url = url_serveur + "?action=list";
        $http.get(url).then(function(res) {
            $scope.giocatori = res.data;
        });
    }

    function buildNumeroList() {
        for (var i = 1; i < 1000; i++) {
            $scope.maillot_range.push(i);
        }
    }

    function initPlayer() {
        $scope.player = { //pré remplissage des champs
            nom: null,         //chaîne vide ou null, équivalent ex: nom:'', OU nom: null,
            prenom: null,
            age: null,
            maillot: "1",
            equipe: "0"
        };
    }

    //non accessible à la vue
    $scope.teams = equipes; //ns exposons les equipes, elles deviennent accessibles à la vue via le scope.

    $scope.changeOrder = function(key){
        $scope.orderKey = key;
        $scope.reverse = !$scope.reverse; // on inverse l'ordre du tri
    }

    $scope.savePlayer = function() {
        //console.log($scope.team);
        //requête ajax pr ajouter un joueur
        var url = url_serveur;
        //console.log($scope.player);

        $http.post(url, {player: $scope.player}).then(function(res){ //ici $scope.player représente les données envoyées au serveur
            console.log(res.data);
            //rechargement des joueurs
            getPlayers();

            //effacer les champs du formulaire et repasse en mode insertion grâce à $scope.clearForm
            //$scope.player = {};//réinitialise avec objet vide
            $scope.clearForm();
        });
    };

    $scope.editPlayer = function() {
        //console.log('edit');
        //console.log(this.g);
        $scope.player = this.g;
        $scope.updateMode = true;
        $scope.visibleForm = true;
    };

    $scope.deletePlayer = function() {
        //this retourne le "contexte" du bouton cliqué
        //on obtient ainsi les données incluses ds la même ligne (tr)
        //que le bouton cliqué
        // this.g (g est généré par le ng-repeat) retourne
        // les données du joueur que l'on veut supprimer 
        var player_id = this.g.id;

        //requête ajax pr supprimer le joueur identitfié
        var url = url_serveur + "?action=delete&id=" + player_id;
        $http.get(url).then(function(res){
            //console.log(res.data);
            //rechargement des joueurs
            getPlayers();
        });
    };

    $scope.clearForm = function() {
        //$scope.player = {}; //réinitialisation de $scope.player
        initPlayer();
        $scope.updateMode = false;
    }

    //chargement des joueurs
    getPlayers();

    //construction de la liste des numéros de maillot
    buildNumeroList();
    //console.log($scope.maillot_range);

    //initialisation du formulaire d'ajout de joueur
    initPlayer();

    //$scope.player = {nom:'PIRES', prenom:'Roberto'};
    //ci-dessus, permet de préremplir les champs.
});
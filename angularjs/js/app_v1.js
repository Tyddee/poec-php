// .module(argument 1, arg2)
//arg1 : nom du module
//arg2 : tableau des dépendances (autres modules chargés)
var app = angular.module('introApp', []);

app.controller('mainCtrl', function($scope, $http){
    $scope.nb_clicks = 0;
    $scope.orderKey = "age";//critère de tri initial
    $scope.reverse = false; //par défaut, tri croissant (pas d'inversion)
    $scope.message = "coucou"; //ajout d'une propriété "message" à l'objet $scope
    //(espace d'échange entre la vue et le controller).

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
        var url = "http://localhost/projet/php/ajax2.php";
        $http.get(url).then(function(res) {
            $scope.giocatori = res.data;
        });
    }

    //non accessible à la vue
    $scope.teams = equipes; //ns exposons les equipes, elles deviennent accessibles à la vue via le scope.

    $scope.changeOrder = function(key){
        $scope.orderKey = key;
        $scope.reverse = !$scope.reverse; // on inverse l'ordre du tri
    }

    $scope.deletePlayer = function() {
        //this retourne le "contexte" du bouton cliqué
        //on obtient ainsi les données incluses ds la même ligne (tr)
        //que le bouton cliqué
        // this.g (g est généré par le ng-repeat) retourne
        // les données du joueur que l'on veut supprimer 
        var player_id = this.g.id;

        //requête ajax pr supprimer le joueur identitfié
        var url = "http://localhost/projet/php/deletePlayer.php?ajax=true&id=" + player_id;
        $http.get(url).then(function(res){
            //console.log(res.data);
            //rechargement des joueurs
            getPlayers();
        });
    };

    //chargement des joueurs
    getPlayers();
});
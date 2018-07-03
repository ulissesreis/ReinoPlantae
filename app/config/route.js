angular.module("plantae").config(function ($routeProvider) {
    $routeProvider                                
        .when("/", {
            templateUrl: "views/home.html",
            controller: "homeController"
        })
        .when("/plantamedicinal/:id", {
            templateUrl: "views/planta.html",
            controller: "plantaController"
        })
        .when("/sintoma/:id", {
            templateUrl: "views/sintoma.html",
            controller: "sintomaController"
        })
        .when("/sugerir", {
            templateUrl: "views/sugerir.html",
            controller: "sugerirController"
        })
        .when("/painel", {
            templateUrl: "views/painel.html",
            controller: "painelController"
        })
        
        .when("/painel/monitor/respostas", {
            templateUrl: "views/monitorRespostas.html",
            controller: "monitorRespostasController"
        })
        .when("/painel/monitor/analise", {
            templateUrl: "views/monitorAnalise.html",
            controller: "monitorAnaliseController"
        })
        .when("/painel/planta", {
            templateUrl: "views/plantaPainel.html",
            controller: "plantaPainelController"
        })
        .when("/painel/sintoma", {
            templateUrl: "views/sintomaPainel.html",
            controller: "sintomaPainelController"
        })
        .when("/painel/indicacoes", {
            templateUrl: "views/indicacoesPainel.html",
            controller: "indicacoesController"
        })
        .when("/painel/usuario", {
            templateUrl: "views/usuarioPainel.html",
            controller: "usuarioPainelController"
        })
        .when("/painel/sugestoes", {
            templateUrl: "views/sugestoes.html",
            controller: "sugestoesController"
        })
        .when("/painel/pendencias", {
            templateUrl: "views/pendencias.html",
            controller: "pendenciasController"
        })
        .otherwise({ redirectTo: "/" });
});
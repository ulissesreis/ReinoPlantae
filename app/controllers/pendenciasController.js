angular.module(["plantae"]).controller('pendenciasController', function ($rootScope, $scope, $location, $routeParams, sintomas, plantas, indicacoes, admin,parametros) {

    $scope.verSintomas = function () {
        ClearMemory();
        $scope.guia = 'sintomas';
        sintomas.getAprovacao().success(function (data) {
            $scope.sintomas = data;
        });
    };
    $scope.verPlantas = function () {
        ClearMemory();
        $scope.guia = 'plantas';
        plantas.getAprovacao().success(function (data) {            
            $scope.plantas = data;
        });
    };
    $scope.verIndicacoes = function () {
        ClearMemory();
        $scope.guia = 'indicacoes';
        indicacoes.getAprovacao().success(function (data) {            
            $scope.indicacoes = data;
        });
    };
    let ClearMemory = function () {
        delete $scope.indicacoes;
        delete $scope.indicacao;
        delete $scope.plantas;
        delete $scope.planta;
        delete $scope.sintomas;
        delete $scope.sintoma;
        $scope.descricao = null;
    }
    $scope.avaliarIndicacao = function (indicacao) {
        $scope.indicacao = indicacao;        
    }
    $scope.avaliarSintoma = function (sintoma) {
        $scope.sintoma = sintoma;
    }
    $scope.avaliarPlanta = function (planta) {
        $scope.planta = planta;
    }
    $scope.setAvaliacao = function (bool) {
        if ($scope.guia == 'plantas') {
            $scope.setAvaliacaoPlanta(bool);
        } else if ($scope.guia == 'sintomas') {
            $scope.setAvaliacaoSintoma(bool);
        } else if ($scope.guia == 'indicacoes') {
            $scope.setAvaliacaoIndicacao(bool);
        }
    }
    $scope.setAvaliacaoSintoma = function (bool) {
        let model = {
            status: bool,
            sintoma_id: $scope.sintoma.edicao_id,
            descricao: $scope.descricao
        }        
        sintomas.aprovar(model).success(function (data) {            
            prepare();
            $scope.verSintomas();
        });
    }
    $scope.setAvaliacaoPlanta = function (bool) {
        let model = {
            status: bool,
            planta_id: $scope.planta.edicao_id,
            descricao: $scope.descricao
        }
        plantas.aprovar(model).success(function (data) {            
            prepare();
            $scope.verPlantas();
        });
    }
    $scope.setAvaliacaoIndicacao = function (bool) {
        let model = {
            status: bool,
            indicacao_id: $scope.indicacao.edicao_id,
            descricao: $scope.descricao
        }
        indicacoes.aprovar(model).success(function (data) {            
            prepare();
            $scope.verIndicacoes();
        });
    }

    let prepare = function () {
        admin.getRelatorio({ relatorio: 'pendencias' }).success(function (data) {
            $scope.rel = data;
        });
        $scope.baseImg = parametros.baseImg;
        $scope.noImage = 'noImage.png';
    };
    // INIT
    prepare();
    $rootScope.getVolumetria();
});
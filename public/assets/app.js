angular.module('Bifortis', ['ngRoute']).
    controller('AppCtrl', ['$scope','$http','$routeParams', function($scope,$http,$routeParams){

        $scope.upload = function(data)
        {
            $scope.formLoader = true;

            $scope.errorMsg ='';

            var fd = new FormData();

            fd.append('label', data.label);
            fd.append('image', data.avatar);

            $http.post('api/images', fd, {
                transformRequest: angular.identity, //No serialize
                headers: { 'Content-Type': undefined }
            }).success(function(data){
                $scope.formLoader = false;
                $scope.images.push(data);
                $scope.data = {};
            }).error(function (data, status) {
                $scope.formLoader = false;
                if(status == 422){
                    angular.forEach(data, function(elem){
                        if(! elem.undefined) $scope.errorMsg += elem[0];
                    })
                }
            });
        }



        $scope.getImages = function()
        {
            $scope.loader = true;
            $http.get('api/images')
                .success(function(data){
                    $scope.loader = false;
                    $scope.images = data;
                }).error(function(){
                    $scope.loader = false;
                });
        }

        $scope.getImage = function()
        {
            $scope.loader = true;

            var id = $routeParams.id;

            $http.get('api/images/'+id)
                .success(function(data){
                    $scope.loader = false;
                    $scope.image = data;
                }).error(function(data, status){
                    $scope.loader = false;
                });
        }



    }]).
    directive('fileDirective', ['$parse', function($parse){
        return {
            restrict: 'A',
            link: function(scope, element, attrs)
            {
                element.bind('change', function(){
                    scope.$apply(function(){
                        $parse(attrs.fileDirective).assign(scope, element[0].files[0]);
                    });
                })
            }
        };
    }]).
    config(function($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'views/home.html',
                controller: 'AppCtrl'
            })
            .when('/images/:id', {
                templateUrl: 'views/images/show.html',
                controller: 'AppCtrl'
            })
            .when('/images', {
                templateUrl: 'views/images/index.html',
                controller: 'AppCtrl'
            });

    })
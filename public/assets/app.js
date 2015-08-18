angular.module('Bifortis', []).
    controller('AppCtrl', ['$scope','$http', function($scope,$http){

        $scope.upload = function(data)
        {
            $scope.errorMsg ='';

            var fd = new FormData();

            fd.append('label', data.label);
            fd.append('image', data.avatar);

            $http.post('api/images', fd, {
                transformRequest: angular.identity, //No serialize
                headers: { 'Content-Type': undefined }
            }).success(function(data){
                $scope.images.push(data);
                $scope.data = {};
                $scope.data.avatar = {};
            }).error(function (data, status) {
                if(status == 422){

                    angular.forEach(data, function(elem){
                        if(! elem.undefined) $scope.errorMsg += elem[0];
                    })
                }
            });
        }



        $scope.getImages = function()
        {
            $http.get('api/images')
                .success(function(data){
                    $scope.images = data;
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
    }])
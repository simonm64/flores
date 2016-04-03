var app = angular.module('floresTest', []);
app.controller('testBasicoCtrl', function($scope,$http) {
      
      $http({
         method : "GET",
         url : "get-question?iTest=1",
         headers: {
            
            'X-Requested-With':'XMLHttpRequest'
      },
     }).then(function mySucces(response) {
         $scope.oQuestion = response.data.data;
         $scope.oQuestion.value = 0;
     }, function myError(response) {
         $scope.myWelcome = response.statusText;
     });
    
      $scope.sendAnswer = function(){
            
            /*console.log($scope.oQuestion.value);
            $http({
            method : "POST",
            url : "add-answer",
            data: $.param($scope.oQuestion),
            headers: {
                  'X-Requested-With':'XMLHttpRequest',
                  'Content-Type': 'application/x-www-form-urlencoded'
            },
            }).then(function mySucces(response) {
            console.log(response);
         $scope.oQuestion = response.data;
         //$scope.oQuestion.value = 2;
            }, function myError(response) {
          $scope.myWelcome = response.statusText;
            });*/
            
            $http({
            method : "GET",
            url : "add-answer",
            params: {i_question:$scope.oQuestion.i_question,
                  value: $scope.oQuestion.value,
                  id_test:$scope.oQuestion.id_test,
                  i_group:$scope.oQuestion.i_group},
            headers: {
                  'X-Requested-With':'XMLHttpRequest',
                  'Content-Type': 'application/x-www-form-urlencoded'
            },
            }).then(function mySucces(response) {
            console.log(response);
         $scope.oQuestion = response.data;
         //$scope.oQuestion.value = 2;
            }, function myError(response) {
          $scope.myWelcome = response.statusText;
            });
     
      }
      
});
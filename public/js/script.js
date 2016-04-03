var app = angular.module('floresTest', []);
app.controller('testCtrl', function($scope,$http) {
  
      $http({
         method : "GET",
         url : "get-question"
     }).then(function mySucces(response) {
         $scope.content = response.data;
     }, function myError(response) {
         $scope.myWelcome = response.statusText;
     });
    
});
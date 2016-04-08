var app = angular.module('floresTest', []);
app.controller('testBasicoCtrl', function($scope,$http) {

  $http({method : "GET",
    url : "get-question",
    params: {iTest:1},
    headers: {
      'X-Requested-With':'XMLHttpRequest',
      },
  }).then(function mySucces(response) {
     $scope.oQuestion = response.data;
     //$scope.oQuestion.value = 0;
  }, function myError(response) {
     $scope.myWelcome = response.statusText;
  });

  $scope.sendAnswer = function(){
    $http({
    method : "POST",
    url : "add-answer",
    //transformRequest: transformRequestAsFormPost,
    data:$.param({i_question:$scope.oQuestion.i_question,
      value: $scope.oQuestion.value,
      id_test:$scope.oQuestion.id_test,
      i_group:$scope.oQuestion.i_group}),
    /*params: {i_question:$scope.oQuestion.i_question,
          value: $scope.oQuestion.value,
          id_test:$scope.oQuestion.id_test,
          i_group:$scope.oQuestion.i_group},*/
    headers: {
          'X-Requested-With':'XMLHttpRequest',
          'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
          },
    }).then(function Succes(response) {
      console.log(response);
      if(response.data==0){
        //here the questions are finished. Need to display a view (modal)
        $scope.oQuestion.vc_question = 'PREGUNTAS TERMINADAS GRACIAS';
      }else{
        $scope.oQuestion = response.data;
      }


    //$scope.oQuestion.value = 2;
    }, function Error(response) {
          $scope.myWelcome = response.statusText;
    });
  }
});
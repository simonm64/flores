var app = angular.module('floresTest', []);

app.controller('testCtrl', function($scope, $http, $window){
  $scope.init = function (id){
    $scope.id_test = id;
    $http({
      method: "GET",
      url: "get-question",
      params: {iTest: $scope.id_test},
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      },
    }).then(function mySucces(response) {
      //console.log(response);
      if (response.data == 0) {
        //no more questions send to the completed view
        //TODO create completed view
        var url = $window.location.host;
        $window.location = 'http://' + $window.location.host + '/test/terminado';
      }
      $scope.oQuestion = response.data;
      //$scope.oQuestion.value = 0;
    }, function myError(response) {
      $scope.myWelcome = response.statusText;

    });
  };

  $scope.sendAnswer = function(){
    $http({
    method : "POST",
    url : "add-answer",
    //transformRequest: transformRequestAsFormPost,
    data:$.param({i_question:$scope.oQuestion.i_question,
      value: $scope.oQuestion.value,
      id_test:$scope.oQuestion.id_test,
      i_group:$scope.oQuestion.i_group}),
    headers: {
          'X-Requested-With':'XMLHttpRequest',
          'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
          },
    }).then(function Succes(response) {
      //console.log(response);
      if(response.data==0){
        //TODO here the questions are finished. Need to redirect to a view explaining has finished
        //$scope.oQuestion.vc_question = 'PREGUNTAS TERMINADAS GRACIAS';
        $window.location = 'http://'+$window.location.host+'/user?i='+$scope.oQuestion.id_test;
      }else{
        $scope.oQuestion = response.data;
      }
    //$scope.oQuestion.value = 2;
    }, function Error(response){
      $scope.myWelcome = response.statusText;
    });
  }
});


app.controller('UserCtrl', function($scope, $http, $window){
  $scope.register = function(idTest){
	$scope.idTest = idTest;
    $http({
      method : "POST",
      url : "/user/register-user",
      //transformRequest: transformRequestAsFormPost,
      data:$.param({iTest:$scope.idTest,
        firstName:$scope.firstName,
        lastName: $scope.lastName,
        email:$scope.email,
        country:$scope.country,
        phoneNumber:$scope.phoneNumber}),
      headers: {
        'X-Requested-With':'XMLHttpRequest',
        'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
      },
    }).then(function Succes(response){
      //console.log(response);
      if(response.data.success==true) {
        //here the questions are finished. Need to display a view (modal)
        alert(response.data.msg);
        $window.location = 'http://'+$window.location.host+'/test/resultados';
      }else{
        $scope.Message = response.data.msg;
      }
      //$scope.oQuestion.value = 2;
    }, function Error(response){
      $scope.myWelcome = response.statusText;
    });
  }
});


app.controller('StoreCtrl', function($scope, $http, $window){
  $scope.sendAddress= function(){
    $http({
      method : "POST",
      url : "/store/send-address",
      data:$.param({
        firstName:$scope.firstName,
        lastName:$scope.lastName,
        email:$scope.email,
        street:$scope.street,
        area:$scope.colonia,
        city:$scope.city,
        state:$scope.state,
        zip:$scope.zip,
        country:$scope.country,
        phoneNumber:$scope.phoneNumber}),
      headers: {
        'X-Requested-With':'XMLHttpRequest',
        'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
      },
    }).then(function Succes(response){
      //console.log(response);
      if(response.data.success==true) {
        //here the questions are finished. Need to display a view (modal)
        alert(response.data.msg);
        $window.location = 'http://'+$window.location.host+'/';
      }else{
        $scope.Message = response.data.msg;
      }
    }, function Error(response){
      $scope.myWelcome = response.statusText;
    });
  }
});

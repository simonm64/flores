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
    $scope.oQuestion = response.data;
    //$scope.oQuestion.value = 2;
    }, function Error(response) {
          $scope.myWelcome = response.statusText;
    });
  }
});

app.factory(
    "transformRequestAsFormPost",
    function() {
        // I prepare the request data for the form post.
        function transformRequest( data, getHeaders ) {
            var headers = getHeaders();
            headers[ "Content-type" ] = "application/x-www-form-urlencoded; charset=utf-8";
            return( serializeData( data ) );
        }
        // Return the factory value.
        return( transformRequest );
        // ---
        // PRVIATE METHODS.
        // ---
        // I serialize the given Object into a key-value pair string. This
        // method expects an object and will default to the toString() method.
        // --
        // NOTE: This is an atered version of the jQuery.param() method which
        // will serialize a data collection for Form posting.
        // --
        // https://github.com/jquery/jquery/blob/master/src/serialize.js#L45
        function serializeData( data ) {
            // If this is not an object, defer to native stringification.
            if ( ! angular.isObject( data ) ) {
                return( ( data == null ) ? "" : data.toString() );
            }
            var buffer = [];
            // Serialize each key in the object.
            for ( var name in data ) {
                if ( ! data.hasOwnProperty( name ) ) {
                    continue;
                }
                var value = data[ name ];
                buffer.push(
                    encodeURIComponent( name ) +
                    "=" +
                    encodeURIComponent( ( value == null ) ? "" : value )
                );
            }
            // Serialize the buffer and clean it up for transportation.
            var source = buffer
                .join( "&" )
                .replace( /%20/g, "+" )
            ;
            return( source );
        }
    }
);
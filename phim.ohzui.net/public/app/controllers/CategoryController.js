app.controller('CategoryController', function($scope, $http, API_URL) {
     $http.get(API_URL +"/categories")
            .then(function(response) {
               $scope.categories=response.data;
    });
    $scope.save = function(){
         var url = API_URL + "/categories";
         console.log($scope.category.name);
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.category),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            $http.get(API_URL +"/categories")
            .then(function(response) {
               $scope.categories=response.data;
            });
        }).error(function(response) {
            alert('This is embarassing. An error has occured. Please check the log for details'+url);
        });
    }
}); 
    
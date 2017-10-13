app.controller('PostController', function($scope, $http, API_URL) {  
	// add category
    $http.get(API_URL +"/categories")
            .then(function(response) {
               $scope.categories=response.data;
    });
    $scope.addCategory = function(){
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
    $scope.deleteCategory = function(id){
        var url = API_URL + "/categories/" + id;
          var isConfirmDelete = confirm('Do you want to delete this category?');
          if (isConfirmDelete) {
              $http({
                  method: 'DELETE',
                  url: url
              }).
              success(function(data) {
                  console.log(data);
                  $http.get(API_URL +"/categories")
                    .then(function(response) {
                       $scope.categories=response.data;
                    });
                  
              }).
              error(function(data) {
                  alert('Unable to delete');
              });
            }
    }
     $scope.getLinkPhim = function(){
        var url = API_URL + "/getPhim";
        // console.log($scope.youtube);
        console.log(url);
        $http.get(url,{params: { linkphim : $scope.youtube }})
            .then(function(response) {
               console.log(response.data);
               // var videoFile = response.data['hd720-22'];
               // console.log(videoFile);
               //          var video = $('#youtube video');
               //          video.html('<source src="'.videoFile.'" type="video/mp4"></source>');

            });
    }
    
});
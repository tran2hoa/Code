app.controller('PhimController', function($scope, $http, API_URL) {

   $scope.getYoutube = function(){
        var url = API_URL + "/getPhim";
        // console.log($scope.youtube);
        $http.get(url,{params: { youtube : $scope.youtube }})
            .then(function(response) {
              console.log(response);
            //    var videoFile = response.data['hd720-22'];
            //    console.log(videoFile);
        				// var video = $('#youtube video');
        				// video.html('<source src="'.videoFile.'" type="video/mp4"></source>');

            });
    }


    console.log('test controller');
}); 
    
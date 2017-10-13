var app = angular.module('blog', []).constant('API_URL', 'http://ohzui.net');
//app.constant("CSRF_TOKEN", '{{ csrf_token() }}');
app.config(function($interpolateProvider) {
   $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
});
app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common['X-CSRFToken'] = '{{ csrf_token|escapejs }}';
}]);
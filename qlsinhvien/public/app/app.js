var app = angular.module('app', ['ngTouch','ui.grid']).constant('API_URL', 'http://dvdt.hueic.edu.vn/api/');
//app.constant("CSRF_TOKEN", '{{ csrf_token() }}');
// app.config(function($interpolateProvider) {
//    $interpolateProvider.startSymbol('[[');
//   $interpolateProvider.endSymbol(']]');
// });
// app.config(['$httpProvider', function($httpProvider) {
//     $httpProvider.defaults.headers.common['X-CSRFToken'] = '{{ csrf_token|escapejs }}';
// }]);
app.controller('MainCtrl', ['$scope','uiGridConstants', '$http', function ($scope, uiGridConstants, $http) {
var data = [];

$scope.gridOptions = {
    showGridFooter: true,
    showColumnFooter: true,
    enableFiltering: true,
    columnDefs: [
        { field: 'name', width: '13%' },
        { field: 'address.street',aggregationType: uiGridConstants.aggregationTypes.sum, width: '13%' },
        { field: 'age', aggregationType: uiGridConstants.aggregationTypes.avg, aggregationHideLabel: true, width: '13%' },
        { name: 'ageMin', field: 'age', aggregationType: uiGridConstants.aggregationTypes.min, width: '13%', displayName: 'Age for min' },
        { name: 'ageMax', field: 'age', aggregationType: uiGridConstants.aggregationTypes.max, width: '13%', displayName: 'Age for max' },
        { name: 'customCellTemplate', field: 'age', width: '14%', footerCellTemplate: '<div class="ui-grid-cell-contents" style="background-color: Red;color: White">custom template</div>' },
        { name: 'registered', field: 'registered', width: '20%', cellFilter: 'date', footerCellFilter: 'date', aggregationType: uiGridConstants.aggregationTypes.max }
    ],
    data: data,
    onRegisterApi: function(gridApi) {
            $scope.gridApi = gridApi;
    }
};

$scope.toggleFooter = function() {
  $scope.gridOptions.showGridFooter = !$scope.gridOptions.showGridFooter;
  $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
};

$scope.toggleColumnFooter = function() {
  $scope.gridOptions.showColumnFooter = !$scope.gridOptions.showColumnFooter;
  $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
};

$http.get('/data/500_complex.json')
  .success(function(data) {
    data.forEach( function(row) {
      row.registered = Date.parse(row.registered);
    });
    $scope.gridOptions.data = data;
  });
}]);

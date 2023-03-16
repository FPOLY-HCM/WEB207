import 'angular'
import 'angular-route'

const app = angular
    .module('app', ['ngRoute'])

app.config(($interpolateProvider) => {
    $interpolateProvider.startSymbol('%')
    $interpolateProvider.endSymbol('%')
})

app.controller('MainController', function ($scope, $route) {
    $scope.$route = $route
})

app.controller('HomeController', function ($scope, $http) {
    $scope.discussions = []

    $http.get('api/discussions').then((response) => $scope.discussions = response.data)
})

app.controller('DiscussionController', function ($scope, $http, $routeParams) {
    $scope.discussion = {}

    $http.get('api/discussions/' + $routeParams.id).then((response) => $scope.discussion = response.data)
})

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'home.html',
            controller: 'HomeController'
        })
        .when('/d/:id', {
            templateUrl: 'discussion.html',
            controller: 'DiscussionController'
        })
        .when('/login', {
            templateUrl: 'login.html',
            controller: 'LoginController'
        })
})


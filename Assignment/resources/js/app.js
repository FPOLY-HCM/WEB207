import 'bootstrap'
import 'angular'
import 'angular-route'

const app = angular.module('app', ['ngRoute'])

app.config(($interpolateProvider) => {
    $interpolateProvider.startSymbol('%')
    $interpolateProvider.endSymbol('%')
})

app.controller('MainController', function ($scope, $route) {
    $scope.$route = $route
})

app.controller('HomeController', function ($scope, $http, $routeParams) {
    $scope.discussions = []
    $scope.tags = []

    $http.get($routeParams.slug ? 'api/tags/' + $routeParams.slug : 'api/discussions').then((response) => ($scope.discussions = response.data))
    $http.get('api/tags').then((response) => ($scope.tags = response.data))
})

app.controller('LoginController', function ($scope, $http) {
    $scope.email = ''
    $scope.password = ''

    $scope.login = () => {
        $http
            .post('api/login', {
                email: $scope.email,
                password: $scope.password,
            })
            .then((response) => {
                console.log(response)
            })
    }
})

app.controller('DiscussionController', function ($scope, $http, $routeParams) {
    $scope.discussion = {}

    $http
        .get('api/discussions/' + $routeParams.id)
        .then((response) => ($scope.discussion = response.data))
})

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'home.html',
            controller: 'HomeController',
        })
        .when('/d/:id', {
            templateUrl: 'discussion.html',
            controller: 'DiscussionController',
        })
        .when('/t/:slug', {
            templateUrl: 'home.html',
            controller: 'HomeController',
        })
        .when('/login', {
            templateUrl: 'login.html',
            controller: 'LoginController',
        })
})

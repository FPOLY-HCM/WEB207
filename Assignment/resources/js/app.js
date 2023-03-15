import 'angular'

const app = angular.module('app', [])

app.config(($interpolateProvider) => {
    $interpolateProvider.startSymbol('%')
    $interpolateProvider.endSymbol('%')
})

app.controller('GreetingController', ($scope) => {
    $scope.greeting = 'Hello world'
})

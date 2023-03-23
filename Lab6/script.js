const app = angular.module('app', [])

app.controller('MainController', function ($scope) {
    $scope.greeting = 'Hello AngularJS'
    $scope.user = {
        name: 'Ngo Quoc Dat',
        email: 'datnqpd05994@fpt.edu.vn',
        phone: '0372124043',
        subject: 'Web Development',
        website: 'https://ngoquocdat.dev',
    }
})
const app = angular.module('app', [])

app.controller('ContactController', function ($scope, $http) {
    $scope.error = null
    $scope.success = null
    $scope.editId = null

    $scope.name = null
    $scope.phone = null

    $scope.contacts = []

    $scope.getContacts = () => {
        $http.get('contact.php').then((response) => {
            $scope.contacts = response.data
        })
    }

    $scope.add = () => {

        $http.post('contact.php', { name: $scope.name, phone: $scope.phone }).then((response) => {
            $scope.success = response.data.message
        }).catch((error) => {
            $scope.error = error.data.message
        }).finally(() => {
            $scope.getContacts()
            $scope.reset()
        })
    }

    $scope.update = () => {

        $http.put('contact.php?id=' + $scope.editId, { name: $scope.name, phone: $scope.phone }).then((response) => {
            $scope.success = response.data.message
        }).catch((error) => {
            $scope.error = error.data.message
        }).finally(() => {
            $scope.getContacts()
            $scope.reset()
        })
    }

    $scope.delete = (id) => {

        $http.delete('contact.php?id=' + id).then((response) => {
            $scope.success = response.data.message
        }).catch((error) => {
            $scope.error = error.data.message
        }).finally(() => {
            $scope.getContacts()
        })
    }

    $scope.edit = (id) => {

        $http.get('contact.php?id=' + id).then((response) => {
            $scope.name = response.data.name
            $scope.phone = response.data.phone
            $scope.editId = response.data.id
        }).finally(() => {
        })
    }

    this.$onInit = () => {
        $scope.getContacts()
    }

    $scope.reset = () => {
        $scope.name = null
        $scope.phone = null
        $scope.editId = null
    }
})
import * as bootstrap from 'bootstrap'
import 'angular'
import 'angular-route'
import 'angular-sanitize'
import moment from 'moment'
import { handleError } from './utils'

moment.locale('vi', {
    months: 'tháng 1_tháng 2_tháng 3_tháng 4_tháng 5_tháng 6_tháng 7_tháng 8_tháng 9_tháng 10_tháng 11_tháng 12'.split(
        '_'
    ),
    monthsShort:
        'Thg 01_Thg 02_Thg 03_Thg 04_Thg 05_Thg 06_Thg 07_Thg 08_Thg 09_Thg 10_Thg 11_Thg 12'.split(
            '_'
        ),
    monthsParseExact: true,
    weekdays: 'chủ nhật_thứ hai_thứ ba_thứ tư_thứ năm_thứ sáu_thứ bảy'.split(
        '_'
    ),
    weekdaysShort: 'CN_T2_T3_T4_T5_T6_T7'.split('_'),
    weekdaysMin: 'CN_T2_T3_T4_T5_T6_T7'.split('_'),
    weekdaysParseExact: true,
    meridiemParse: /sa|ch/i,
    isPM: function (input) {
        return /^ch$/i.test(input)
    },
    meridiem: function (hours, minutes, isLower) {
        if (hours < 12) {
            return isLower ? 'sa' : 'SA'
        } else {
            return isLower ? 'ch' : 'CH'
        }
    },
    longDateFormat: {
        LT: 'HH:mm',
        LTS: 'HH:mm:ss',
        L: 'DD/MM/YYYY',
        LL: 'D MMMM [năm] YYYY',
        LLL: 'D MMMM [năm] YYYY HH:mm',
        LLLL: 'dddd, D MMMM [năm] YYYY HH:mm',
        l: 'DD/M/YYYY',
        ll: 'D MMM YYYY',
        lll: 'D MMM YYYY HH:mm',
        llll: 'ddd, D MMM YYYY HH:mm',
    },
    calendar: {
        sameDay: '[Hôm nay lúc] LT',
        nextDay: '[Ngày mai lúc] LT',
        nextWeek: 'dddd [tuần tới lúc] LT',
        lastDay: '[Hôm qua lúc] LT',
        lastWeek: 'dddd [tuần trước lúc] LT',
        sameElse: 'L',
    },
    relativeTime: {
        future: '%s tới',
        past: '%s trước',
        s: 'vài giây',
        ss: '%d giây',
        m: 'một phút',
        mm: '%d phút',
        h: 'một giờ',
        hh: '%d giờ',
        d: 'một ngày',
        dd: '%d ngày',
        w: 'một tuần',
        ww: '%d tuần',
        M: 'một tháng',
        MM: '%d tháng',
        y: 'một năm',
        yy: '%d năm',
    },
    dayOfMonthOrdinalParse: /\d{1,2}/,
    ordinal: function (number) {
        return number
    },
    week: {
        dow: 1,
        doy: 4,
    },
})

const app = angular.module('app', ['ngRoute', 'ngSanitize'])

app.config(function ($interpolateProvider, $routeProvider) {
    $interpolateProvider.startSymbol('%')
    $interpolateProvider.endSymbol('%')

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
        .when('/u/:id', {
            templateUrl: 'profile.html',
            controller: 'ProfileController',
        })
})

app.filter('since', function () {
    return function (datetime) {
        return moment(datetime).fromNow()
    }
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

app.controller('StartDiscussionController', function ($scope, $http, $location) {
    $scope.title = ''
    $scope.content = ''
    $scope.autoAnswer = true
    $scope.loading = false

    const modal = new bootstrap.Modal('#startDiscussionModal')

    $scope.start = () => {
        $scope.loading = true

        $http
            .post('api/discussions', {
                title: $scope.title,
                content: $scope.content,
                auto_answer: $scope.autoAnswer,
            })
            .then((response) => {
                modal.hide()

                const { id } = response.data

                $scope.loading = false

                $location.path('/d/' + id)
            }, function (error) {
                handleError(error)
            })
    }
})

app.controller('ReplyDiscussionController', function ($scope, $rootScope, $http, $anchorScroll, $location) {
    $scope.content = ''

    const modal = new bootstrap.Modal('#replyDiscussionModal')

    $scope.reply = () => {
        $http.post('api/discussions/' + $scope.discussion.id + '/reply', {
            content: $scope.content,
        }).then((response) => {
            $scope.content = ''

            modal.hide()

            $rootScope.discussion = response.data

            const lastPost = response.data.posts[response.data.posts.length - 1]
            $location.hash('post-' + lastPost.id)
            $anchorScroll()
        }).catch((error) => {
            handleError(error)
        })
    }
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
            .then(() => {
                window.location.href = '/'
            }, function (error) {
                handleError(error)
            })
    }
})

app.controller('RegisterController', function ($scope) {
    $scope.name = ''
    $scope.email = ''
    $scope.password = ''
    $scope.password_confirmation = ''
})

app.controller('DiscussionController', function ($rootScope, $http, $routeParams) {
    $rootScope.discussion = {}

    $http
        .get('api/discussions/' + $routeParams.id)
        .then((response) => ($rootScope.discussion = response.data))
})

app.controller('ProfileController', function ($scope, $http, $routeParams) {
    $scope.user = {}

    $http.get('api/users/' + $routeParams.id).then((response) => ($scope.user = response.data))
})

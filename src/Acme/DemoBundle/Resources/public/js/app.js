(function (window, angular) {
    'use strict';

    angular.module('App', [])

    angular.module('App').config(['$interpolateProvider', '$httpProvider', function ($interpolateProvider, $httpProvider) {
        // change default characters for interpolateion
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

})(window, angular);
(function (window, angular) {
    'use strict';

    angular.module('App').controller('DemoController', [
        '$scope', '$contacts',
        function ($scope, $contacts)
        {
            $scope.contactsLoaded = false;
            $scope.contacts;
            $scope.contactsError;


            $scope.findAllContacts = function()
            {
                $scope.contactsLoaded = false;
                $scope.contacts = [];

                $contacts.findAll().then(findAllContactsSuccess, findAllContactsFailure);

                function findAllContactsSuccess(contacts)
                {
                    $scope.contacts = contacts;
                    $scope.contactsLoaded = true;
                }

                function findAllContactsFailure(reason)
                {
                    $scope.contactsError = reason;
                    $scope.contactsLoaded = true;
                }
            };

            $scope.addNewContact = function ()
            {
                $('.modal').first().modal('show');
            }

            $scope.findAllContacts();
        }
    ]);

})(window, angular);
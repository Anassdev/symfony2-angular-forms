(function (window, angular) {
    'use strict';

    angular.module('App').controller('DemoController', [
        '$scope', '$contacts',
        function ($scope, $contacts)
        {
            $scope.contactsLoaded = false;
            $scope.contacts = null;
            $scope.contactsError = null;


            /**
             * Find all existing contacts
             */
            $scope.findAllContacts = function()
            {
                $scope.contactsLoaded = false;
                $scope.contacts = [];

                $contacts.findAll().then(findAllContactsSuccess, findAllContactsFailure);

                function findAllContactsSuccess(contacts)
                {
                    console.log(contacts);
                    $scope.contacts = contacts;
                    $scope.contactsLoaded = true;
                }

                function findAllContactsFailure(reason)
                {
                    $scope.contactsError = reason;
                    $scope.contactsLoaded = true;
                }
            };

            /**
             * Show modal for creating new contact
             */
            $scope.addNewContact = function ()
            {
                $scope.contact = new Contact();
                $('.modal').first().modal('show');
            }

            /**
             * Show modal for updating existing contact
             * @param Contact contact
             */
            $scope.updateContact = function (contact)
            {
                $scope.contact = angular.copy(contact);
                $('.modal').first().modal('show');
            }

            // reset
            $scope.cancelCreateContact = function ()
            {
                $scope.contact = null;
                $scope.contactForm.$setPristine();
                $('.modal').first().modal('hide');
            };

            $scope.submitCreateContact = function ()
            {
                if ($scope.contactForm.$valid) {
                    $contacts.create($scope.contact, $scope.contactForm._token).then(contactCreated, contactNotCreated);
                }

                function contactCreated()
                {
                    $scope.contact = null;
                    $scope.contactForm.$setPristine();
                    $('.modal').first().modal('hide');
                    $scope.findAllContacts();
                }

                function contactNotCreated(errors)
                {
                    // set error on form
                    angular.forEach(errors, function (errors, field) {
                        $scope.contactForm[field].$invalid = true;
                        angular.forEach(errors, function (error, key) {
                            $scope.contactForm[field].$error[error] = true;
                        });
                    });
                }
            }

            $scope.submitUpdateContact = function ()
            {
                if ($scope.contactForm.$valid) {
                    $contacts.update($scope.contact, $scope.contactForm._token).then(contactUpdated, contactNotUpdated);
                }

                function contactUpdated()
                {
                    $scope.contact = null;
                    $scope.contactForm.$setPristine();
                    $('.modal').first().modal('hide');
                    $scope.findAllContacts();
                }

                function contactNotUpdated(errors)
                {
                    // set error on form
                    angular.forEach(errors, function (errors, field) {
                        $scope.contactForm[field].$invalid = true;
                        angular.forEach(errors, function (error, key) {
                            $scope.contactForm[field].$error[error] = true;
                        });
                    });
                }
            }

            $scope.findAllContacts();
        }
    ]);

})(window, angular);
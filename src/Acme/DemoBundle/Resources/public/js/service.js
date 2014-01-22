(function (window, angular) {
    'use strict';

    angular.module('App').service('$contacts', [
        '$http', '$q',
        function ($http, $q)
        {
            var contactsDefer;

            /**
             * Fetch contacts on server or from promise
             * @returns {promise}
             */
            function fetch ()
            {
                if (!contactsDefer) {
                    contactsDefer = $q.defer();
                    $http.get('/contacts') // hardcoded url
                        .success(contactsLoadSuccess)
                        .error(contactsLoadError);
                }

                /**
                 * Callback called when http request was successful
                 * @param response
                 */
                function contactsLoadSuccess(response)
                {
                    var contacts = [];

                    angular.forEach(response.data, function (value, key) {
                        contacts.push(new Contact(value));
                    });

                    contactsDefer.resolve(contacts);
                }

                /**
                 * Callback to be called when the http request failed
                 * @param response
                 */
                function contactsLoadError(response)
                {
                    contactsDefer.reject('Could not load the contacts from the server');
                }

                return contactsDefer.promise;
            }


            /**
             * Find all contacts
             * @return {promise}
             */
            function findAll()
            {
                var findAllDefer = $q.defer();

                fetch().then(fetchSuccess, fetchFailure);

                /**
                 * Callback called when fetching contacts was successful
                 * @param contacts
                 */
                function fetchSuccess(contacts)
                {
                    findAllDefer.resolve(contacts);
                }

                /**
                 * Callback called when fetching the contacts failed
                 * @param reason
                 */
                function fetchFailure(reason)
                {
                    findAllDefer.reject('Could not find all contacts: ' + reason);
                }

                return findAllDefer.promise;
            }

            return {
                findAll: findAll
            }
        }
    ]);

})(window, angular);
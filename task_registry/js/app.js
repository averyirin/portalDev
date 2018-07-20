(function () {
    'use strict';

    angular
            .module('portal', [
                'ngResource',
                'ngRoute',
                'ngFileUpload',
                'ngMessages',
                'ngAnimate',
                'datatables',
                'ui.slider',
                'ui.bootstrap',
            ]);

    angular
            .module('portal')
            .config(function ($routeProvider) {
                $routeProvider.when('/tasks', {
                    templateUrl: 'tasks/list',
                    controller: 'Tasks as vm',
                    resolve: {
                        resolveTask: function () {
                            return {};
                        }
                    }
                }).
                        when('/tasks/create', {
                            templateUrl: 'tasks/add',
                            controller: 'Tasks as vm',
                            resolve: {
                                resolveTask: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/tasks/view/:task_id', {
                            templateUrl: function (params) {
                                return 'tasks/view/' + params.task_id;
                            },
                            controller: 'Tasks as vm',
                            resolve: {
                                resolveTask: function (task, $route) {
                                    var paramObject = new Object();

                                    return task.getTask(paramObject, $route.current.params.task_id);
                                }
                            }
                        }).
                        when('/tasks/edit/:task_id', {
                            templateUrl: function (params) {
                                return 'tasks/edit/' + params.task_id;
                            },
                            controller: 'Tasks as vm',
                            resolve: {
                                resolveTask: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/tasks/delete/:task_id', {
                            templateUrl: function (params) {
                                return 'tasks/delete/' + params.task_id;
                            },
                            controller: 'Tasks as vm',
                            resolve: {
                                resolveTask: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/tasks/create_admin', {
                            templateUrl: 'tasks/add_admin',
                            controller: 'UsersCtrl as vm',
                            resolve: {
                                users: function (user) {
                                    return user.getUsers();
                                },
                                resolveTask: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/tasks/manage_admins', {
                            templateUrl: 'tasks/manage_admins',
                            controller: 'UsersCtrl as vm',
                            resolve: {
                                users: function (user) {
                                    return user.getAllUsers();
                                },
                                resolveTask: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/tasks/dashboard', {
                            templateUrl: 'tasks/dashboard',
                            controller: 'TasksDashboard as vm',
                            resolve: {
                                tasks: function (task) {
                                    return task.getTasks().then(function (results) {
                                        return results.data;
                                    }, function (results) {
                                        console.log(results);
                                    });
                                }
                            }
                        }).
                        otherwise({
                            redirectTo: '/tasks'
                        });
            });

    angular.module('portal').run(function ($rootScope, user) {
        $rootScope.isLoading = false;
        $rootScope.successMessage = false;
        $rootScope.message = '';

        var publicKey = localStorage.getItem('publicKey');
        if (!publicKey) {
            publicKey = elgg.get_logged_in_user_guid();
        }

        user.getUser(publicKey).then(function (result) {
            $rootScope.user = result.data.user;
        }, function (error) {
            console.log(error);
        });
    });
})();

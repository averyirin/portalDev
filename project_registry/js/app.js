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
                $routeProvider.when('/projects', {
                    templateUrl: 'projects/list',
                    controller: 'Projects as vm',
                    resolve: {
                        resolveProject: function () {
                            return {};
                        }
                    }
                }).
                when('/projects/list_task', {
                    templateUrl: 'projects/list_task',
                    controller: 'Projects as vm',
                    resolve: {
                        resolveProject: function () {
                            return {};
                        }
                    }
                }).
                        when('/projects/create', {
                            templateUrl: 'projects/add',
                            controller: 'Projects as vm',
                            resolve: {
                                resolveProject: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/projects/request_support', {
                            templateUrl: 'projects/request_support',
                            controller: '',
                            resolve: {
                            }
                        }).
                        when('/projects/create_task', {
                          templateUrl: 'projects/create_task',
                          controller: 'Projects as vm',
                          resolve: {
                              resolveProject: function () {
                                  return {};
                              }
                          }
                        }).
                        when('/projects/view/:project_id', {
                            templateUrl: function (params) {
                                return 'projects/view/' + params.project_id;
                            },
                            controller: 'Projects as vm',
                            resolve: {
                                resolveProject: function (project, $route) {
                                    var paramObject = new Object();

                                    return project.getProject(paramObject, $route.current.params.project_id);
                                }
                            }
                        }).
                        when('/projects/view_task/:project_id', {
                            templateUrl: function (params) {
                                return 'projects/view_task/' + params.project_id;
                            },
                            controller: 'Projects as vm',
                            resolve: {
                                resolveProject: function (project, $route) {
                                    var paramObject = new Object();

                                    return project.getProject(paramObject, $route.current.params.project_id);
                                }
                            }
                        }).
                        when('/projects/edit/:project_id', {
                            templateUrl: function (params) {
                                return 'projects/edit/' + params.project_id;
                            },
                            controller: 'Projects as vm',
                            resolve: {
                                resolveProject: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/projects/delete/:project_id', {
                            templateUrl: function (params) {
                                return 'projects/delete/' + params.project_id;
                            },
                            controller: 'Projects as vm',
                            resolve: {
                                resolveProject: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/projects/create_admin', {
                            templateUrl: 'projects/add_admin',
                            controller: 'UsersCtrl as vm',
                            resolve: {
                                users: function (user) {
                                    return user.getUsers();
                                },
                                resolveProject: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/projects/manage_admins', {
                            templateUrl: 'projects/manage_admins',
                            controller: 'UsersCtrl as vm',
                            resolve: {
                                users: function (user) {
                                    return user.getAllUsers();
                                },
                                resolveProject: function () {
                                    return {};
                                }
                            }
                        }).
                        when('/projects/dashboard', {
                            templateUrl: 'projects/dashboard',
                            controller: 'ProjectsDashboard as vm',
                            resolve: {
                                projects: function (project) {
                                    return project.getProjects().then(function (results) {
                                        return results.data;
                                    }, function (results) {
                                        console.log(results);
                                    });
                                }
                            }
                        }).
                        otherwise({
                            redirectTo: '/projects'
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

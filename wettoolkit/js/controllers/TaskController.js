(function () {
    'use strict';

    angular
            .module('portal')
            .controller('Tasks', Tasks);

    function Tasks(resolveTask, task, user, notification, $location, Upload, $routeParams, $rootScope, helper, DTOptionsBuilder, $q, $sce) {
        tinyMCE.remove();

        var vm = this;
        vm.tasks = [];
        vm.task = resolveTask;
        vm.opis = [{}];
        //filter object
        vm.filters = {owner_guid: '', status: '', task_type: '', department_owner: ''};
        vm.filters.owner_guid = vm.filters.status = vm.filters.task_type = vm.filters.department_owner = elgg.echo('tasks:label:all');

        //JSON arrays for select dropdowns - this SHOULD be all retreived from a service or directive
        vm.statuses = [
            {name: elgg.echo('tasks:label:submitted'), id: elgg.echo('tasks:label:submitted')},
            {name: elgg.echo('tasks:label:underreview'), id: elgg.echo('tasks:label:underreview')},
            {name: elgg.echo('tasks:label:inprogress'), id: elgg.echo('tasks:label:inprogress')},
            {name: elgg.echo('tasks:label:completed'), id: elgg.echo('tasks:label:completed')}
        ];

        vm.ta_options = {
            "values": [
                elgg.echo('tasks:pleaseselect'),
                elgg.echo('tasks:ta:air_force'),
                elgg.echo('tasks:ta:army'),
                elgg.echo('tasks:ta:mpc'),
                elgg.echo('tasks:ta:navy')
            ]
        };

        vm.taskTypes = {
            "values": [
                elgg.echo('tasks:types:courseware'),
                elgg.echo('tasks:types:enterprise_apps'),
                elgg.echo('tasks:types:instructor_support'),
                elgg.echo('tasks:types:learning_application'),
                elgg.echo('tasks:types:learning_technologies'),
                elgg.echo('tasks:types:mobile'),
                elgg.echo('tasks:types:modelling'),
                elgg.echo('tasks:types:rnd'),
                elgg.echo('tasks:types:gaming'),
                elgg.echo('tasks:types:support')
            ]
        };

        vm.booleanOptions = {
            "values": [
                elgg.echo('tasks:no'),
                elgg.echo('tasks:yes')
            ]
        };

        vm.multiOptions = {
            "values": [
                elgg.echo('tasks:no'),
                elgg.echo('tasks:update'),
                elgg.echo('tasks:change')
            ]
        };

        vm.department_options = {
            "values": [
                //elgg.echo('tasks:unassigned'),
                //elgg.echo('tasks:owner:learning_technologies'),
                elgg.echo('tasks:owner:lsc'),
                elgg.echo('tasks:owner:alsc'),
                //elgg.echo('tasks:owner:modernization'),
                //elgg.echo('tasks:owner:programmes'),
                //elgg.echo('tasks:owner:lt_lsc')
            ]
        };

        vm.classification_options = {
            "values": [
                elgg.echo('tasks:unassigned'),
                elgg.echo('tasks:task'),
                elgg.echo('tasks:task')
            ]
        };

        //choices for the savings checkboxes
        vm.choices = {
            "tasks:savings:productivityIncrease": {"title": elgg.echo('tasks:savings:productivityIncrease')},
            "tasks:savings:reduction": {"title": elgg.echo('tasks:savings:reduction')},
            "tasks:savings:rationalization": {"title": elgg.echo('tasks:savings:rationalization')},
            "tasks:savings:qualitative": {"title": elgg.echo('tasks:savings:qualitative')}
        };

        //make datatable default sorting by the fourth column(time-submitted)
        vm.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [[3, 'desc']]);

        //get public key from the client
        var publicKey = localStorage.getItem('publicKey');

        //get single task
        if ($routeParams.task_id) {
            $(window).scrollTop(0);
            vm.loaded = false;
            vm.sme = {};
            vm.usa = {};
            vm.savings = {};

            //set default value for existing task from saved json data
            angular.forEach(vm.task, function (value, key) {
                vm[key] = value;
            });
            vm.task.description = $sce.trustAsHtml(vm.task.description);

            //create slider for percentage complete
            vm.slider = {
                'options': {
                    start: function (event, ui) {
                        $log.info('Event: Slider start - set with slider options', event);
                    },
                    stop: function (event, ui) {
                        $log.info('Event: Slider stop - set with slider options', event);
                    }
                }
            };

            vm.task.editable = [];
            vm.loaded = true;
        } else {
            getTasks();

            vm.task.ta = vm.ta_options.values[0];
            vm.task.task_type = vm.taskTypes.values[0];
            vm.task.is_sme_avail = vm.booleanOptions.values[0];
            vm.task.is_limitation = vm.booleanOptions.values[0];
            vm.task.update_existing_product = vm.multiOptions.values[0];
            vm.task.department_owner = vm.department_options.values[0];
            vm.task.classification = vm.classification_options.values[0];
        }

        /*
         * Helper Functions
         */

        function getTasks(params) {
            return $q(function (resolve, reject) {
                task.getTasks(params).then(function (results) {
                    vm.tasks = results.data;
                    resolve();
                }, function (error) {
                    reject(error);
                });
            });
        }

        function getTasksByStatus(value) {
            var params = {};
            params.status = value;
            return getTasks(params);
        }

        function getTasksByParam(params) {
            //no need to add filter query param if set to All
            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    if (params[key] == 'All' || params[key] == 'all' || params[key] == 'Toutes' || params[key] == 'toutes') {
                        delete params[key];
                    }
                }
            }
            return getTasks(params);
        }

        /*
         * scope functions
         */

        // Sets the department owner based on the unit selected in the add form
        vm.setDepartmentOwner = function (param) {
            if (param != elgg.echo('tasks:pleaseselect')) {
                var deptOwner = null;

                switch(param) {
                    case elgg.echo('tasks:ta:air_force'):
                        deptOwner = elgg.echo('tasks:owner:alsc');
                        break;
                    case elgg.echo('tasks:ta:army'):
                    case elgg.echo('tasks:ta:navy'):
                    case elgg.echo('tasks:ta:mpc'):
                        deptOwner = elgg.echo('tasks:owner:lsc');
                        break;
                }

                vm.task.department_owner = deptOwner;
            }
        }

        //create a task
        vm.createTask = function (isValid) {
            tinymce.triggerSave();

            setTimeout(function () {
                //assign description attribute to the html generated by the mce editor
                vm.task.description = $('body').find('#description').val();
                if (isValid) {
                    //display loading overlay
                    $rootScope.isLoading = true;

                    if (!vm.task.hasOwnProperty('savings')) {
                        vm.task.savings = {};
                    }
                    vm.task.opis = vm.opis;
                    vm.task.savings.choices = vm.choices;
                    vm.task.percentage = 0;
                    vm.task.status = 'Submitted';

                    task.create(vm.task).then(function (success) {
                        //upload attachments
                        Upload.upload({
                            url: 'api/tasks',
                            data: {files: vm.files, 'taskId': success.data.id, 'accessId': success.data.accessId, 'action': 'attachFile'}
                        }).then(function (success) {

                        }, function (error) {
                            console.log(error);
                        });

                        //notify task admins
                        var filter = {'task_admin': true};
                        filter.department_owner = vm.task.department_owner;

                        user.getUsers(filter).then(function (result) {
                            var subject = 'New Support Request';
                            var body = 'A new support request has been submitted by ' + $rootScope.user.name + '. You can view the new support request at ' + elgg.get_site_url() + 'tasks#/tasks/view/' + success.data.id;

                            angular.forEach(result.data, function (value, key) {
                                notification.create(subject, body, value.id).then(function (result) {

                                }, function (error) {
                                    console.log(error);
                                });
                            });
                        }, function (error) {
                            console.log(error);
                        });

                        getTasksByStatus('Submitted').then(function (success) {
                            $rootScope.isLoading = false;

                            $location.path('tasks');
                            $(window).scrollTop(0);
                        }, function (error) {
                            console.log(error);
                        });

                    }, function (error) {
                        $rootScope.isLoading = false;
                        console.log(error);
                    });
                }
            }, 500);
        }

        vm.deleteTask = function (id, index) {
            //display loading overlay
            $rootScope.isLoading = true;

            var paramObject = new Object();
            task.remove(paramObject, id).then(function (success) {
                //Instead of reload all the tasks, we just remove the corresponding task row from list
                //Cannot use 'delete vm.tasks[index];', it will crash the datatables
                $('#statusSelect' + index).closest('tr').remove();
                //remove loading overlay
                $rootScope.isLoading = false;
            }, function (error) {
                $rootScope.isLoading = false;
                console.log(error);
            });
        }

        vm.update = function (field) {
            tinyMCE.triggerSave();
            if (field == "description") {
                vm[field] = $('body').find('#description').val();
            } else if (field == "savings") {
                vm.savings.choices = vm.choices;
            }

            task.update({
                'field': field,
                'value': vm[field]
            }, vm.task.id).then(function (success) {
                if (field == 'description') {
                    vm.task[field] = $sce.trustAsHtml(vm[field]);
                } else {
                    vm.task[field] = vm[field];
                }
            }, function (error) {
                console.log(error);
            });
        }

        //partial update - status
        vm.updateStatus = function (index) {
            $('#statusSelect' + index).prop('disabled', 'disabled');

            task.update({
                'field': 'status',
                'value': vm.tasks[index].status
            }, vm.tasks[index].id).then(function (success) {
                $('#statusSelect' + index).prop('disabled', false);
            }, function (error) {
                console.log(error);
            });
        }

        //decide the boolean value of selected option box
        vm.boolOption = function (optionVal) {
            if (optionVal == 'Yes') {
                return true;
            } else {
                return false;
            }
        }

        vm.emptyObject = function (object, exclusion) {
            for (var prop in object) {
                if (object.hasOwnProperty(prop)) {
                    if (prop != exclusion) {
                        delete object[prop];
                    }
                }
            }
        }

        //add opi to stack
        vm.addContact = function () {
            vm.opis.push({});
        }

        //remove opi from stack
        vm.removeContact = function (index) {
            vm.opis.splice(index, 1);
        }

        vm.filter = function (event) {
            var filter = $(event.target).attr('id');
            var filterType = $(event.target).attr('data-filter-type');
            //Testing
            //console.log('filter = ' + filter);
            //console.log('type = ' + filterType);

            //toggle menu item highlighting
            if (filterType == 'owner_guid') {
                $("[id='" + filter + "'][data-filter-type=" + filterType + "]").parent().siblings('.active').removeClass('active');
                $("[id='" + filter + "'][data-filter-type=" + filterType + "]").parent().addClass('active');
                if (filter == 'mine') {
                    filter = $rootScope.user.id;
                }
            } else {
                $('.list-group-item.active[data-filter-type=' + filterType + ']').removeClass('active');
                $("[id='" + filter + "'][data-filter-type=" + filterType + "]").addClass('active');
            }

            //sort the tasks
            vm.filters[filterType] = filter;
            getTasksByParam(vm.filters).then(function (success) {

            }, function (error) {
                console.log(error);
            });
        }

        vm.toggleEditMode = function (event, i) {
            i = (typeof i === 'undefined') ? null : i;

            var value = event.target.attributes['data-id'].value;
            var element = $('.task').find("[data-field-id='" + event.target.attributes['data-id'].value + "']");

            if (element.hasClass('hidden')) {
                element.removeClass('hidden');
                $('a.edit-button.' + value).removeClass('hidden');

                //hide cancel and accept buttons
                if (value == 'opi') {
                    vm.task.editable[value] = {};
                    vm.task.editable[value][i] = false;
                } else {
                    vm.task.editable[value] = false;
                }
            } else {
                element.addClass('hidden');
                $('a.edit-button.' + value).addClass('hidden');

                //show cancel and accept buttons
                if (value == 'opi') {
                    vm.task.editable[value] = {};
                    vm.task.editable[value][i] = true;
                } else {
                    vm.task.editable[value] = true;
                }
            }
        }

        vm.toggleEditMode_variant = function (event) {
            var value = event.target.attributes['data-id'].value;
            vm.task.editable[value] ? vm.task.editable[value] = false : vm.task.editable[value] = true;
        }

        vm.animateToField = function (event) {
            var name = event.target.attributes['data-list-id'].value;
            var top = $("[data-row-id='" + name + "']").offset().top;
            $('html, body').animate({
                scrollTop: top
            }, 500);
        }

        vm.printAll = function (opMandate) {
            var tasks = vm.tasks.filter(function (el) {
                return (el.op_mandate === opMandate);
            });
            var printContents = '<h1>DRT 5.1 Tasks</h1>';

            for (var i = 0; i < tasks.length; i++) {
                var task = tasks[i];

                try {
                    task.opis = JSON.parse(task.opis);
                    task.sme = JSON.parse(task.sme);
                    task.usa = JSON.parse(task.usa);
                    task.savings = JSON.parse(task.savings);
                } catch (e) {
                    console.log(e);
                }

                printContents += "<h2 style='margin-top: 2.25rem; padding-bottom:1rem; border-bottom: 1px solid grey; font-weight:bold;'>Task #" + (parseInt(i) + 1) + "</h2>";
                printContents += getPrintContent(task);
            }

            var popupWin = window.open('', '_blank', 'scrollbars=1,resizable=1,width=1024,height=778');
            popupWin.document.open();
            popupWin.document.write('<html><head><style>body{font-family:sans-serif; margin: 2.25rem;} p{margin:.667rem 0 2.25rem; white-space: pre-wrap;}</style></head><body onload="window.print()">' + printContents + '</body></html>');
            popupWin.document.close();
        }

        function getPrintContent(task) {
            var fields = ['title', 'department_owner', 'status', 'course', 'org', 'ta', 'task_type', 'description', 'scope', 'opis',
                'op_mandate', 'priority', 'is_limitation', 'update_existing_product', 'life_expectancy', 'usa',
                'comments', 'investment', 'risk', 'timeline', 'impact', 'savings'];
            var printContents = '';

            for (var i = 0; i < fields.length; i++) {
                var object = task[fields[i]];
                var value = '';
                if (object) {
                    if (fields[i] == 'opis') {
                        for (var index in task[fields[i]]) {
                            value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:opi:title') + " " + (parseInt(index) + 1) + "</h4>";
                            value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:rank') + ":</label> " + object[index].rank + "<br/>";
                            value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:name') + ":</label> " + object[index].name + "<br/>";
                            value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:phone') + ":</label> " + object[index].phone + "<br/>";
                            value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:email') + ":</label> " + object[index].email + "<br/>";
                        }
                    } else if (fields[i] == 'usa') {
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:rank') + ":</label> " + object.rank + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:name') + ":</label> " + object.name + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:position') + ":</label> " + object.position + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:email') + ":</label> " + object.email + "<br/>";
                    } else if (fields[i] == 'savings') {
                        value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:savings:label') + "</h4>";

                        for (var index in object.choices) {
                            var choice = object.choices[index];
                            if (choice.selected) {
                                value += "<p>" + choice.title + "</p>";
                            }
                        }

                        value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:savings:substantiation') + "</h4>";
                        value += "<p>" + object.substantiation + "</p>";
                    } else {
                        object ? value = object : value = '&nbsp;';
                    }
                }

                printContents += '<div>';
                printContents += '<label style="font-size:1.5rem; font-weight:bold;">' + elgg.echo('tasks:' + fields[i]) + '</label>';
                printContents += '<p>' + value + '</p>';
                printContents += "</div>";
            }

            return printContents;
        }

        vm.print = function () {
            var fields = ['title', 'department_owner', 'status', 'course', 'org', 'ta', 'task_type', 'description', 'scope', 'opis',
                'op_mandate', 'priority', 'is_limitation', 'update_existing_product', 'life_expectancy', 'usa',
                'comments', 'investment', 'risk', 'timeline', 'impact', 'savings'];
            var printContents = '<h1>DRT 5.1 Task</h1>';

            for (var i = 0; i < fields.length; i++) {
                var object = vm.task[fields[i]];
                var value = '';

                if (fields[i] == 'opis') {
                    for (var index in vm.task[fields[i]]) {
                        value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:opi:title') + " " + (parseInt(index) + 1) + "</h4>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:rank') + ":</label> " + object[index].rank + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:name') + ":</label> " + object[index].name + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:phone') + ":</label> " + object[index].phone + "<br/>";
                        value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:email') + ":</label> " + object[index].email + "<br/>";
                    }
                } else if (fields[i] == 'usa') {
                    value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:rank') + ":</label> " + object.rank + "<br/>";
                    value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:name') + ":</label> " + object.name + "<br/>";
                    value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:position') + ":</label> " + object.position + "<br/>";
                    value += "<label style='font-weight:bold;'>" + elgg.echo('tasks:email') + ":</label> " + object.email + "<br/>";
                } else if (fields[i] == 'savings') {
                    value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:savings:label') + "</h4>";

                    for (var index in object.choices) {
                        var choice = object.choices[index];
                        if (choice.selected) {
                            value += "<p>" + choice.title + "</p>";
                        }
                    }

                    value += "<h4 style='font-weight:bold;'>" + elgg.echo('tasks:savings:substantiation') + "</h4>";
                    value += "<p>" + object.substantiation + "</p>";
                } else {
                    object ? value = object : value = '&nbsp;';
                }

                printContents += '<div>';
                printContents += '<label style="font-size:1.5rem; font-weight:bold;">' + elgg.echo('tasks:' + fields[i]) + '</label>';
                printContents += '<p>' + value + '</p>';
                printContents += "</div>";
            }

            var popupWin = window.open('', '_blank', 'scrollbars=1,resizable=1,width=1024,height=778');
            popupWin.document.open();
            popupWin.document.write('<html><head><style>body{font-family:sans-serif; margin: 2.25rem;} p{margin:.667rem 0 2.25rem; white-space: pre-wrap;}</style></head><body onload="window.print()">' + printContents + '</body></html>');
            popupWin.document.close();
        }
    }

})();

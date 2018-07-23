(function(){
	'use strict';

	angular
		.module('portal')
		.controller('SupportRequestCtrl', SupportRequest);

		function SupportRequest(projects, $rootScope) {

            var vm = this;

            /**
             * Initialization function
             *
             */
            var init = function()
            {
                vm.hello = "Hello World";
            };

            init();

            /**
             * Toggle the 'active' class on filter tab <li> eleements
             *
             */
            vm.toggleFilterTab = function(event)
            {
                var domElement = event.target;

                //remove old active element and add class to clicked element
                $(domElement).closest('ul').find('li.active').removeClass('active');
                $(domElement).parent().addClass('active');
            }


        }
})();

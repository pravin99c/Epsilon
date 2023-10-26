"use strict";

// Class definition
var KTModalCustomersAdd = function () {
    var submitButton;
    var validator;
    var form;

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    'name': {
						validators: {
							notEmpty: {
								message: 'Role name is required'
							},
                            regexp: {
                                regexp: /^[a-zA-Z ]*$/,
                                message: 'The Role name can only consist of alphabetical and spaces'
                            },
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		);

        // Action buttons
		submitButton.addEventListener('click', function (e) {
            // Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {
					if (status != 'Valid') {
                        e.preventDefault();
						Swal.fire({
							text: "Please enter a valid role name",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-primary"
							}
						});
					}
				});
			}
		});

    }

    return {
        // Public functions
        init: function () {
            // Elements
            form = document.querySelector('#role_and_permission');
            submitButton = form.querySelector('#btn_role_and_permission');
            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	KTModalCustomersAdd.init();
});

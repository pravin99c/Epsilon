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
                    'first_name': {
						validators: {
							notEmpty: {
								message: 'First name is required'
							},
                            regexp: {
                                regexp: /^[a-zA-Z ]*$/,
                                message: 'The Role name can only consist of alphabetical and spaces'
                            },
						}
					},
                    'last_name': {
						validators: {
							notEmpty: {
								message: 'Last name is required'
							},
                            regexp: {
                                regexp: /^[a-zA-Z ]*$/,
                                message: 'The Role name can only consist of alphabetical and spaces'
                            },
						}
					},
                    'email': {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            regexp: {
                                regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                                message: 'Enter a valid email address'
                            },
						}
					},
                    'password': {
						validators: {
							notEmpty: {
								message: 'Password is required'
							},
						}
					},
                    'password_confirmation': {
						validators: {
							notEmpty: {
								message: 'Password confirm is required'
							},
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            },
						},
					},
                    'phone_number' : {
                        validators: {
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Phone number must contain only numbers'
                            },
                            stringLength: {
                                max: 10,
                                message: 'Phone number must not exceed 10 digits'
                            }
                        },
                    },
                    'role' : {
                        validators: {
                            notEmpty: {
								message: 'Role select is required'
							},
                        },
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
            form = document.querySelector('#users_add_form');
            submitButton = form.querySelector('#users_submit_btn');
            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	KTModalCustomersAdd.init();
});

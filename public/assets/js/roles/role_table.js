$( document ).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var rolesTable = $('#roles_table').DataTable( {
        responsive: true,
        searchDelay: 200,
        processing: true,
        serverSide: true,
        order: [1, 'asc'],
        ajax: {
            url: '/roles',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        },
        columns:[
            {
                data: 'id',
                class: "text-center ",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data:'name', class: "text-center ls-1" },
            { data: 'created_at',
                autoHide: false,
                orderable:false,
                class: "text-center ls-1",
                "render": function ( row, type, set) {
                    let dateString_ = moment(row.created_at).format("DD MMM YYYY");
                    return dateString_
                }},
            {
                data:'id',
                sortable: false,
                autoHide: false,
                orderable:false,
                class: "text-center ls-1",
                "render": function (id, row, type, set) {
                    var permission = document.querySelector('input[name="userPermission"]').value;;
                    var viewButton =`<a href="/roles/view/${type.role_id}" class="btn btn-icon btn-custom btn-light btn-sm btn-active-light btn-active-color-primary">
                            <span class="svg-icon svg-icon-3 svg-icon-md-2" title="View"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="currentColor"></path>
                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="currentColor" opacity="0.3"></path>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </a>`;
                    var editButton = `<a href="/roles/edit/${type.role_id}" class="btn btn-icon btn-custom btn-light btn-sm btn-active-light btn-active-color-primary mx-3">
                            <span class="svg-icon svg-icon-3 svg-icon-md-2" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="currentColor" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"></path>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </a>`;
                    var deleteButton = `<a href="javascript:void(0);" class="btn btn-icon btn-custom btn-light btn-sm btn-active-light btn-active-color-primary" id="roleDeleteButton" data-id="${type.role_id}">
                        <span class="svg-icon svg-icon-3 svg-icon-md-2" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="currentColor" fill-rule="nonzero"></path>
                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="currentColor" opacity="0.3"></path>
                            </g>
                            </svg><!--end::Svg Icon-->
                        </span>
                        </a>
                    `

                    if (permission === '11'){
                        var html = viewButton + editButton + deleteButton;
                    }
                    else if (permission === '01'){
                        var html = viewButton + deleteButton;
                    }
                    else if (permission === '10'){
                        var html = viewButton + editButton;
                    } else {
                        var html = viewButton
                    }
                    return html;
                }
            }
        ]
    });
    const filterSearch = document.querySelector('[data-kt-customer-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        rolesTable.search("",false).draw();
        rolesTable.search(e.target.value).draw();
    });

    // Private functions
    const handleDeleteButton = () => {
        // Select form
        const deleteButton = document.getElementById('roleDeleteButton');

        if (!deleteButton) {
            return;
        }

        deleteButton.addEventListener('click', e => {
            // Prevent default button action
            e.preventDefault();

            // Show popup confirmation
            Swal.fire({
                text: "Delete contact confirmation",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        text: "Contact has been deleted!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            // Redirect to customers list page
                            window.location = deleteButton.getAttribute("data-kt-redirect");
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Contact has not been deleted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    handleDeleteButton();
});

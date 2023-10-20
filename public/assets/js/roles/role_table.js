
$( document ).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('#roles_table').DataTable( {
        serverSide: true,
        ajax: {
            url: '/roles',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        }
    });
});

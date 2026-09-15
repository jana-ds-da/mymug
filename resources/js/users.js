import DataTable from 'datatables.net-bs5';

$(document).on('click', '.delete-this-user', function () {

    const url = $(this).data('url');

    if (!confirm('Are you sure you want to delete this user?')) {
        return;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'DELETE'
        },

        success: function (response) {

            $('#usersTable').DataTable().ajax.reload(null, false);

        },

        error: function (xhr) {

            console.log(xhr.status);
            console.log(xhr.responseText);

            alert('Something went wrong while deleting the user.');

        }
    });

});


const editUserForm = document.getElementById('editUserForm');

if (editUserForm) {

    editUserForm.addEventListener('submit', function (event) {

        event.preventDefault();

        const formData = new FormData(editUserForm);

        fetch(editUserForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),

                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {

            if (!response.ok) {
                throw new Error('Request failed');
            }

            return response.json();
        })
        .then(data => {

            alert(data.message);

            window.location.href = '/users';

        })
        .catch(error => {

            console.error(error);

            alert('Something went wrong while editing the user.');

        });
    });
}
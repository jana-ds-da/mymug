document.addEventListener('click', function (event) {

    const deleteButton = event.target.closest('.delete-this-role');

    if (!deleteButton) {
        return;
    }

    const deleteUrl = deleteButton.dataset.url;

    if (!confirm('Are you sure you want to delete this role?')) {
        return;
    }

    fetch(deleteUrl, {
        method: 'DELETE',

        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),

            'Accept': 'application/json'
        }
    })

    .then(response => {

        if (!response.ok) {
            throw new Error('Delete request failed.');
        }

        return response.json();
    })

    .then(data => {

        alert(data.message);

        $('#rolesTable')
            .DataTable()
            .ajax
            .reload(null, false);

    })

    .catch(error => {

        console.error(error);

        alert('Something went wrong while deleting the role.');

    });

});

const editRoleForm = document.getElementById('editRoleForm');

if (editRoleForm) {

    editRoleForm.addEventListener('submit', function (event) {

        event.preventDefault();

        const formData = new FormData(editRoleForm);

        fetch(editRoleForm.action, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),

                'Accept': 'text/html'
            },

            body: formData

        })

        .then(response => {

            if (!response.ok) {
                throw new Error('Update request failed.');
            }


            window.location.href = '/roles';

        })

        .catch(error => {

            console.error(error);

            alert('Something went wrong while updating the role.');

        });

    });

}
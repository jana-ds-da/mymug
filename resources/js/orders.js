const orderMessages = {
    updated: document.querySelector('#order-messages')?.dataset.updated,
    deleted: document.querySelector('#order-messages')?.dataset.deleted,
    error: document.querySelector('#order-messages')?.dataset.error,
    confirmDelete: document.querySelector('#order-messages')?.dataset.confirmDelete
};


document.querySelectorAll('.order-status').forEach(select => {

    select.addEventListener('change', function () {

        const orderId = this.dataset.orderId;
        const status = this.value;

        fetch(`/orders/${orderId}/status`, {

            method: 'PATCH',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            },

            body: JSON.stringify({
                status: status
            })

        })

        .then(response => response.json())

        .then(data => {

            if (data.success) {
                alert(data.message);
            } else {
                alert(orderMessages.error);
            }

        })

        .catch(() => {
            alert(orderMessages.error);
        });

        updateOrderStats();

    });

});



document.querySelectorAll('.delete-order').forEach(button => {

    button.addEventListener('click', function () {

        if (!confirm(orderMessages.confirmDelete)) {
            return;
        }

        const orderId = this.dataset.orderId;

        fetch(`/orders/${orderId}`, {

            method: 'DELETE',

            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }

        })

        .then(response => response.json())

        .then(data => {

            if (data.success) {

                document
                    .getElementById(`order-row-${orderId}`)
                    .remove();

                alert(data.message);

            } else {

                alert(orderMessages.error);

            }

        })

        .catch(() => {
            alert(orderMessages.error);
        });

    });

});


function updateOrderStats() {
    const statuses = Array.from(
        document.querySelectorAll('.order-status')
    ).map(select => select.value);

    document.getElementById('all-orders-count').textContent =
        statuses.length;

    document.getElementById('pending-orders-count').textContent =
        statuses.filter(status => status === 'pending').length;

    document.getElementById('preparing-orders-count').textContent =
        statuses.filter(status => status === 'preparing').length;

    document.getElementById('delivered-orders-count').textContent =
        statuses.filter(status => status === 'delivered').length;
}
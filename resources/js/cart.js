document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');


    

    document.querySelectorAll('.qty-selector').forEach(selector => {

        const cartItemId = selector.dataset.id;

        const decreaseBtn = selector.querySelector('.qty-decrease');
        const increaseBtn = selector.querySelector('.qty-increase');
        const quantityElement = selector.querySelector('.qty-value');

        const cartItem = document.querySelector(
            `.cart-item[data-item-id="${cartItemId}"]`
        );

        const priceElement = cartItem.querySelector('.item-price');


        
        increaseBtn.addEventListener('click', function () {

            changeQuantity(cartItemId, 'increase');
        });


        
        decreaseBtn.addEventListener('click', function () {

            changeQuantity(cartItemId, 'decrease');
        });


        function changeQuantity(id, action) {

            fetch(`/cart/${id}/${action}`, {

                method: 'PATCH',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }

            })

            .then(response => response.json())

            .then(data => {

               
                quantityElement.textContent = data.quantity;


                
                priceElement.textContent =
                    `${Number(data.item_total).toFixed(2)} EGP`;


                
                document.getElementById('subtotal-val').textContent =
                    `${Number(data.subtotal).toFixed(2)} EGP`;


                
                document.getElementById('total-val').textContent =
                    `${Number(data.total).toFixed(2)} EGP`;

            })

            .catch(error => {

                console.error(error);

                alert('Something went wrong. Please try again.');

            });
        }

    });




    document.querySelectorAll('.delete-btn').forEach(button => {

        button.addEventListener('click', function () {

            const cartItemId = this.dataset.id;

            const cartItem = document.querySelector(
                `.cart-item[data-item-id="${cartItemId}"]`
            );


            if (!confirm('Are you sure you want to remove this product?')) {
                return;
            }


            fetch(`/cart/${cartItemId}`, {

                method: 'DELETE',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }

            })

            .then(response => response.json())

            .then(data => {

                
                cartItem.remove();


                
                document.getElementById('subtotal-val').textContent =
                    `${Number(data.subtotal).toFixed(2)} EGP`;


                
                document.getElementById('total-val').textContent =
                    `${Number(data.total).toFixed(2)} EGP`;

            })

            .catch(error => {

                console.error(error);

                alert('Something went wrong. Please try again.');

            });

        });

    });

});
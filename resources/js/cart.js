
document.addEventListener('DOMContentLoaded', function () {

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

   
    function updateCartBadge() {
        const cartBadge = document.getElementById('cart-badge');

        if (!cartBadge) return;

        let currentCount = 0;

        document.querySelectorAll('.qty-selector .qty-value').forEach(element => {
            currentCount += Number(element.textContent) || 0;
        });

        cartBadge.textContent = currentCount;
        cartBadge.style.display = currentCount > 0 ? 'flex' : 'none';
    }

    function updateTotals(data) {
        const subtotalElement = document.getElementById('subtotal-val');
        const totalElement = document.getElementById('total-val');

        if (subtotalElement) {
            subtotalElement.textContent =
                `${Number(data.subtotal).toFixed(2)} EGP`;
        }

        if (totalElement) {
            totalElement.textContent =
                `${Number(data.total).toFixed(2)} EGP`;
        }
    }

    
    document.querySelectorAll('.qty-selector').forEach(selector => {

        const cartItemId = selector.dataset.id;
        const decreaseBtn = selector.querySelector('.qty-decrease');
        const increaseBtn = selector.querySelector('.qty-increase');
        const quantityElement = selector.querySelector('.qty-value');

        const cartItem = document.querySelector(
            `.cart-item[data-item-id="${cartItemId}"]`
        );

        if (!cartItem || !quantityElement) return;

        const priceElement = cartItem.querySelector('.item-price');

        if (increaseBtn) {
            increaseBtn.addEventListener('click', function () {
                changeQuantity(cartItemId, 'increase');
            });
        }

        if (decreaseBtn) {
            decreaseBtn.addEventListener('click', function () {
                changeQuantity(cartItemId, 'decrease');
            });
        }

        function changeQuantity(id, action) {

            fetch(`/cart/${id}/${action}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update quantity');
                }

                return response.json();
            })
            .then(data => {

                quantityElement.textContent = data.quantity;

                const cartBadge = document.getElementById('cart-badge');

              if (cartBadge) {
                let count = 0;

               document.querySelectorAll('.qty-selector .qty-value').forEach(element => {
                count += Number(element.textContent) || 0;
              });

              cartBadge.textContent = count;
              cartBadge.style.display = count > 0 ? 'flex' : 'none';
            }

                if (priceElement) {
                    priceElement.textContent =
                        `${Number(data.item_total).toFixed(2)} EGP`;
                }

                updateTotals(data);

                
                updateCartBadge();
            })
            .catch(error => {
                console.error(error);
                alert(translations.cartError);
            });
        }
    });

    
    document.querySelectorAll('.delete-btn').forEach(button => {

        button.addEventListener('click', function () {

            const cartItemId = this.dataset.id;

            const cartItem = document.querySelector(
                `.cart-item[data-item-id="${cartItemId}"]`
            );

            if (!cartItem) return;

            if (!confirm(translations.removeProductConfirm)) {
                return;
            }

            
            this.disabled = true;

            fetch(`/cart/${cartItemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete cart item');
                }

                return response.json();
            })
            .then(data => {

                
                cartItem.remove();

                 
                updateTotals(data);

                
                updateCartBadge();
            })
            .catch(error => {
                console.error(error);
                alert(translations.cartError);
                this.disabled = false;
            });
        });
    });

    
    updateCartBadge();


    const cartBadge = document.getElementById('cart-badge');

if (cartBadge) {
    let count = 0;

    document.querySelectorAll('.qty-selector .qty-value').forEach(element => {
        count += Number(element.textContent) || 0;
    });

    cartBadge.textContent = count;
    cartBadge.style.display = count > 0 ? 'flex' : 'none';
}

});

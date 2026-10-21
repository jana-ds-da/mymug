
document.addEventListener('DOMContentLoaded', function () {

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    const cartContainer = document.getElementById('cart-items-container');
    const emptyCartBtn = document.getElementById('empty-cart-btn');

    function updateCartBadge() {
        const cartBadge = document.getElementById('cart-badge');

        if (!cartBadge) return;

        let count = 0;

        document.querySelectorAll('.qty-selector .qty-value').forEach(element => {
            count += Number(element.textContent) || 0;
        });

        cartBadge.textContent = count;
        cartBadge.style.display = count > 0 ? 'flex' : 'none';
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

    function showEmptyCart() {
        if (!cartContainer) return;

        cartContainer.querySelectorAll('.cart-item').forEach(item => {
            item.remove();
        });

        let emptyMessage = cartContainer.querySelector('.empty-cart-message');

        if (!emptyMessage) {
            emptyMessage = document.createElement('p');
            emptyMessage.className = 'empty-cart-message';
            emptyMessage.style.padding = '20px';
            emptyMessage.textContent = translations.emptyCart;
            cartContainer.appendChild(emptyMessage);
        }

        if (emptyCartBtn) {
            emptyCartBtn.style.display = 'none';
        }

        updateCartBadge();
    }

    function handleEmptyCartState() {
        if (!cartContainer) return;

        const remainingItems = cartContainer.querySelectorAll('.cart-item');

        if (remainingItems.length === 0) {
            showEmptyCart();
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
                handleEmptyCartState();
            })
            .catch(error => {
                console.error(error);
                alert(translations.cartError);
                this.disabled = false;
            });
        });
    });

   
    if (emptyCartBtn) {
        emptyCartBtn.addEventListener('click', function () {

            if (!confirm(translations.emptyCartConfirm)) {
                return;
            }

            emptyCartBtn.disabled = true;

            fetch('/cart/empty', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to empty cart');
                }

                return response.json();
            })
            .then(data => {
                showEmptyCart();
                updateTotals(data);
            })
            .catch(error => {
                console.error(error);
                alert(translations.cartError);
                emptyCartBtn.disabled = false;
            });
        });
    }

   
    updateCartBadge();
    handleEmptyCartState();

});

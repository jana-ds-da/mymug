
let total = 0;

const SHIPPING = 200;

function renderCheckoutSummary() {

    const container = document.getElementById("checkout-items");

    container.innerHTML = "";

    let subtotal = 0;

    cart.forEach(item => {


         if (!item.product) {
             console.error("Product not found for cart item:", item);
         return;
         
         }

        const price = Number(item.product.price);
        const quantity = Number(item.quantity);

        const itemTotal = price * quantity;

        subtotal += itemTotal;

        const row = document.createElement("div");

        row.classList.add("checkout-row");

        row.innerHTML = `
            <div class="checkout-item-info">

                <strong>
                    ${item.product.mug_name}
                </strong>

                <span>
                    Quantity: ${quantity}
                </span>

                <span>
                    Price: ${price.toFixed(2)} EGP
                </span>

            </div>

            <strong>
                ${itemTotal.toFixed(2)} EGP
            </strong>
        `;
        container.appendChild(row);
    });

    total = subtotal + SHIPPING;

  document.getElementById("checkout-subtotal-val").textContent =
    subtotal.toFixed(2) + " EGP";

  document.getElementById("shipping-val").textContent =
    SHIPPING.toFixed(2) + " EGP";

  document.getElementById("checkout-total-val").textContent =
    total.toFixed(2) + " EGP";
}

renderCheckoutSummary();
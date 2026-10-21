let quantity = 1;

const quantityText = document.getElementById("quantity");

document.getElementById("plus").addEventListener("click", () => {

    quantity++;
    quantityText.textContent = quantity;

});

document.getElementById("minus").addEventListener("click", () => {

    if (quantity > 1) {

        quantity--;
        quantityText.textContent = quantity;

    }

});




document.getElementById("addCart").addEventListener("click", async () => {
    if (!isLoggedIn) {
        alert(translations.loginToAddCart);
        window.location.href = "/login";
        return;
    }

    try {
        const response = await fetch("/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Accept": "application/json"
            },
            body: JSON.stringify({
                product_id: product.id,
                quantity: quantity
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || "Failed to add product to cart");
        }

        if (data.success) {
            const cartBadge = document.getElementById("cart-badge");

            if (cartBadge && data.cart_count !== undefined) {
                cartBadge.textContent = data.cart_count;
                cartBadge.style.display =
                    Number(data.cart_count) > 0 ? "flex" : "none";
            }

            alert(data.message);
        }
    } catch (error) {
        console.error(error);
        alert("Could not add the product to your cart.");
    }
});




document.getElementById("buyNow").addEventListener("click", async () => {
    if (!isLoggedIn) {
        alert(translations.loginToBuy);
        window.location.href = "/login";
        return;
    }

    try {
        const response = await fetch("/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Accept": "application/json"
            },
            body: JSON.stringify({
                product_id: product.id,
                quantity: Number(
                    document.getElementById("quantity").textContent
                ),
                buy_now: true
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || "Buy Now failed");
        }

        if (data.success) {
            window.location.href = data.redirect;
        }
    } catch (error) {
        console.error(error);
        alert("Could not process Buy Now. Please try again.");
    }
});

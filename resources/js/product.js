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


document.getElementById("addCart").addEventListener("click", () => {

    if(!isLoggedIn) {

        alert(translations.loginToAddCart);

        window.location.href = '/login';

        return;

    }

    fetch("/cart/add", {

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

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            alert(data.message);

        }

    })

    .catch(error => {

        console.error(error);

    });



    });


document.getElementById("buyNow").addEventListener("click", () => {

    if (!isLoggedIn) {

        alert(translations.loginToBuy);
        window.location.href = "/login";

        return;
    }

    fetch("/cart/add", {

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
            quantity: quantity,
            buy_now: true

        })

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            window.location.href = "/cart";

        }

    })

    .catch(error => {

        console.error(error);

    });

});

document.getElementById("productName").textContent = product.mug_name;
document.getElementById("productPrice").textContent = `${product.price} EGP`;



document.getElementById("productCapacity").textContent = product.capacity;
document.getElementById("productMicrowave").textContent = product.microwave;
document.getElementById("producthowItsMade").textContent = product.how_its_made;




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

        alert('please login or create an account to add products to your cart.');

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

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const existing = cart.find(item => item.id === product.id);

    if (existing) {

        existing.quantity += quantity;

    } else {

        cart.push({

            ...product,

            price: Number(product.price),

            quantity: quantity

        });

    }

    
    window.location.href = "cart.html";

});
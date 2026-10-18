let total = 0;
const SHIPPING = 200;

function renderCheckoutSummary() {
    const container = document.getElementById("checkout-items");
    if (!container) return;
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
        <span>Quantity: ${quantity}</span>
        <span>Price: ${price.toFixed(2)} EGP</span>
    </div>
    <strong>${itemTotal.toFixed(2)} EGP</strong>
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

const checkoutForm = document.getElementById("checkout-form");

if (checkoutForm) {
    checkoutForm.noValidate = true;

    const paymentOptions = document.querySelectorAll(
        'input[name="payment"]'
    );

    const cardFields = document.getElementById("card-payment-fields");
    const cardInputs = cardFields
        ? cardFields.querySelectorAll("input")
        : [];

    function updatePaymentFields() {
        const selectedPayment = document.querySelector(
            'input[name="payment"]:checked'
        );

        const isCashOnDelivery =
            selectedPayment?.value === "Cash on Delivery";

        if (cardFields) {
            cardFields.hidden = isCashOnDelivery;
        }

        cardInputs.forEach(input => {
            input.required = !isCashOnDelivery;
            input.setCustomValidity("");
            input.classList.remove("input-error");
            input.removeAttribute("aria-invalid");
        });
    }

paymentOptions.forEach(option => {
    option.addEventListener("change", updatePaymentFields);
});

updatePaymentFields();

    
checkoutForm.querySelectorAll("input").forEach(input => {
input.addEventListener("input", function () {
if (input.name === "phone") {
   input.setCustomValidity("");
}
const isOptional =
input.name === "email" || input.name === "zip";

if (
    (isOptional && input.value.trim() === "") ||
    input.checkValidity()
    ) {
       input.classList.remove("input-error");
        input.removeAttribute("aria-invalid");
       }
});
});

checkoutForm.addEventListener("submit", function (event) {
let firstInvalid = null;
const inputs = Array.from(
   checkoutForm.querySelectorAll("input")
);

inputs.forEach(input => {
if (
    input.type === "radio" ||
    input.disabled ||
    input.closest("[hidden]")
    ) {
        return;
       }

const isOptional =
input.name === "email" || input.name === "zip";

if (isOptional && input.value.trim() === "") {
    input.setCustomValidity("");
    input.classList.remove("input-error");
    input.removeAttribute("aria-invalid");
    return;
    }

            
if (input.name === "phone") {
    const phonePattern = /^01[0125][0-9]{8}$/;

    input.setCustomValidity(
    phonePattern.test(input.value.trim())
    ? ""
    : "Enter a valid Egyptian mobile number."
    );
    }

const isInvalid =
!input.checkValidity() ||
(input.required && input.value.trim() === "");

if (isInvalid) {
    input.classList.add("input-error");
    input.setAttribute("aria-invalid", "true");

if (!firstInvalid) {
    firstInvalid = input;
}
} else {
    input.classList.remove("input-error");
    input.removeAttribute("aria-invalid"); }
});

if (firstInvalid) {
    event.preventDefault();

    firstInvalid.focus();

    firstInvalid.scrollIntoView({
    behavior: "smooth",
    block: "center"
   });
}
});
}

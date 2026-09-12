import DataTable from 'datatables.net-bs5';


const productForm = document.getElementById("productForm");
const imageInput = document.getElementById("image");
const imagePreview = document.getElementById("imagePreview");





if (imageInput) {

    imageInput.addEventListener("change", function () {

        const file = this.files[0];

        if (!file) {
            if (imagePreview) {
                imagePreview.style.display = "none";
            }
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            if (imagePreview) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block";
            }

        };

        reader.readAsDataURL(file);

    });

}





if (productForm) {

    productForm.addEventListener("submit", function (e) {

        const name = document.getElementById("name").value.trim();
        const price = document.getElementById("price").value.trim();
        const category = document.getElementById("category").value;
        const description = document.getElementById("description").value.trim();
        const capacity = document.getElementById("capacity").value.trim();
        const howItsMade = document.getElementById("howItsMade").value.trim();
        const microwave = document.getElementById("microwave").value;

        const image = imageInput ? imageInput.files[0] : null;

        
        
        
        const productId = document.getElementById("productId").value;

        const isEdit = productId !== "";

        
        
       

        if (
            !name ||
            !price ||
            !category ||
            !description ||
            !capacity ||
            !howItsMade ||
            microwave === ""
        ) {

            e.preventDefault();

            showMessage("Please fill in all fields.");

            return;
        }

        
        
       

        
        if (!isEdit && !image) {

            e.preventDefault();

            showMessage("Please choose an image.");

            return;
        }

       
    });

}



function showMessage(message) {

    const box = document.getElementById("messageBox");

    if (!box) return;

    box.textContent = message;

    box.classList.remove("d-none");

    setTimeout(() => {
        box.classList.add("d-none");
    }, 3000);

}




const salesCanvas = document.getElementById("salesChart");

if (salesCanvas) {

    new Chart(salesCanvas, {
        type: "line",

        data: {
            labels: chartLabels,

            datasets: [{
                label: "Sales",
                data: chartData,
                tension: 0.4,
                borderWidth: 2,

                borderColor: '#A65A2E',
                backgroundColor: "rgba(231, 123, 57, 0.15)",

                fill: true
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

    
document.addEventListener("click", function (e) {

    const deleteButton = e.target.closest(".delete-this-product");

    if (!deleteButton) return;

    e.preventDefault();

    const deleteUrl = deleteButton.dataset.url;

    if (!confirm("Are you sure you want to delete this product?")) {
        return;
    }

    fetch(deleteUrl, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),

            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(response => {

        if (!response.ok) {
            throw new Error("Delete failed");
        }

        return response.json();
    })
    .then(data => {

        alert(data.message || "Product deleted successfully.");

        $('#productsTable').DataTable().ajax.reload(null, false);

    })
    .catch(error => {

        console.error(error);

        alert("Something went wrong while deleting the product.");
    });

});
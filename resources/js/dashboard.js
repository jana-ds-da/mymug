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








const productsTable = document.getElementById("productsTable");

if (productsTable) {

    new DataTable(productsTable, {
        processing: true,
        serverSide: true,

        ajax: "/products/data",

        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false
            },
            {
                data: "image_path",
                name: "image_path",
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `
                        <img 
                            src="/storage/${data}" 
                            width="70"
                            alt="Product"
                        >
                    `;
                }
            },
            {
                data: "mug_name",
                name: "mug_name"
            },
            {
                data: "price",
                name: "price"
            },
            {
                data: "category",
                name: "category"
            },
            {
                data: null,
                name: "actions",
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `
                        <a 
                            href="/dashboard?edit=${data.id}" 
                            class="edit-btn"
                        >
                            Edit
                        </a>

                        <form 
                            action="/products/${data.id}" 
                            method="POST"
                            style="display:inline;"
                        >
                            <input 
                                type="hidden" 
                                name="_token" 
                                value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}"
                            >

                            <input 
                                type="hidden" 
                                name="_method" 
                                value="DELETE"
                            >

                            <button 
                                type="submit"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this product?')"
                            >
                                Delete
                            </button>
                        </form>
                    `;
                }
            }
        ],

        pageLength: 10,

        order: [[0, "desc"]]
    });

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

                borderColor:'#A65A2E',
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
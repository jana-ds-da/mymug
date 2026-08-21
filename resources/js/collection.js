
const filterButtons = document.querySelectorAll(".filter-btn");
const mugsGrid = document.getElementById("mugsGrid");


// Filter


filterButtons.forEach(button => {

    button.addEventListener("click", () => {

        filterButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        const category = button.dataset.category;

        if (category === "all") {

            displayProducts(products);

        } else {

            const filteredProducts = products.filter(product => {

                return product.category === category;

            });

            displayProducts(filteredProducts);

        }

    });

});





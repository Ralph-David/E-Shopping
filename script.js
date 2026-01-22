function searchProducts() {
    // Get the search input value and convert to lowercase
    let input = document.getElementById('searchInput').value.toLowerCase();
    
    // Get the products grid container
    let productsGrid = document.getElementById('productsGrid');
    
    // Get all product cards
    let products = productsGrid.getElementsByClassName('product-card');

    // Loop through all product cards
    for (let i = 0; i < products.length; i++) {
        // Get the product name from the h3 tag
        let productName = products[i].getElementsByTagName('h3')[0];
        let textValue = productName.textContent || productName.innerText;

        // Check if the product name includes the search term
        if (textValue.toLowerCase().indexOf(input) > -1) {
            products[i].style.display = ''; // Show the product
        } else {
            products[i].style.display = 'none'; // Hide the product
        }
    }
}

// Optional: Clear search when input is empty
document.addEventListener('DOMContentLoaded', function() {
    let searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            if (this.value === '') {
                searchProducts(); // Show all products when search is cleared
            }
        });
    }
});
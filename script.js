function searchProducts() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let products = document.getElementById('productsGrid').getElementsByClassName('product-card');

    for (let i = 0; i < products.length; i++) {
        let title = products[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
        if (title.includes(input)) {
            products[i].style.display = '';
        } else {
            products[i].style.display = 'none';
        }
    }
}

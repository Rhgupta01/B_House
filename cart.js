document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const itemElement = this.parentElement;
            const itemName = itemElement.querySelector('h2').innerText;
            const itemPrice = parseFloat(itemElement.querySelector('.price').innerText.replace('₹', ''));

            addItemToCart(itemName, itemPrice);
        });
    });

    function addItemToCart(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity += 1;
            existingItem.total = existingItem.quantity * existingItem.price;
        } else {
            cart.push({ name, price, quantity: 1, total: price });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
    }

   
});

document.getElementById('search-input').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const items = document.querySelectorAll('.col-md-4');
    
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

document.getElementById('search-icon').addEventListener('click', function() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const items = document.querySelectorAll('.col-md-4');
    
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

function redirectToBillPage() {
    window.location.href = 'bill.html';
}
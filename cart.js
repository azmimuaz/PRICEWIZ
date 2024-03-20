function addToCart(itemId, event) {
    event.preventDefault(); // Prevent the default link behavior

    // Send an AJAX request to add the item to the cart
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Item added to cart successfully!');
        }
        else alert('Item added to cart failed!');
    };
    xhr.open("GET", "/PRICEWIZ/add_to_cart.php?item_id=" + itemId, true);
    xhr.send();
}
    var cart = []; // Array to store cart items

    function addToCart(itemImage, itemName, itemPrice1, itemPrice2, itemPrice3, itemCategory) {
        // Check if the item already exists in the cart
        var existingItem = cart.find(function(item) {
            return item.name === itemName;
            
        });

        if (existingItem) {
            // Update the quantity of the existing item
            existingItem.quantity++;
        } else {
            // Add the item to the cart array
            cart.push({image: itemImage, name: itemName, price1: itemPrice1, price2: itemPrice2, price3: itemPrice3, category: itemCategory, quantity: 1 });
        }

        // Update the cart display
        updateCart();
        window.location.href = "/PRICEWIZ/cart_page.php?cart_data=" + JSON.stringify(cart);
    }

    function updateCart() {
        // Get the cart element
        var cartElement = document.getElementById('cart-items');

        // Clear existing cart items
        cartElement.innerHTML = '';

        // Initialize total for each price
        var totalLotus = 0;
        var totalMydin = 0;
        var totalCS = 0;
        var totalQuantity = 0;

        // Display each item in the cart
        cart.forEach(function (item) {
            // Create list item for the item with quantity
            var listItem = document.createElement('li');
            var quantityText = ' - Quantity: ' + item.quantity;
            listItem.textContent = item.name + quantityText;
            cartElement.appendChild(listItem);

            // Calculate total for each price and total quantity
            totalLotus += item.price1 * item.quantity;
            totalMydin += item.price2 * item.quantity;
            totalCS += item.price3 * item.quantity;
            totalQuantity += item.quantity;
        });

        // Update the total quantity display
        var totalQuantityBadge = document.getElementById('totalQuantityBadge');
        totalQuantityBadge.textContent = totalQuantity;

        // Update the total in the cart for Lotus price
        var totalElementLotus = document.getElementById('totalLotus');
        totalElementLotus.textContent = totalLotus.toFixed(2);

        // Update the total in the cart for Mydin price
        var totalElementMydin = document.getElementById('totalMydin');
        totalElementMydin.textContent = totalMydin.toFixed(2);

        // Update the total in the cart for CS price
        var totalElementCS = document.getElementById('totalCS');
        totalElementCS.textContent = totalCS.toFixed(2);
    }

    function sendCartToServer() {
        // Convert the cart array to a JSON string
        var cartData = JSON.stringify(cart);

        // Create a form element
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '/PRICEWIZ/cart_page.php';

        // Create an input field to store the cart data
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cart_data';
        input.value = cartData;

        // Append the input field to the form
        form.appendChild(input);

        // Append the form to the document and submit it
        document.body.appendChild(form);
        form.submit();
    }

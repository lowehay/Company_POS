<style>
    /* Numeric Keypad Styles */
    #numeric-keypad {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 5px;
    }

    .numeric-button {
        font-size: 1.5rem;
        padding: 10px;
        text-align: center;
        background-color: #2a3b57;
        border: 1px solid #ccc;
        cursor: pointer;
        background-color: transparent;
        /* Change the background color to transparent */
        color: black;
        /* Set the text color to black */
    }

    .numeric-button:hover {
        background-color: #ddd;
    }

    .clear-button {
        grid-column: span 1;
        background-color: #ff5555;
        color: #fff;

    }

    .payment-button {
        grid-column: span 3;
        padding: 15px;
        background-color: #EED11A;
        color: #fff;
        background-color: #009900;
    }

    .payment-button:hover {
        background-color: #C0A810;
    }

    .clear-button:hover {
        background-color: #cc0000;
    }

    .add-weight-button {
        background-color: #55cc55;
        color: #fff;
    }

    .add-weight-button:hover {
        background-color: #009900;
    }

    #cart-items {
        max-height: 450px;
        /* Adjust the height as needed */
        overflow-y: auto;
    }

    .selected-item {
        background-color: #d9edf7;
    }

    .delete-item {
        cursor: pointer;
    }

    #product-list {
        white-space: nowrap;
        /* Prevent line breaks */
        overflow-x: auto;
        /* Add horizontal scroll if necessary */
    }

    /* Add margin to each product card in the horizontal list */
    #product-list .d-inline-block {
        margin-right: 8px;
        /* Adjust the margin to your preference */
    }

    .total-price {
        font-weight: bold;
    }

    .card-title {
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 90%;


    }


    .product-card {
        width: 400px;
        height: 380px;
        border-radius: 12px;
        position: relative;

    }

    .card {
        margin: 10px auto;
        background: rgba(255, 255, 255, 0);
        /* Adjust the opacity (0.7 in this example) for transparency */
        backdrop-filter: blur(10px);
        /* Add a background blur effect */
    }

    .card {
        margin: 10px auto;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Product List -->
            <div class="col-md-8">
                <div class="card shadow" style="max-height: 100vh; overflow-y: auto; background: linear-gradient(to bottom, #a8e0ed 0%,#eaeaea 23%);">
                    <div class="card-header">
                        <h2>Product List</h2>
                        <!-- Add the search input and button inside the card header -->
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="product-search" placeholder="Search for a product">
                            <button class="btn btn-primary" id="search-button">Search</button>
                        </div>
                    </div>
                    <div class="card-body" id="product-list">
                        <div class="row">
                            <?php foreach ($result as $product) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-2">

                                    <div class="card product-card" data-product-name="<?php echo $product->product_name; ?>" data-product-price="<?php echo $product->product_sellingprice; ?>" data-product-image="<?php echo base_url('assets/images/' . $product->product_image); ?>">

                                        <div class="card-body" style="height: 300px;">
                                            <h5 class="card-title" style="max-width: 100%;">
                                                <?php echo $product->product_name; ?>
                                            </h5>

                                            <img src="<?php echo base_url('assets/images/' . $product->product_image); ?>" alt="<?php echo $product->product_name; ?>" class="img-fluid mb-3" style="max-width: 100%; max-height: 300px;">

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column - Cart -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header" style="background: linear-gradient(to bottom, #a8e0ed 0%,#eaeaea 23%);">
                        <h2>Cart</h2>

                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="cart-items">
                            <!-- Cart items will be added here -->
                        </ul>
                        <p class="total-price">Total Amount: ₱<span id="total">0.00</span></p>

                        <!-- Numeric Keypad for Weight Input -->
                        <div id="numeric-keypad">
                            <button class="btn btn-secondary numeric-button">1</button>
                            <button class="btn btn-secondary numeric-button">2</button>
                            <button class="btn btn-secondary numeric-button">3</button>
                            <button class="btn btn-secondary numeric-button">4</button>
                            <button class="btn btn-secondary numeric-button">5</button>
                            <button class="btn btn-secondary numeric-button">6</button>
                            <button class="btn btn-secondary numeric-button">7</button>
                            <button class="btn btn-secondary numeric-button">8</button>
                            <button class="btn btn-secondary numeric-button">9</button>
                            <button class="btn btn-secondary numeric-button">0</button>
                            <button class="btn btn-secondary numeric-button">.</button>
                            <button class="btn btn-secondary clear-button">Clear</button>
                            <a href="<?php echo site_url('main/payment'); ?>" class="btn  payment-button">
                                Payment <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script at the end of your page, after including jQuery -->
    <script>
        $(document).ready(function() {

            // Store all product cards in an array
            var allProductCards = $('.product-card');

            $('#search-button').on('click', function() {
                performSearch();
            });

            // Add an input event listener to the search input
            $('#product-search').on('input', function() {
                performSearch();
            });

            var originalProductListHTML = $('#product-list').html();

            function performSearch() {
                var searchTerm = $('#product-search').val().toLowerCase();

                // Clear the product list
                $('#product-list').empty();

                if (searchTerm === '') {
                    // If the search term is empty, restore the original product list
                    $('#product-list').html(originalProductListHTML);
                } else {
                    // Filter and display products that match the search term
                    allProductCards.each(function() {
                        var productName = $(this).data('product-name').toLowerCase();
                        if (productName.startsWith(searchTerm)) {
                            // Create a horizontal list for searched products
                            var productCard = $('<div class="d-inline-block mr-3"></div>');
                            productCard.append($(this).clone());
                            $('#product-list').append(productCard);
                        }
                    });
                }
            }

            $(document).on('click', '.product-card', function() {
                console.log('Product card clicked');
                var productName = $(this).data('product-name');
                var productPrice = parseFloat($(this).data('product-price'));

                // Check if the product is already in the cart
                if (isProductInCart(productName)) {
                    alert('This product is already in the cart.');
                    return; // Exit the function to prevent adding duplicates
                }

                // Create a new cart item element with weight text
                var totalPrice = productPrice.toFixed(2); // Calculate the total price
                var cartItem = $('<li class="list-group-item" data-product-price="' + totalPrice + '" data-product-name="' + productName + '">' +
                    productName + ' - ₱' + totalPrice + ' Quantity: <span class="weight-text">0</span> ' +
                    'Total: ₱<span class="product-total">0.00</span> <i class="fas fa-trash-alt text-danger float-right delete-item" style="cursor: pointer;"></i>');

                // Append the cart item to the cart
                $('#cart-items').append(cartItem);

                updateTotal();
            });


            // Function to check if a product is already in the cart
            function isProductInCart(productName) {
                var inCart = false;
                $('#cart-items li').each(function() {
                    var cartProductName = $(this).text().split(' - ')[0].trim(); // Extract product name from the cart item
                    if (cartProductName === productName) {
                        inCart = true;
                        return false; // Exit the loop early since we found a match
                    }
                });
                return inCart;
            }


            function updateTotal() {
                // Calculate and update the total price for all products in the cart
                var total = 0;
                var cartItems = []; // Initialize an array to store updated cart items

                $('#cart-items li').each(function() {
                    var productPrice = parseFloat($(this).data('product-price'));
                    var weight = parseFloat($(this).find('.weight-text').text());
                    weight = isNaN(weight) ? 0 : weight; // Ensure weight is a valid number
                    var totalPrice = weight * productPrice;
                    total += totalPrice;

                    // Update the individual product's total
                    $(this).find('.product-total').text(totalPrice.toFixed(2));

                    // Get the product name from the existing data attribute
                    var productName = $(this).data('product-name');

                    // Add the updated item to the cartItems array
                    cartItems.push({
                        name: productName,
                        price: totalPrice,
                        weight: weight
                    });
                });

                $('#total').text(total.toFixed(2));

                // Store the updated cartItems array in localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }



            var selectedCartItem = null; // Initialize the selectedCartItem variable

            // Click event handler for selecting items in the cart
            $('#cart-items').on('click', 'li', function() {
                if (selectedCartItem) {
                    // Remove the 'selected-item' class from the previously selected item
                    selectedCartItem.removeClass('selected-item');
                }

                // Add the 'selected-item' class to the clicked item
                $(this).addClass('selected-item');

                // Update the total price when a product is selected
                var productPrice = parseFloat($(this).data('product-price'));
                var weight = parseFloat($(this).find('.weight-text').text());
                weight = isNaN(weight) ? 0 : weight; // Ensure weight is a valid number
                var totalPrice = weight * productPrice;
                updateTotal();

                // Set the currently selected item
                selectedCartItem = $(this);
            });

            // Click event handler for deleting items from the cart (using event delegation)
            $('#cart-items').on('click', '.delete-item', function() {
                var listItem = $(this).closest('li');
                var itemPrice = parseFloat(listItem.data('product-price'));

                // Update the total price by subtracting the item price
                updateTotal(-itemPrice);

                // Remove the item from the cart
                listItem.remove();
            });

            // Add a keydown event listener to the entire document
            $(document).on('keydown', function(event) {
                // Check if a numeric key or decimal point was pressed
                if (event.key.match(/[0-9.]/)) {
                    // Simulate a click on the corresponding numeric keypad button
                    var digit = event.key;
                    $('#numeric-keypad .numeric-button:contains(' + digit + ')').click();
                } else if (event.key === 'Enter') {
                    // Handle Enter key press (e.g., perform a search if necessary)
                    performSearch();
                } else if (event.key === 'Backspace') {
                    // Handle Backspace key press (e.g., clear the selected item's weight)
                    $('#numeric-keypad .clear-button').click();
                }
            });

            function isCartEmpty() {
                return $('#cart-items li').length === 0;
            }

            // Click event handler for the "Payment" button
            $('.payment-button').on('click', function(e) {
                // Check if the cart is empty
                if (isCartEmpty()) {
                    e.preventDefault(); // Prevent the default behavior (proceeding to payment)
                    alert('There are no products in the cart. Please add products before proceeding to payment.');
                } else if (hasUnspecifiedWeights()) {
                    e.preventDefault(); // Prevent the default behavior (proceeding to payment)
                    alert('Please specify the quantity for all products in the cart before proceeding to payment.');
                }
            });

            // Function to check if there are products in the cart without a specified weight
            function hasUnspecifiedWeights() {
                var hasUnspecifiedWeight = false;
                $('#cart-items li').each(function() {
                    var weightText = $(this).find('.weight-text').text();
                    if (!weightText || parseFloat(weightText) <= 0) {
                        hasUnspecifiedWeight = true;
                        return false; // Exit the loop early since we found a product without a weight
                    }
                });
                return hasUnspecifiedWeight;
            }

            // Numeric Keypad Logic (same as before)...
            $('#numeric-keypad .numeric-button').on('click', function() {
                var digit = $(this).text();
                var selectedItem = $('.selected-item');
                var weightText = selectedItem.find('.weight-text');

                var currentWeight = weightText.text(); // Get the current weight as a string

                if (digit === '.') {
                    // If the clicked button is a decimal point (.), add it to the current weight text
                    if (!currentWeight.includes('.')) {
                        weightText.text(currentWeight + digit);
                    }
                } else {
                    // If the clicked button is a digit (0-9), update the weight text
                    var newWeight = currentWeight === '0' ? digit : currentWeight + digit;
                    weightText.text(newWeight);
                }

                // Update the total price as the weight text changes
                var productPrice = parseFloat(selectedItem.data('product-price'));
                var totalPrice = parseFloat(weightText.text()) * productPrice;
                totalPrice = isNaN(totalPrice) ? 0 : totalPrice; // Ensure totalPrice is a valid number
                updateTotal();
            });
        });

        $('#numeric-keypad .clear-button').on('click', function() {
            var selectedItem = $('.selected-item');
            if (selectedItem.length > 0) {
                // Clear the weight of the selected item
                var weightText = selectedItem.find('.weight-text');
                weightText.text('0');

                // Trigger the 'input' event to update the total price in real-time
                weightText.trigger('input');

                // Remove the 'selected-item' class
                selectedItem.removeClass('selected-item');
            }
        });
    </script>
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
        grid-column: span 1;
        background-color: #56C94E;
        color: #fff;
    }

    .payment-button:hover {
        background-color: #2a3b57;
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
        overflow-y: auto;
        max-height: 748px;
    }

    .total-price {
        font-weight: bold;
    }

    .card-title {
        font-weight: bold;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Product List -->
            <div class="col-md-8">
                <div class="card shadow" style="max-height: 100vh; overflow-y: auto;">
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
                                <div class="col-md-4 mb-2">
                                    <div class="card product-card" data-product-name="<?php echo $product->product_name; ?>" data-product-price="<?php echo $product->product_price; ?>" data-product-image="<?php echo base_url('assets/images/' . $product->product_image); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product->product_name; ?></h5>
                                            <img src="<?php echo base_url('assets/images/' . $product->product_image); ?>" alt="<?php echo $product->product_name; ?>" class="img-fluid mb-3" style="max-height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column - Cart -->
            <div class="col-md-4" style="background-color: #ffffff;">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>Cart</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="cart-items">
                            <!-- Cart items will be added here -->
                        </ul>
                        <p class="total-price">Total Price: ₱<span id="total">0.00</span></p>

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
                            <button class="btn btn-danger clear-button">Clear</button>
                            <button class="btn btn-warning payment-button">Payment</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                            $('#product-list').append($(this).parent()); // Keep the original parent container
                        }
                    });
                }
            }

            $(document).on('click', '.product-card', function() {
                var productName = $(this).data('product-name');
                var productPrice = parseFloat($(this).data('product-price'));

                // Create a new cart item element with weight text
                var cartItem = $('<li class="list-group-item" data-product-price="' + productPrice.toFixed(2) + '">' + productName + ' - ₱' + productPrice.toFixed(2) + ' Weight: <span class="weight-text">0</span> kg Total: ₱<span class="product-total">0.00</span> <i class="fas fa-trash-alt text-danger float-right delete-item" style="cursor: pointer;"></i></li>');


                // Append the cart item to the cart
                $('#cart-items').append(cartItem);

                // Update the total price in the cart
                updateTotal(productPrice);

                // Add a weight text field to the cart item
                var weightText = cartItem.find('.weight-text');

                // Update the total price as the weight text changes
                weightText.on('input', function() {
                    var weight = parseFloat($(this).text());
                    var productPrice = parseFloat(cartItem.data('product-price'));
                    var productTotal = weight * productPrice;
                    $(this).closest('li').find('.product-total').text(productTotal.toFixed(2));

                    // Update the total price for all products in the cart
                    updateTotal();
                });
            });

            function updateTotal() {
                // Calculate and update the total price for all products in the cart
                var total = 0;
                $('#cart-items li').each(function() {
                    var productPrice = parseFloat($(this).data('product-price'));
                    var weight = parseFloat($(this).find('.weight-text').text());
                    weight = isNaN(weight) ? 0 : weight; // Ensure weight is a valid number
                    var totalPrice = weight * productPrice;
                    total += totalPrice;

                    // Update the individual product's total
                    $(this).find('.product-total').text(totalPrice.toFixed(2));
                });

                $('#total').text(total.toFixed(2));
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

            // Numeric Keypad Logic (same as before)...
            $('#numeric-keypad .numeric-button').on('click', function() {
                var digit = $(this).text();
                var selectedItem = $('.selected-item');
                var weightText = selectedItem.find('.weight-text');
                var currentWeight = parseFloat(weightText.text());
                currentWeight = isNaN(currentWeight) ? 0 : currentWeight; // Ensure currentWeight is a valid number
                var newWeight = currentWeight === 0 ? digit : currentWeight + digit;
                weightText.text(newWeight);

                // Update the total price as the weight text changes
                var productPrice = parseFloat(selectedItem.data('product-price'));
                var totalPrice = parseFloat(newWeight) * productPrice;
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

                // Update the total price as the weight text changes
                var productPrice = parseFloat(selectedItem.data('product-price'));
                var totalPrice = parseFloat(0) * productPrice;
                updateTotal(totalPrice);
            }
        });
    </script>
</body>
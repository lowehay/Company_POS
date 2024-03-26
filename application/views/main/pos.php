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
        background-color: #5a6268;
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
        grid-column: span 3;
        padding: 15px;
        background-color: #EED11A;
        color: #fff;
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
        /* Adjust the maximum width as needed */
    }

    .product-card {
        width: 280px;
        height: 300px;
        border-radius: 12px;
        position: relative;
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
                <div class="card shadow" style="max-height: 100vh; overflow-y: auto;">
                    <div class="card-header">
                        <h3>Product List</h3>
                        <!-- Add the search input and button inside the card header -->
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" id="product-search" placeholder="Search for a product">
                            <button class="btn btn-secondary" id="search-button">Search</button>
                        </div>
                    </div>
                    <div class="card-body" id="product-list">
                        <div class="row">
                            <?php foreach ($result as $product) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                                    <div class="card product-card" data-product-name="<?php echo $product->product_name; ?>" data-product-price="<?php echo $product->product_price; ?>" data-product-image="<?php echo base_url('assets/images/' . $product->product_image); ?>">
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
                    <div class="card-header">
                        <h3>Cart</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="cart-items">
                            <table class="table table-bordered text-center" id="table_field">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Product Name</th>
                                        <th style="width: 15%;">Quantity</th>
                                        <th style="width: 20%;">Price</th>
                                        <th style="width: 20%;">Total</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row_content" id="row_product">
                                </tbody>
                            </table>
                        </ul>
                        <p class="total-price">Total Amount: ₱<span id="total">0.00</span></p>

                        <!-- Numeric Keypad for Weight Input -->
                        <div id="numeric-keypad">
                            <button class="btn btn-secondary numeric-button" data-key="1">1</button>
                            <button class="btn btn-secondary numeric-button" data-key="2">2</button>
                            <button class="btn btn-secondary numeric-button" data-key="3">3</button>
                            <button class="btn btn-secondary numeric-button" data-key="4">4</button>
                            <button class="btn btn-secondary numeric-button" data-key="5">5</button>
                            <button class="btn btn-secondary numeric-button" data-key="6">6</button>
                            <button class="btn btn-secondary numeric-button" data-key="7">7</button>
                            <button class="btn btn-secondary numeric-button" data-key="8">8</button>
                            <button class="btn btn-secondary numeric-button" data-key="9">9</button>
                            <button class="btn btn-secondary numeric-button" data-key="0">0</button>
                            <button class="btn btn-secondary numeric-button" data-key=".">.</button>
                            <button class="btn btn-secondary clear-button">Clear</button>
                            <a href="<?php echo site_url('main/payment'); ?>" class="btn btn-warning payment-button">
                                Payment <i class="fas fa-arrow-right"></i>
                            </a>
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

            // Event handler for selecting items in the product list
            $(document).on('click', '.product-card', function() {
                var productName = $(this).data('product-name');
                var productPrice = parseFloat($(this).data('product-price'));

                // Check if the product is already in the cart
                if (isProductInCart(productName)) {
                    toastr.error('This product is already in the cart.');
                    return; // Exit the function to prevent adding duplicates
                }

                // Create a new cart item element with quantity input
                var cartItem = $('<tr data-product-name="' + productName + '" data-product-price="' + productPrice.toFixed(2) + '"></tr>');
                cartItem.append('<td>' + productName + '</td>');
                cartItem.append('<td><input class="form-control form-control-sm product-quantity" type="number" value="1" min="1"></td>');
                cartItem.append('<td>₱' + productPrice.toFixed(2) + '</td>');
                cartItem.append('<td class="product-total">' + productPrice.toFixed(2) + '</td>');
                cartItem.append('<td><button class="btn btn-danger delete-item">Delete</button></td>');

                // Append the cart item to the cart table
                $('#table_field tbody').append(cartItem);

                // Update the total price in the cart
                updateTotal();

                // Store the cart items in localStorage
                updateLocalStorage();
            });

            // Function to update localStorage with cart items
            function updateLocalStorage() {
                var cartItems = [];

                // Iterate through cart items and store them in an array
                $('#table_field tbody').find('tr').each(function() {
                    var item = {
                        productName: $(this).data('product-name'),
                        productPrice: parseFloat($(this).data('product-price')),
                        quantity: parseFloat($(this).find('.product-quantity').val())
                    };
                    cartItems.push(item);
                });

                // Store the cart items array in localStorage
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

            // Event handler for updating quantities and calculating total prices
            $('#table_field tbody').on('input', '.product-quantity', function() {
                // Update the quantity in the localStorage
                updateLocalStorage();

                var quantity = parseFloat($(this).val());
                var productPrice = parseFloat($(this).closest('tr').data('product-price'));
                var totalPrice = quantity * productPrice;

                // Update the total price and individual product's total
                $(this).closest('tr').find('.product-total').text(totalPrice.toFixed(2));
                updateTotal();
            });


            // Event handler for deleting items from the cart
            $('#table_field tbody').on('click', '.delete-item', function() {
                var listItem = $(this).closest('tr');
                var itemPrice = parseFloat(listItem.data('product-price'));

                // Update the total price by subtracting the item price
                updateTotal(-itemPrice);

                // Remove the item from the cart
                listItem.remove();
            });

            // Function to check if a product is already in the cart
            function isProductInCart(productName) {
                var inCart = false;
                $('#table_field tbody').find('tr').each(function() {
                    var cartProductName = $(this).data('product-name');
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
                $('#table_field tbody').find('tr').each(function() {
                    var productPrice = parseFloat($(this).data('product-price'));
                    var quantity = parseFloat($(this).find('.product-quantity').val());
                    quantity = isNaN(quantity) ? 0 : quantity; // Ensure quantity is a valid number
                    var totalPrice = quantity * productPrice;
                    total += totalPrice;
                    // Update the individual product's total
                    $(this).find('.product-total').text(totalPrice.toFixed(2));
                });

                $('#total').text(total.toFixed(2));

                // Store the total price in a JavaScript variable
                var totalPriceForCheckout = total;

                // Update the total price on the payment page (assuming you have a way to pass this data)
                // For example, you can use a query parameter in the URL or use localStorage.
                // Here, we'll update the total pricein localStorage.
                localStorage.setItem('totalPriceForCheckout', totalPriceForCheckout);
            }

            // Event handler for clearing all quantities when the "Clear" button is clicked
            $('#numeric-keypad .clear-button').on('click', function() {
                // Set the quantity to zero for all rows in the cart
                $('.product-quantity').val(0);
                // Trigger the input event to recalculate totals
                $('.product-quantity').trigger('input');
            });

            // Event handler for clearing the quantity of a specific row
            $('#table_field tbody').on('click', '.clear-row', function(event) {
                event.stopPropagation(); // Stop the event from propagating to the parent elements
                var row = $(this).closest('tr');
                // Set the quantity to zero for the specific row
                row.find('.product-quantity').val(0);
                // Trigger the input event to recalculate totals
                row.find('.product-quantity').trigger('input');
            });

            // Event handler for checking if the cart is empty before allowing payment
            $('#numeric-keypad .payment-button').on('click', function() {
                if ($('#table_field tbody tr').length === 0) {
                    toastr.error('Please add items to the cart before proceeding to payment.');
                    return false; // Prevent the default behavior (e.g., following the link)
                }
            });

        });

        // Event handler for numeric keypad buttons
        $('#numeric-keypad .numeric-button').on('click', function() {
            var key = $(this).data('key');
            var selectedQuantityField = $('.selected-quantity');

            if (key === 'Clear') {
                // Clear the quantity field
                selectedQuantityField.val(0);
            } else {
                // Append the pressed key to the quantity field
                var currentValue = selectedQuantityField.val();
                selectedQuantityField.val(currentValue + key);
            }

            // Trigger the input event to recalculate totals
            selectedQuantityField.trigger('input');
        });

        // Event handler for selecting a quantity field in the cart
        $('#table_field tbody').on('click', '.product-quantity', function() {
            // Remove the "selected-item" class from all quantity fields
            $('.product-quantity').removeClass('selected-quantity');

            // Add the "selected-item" class to the clicked quantity field
            $(this).addClass('selected-quantity');
        });
    </script>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>');
            <?php } elseif ($this->session->flashdata('error')) { ?>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>');
            <?php } ?>
        });
    </script>
</body>
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
                                    <div class="card product-card" data-product-name="<?php echo $product->product_name; ?>" data-product-image="<?php echo base_url('assets/images/' . $product->product_image); ?>">
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
                        <p>Total: ₱<span id="total">0.00</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for entering weight and price -->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Enter Weight and Price for Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="itemForm">
                        <div class="mb-3">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight">Weight:</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addToCart">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle clicking on a product card
            $('.product-card').on('click', function() {
                const productCard = $(this);
                const productName = productCard.data('product-name');
                const productImage = productCard.data('product-image');

                // Reset the form fields and error message
                $('#itemForm')[0].reset();
                $('#validationError').text('');

                // Set modal title and image
                $('#itemModalLabel').text(`Enter Weight and Price for ${productName}`);
                $('#itemModal img').attr('src', productImage);

                // Store the selected product name in a data attribute
                $('#addToCart').data('product-name', productName);

                // Show the modal
                $('#itemModal').modal('show');
            });

            // Handle adding to cart
            $('#addToCart').on('click', function() {
                const weight = $('#weight').val();
                const price = $('#price').val();
                const productName = $('#addToCart').data('product-name');

                // Validate the form fields
                if (weight === '' || price === '') {
                    $('#validationError').text('Please fill in all fields.');
                    return; // Don't proceed if validation fails
                }

                // Calculate the total
                const total = (parseFloat(weight) * parseFloat(price)).toFixed(2);

                // Create a new list item for the cart
                const listItem = `<li class="list-group-item">${productName} <br> ${weight}kgs at ₱${price}/kg Total: ₱${total}</li>`;

                // Append the list item to the cart
                $('#cart-items').append(listItem);
 
                // Update the total in the cart
                updateTotal();

                // Close the modal and reset the form
                $('#itemModal').modal('hide');
                $('#itemForm')[0].reset();
                $('#validationError').text('');
            });

            // Function to update the total in the cart
            function updateTotal() {
                let total = 0.00;
                $('#cart-items li').each(function() {
                    const itemText = $(this).text();
                    const itemTotal = parseFloat(itemText.split('Total: ₱')[1]);
                    total += itemTotal;
                });

                $('#total').text(total.toFixed(2));
            }
        });
    </script>
    <!-- Add this script at the end of your page, after including jQuery -->
    <script>
        $(document).ready(function() {
            $('#search-button').on('click', function() {
                var searchTerm = $('#product-search').val().toLowerCase();

                // Loop through each product card
                $('.product-card').each(function() {
                    var productName = $(this).data('product-name').toLowerCase();

                    // Check if the product name contains the search term
                    if (productName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

</body>
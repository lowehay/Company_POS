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
                        <button type="button" class="btn btn-success" id="placeOrderButton" data-bs-toggle="modal"
                                    data-bs-target="#checkoutModal">Checkout</button>
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


        <!-- place /checkout for existing customer order Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <!--toggle button for walking-->
                            <div class="form-check form-switch ms-auto">        
                                <input class="form-check-input" type="checkbox" id="walkInToggle">
                                <label class="form-check-label" for="walkInToggle">Walk-In</label>
                            </div>
                            <!--end toggle button for walking-->
                            <label>Customer Name</label>
                                <select class="form-select" id="customerName">
                                    <option value=""></option>
                                </select>
                        </div>
                        <div class="mb-3">  
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Account Number">Account Number</option>
                            </select>
                        </div>
                        <p>Total Amount: ₱<span id="modalTotal">0.00</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Place Order</button>
                    </div>
                </div>
            </div>
        </div><!-- end of place order Modal -->

         <!-- checkout for Walk-In Modal -->
         <form action="<?= base_url('Register/registerCustomer'); ?>" method="post"  id="registrationForm">
        <div class="modal fade" id="walkInModal" tabindex="-1" aria-labelledby="walkInModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="walkInModalLabel">Walk-In Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div id="error-message" class="alert alert-danger"  style="display: none;">
                        Error: Invalid Philippine contact number or empty fields.
                    </div>

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name"  id="customer_fname" name="customer_fname" class ="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Last Name" id="customer_lname" name="customer_lname" class ="form-control">
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" placeholder="Enter Contact NUmber" id="contact_no" name="contact_no" class ="form-control">
    
                        </div>
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-select" name="role" id="role" aria-label="Default select example">
                                <option selected hidden>Select Payment Method</option>
                                <option value="encoder">Cash</option>
                                <option value="cashier">Cash Account</option>
                                <option value="auditor">Cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="register" name="insertdata" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Register Customer</button>
                    </div>
              
                </div>
            </div>
        </div>
        <div id="successMessage" class="alert alert-success" style="display: none;">
    Customer registered successfully!
</div>
</form>

        <!-- end of code for checkout for Walk-In Modal -->






    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
            $(document).ready(function () {
                // Handle clicking on a product card
                $('.product-card').on('click', function () {
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
                $('#addToCart').on('click', function () {
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
                    const listItem = `<li class="list-group-item">${productName} - Weight: ${weight}, Price: ${price}, Total: ₱${total}</li>`;

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
                    $('#cart-items li').each(function () {
                        const itemText = $(this).text();
                        const itemTotal = parseFloat(itemText.split('Total: ₱')[1]);
                        total += itemTotal;
                    });

                    $('#total').text(total.toFixed(2));
                }
            });     

            // JavaScript code to update the modal's total amount
            document.getElementById('placeOrderButton').addEventListener('click', function () {
                // Get the total amount from the cart and update the modal
                var totalAmount = document.getElementById('total').textContent;
                document.getElementById('modalTotal').textContent = totalAmount;
            });

            // JavaScript code for toggling between Walk-In and Checkout Modals
            document.getElementById('walkInToggle').addEventListener('change', function () {
                if (this.checked) {
                    // If Walk-In is checked, show the Walk-In Modal
                    $('#walkInModal').modal('show');
                } else {
                    // If Walk-In is unchecked, show the Checkout Modal
                    $('#checkoutModal').modal('show');
                }
            });



//to verify if the user entered the information......
$(document).ready(function() {
    $("#register").click(function() {
        var customer_fname = $("#customer_fname").val();
        var customer_lname = $("#customer_lname").val();
        var contact_no = $("#contact_no").val();

        // Check if any of the fields are empty
        if (customer_fname === "" || customer_lname === "" || contact_no === "") {
        return false;
        }
        else{
            alert("saksespul.");
            ;
        }
    });
});

$(document).ready(function () {
        // Delay in milliseconds (e.g., 3000ms = 3 seconds)
        var delay = 3000;x

  
        var successMessage = $('#success-message');

        // Check if the success message element exists
        if (successMessage.length) {
            // Hide the success message after the specified delay
            setTimeout(function () {
                successMessage.fadeOut('slow', function () {
                    // Optionally, you can remove the element from the DOM after fading out
                    successMessage.remove();
                });
            }, delay);
        }
    });

    // Make an AJAX request to get customer data and display it on the drop dwon field
$.ajax({
    type: 'GET',
    url: 'Register/getCustomers',
    dataType: 'json',
    success: function (response) {
        console.log(response);
        if (response.customers.length > 0) {
            // Clear the existing options
            $('#customerName').empty();
            // Add a default option
            $('#customerName').append($('<option>', {
                value: '',
                text: ''
            }));
            // Populate the dropdown with customer names
            $.each(response.customers, function (index, customer) {
                $('#customerName').append($('<option>', {
                    value: customer.customer_id,
                    text: customer.customer_fname + ' ' + customer.customer_lname
                }));
            });
        } else {
            // Handle the case when no customers are available
            $('#customerName').empty();
            $('#customerName').append($('<option>', {
                value: '',
                text: 'No customers available'
            }));
        }
    },
    error: function (error) {
        console.error('Error:', error);
        // Handle errors if the request fails
    }
});


$(document).ready(function() {
    $('#register').on('click', function() {
        var customer_fname = $('#customer_fname').val();
        var customer_lname = $('#customer_lname').val();
        var contact_no = $('#contact_no').val();

        // Regular expression pattern for a valid Philippine mobile or landline number
        var validPhContactPattern = /^(09\d{9}|0\d{1,2}-\d{6,8}(?:-\d{1,5})?)$/;

        if (
            customer_fname === '' ||
            customer_lname === '' ||
            contact_no === '' ||
            !contact_no.match(validPhContactPattern)
        ) {
            // Display an error message if any of the fields are empty or contact number is invalid
            $('#error-message').show();
        } else {
            // Hide the error message if everything is valid
            $('#error-message').hide();

            // Send data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: '/Register/registerCustomer', // Adjust the URL based on your setup
                data: {
                    customer_fname: customer_fname,
                    customer_lname: customer_lname,
                    contact_no: contact_no,
                },
               
                error: function(error) {
                    // Handle errors if the request fails
                },
            });
        }
    });
});
        </script>
</body>
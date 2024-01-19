<style>
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
        color: #fff;
    }

    .numeric-button:hover {
        background-color: #ddd;
    }

    .clear-button,
    .checkout-button,
    .back-button {
        padding: 15px;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .clear-button,
    .checkout-button {
        background-color: #FF0000;
    }

    .clear-button:hover,
    .checkout-button:hover {
        background-color: #C0A810;
    }

    .clear-button:hover {
        background-color: #C0A810;
    }

    .payment-button {
        grid-column: span 2;
        padding: 20px;
        background-color: #EED11A;
        color: #fff;
    }

    .payment-button:hover {
        background-color: #C0A810;
    }

    .back-button {
        grid-column: span 1;
        padding: 15px;
        background-color: #807F7E;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .back-button:hover {
        background-color: #5E5B58;
    }
</style>
<?php echo form_open('', array('onsubmit' => 'return confirm(\'Are you sure you want to post this sales?\')')); ?>
<div class="card shadow" style="max-width: 2000px; margin: 0 auto; height: auto;">
    <div class="card-header text-center">
        <h2>Payment</h2>
    </div>
    <div class="card-body" style="flex-grow: 1; position: relative;">
        <div class="row">
            <div class="col-md-7 text-center">
                <div class="border p-3">
                    <p class="total-price" name="total_cost" style="font-size: 50px;">Total Amount: ₱<span id="total">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Cash Payment: ₱<span id="cashPayment">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Remaining Balance: ₱<span id="remainingBalance">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Change: ₱<span id="change">0.00</span></p>
                </div>

                <!-- Numeric Keypad for Weight Input -->
                <div id="numeric-keypad">
                    <button type="button" class="btn btn-secondary numeric-button">1</button>
                    <button type="button" class="btn btn-secondary numeric-button">2</button>
                    <button type="button" class="btn btn-secondary numeric-button">3</button>
                    <button type="button" class="btn btn-secondary numeric-button">4</button>
                    <button type="button" class="btn btn-secondary numeric-button">5</button>
                    <button type="button" class="btn btn-secondary numeric-button">6</button>
                    <button type="button" class="btn btn-secondary numeric-button">7</button>
                    <button type="button" class="btn btn-secondary numeric-button">8</button>
                    <button type="button" class="btn btn-secondary numeric-button">9</button>
                    <button type="button" class="btn btn-secondary numeric-button">0</button>
                    <button type="button" class="btn btn-secondary numeric-button">.</button>
                    <button type="button" class="btn btn-secondary clear-button">Clear</button>
                    <a href="javascript:void(0);" class="btn btn-secondary back-button" onclick="confirmBack()"> Back <i class="fas fa-arrow-left"></i></a>
                    <input type="submit" value="Check Out" name="btn_add_sales" id="submit_pr" class="btn btn-warning payment-button">
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div>
                        <div class="card-body" id="buttong" style="max-height: 30vh; overflow-y: auto; display: flex; flex-direction: column; justify-content: space-between; color: #FFF;">
                            <table class="table table-bordered text-center" id="table_field">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Product Name</th>
                                        <th style="width: 15%;">Quantity</th>
                                        <th style="width: 20%;">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="row_content" id="row_product">
                                    <!-- Your table rows go here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" id="buttong" style="height: 40vh; display: flex; flex-direction: column; justify-content: space-between; color: #FFF;">
                        <label class="btn btn-primary btn-block payment-method" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #6096B4; color: #FFF;" onclick="handlePaymentMethodClick(this)">
                            <input type="radio" name="payment_method" value="cash" data-method="cash" style="display: none;"> <!-- Hide radio button -->
                            Cash
                            <input type="hidden" value="<?= $ref_no ?>" name="reference_no" readonly class="form-control form-control-sm">
                            <input type="hidden" value="<?= date('Y-m-d'); ?>" name="date_created" readonly class="form-control form-control-sm">
                        </label>
                        <label class="btn btn-primary btn-block payment-method" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #6096B4; color: #FFF;" onclick="handlePaymentMethodClick(this)">
                            <input type="radio" name="payment_method" value="cheque" data-method="cheque" style="display: none;"> <!-- Hide radio button -->
                            Cheque
                        </label>
                        <label class="btn btn-primary btn-block payment-method" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 20px; background-color: #6096B4; color: #FFF;" onclick="handlePaymentMethodClick(this)">
                            <input type="radio" name="payment_method" value="bank account" data-method="bank" style="display: none;"> <!-- Hide radio button -->
                            Bank Account
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    function confirmBack() {
        var confirmMessage = "Are you sureyou want to go back and make new transactions?";

        // Display a confirmation dialog
        var userConfirmed = window.confirm(confirmMessage);

        // Check the user's choice
        if (userConfirmed) {
            // If the user clicked "OK," navigate back to the dashboard page
            window.location.href = "<?php echo site_url('main/pos'); ?>";
        }
        // If the user clicked "Cancel" or closed the dialog, stay on the payment page
    }
    $(document).ready(function() {
        var totalPriceForCheckout = localStorage.getItem('totalPriceForCheckout');
        var cashPayment = 0;

        if (totalPriceForCheckout !== null && totalPriceForCheckout !== undefined) {
            $('#total').text(parseFloat(totalPriceForCheckout).toFixed(2));
        } else {
            $('#total').text('N/A');
        }

        function loadCartItems() {
            var cartItems = localStorage.getItem('cartItems');

            if (cartItems) {
                cartItems = JSON.parse(cartItems);

                // Store cart items in a consistent key
                localStorage.setItem('paymentPageCartItems', JSON.stringify(cartItems));

                // Iterate through cart items and display them on the payment page
                cartItems.forEach(function(item) {
                    var cartItem = $('<tr data-product-name="' + item.productName + '" data-product-price="' + item.productPrice.toFixed(2) + '"></tr>');
                    cartItem.append('<td><input type="text" name="product[]" value="' + item.productName + '" class="form-control" readonly></td>');
                    cartItem.append('<td><input type="number" name="quantity[]" value="' + item.quantity + '" class="form-control product-quantity" readonly></td>');
                    cartItem.append('<td><input type="text" name="product_price[]" value="' + item.productPrice.toFixed(2) + '" class="form-control" readonly></td>');
                    // Append the cart item to the cart table
                    $('#table_field tbody').append(cartItem);
                });

                // Update the total price in the cart
                updateTotal();
            }
        }

        // Call the function to load cart items when the page is ready
        loadCartItems();

        // Intercept form submission to ensure proper data is sent
        $('form').submit(function() {
            // Ensure the form data is correctly populated before submitting
            var form = $(this);
            var formData = form.serializeArray();

            // Log form data to the console for debugging (optional)
            console.log(formData);

            // Add additional checks or adjustments to formData if needed

            return true; // Allow the form to be submitted
        });
    });

    function handlePaymentMethodClick(button) {
        // Reset styling for all buttons
        var buttons = document.querySelectorAll('.payment-method');
        buttons.forEach(function(btn) {
            btn.style.backgroundColor = '#6096B4'; // Reset to default color
        });

        // Change color for the clicked button
        button.style.backgroundColor = '#2a3b57'; // Set the desired color

        // Store the selected payment method value in localStorage
        var selectedPaymentMethod = button.querySelector('input[name="payment_method"]').value;
        localStorage.setItem('selectedPaymentMethod', selectedPaymentMethod);
    }

    // Function to update the checkout button state
    // Function to update the checkout button state
    function updateCheckoutButton() {
        var totalAmount = parseFloat($('#total').text());
        var cashPayment = parseFloat($('#cashPayment').text());
        var remainingBalance = Math.max(totalAmount - cashPayment, 0);
        var change = Math.max(cashPayment - totalAmount, 0);

        // Update remaining balance and change
        $('#remainingBalance').text(remainingBalance.toFixed(2));
        $('#change').text(change.toFixed(2));

        // Store data in local storage
        var paymentData = {
            totalAmount: totalAmount.toFixed(2),
            cashPayment: cashPayment.toFixed(2),
            remainingBalance: remainingBalance.toFixed(2),
            change: change.toFixed(2)
        };

        localStorage.setItem('paymentData', JSON.stringify(paymentData));

        // Get and store reference number in local storage
        var referenceNo = '<?= $ref_no ?>';
        localStorage.setItem('referenceNo', referenceNo);

        // Disable checkout button if there's a remaining balance or cash payment is insufficient
        var isDisabled = remainingBalance > 0 || cashPayment < totalAmount;
        $('#submit_pr').prop('disabled', isDisabled);
    }
    updateCheckoutButton();

    $(document).ready(function() {

        var totalPriceForCheckout = localStorage.getItem('totalPriceForCheckout');

        if (totalPriceForCheckout !== null && totalPriceForCheckout !== undefined) {
            $('#total').text(parseFloat(totalPriceForCheckout).toFixed(2));
        } else {
            $('#total').text('N/A');
        }

        // Function to update payment fields based on the selected payment method
        function updatePaymentFields(paymentMethod) {
            // Reset cash payment, remaining balance, and change
            $('#cashPayment').text('0.00');
            $('#remainingBalance').text('0.00');
            $('#change').text('0.00');

            // Automatically fill the cash payment field for cheque and bank account
            if (paymentMethod === 'cheque' || paymentMethod === 'bank account') {
                $('#cashPayment').text(parseFloat(totalPriceForCheckout).toFixed(2));
            }

            // Clear cash payment and change when the clear button is clicked
            $('.clear-button').click(function() {
                $('#cashPayment').text('0.00');
                $('#change').text('0.00');

                // Update the checkout button state after clearing
                updateCheckoutButton();
            });

            // Disable numeric keypad for cheque and bank account
            if (paymentMethod === 'cheque' || paymentMethod === 'bank account') {
                $('.numeric-button').prop('disabled', true);
            } else {
                // Enable numeric keypad for cash input
                $('.numeric-button').prop('disabled', false);

                // Update remaining balance and change based on cash payment
                $('.numeric-button').unbind('click').click(function() {
                    var totalPrice = parseFloat($('#total').text());
                    var cashPayment = parseFloat($('#cashPayment').text());
                    var enteredValue = parseFloat($(this).text());

                    // Handle numeric input and calculate remaining balance and change
                    if (!isNaN(enteredValue)) {
                        cashPayment = cashPayment * 10 + enteredValue;
                        $('#cashPayment').text(cashPayment.toFixed(2));

                        // Calculate remaining balance and change
                        var remainingBalance = Math.max(totalPrice - cashPayment, 0);
                        var change = Math.max(cashPayment - totalPrice, 0);

                        $('#remainingBalance').text(remainingBalance.toFixed(2));
                        $('#change').text(change.toFixed(2));

                        // Update the checkout button state
                        updateCheckoutButton();
                    }
                });
            }
        }

        // Handle payment method click
        $('.payment-method').click(function() {
            var paymentMethod = $(this).find('input[name="payment_method"]').val();
            updatePaymentFields(paymentMethod);
            updateCheckoutButton(); // Update the checkout button state when the payment method changes
        });

        // Call the function to update the checkout button state when the page is ready
        updateCheckoutButton();
    });
</script>
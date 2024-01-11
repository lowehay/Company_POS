<style>
    #numeric-keypadding {
        position: absolute;
        bottom: 0;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 5px;
        width: 100%;
        /* Ensure it spans the full width */
        background-color: #ffffff;
        /* Add a background color for better visibility */
        padding: 10px;
        /* Add some padding for spacing */
        z-index: 1000;
        /* Add a higher z-index value */
    }

    /* Rest of your existing CSS */


    .numeric-button {
        font-size: 1.5rem;
        padding: 10px;
        text-align: center;
        background-color: transparent;
        /* Change the background color to transparent */
        border: 1px solid #ccc;
        cursor: pointer;
        color: black;
        /* Add text color for better visibility */
    }

    .numeric-button:hover {
        background-color: #ddd;
    }

    .clear-button {
        grid-column: span 1;
        background-color: #ff5555;
        color: #fff;
    }

    .checkout-button {
        grid-column: span 2;
        padding: 30px;
        background-color: #EED11A;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .checkout-button:hover {
        background-color: #C0A810;
    }

    .back-button {
        grid-column: span 1;
        padding: 30px;
        background-color: #807F7E;
        color: #fff;
        font-weight: bold;
        font-size: larger;
    }

    .back-button:hover {
        background-color: #5E5B58;
    }

    .clear-button:hover {
        background-color: #cc0000;
    }

    .bten:link,
    .bten:visited {
        text-transform: uppercase;
        text-decoration: none;
        padding: 15px 40px;
        display: inline-block;
        border-radius: 100px;
        transition: all 0.2s;
    }

    .bten:hover {
        /* transform: translateY(-3px); */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .bten:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .bten {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
    }

    .bten-white {
        background-color: #fff;
        color: #777;
    }

    .bten::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 100%;
        border-radius: 100px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        transition: all 0.4s;
    }

    .bten {
        color: black;
        /* Set the text color to black */
    }

    .bten:hover::after {
        transform: scaleX(1.4) scaleY(1.6);
        opacity: 0;
    }

    .bten-animated {
        animation: moveInBottom 5s ease-out;
        animation-fill-mode: backwards;
    }

    @keyframes moveInBottom {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0px);
        }
    }

    .receipt {
        max-width: 2000px;
        margin: 0 auto;
        height: 40vh;
        overflow-x: auto;
    }

    body {

        background: #eee;
    }

    .print-button-container {
        text-align: center;
        margin-top: 20px;
    }

    .print-button-container button {
        padding: 10px;
    }
</style>

<div class="card shadow" style="max-width: 2000px; margin: 0 auto; height: 59vh;">
    <div class="card-header text-center">
        <h2>Payment</h2>
    </div>
    <div class="card-body" style="flex-grow: 1;">
        <div class="row">
            <!-- Left column for payment method -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment Method</h3>
                    </div>

                    <!-- Modify the content within the buttong div -->
                    <div class="card-body" id="buttong" style="height: 30vh; display: flex; flex-direction: column; justify-content: space-between; background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);">
                        <button class="bten btn-block" style="height: 100px; font-size: 20px; color: black;" onclick="selectPaymentMethod('Cash')">Cash</button>
                        <button class="bten btn-block" style="height: 100px; font-size: 20px; color: black;" onclick="selectPaymentMethod('Cheque')">Cheque</button>
                        <button class="bten btn-block" style="height: 100px; font-size: 20px; color: black;" onclick="selectPaymentMethod('Bank Account')">Bank Account</button>

                    </div>

                </div>
            </div>

            <!-- Right column for total price, cash payment, and change -->
            <div class="receipt col-md-8 text-center">
                <div class="border p-3">

                    <div class="container bootdey">
                        <div class="row invoice row-printable">
                            <div class="col-md-10">
                                <!-- col-lg-12 start here -->
                                <div class="panel panel-default plain" id="dash_0">
                                    <!-- Start .panel -->
                                    <div class="panel-body p30">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <!-- col-lg-12 start here -->
                                                <div class="invoice-details mt25">
                                                    <div class="well">
                                                        <ul class="list-unstyled mb0">
                                                            | <li><strong>Receipt</strong></li>
                                                            <li><strong> Date:</strong> Monday, October 10th,
                                                                2023</li>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="invoice-to mt25">
                                                    <ul class="list-unstyled">
                                                        <li><strong>Company</strong></li>
                                                        <li>Sample </li>
                                                        <li>Surallah, South Cotabato</li>
                                                        <li>...</li>
                                                        <li>...</li>
                                                    </ul>
                                                </div>
                                                <div class="invoice-items">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="per70 text-center">Description</th>
                                                                    <th class="per5 text-center">Qty</th>
                                                                    <th class="per25 text-center">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="payment-table">


                                                            </tbody>
                                                            <tfoot>

                                                                <tr>
                                                                    <th colspan="2" class="text-right">Total:</th>
                                                                    <th class="text-center" id="total-amount">₱0.00</th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="2" class="text-right">Change:</th>
                                                                    <th class="text-center" id="change-amount">₱0.00
                                                                    </th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="invoice-footer mt25">
                                                    <p class="text-center">Generated on Monday, October 08th, 2015 <a href="#" class="btn btn-default ml15"><i class="fa fa-print mr5"></i> Print</a></p>
                                                </div>
                                            </div>
                                            <!-- col-lg-12 end here -->
                                        </div>
                                        <!-- End .row -->

                                    </div>
                                </div>
                                <!-- End .panel -->
                            </div>
                            <!-- col-lg-12 end here -->

                            <div id="cashTextFieldContainer" style="display: none;">
                                <label for="cashAmount">Cash Amount:</label>
                                <input type="text" id="cashAmount" class="form-control" placeholder="Enter cash amount">
                            </div>
                            <div id="chequeFields" style="display: none;">
                                <label for="chequeNumber">Cheque Number:</label>
                                <input type="text" id="chequeNumber" class="form-control" placeholder="Enter cheque number">
                                <label for="chequeDate">Cheque Date:</label>
                                <input type="text" id="chequeDate" class="form-control" placeholder="Enter cheque date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of receipt code -->

        </div>
    </div>
</div>
<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Receipt content will be displayed here -->
            </div>
        </div>
    </div>
</div>


<!-- modal for cheque -->



<div id="numeric-keypadding" data-numeric-keypad>
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
    <button class="btn btn-danger clear-button" onclick="clearCashAmount()">Clear</button>
    <button class="btn btn-success numeric-button confirm-payment-button" onclick="generateReceipt()">Confirm
        Payment</button>


</div>
<div id="receipt-container" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="receipt-content">
                    <div class="print-only">
                        <div class="well">
                            <ul class="list-unstyled mb0">
                                <li><strong>Receipt</strong></li>
                            </ul>
                        </div>
                        <div class="invoice-to mt25">
                            <ul class="list-unstyled">
                                <li><strong>Company</strong></li>
                                <li>Welcome,</li>
                                <li>Sample</li>
                                <li>Surallah, South Cotabato</li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="invoice-items">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="per70">Description</th>
                                            <th class="per5">Qty</th>
                                            <th class="per25">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="payment-table">
                                        <!-- ... table body content ... -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Total:</th>
                                            <th id="total-amount">₱0.00</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">Change:</th>
                                            <th id="change-amount">₱0.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <p id="generated-time"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    function confirmBack() {
        var confirmMessage = "Are you sure you want to go back and make new transactions?";

        // Display a confirmation dialog
        var userConfirmed = window.confirm(confirmMessage);

        // Check the user's choice
        if (userConfirmed) {
            // If the user clicked "OK," navigate back to the dashboard page
            window.location.href = "<?php echo site_url('main/'); ?>";
        }
        // If the user clicked "Cancel" or closed the dialog, stay on the payment page
    }

    function startNewTransaction() {
        // Clear the cart items array and update the cart display
        cartItems = [];
        updateCartDisplay();
    }


    $(document).ready(function() {
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        var paymentTable = $('#payment-table');

        // Loop through cartItems and add them to the payment table
        cartItems.forEach(function(item) {
            var row = $('<tr></tr>');
            row.append($('<td class="per70 text-center">' + item.name + '</td>'));
            row.append($('<td class="per5 text-center">' + item.weight + '</td>')); // Display the weight
            row.append($('<td class="per25 text-center"> ₱' + item.price + '</td>'));
            paymentTable.append(row);
        });

        // Calculate and display the subtotal and total amounts
        var subtotal = 0;
        cartItems.forEach(function(item) {
            subtotal += parseFloat(item.price);
        });
        $('#subtotal-amount').text('₱' + subtotal.toFixed(2));
        $('#total-amount').text('₱' + subtotal.toFixed(2));
    });


    function clearCartItems() {
        cartItems = []; // Clear the cart items
        updateCartDisplay(); // Update the table (payment-table) in the HTML 
    }


    window.addEventListener('beforeunload', function(event) {

        localStorage.removeItem('cartItems');
        clearCartItems();
    });

    function selectPaymentMethod(paymentMethod) {
        // Show the text field for cash amount if "Cash" is selected
        if (paymentMethod === 'Cash') {
            $('#cashTextFieldContainer').show();
        } else {
            // Hide the text field for other payment methods
            $('#cashTextFieldContainer').hide();
        }

        // Show or hide additional fields based on the selected payment method
        switch (paymentMethod) {
            case 'Cheque':
                $('#chequeFields').show();
                break;
            case 'Bank':
                // Show additional fields or perform actions specific to Bank payment
                break;
            default:
                // Hide additional fields for any other payment method
                $('#chequeFields').hide();
        }
    }

    // Event listener for payment method buttons
    $('#buttong button').on('click', function() {
        var paymentMethod = $(this).text().trim(); // Get the text content of the clicked button
        selectPaymentMethod(paymentMethod);
    });

    var currentCashAmount = '';

    function handleNumericButtonClick(value) {
        // Get the current value of the cashAmount input field
        var currentCashAmount = $('#cashAmount').val();

        // Append the clicked value to the current value
        var newCashAmount = currentCashAmount + value;

        // Update the cashAmount input field with the new value
        $('#cashAmount').val(newCashAmount);

        // Update the total amount
        updateTotalAmount();
    }



    document.addEventListener("keydown", function(event) {
        // Check if the event target has the data-numeric-keypad attribute
        if (event.target.hasAttribute("data-numeric-keypad")) {
            // Handle your numeric keypad input logic here
            // For example, you might want to call handleNumericButtonClick based on the pressed key
            // You can use event.key to get the pressed key
            // You may want to check for specific keys, like numbers, dot, etc.

            // Example:
            if (/^[0-9.]$/.test(event.key)) {
                handleNumericButtonClick(event.key);
            }
        } else {
            // Prevent keyboard input for elements without the data-numeric-keypad attribute
            event.preventDefault();
        }
    });


    $(document).ready(function() {
        // Function to update the total amount based on the entered numeric value
        // Function to update the total amount and change based on the entered numeric value
        function updateTotalAmount() {
            var currentNumericValue = parseFloat($('#cashAmount').val()) || 0;
            var newTotal = originalTotalAmount - currentNumericValue;

            // If the user has paid more than the total amount, set total to 0
            if (currentNumericValue >= originalTotalAmount) {
                newTotal = 0;
            }

            // Calculate the change
            var changeAmount = calculateChange(newTotal);

            // Update the total amount and change
            $('#total-amount').text('₱' + newTotal.toFixed(2));

            // Only update the change amount if the user has paid more than the total
            if (currentNumericValue >= originalTotalAmount) {
                $('#change-amount').text('₱' + changeAmount.toFixed(2));
            } else {
                $('#change-amount').text('₱0.00');
            }
        }

        // Function to calculate the change
        function calculateChange(newTotal) {
            // Assuming the user has paid more than the total amount
            // Change is calculated as the difference between the paid amount and the total amount
            var cashAmount = parseFloat($('#cashAmount').val()) || 0;
            var changeAmount = Math.abs(cashAmount - originalTotalAmount);
            return Math.max(0, changeAmount); // Ensure change is not negative
        }
        // Event listener for numeric keypad buttons and keyboard input
        $(document).on('click keydown', '[data-numeric-keypad] .numeric-button', function(event) {
            var numericValue;

            if (event.type === 'click') {
                // Button click
                numericValue = $(this).text();
            } else if (event.type === 'keydown' && /^[0-9.]$/.test(event.key)) {
                // Keyboard input
                numericValue = event.key;
            }

            // Check if the clicked button is the "Confirm Payment" button
            if ($(this).hasClass('confirm-payment-button')) {

                // Execute your logic for the "Confirm Payment" button here
                generateReceipt();
            } else {
                // Append the clicked/typed value to the cashAmount input field
                $('#cashAmount').val(function(index, currentValue) {
                    return currentValue + numericValue;
                });

                // Update the total amount
                updateTotalAmount();
            }
        });




        // Event listener for the Clear button
        $('#numeric-keypadding .clear-button').on('click', function() {
            // Clear the cashAmount input field
            $('#cashAmount').val('');

            // Update the total amount (reset to the original subtotal)
            updateTotalAmount();
        });


        // Store the original total amount when the page loads
        originalTotalAmount = parseFloat($('#total-amount').text().replace('₱', '')) || 0;
    });

    var originalTotalAmount;

    $(document).ready(function() {

        // Store the original total amount when the page loads load sa loasd load loasd loasd laosdloasd  load laod load laodlalalod 
        var originalTotalAmount = parseFloat($('#total-amount').text().replace('₱', '')) || 0;
        $('#total-amount').data('original-total-amount', originalTotalAmount);
    });

    function clearCashAmount() {
        // Clear the cashAmount input field and the currentCashAmount variable
        currentCashAmount = '';
        $('#cashAmount').val('');

        // Reset the total amount to its original value
        $('#total-amount').text('₱' + originalTotalAmount.toFixed(2));
    }

    function generateReceipt() {
        // Fetch the cart items from local storage
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        var changeAmount = $('#change-amount').text();
        var originalTotalAmount = parseFloat($('#total-amount').data('original-total-amount')) || 0;
        var cashAmount = parseFloat($('#cashAmount').val()) || 0;

        if (cashAmount <= 0) {
            // Display an error message
            window.alert('Please enter a valid cash amount to confirm the payment.');
            return; // Exit the function if the amount is zero
        }

        if (cashAmount < originalTotalAmount) {
            // Display an error message
            window.alert('The entered cash amount is less than the total amount. Please enter a valid amount.');
            return; // Exit the function if the amount is less than the total
        }

        var receiptContent = '<div style="font-family: Arial, sans-serif;">';
        receiptContent += '<h2 style="text-align: center; margin-bottom: 20px;">Receipt</h2>';
        receiptContent += '<div style="margin-bottom: 10px;">';
        receiptContent += '<p><strong>Date:</strong> ' + new Date().toLocaleString() + '</p>';
        receiptContent += '</div>';
        receiptContent += '<div style="margin-bottom: 20px;">';
        receiptContent += '<table style="width: 100%; border-collapse: collapse;">';
        receiptContent += '<tr>';
        receiptContent += '<th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Item</th>';
        receiptContent += '<th style="text-align: center; padding: 8px; border: 1px solid #ddd;">Qty</th>';
        receiptContent += '<th style="text-align: right; padding: 8px; border: 1px solid #ddd;">Total</th>';
        receiptContent += '</tr>';

        // Iterate through cart items and add them to the receipt table
        cartItems.forEach(function(item) {
            receiptContent += '<tr>';
            receiptContent += '<td style="text-align: left; padding: 8px; border: 1px solid #ddd;">' + item.name + '</td>';
            receiptContent += '<td style="text-align: center; padding: 8px; border: 1px solid #ddd;">' + item.weight + '</td>';
            receiptContent += '<td style="text-align: right; padding: 8px; border: 1px solid #ddd;">₱' + item.price + '</td>';
            receiptContent += '</tr>';
        });

        receiptContent += '</table>';
        receiptContent += '</div>';
        receiptContent += '<div style="margin-top: 20px;">';
        receiptContent += '<p style="text-align: right;"><strong>Original Total Amount:</strong> ₱' + originalTotalAmount.toFixed(2) + '</p>';
        receiptContent += '<p style="text-align: right;"><strong>Entered Cash Amount:</strong> ₱' + cashAmount.toFixed(2) + '</p>';
        receiptContent += '<p style="text-align: right;"><strong>Change:</strong> ' + changeAmount + '</p>';
        receiptContent += '</div>';
        receiptContent += '</div>';
        receiptContent += '</div>'; // Close the receipt content div
        receiptContent += '<div class="print-button-container">';
        receiptContent += '<button class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>';
        receiptContent += '</div>';

        // Display the receipt content in the modal
        $('#receipt-content').html(receiptContent);

        // Show the receipt modal
        $('#receipt-container').modal('show');
    }
</script>
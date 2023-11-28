<style>

    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .container {
        display: block;
        width: 100%;
        background: #fff;
        max-width: 350px;
        padding: 25px;
        margin: 50px auto 0;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }

    .receipt_header {
        padding-bottom: 40px;
        border-bottom: 1px dashed #000;
        text-align: center;
    }

    .receipt_header h1 {
        font-size: 20px;
        margin-bottom: 5px;
        color: #000;
        text-transform: uppercase;
    }

    .receipt_header h1 span {
        display: block;
        font-size: 25px;
    }

    .receipt_header h2 {
        font-size: 14px;
        color: #727070;
        font-weight: 300;

    }

    body {

        background: #eee;
    }

    .print-only {
        font-family: Arial, sans-serif;
        font-size: 12px;
        max-width: 300px;
        /* Adjust the width based on your preference */
        margin: 0 auto;
    }

    .well {
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }

    .invoice-to ul {
        list-style-type: none;
        padding: 0;
    }

    .invoice-items table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .invoice-items th,
    .invoice-items td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }


    .recepit_cont {
        display: flex;
        justify-content: center;
        column-gap: 25px;
        font-weight: bold;
        font-size: 15px;
        color: #000;
    }

    .items {
        margin-top: 20px;
        color: #000;
    }

    h3 {
        color: #000;
        border-top: 1px dashed #000;
        padding-top: 10px;
        margin-top: 25px;
        text-align: center;
        text-transform: uppercase;
        font-size: 10px

    }

    .print-button {
        color: #000;
    }
</style>

<div class="card shadow" style="max-width: 2000px; margin: 0 auto; height: 100vh;">
    <div class="card-header text-center">
        <h2>Receipt</h2>
    </div>
    <div class="card-body" style="flex-grow: 1;">
        <div class="row">
            <!-- Left column for payment method -->
            <!-- Right column for total price, cash payment, and change -->
            <div class="receipt col-md-8 text-center">
                <div class="border p-3">
                    <div class="container bootdey">
                        <div class="row invoice row-printable">
                            <div class="col-md-10 mx-auto">
                                <!-- col-md-10 start here -->
                                <div class="panel panel-default plain" id="dash_0">
                                    <!-- Start .panel -->
                                    <div class="panel-body p30">
                                        <div class="row">
                                            <div class="col-lg-12 mx-auto">

                                                <!-- col-lg-12 start here -->
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
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <p id="generated-time"></p>
                                                </div>

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- col-lg-12 end here -->
                                </div>
                                <!-- End .row -->
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                    <!-- col-md-10 end here -->
                    <div class="invoice-footer mt25">
                        <p class="text-center"></p>
                        <a href="#" class="btn btn-default ml15" onclick="printDocument()">
                            <i class="fa fa-print mr5"></i> Print
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of receipt code -->
</div>
</div>
</div>
<!-- Numeric Keypad for Weight Input -->
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

    $(document).ready(function () {
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        var paymentTable = $('#payment-table');

        // Loop through cartItems and add them to the payment table
        cartItems.forEach(function (item) {
            var row = $('<tr></tr>');
            row.append($('<td class="per70 text-center">' + item.name + '</td>'));
            row.append($('<td class="per5 text-center">' + item.weight + '</td>')); // Display the weight
            row.append($('<td class="per25 text-center"> ₱' + item.price + '</td>'));
            paymentTable.append(row);
        });

        // Calculate and display the subtotal and total amounts
        var subtotal = 0;
        cartItems.forEach(function (item) {
            subtotal += parseFloat(item.price);
        });
        $('#subtotal-amount').text('₱' + subtotal.toFixed(2));
        $('#total-amount').text('₱' + subtotal.toFixed(2));
    });

    function clearCartItems() {
        cartItems = []; // Clear the cart items
        updateCartDisplay(); // Update the table (payment-table) in the HTML 
    }


    window.addEventListener('beforeunload', function (event) {

        localStorage.removeItem('cartItems');
        clearCartItems();
    });
    function updateGeneratedTime() {
        var currentDate = new Date();
        var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            timeZoneName: 'short'
        };

        var formattedDate = currentDate.toLocaleDateString('en-US', options);
        document.getElementById('generated-time').textContent = 'Generated on ' + formattedDate;
    }

    // Call the function initially 
    updateGeneratedTime();

    // Update the time every second
    setInterval(updateGeneratedTime, 1000);

    function printDocument() {
        // Hide the print button
        var printButton = document.getElementById('printButton');
        if (printButton) {
            printButton.style.display = 'none';
        }

        // Trigger the print dialog
        window.print();
    }
</script>
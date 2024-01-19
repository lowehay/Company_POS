<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .container {
        background: #f9f9f9;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: 50px auto 0;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .receipt_header {
        text-align: center;
        margin-bottom: 15px;
    }

    .receipt_header h1 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #333;
        text-transform: uppercase;
    }

    .receipt_header h2 {
        font-size: 14px;
        color: #777;
        font-weight: 300;
    }

    .receipt_body {
        margin-top: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: none;
        padding: 8px;
        text-align: left;
    }

    .recepit_cont,
    .cashpayment_cont,
    .change_cont {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }

    h3 {
        color: #333;
        border-top: 1px dashed #333;
        padding-top: 10px;
        margin-top: 15px;
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;
    }

    .print-button {
        color: #333;
        display: block;
        text-align: center;
        margin-top: 15px;
        font-size: 16px;
        cursor: pointer;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .container,
        .container * {
            visibility: visible;
        }

        .container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

<div class="container">
    <div class="receipt_header">
        <h1><i class="fas fa-shopping-basket"></i> COMPANY</h1>
        <h2>Prepared By: <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?></h2>
    </div>
    <div class="receipt_body">
        <div class="items">
            <table>
                <thead>
                    <th>ITEM NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </thead>
                <tbody id="itemTableBody"></tbody>
            </table>
        </div>
    </div>
    <div class="recepit_cont">
        <div>Total:</div>
        <div id="totalAmount"></div>
    </div>
    <div class="recepit_cont">
        <div>Payment Method:</div>
        <div id="paymentMethod"></div>
    </div>
    <div class="cashpayment_cont">
        <div>Cash Payment:</div>
        <div id="cashpayment"></div>
    </div>
    <div class="change_cont">
        <div>Change:</div>
        <div id="change"></div>
    </div>
    <h3>Reference No.: <span id="referenceNo"></span> | Date: <?php echo date('m/d/y'); ?></h3>
    <div class="print-button" id="printButton">
        <i class="fas fa-print"></i> Print
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve stored product data from localStorage
        var storedProducts = localStorage.getItem('paymentPageCartItems');
        var products = JSON.parse(storedProducts);

        // Display products in the table
        var itemTableBody = document.getElementById('itemTableBody');
        var totalAmount = 0;

        products.forEach(function(product) {
            var row = document.createElement('tr');
            row.innerHTML = '<td>' + product.productName + '</td>' +
                '<td>' + product.quantity + '</td>' +
                '<td>' + product.productPrice.toFixed(2) + '</td>';
            itemTableBody.appendChild(row);

            // Calculate total amount
            totalAmount += parseFloat(product.productPrice);
        });

        // Display total amount
        document.getElementById('totalAmount').textContent = '₱' + totalAmount.toFixed(2);

        // Retrieve and display payment method value
        var storedPaymentMethod = localStorage.getItem('selectedPaymentMethod');
        var capitalizedPaymentMethod = storedPaymentMethod.charAt(0).toUpperCase() + storedPaymentMethod.slice(1);
        document.getElementById('paymentMethod').textContent = '' + capitalizedPaymentMethod;

        // Retrieve stored payment data from localStorage
        var storedPaymentData = localStorage.getItem('paymentData');
        var paymentData = JSON.parse(storedPaymentData);

        // Display payment data
        document.getElementById('totalAmount').textContent = '₱' + paymentData.totalAmount;
        document.getElementById('cashpayment').textContent = '₱' + paymentData.cashPayment;
        document.getElementById('change').textContent = '₱' + paymentData.change;

        // Retrieve and display reference number
        var storedReferenceNo = localStorage.getItem('referenceNo');
        document.getElementById('referenceNo').textContent = storedReferenceNo;

        // Handle printing
        var printButton = document.getElementById('printButton');
        if (printButton) {
            printButton.addEventListener('click', function() {
                printReceipt();
            });
        }

        function printReceipt() {
            // Hide the print button before printing
            var printButton = document.getElementById('printButton');
            if (printButton) {
                printButton.style.display = 'none';
            }

            // Trigger the print dialog
            window.print();

            // Revert the display property after a short delay
            setTimeout(function() {
                if (printButton) {
                    printButton.style.display = 'block';
                }
            }, 1000); // Adjust the delay as needed
        }
        // Automatically trigger the print dialog
        printReceipt();
    });



    function clearCartItems() {
        cartItems = []; // Clear the cart items
        updateCartDisplay(); // Update the table (payment-table) in the HTML 
    }


    window.addEventListener('beforeunload', function(event) {

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
</script>
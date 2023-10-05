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
    }

    .numeric-button {
        font-size: 1.5rem;
        padding: 10px;
        text-align: center;
        background-color: #2a3b57;
        border: 1px solid #ccc;
        cursor: pointer;
        color: #fff;
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
                    <div class="card-body" id="buttong" style="height: 30vh; display: flex; flex-direction: column; justify-content: space-between; color: #FFF;">
                        <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #6096B4; color: #FFF;">Cash</button>
                        <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #93BFCF; color: #FFF;">Cheque</button>
                        <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #BDCDD6; color: #FFF;">Bank Account</button>
                    </div>
                </div>
            </div>

            <!-- Right column for total price, cash payment, and change -->
            <div class="col-md-8 text-center">
                <div class="border p-3">
                    <p class="total-price" style="font-size: 50px;">Total Price: ₱<span id="total">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Cash Payment: ₱<span id="cashPayment">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Remaining Balance: ₱<span id="remainingBalance">0.00</span></p>
                    <p class="total-price" style="font-size: 30px;">Change: ₱<span id="change">0.00</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Numeric Keypad for Weight Input -->
<div id="numeric-keypadding">
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
    <button class="btn btn-danger clear-button">Clear</button>
    <a href="javascript:void(0);" class="btn btn-secondary back-button" onclick="confirmBack()"> Back <i class="fas fa-arrow-left"></i></a>
    <a href="" class="btn btn-warning checkout-button"> Checkout <i class="fas fa-arrow-right"></i></a>
</div>

<div id="numeric-keypadding">
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
    <button class="btn btn-danger clear-button">Clear</button>
    <a href="javascript:void(0);" class="btn btn-secondary back-button" onclick="confirmBack()"> Back <i class="fas fa-arrow-left"></i></a>
    <a href="" class="btn btn-warning checkout-button"> Checkout <i class="fas fa-arrow-right"></i></a>
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

    $(document).ready(function() {
        var totalPriceForCheckout = localStorage.getItem('totalPriceForCheckout');
        var cashPayment = 0;
        var remainingBalance = 0;
        var change = 0;

        if (totalPriceForCheckout !== null && totalPriceForCheckout !== undefined) {
            $('#total').text(parseFloat(totalPriceForCheckout).toFixed(2));
        } else {
            $('#total').text('N/A');
        }

        // Add a confirmation message when the user tries to leave the page
        window.addEventListener('beforeunload', function(e) {
            var confirmMessage = "Are you sure you want to go back and make new transactions?";
            e.returnValue = confirmMessage; // Display the confirmation message
            return confirmMessage;
        });

        function updateRemainingBalance() {
            remainingBalance = parseFloat(totalPriceForCheckout) - cashPayment;
            $('#remainingBalance').text(remainingBalance.toFixed(2));

            // Calculate change when cash payment exceeds total price
            if (cashPayment >= parseFloat(totalPriceForCheckout)) {
                change = cashPayment - parseFloat(totalPriceForCheckout);
                $('#change').text(change.toFixed(2));
                remainingBalance = 0;
                $('#remainingBalance').text('0.00');
            } else {
                $('#change').text('0.00');
            }
        }

        // Numeric Keypad Logic (same as before)...
        $('#numeric-keypadding .numeric-button').on('click', function() {
            var digit = $(this).text();
            cashPayment = parseFloat(cashPayment.toString() + digit);
            $('#cashPayment').text(cashPayment.toFixed(2));
            updateRemainingBalance();
        });

        $('#numeric-keypadding .clear-button').on('click', function() {
            cashPayment = 0;
            $('#cashPayment').text('0.00');
            updateRemainingBalance();
        });


        $('.checkout-button').on('click', function() {
            if (cashPayment >= parseFloat(totalPriceForCheckout)) {
                alert('Payment successful!');
            } else {
                alert('Insufficient cash payment. Please enter the correct amount.');
            }
        });
    });
</script>
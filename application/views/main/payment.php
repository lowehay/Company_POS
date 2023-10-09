<style>
    #numeric-keypadding {
        position: absolute;
        bottom: 0;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 5px;
        width: 100%; /* Ensure it spans the full width */
        background-color: #ffffff; /* Add a background color for better visibility */
        padding: 10px; /* Add some padding for spacing */
        
    }

    .numeric-button {
        font-size: 1.5rem;
        padding: 10px;
        text-align: center;
        background-color: #2a3b57;
        border: 1px solid #ccc;
        cursor: pointer;
        color: #fff; /* Add text color for better visibility */
        height: 70px;
    }

    .numeric-button:hover {
        background-color: #ddd;
    }
    #buttong{
        height: 30vh; 
        display:flex; 
        flex-direction: column; 
         justify-content: space-between;"
         background-color: #FF5733; 
         color: #FFF;
    }

    .checkout-button {
        grid-column: span 1;
        background-color: #56C94E;
        color: #fff;
        height: 90px;
       
    }
    .btn-block{
        background-color: #ddd;
    }
    
</style>

<div class="card shadow" style="max-width: 2000px; margin: 0 auto; height: 50vh;">
    <div class="card-header text-center">
        <h2>Payment</h2>
    </div>
    <div class="card-body" style="flex-grow: 1;">
        <div class="row">
            <!-- Left column for payment method waw-->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment Method</h3>
                    </div>
                    <div class="card-body" id="buttong">
                    <button class="btn btn-primary btn-block" style="height: 80px; font-size: 20px; background-color: #D3D3D3; color: #000000; " id="cash-button">Cash</button>
                    <button class="btn btn-primary btn-block" style="height: 80px; font-size: 20px; background-color: #D3D3D3; color: #000000;">Cheque</button>
                    <button class="btn btn-primary btn-block" style="height: 80px; font-size: 20px; background-color: #D3D3D3; color: #000000;">Bank Account</button>
                    </div>
                </div>
            </div>
            <!-- Right column for total price -->
            <div class="col-md-8 text-center">
                <div class="border p-3">
                    <p class="total-price" style="font-size: 50px;">Total Price: ₱<span id="total">0.00</span></p>
                </div>
                <div id="cash-input" style="display: none;">
                    <input id="cash-amount" placeholder="Enter Cash Amount">
                  
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
    <button class="btn btn-secondary numeric-button">.</button> <!-- Dot Button -->
    <button class="btn btn-danger clear-button">Clear</button>
    <button class="btn btn-warning checkout-button">Checkout</button>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


   $(document).ready(function() {
        // Retrieve selected products and total price from localStorage
        var selectedProducts = JSON.parse(localStorage.getItem('selectedProducts'));
        var totalPrice = localStorage.getItem('totalPrice');

        // Display the total price
        if (totalPrice !== null) {
            $('#total').text(totalPrice);
        }

        // Display the selected products
        if (selectedProducts !== null && selectedProducts.length > 0) {
            var selectedProductsList = $('#selected-products-list');
            selectedProducts.forEach(function(product) {
                selectedProductsList.append('<li>' + product.name + ' - Weight: ' + product.weight + ' kg</li>');
            });
        }
    }); 

    $(document).ready(function() {
        // Add event listener to the Cash button
        $('#cash-button').click(function() {
            // Hide Cash button and show Cash input area
            $('#cash-input').show();
        });
      
    });


   // Add a variable to store the entered cash amount
// Add a variable to store the entered cash amount
var cashAmount = '';

$(document).ready(function() {
    // ... (your existing code)

    // Add event listener to the Cash button
    $('#cash-button').click(function() {
        // Hide Cash button and show Cash input area
        $('#cash-input').show();
    });

    // Event listener for numeric keypad buttons
    $('#numeric-keypadding .numeric-button').click(function() {
        var buttonValue = $(this).text();

        if (buttonValue === 'clear-button') {
            // Clear the cash amount
            cashAmount = '';
        } else if (buttonValue === 'Checkout') {
            // Handle checkout here, if needed
        } else {
            // Append the clicked numeric value to the cash amount
            cashAmount += buttonValue;
        }

        // Update the cash amount input field
        $('#cash-amount').val(cashAmount);

        // Calculate and update the new total price after deducting the entered cash amount
        var totalPrice = parseFloat($('#total').text().replace('₱', ''));
        var enteredAmount = parseFloat(cashAmount);
        var newTotalPrice = totalPrice - enteredAmount;

        // Ensure newTotalPrice is not negative
        if (newTotalPrice < 0) {
            newTotalPrice = 0;
        }

        // Update the total price on the page
        $('#total').text( + newTotalPrice.toFixed(2));

        // Enable or disable the Checkout button based on the new total price
        if (newTotalPrice <= 0) {
            $('.checkout-button').prop('disabled', false);
        } else {
            $('.checkout-button').prop('disabled', true);
        }
    });
});


        

</script>

    
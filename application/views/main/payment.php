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
    }

    .numeric-button:hover {
        background-color: #ddd;
    }
    #buttong{
        style="height: 40vh; display:
         flex; flex-direction: column; 
         justify-content: space-between;"
         background-color: #FF5733; 
         color: #FFF;
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
                    <div class="card-body" id="buttong">
                    <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #FF5733; color: #FFF;">Cash</button>
                    <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #33FF57; color: #FFF;">Cheque</button>
                    <button class="btn btn-primary btn-block" style="height: 100px; font-size: 20px; background-color: #3357FF; color: #FFF;">Bank Account</button>
                    </div>
                </div>
            </div>
            <!-- Right column for total price -->
            <div class="col-md-8 text-center">
                <div class="border p-3">
                    <p class="total-price" style="font-size: 50px;">Total Price: ₱<span id="total">0.00</span></p>
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
    <button class="btn btn-danger clear-button">.</button>
    <button class="btn btn-danger clear-button">Clear</button>
    <button class="btn btn-warning payment-button">Checkouts</button>
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

        // ... (existing code)
    }); 

</script>

    
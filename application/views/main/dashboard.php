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
                                        <div class="card-body" id="product">
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
                    <div class="card-body" id="card-ah">
                        <ul class="list-group" id="cart-items">
                            <!-- Cart items will be added here -->
                        </ul>
                        <p>Total: ₱<span id="total">0.00</span></p>
                    </div>
                     </div>
                                
                    
                </div>
                <div class="col-md-4" style="background-color: #ffffff;">
                        <div class="card shadow">
                            <div class="card-body" id="numpad">
                                <button class="numpad-button" data-value="1">1</button>
                                <button class="numpad-button" data-value="2">2</button>
                                <button class="numpad-button" data-value="3">3</button>
                                <button class="numpad-button" data-value="4">4</button>
                                <button class="numpad-button" data-value="5">5</button>
                                <button class="numpad-button" data-value="6">6</button>
                                <button class="numpad-button" data-value="7">7</button>
                                <button class="numpad-button" data-value="8">8</button>
                                <button class="numpad-button" data-value="9">9</button>
                                <button class="numpad-button" data-value="0">0</button>
                                <button class="numpad-button" id="numpad-cancel">Cancel</button>
                                <button class="numpad-button" id="numpad-enter">Enter</button>
                            </div>
                        </div>
                    </div>
            </div>         
        </div>
                <style>
                    #numpad{
                        width: 500px; /* Set the width of your card */
                        height: 150px; /* Set the height of your card */
                        background-color: #fff;
                        border: 1px solid #ccc;
                        position: absolute;
                        bottom: 100px; /* Adjust this value to cosntrol the distance from the bottom */
                        right: -800px; /* Adjust this value to control the distance from the right */
                        /* Add other styles for your card as needed */
                         display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 10px;
                        max-width: 200px;
                        margin: 0 auto;
                    }
                    .numpad {
 
}

.numpad-button {
  width: 60px;
  height: 60px;
  background-color: #fff;
  color: #333;
  font-size: 24px;
  border: 2px solid #333;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
}

.numpad-button:hover {
  background-color: #333;
  color: #fff;
}

/* Optional: Add shadow for a subtle touch */
.numpad-button:active {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
                    #card-ah{
                        max-height: 250px;
                        overflow-y: auto;
                    }
                    #product-list{
                        max-height: 550px;
                        overflow-y: auto;
                    }

                </style>
                        

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            // Get references to the product cards and cart items container
            var productCards = document.querySelectorAll(".product-card");
            var cartItemsContainer = document.getElementById("cart-items");
            var totalSpan = document.getElementById("total");

            // Function to add a product to the cart
            function addToCart(productName) {
                // Create a new item element
                var itemElement = document.createElement("div");
                itemElement.classList.add("cart-item");
                itemElement.innerHTML = `
                    <div class="cart-item-details">
                        <h5>${productName}</h5>
                        <span>Weight</span>
                        <button class="btn btn-danger btn-sm delete-button">Delete</button>
                    </div>
                    
                `;

            // Add the item to the cart
            cartItemsContainer.appendChild(itemElement);


            // Add a click event listener to the delete button
            var deleteButton = itemElement.querySelector(".delete-button");
            deleteButton.addEventListener("click", function () {
                itemElement.remove();
                // Update the total price when an item is deleted
                var currentTotal = parseFloat(totalSpan.innerText);
                totalSpan.innerText = (currentTotal - productPrice).toFixed(2);
            });
        }

            // Add click event listeners to each product card
            productCards.forEach(function (card) {
                card.addEventListener("click", function () {
                    var productName = card.getAttribute("data-product-name");
                    // Add the product to the cart
                    addToCart(productName);
                });
            });

    </script>

</body>
<style>
    .container {
        padding-top: 5px;
        padding-bottom: 20px;
    }

    .container h1 {
        font-size: 70px;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 16px;
    }

    .form-control {
        font-size: 16px;
    }

    .table {
        font-size: 16px;
    }

    .table th,
    .table td {
        padding: 10px;
    }

    .card-body {
        overflow: auto;
        /* Add this line to make the card body scrollable */
    }

    .btn-sm {
        font-size: 16px;
    }

    .total-cost {
        font-weight: bold;
    }
</style>

<div class="container">
    <h1 class="text-dark">Create Purchase Order</h1>
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to add this purchase order?')">
        <div class="row mb-3">
            <div class="col-12 col-sm-3">
                <label for="purchase_order_no" class="form-label">Purchase Order No</label>
                <input type="text" value="<?= $po_no ?>" name="purchase_order_no" readonly class="form-control form-control-sm">
            </div>
            <div class="col-12 col-sm-3">
                <label for="date_created" class="form-label">Date Created</label>
                <input type="text" id="date_created" name="date_created" value="<?= date('m-d-Y h:i A'); ?>" readonly class="form-control form-control-sm">
            </div>
            <div class="col-12 col-sm-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-control form-control-sm supplier-select selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Supplier" name="supplier_id" id="po_supplier" required>
                    <option value="" selected hidden>Select Supplier</option>
                    <?php foreach ($supplier as $supp) { ?>
                        <option value="<?= $supp->supplier_id ?>"><?= $supp->supplier_name ?> - <?= $supp->company_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-sm-3">
                <label for="payment_method" class="form-label">Payment Option</label>
                <select class="form-control form-control-sm selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Payment Method" name="payment_method" id="payment_method" required>
                    <option>Cash</option>
                    <option>Check</option>
                    <option>Credit Card</option>
                </select>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-bordered text-center" id="table_field">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Product Name</th>
                            <th style="width: 15%;">Quantity</th>
                            <th style="width: 15%;">Unit of Measure</th>
                            <th style="width: 20%;">Price</th>
                            <th style="width: 20%;">Total Cost</th>
                            <th style="width: 10%;">
                                <button type="button" class="btn btn-info" id="btn_po" onclick="addProductRow()"><i class="fas fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="row_content" id="row_product">
                        <tr>
                            <td>
                                <select class="form-control form-control-sm product-select selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Product" name="product_name[]" id="po_product_name" required>
                                    <option value="" selected disabled>Select Product</option>
                                    <!-- Product options will be dynamically populated using JavaScript -->
                                </select>
                                <input type="hidden" name="selected_product" id="selected_product" value="">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="number" name="po_product_quantity[]" id="po_product_quantity" required min="0">
                            </td>
                            <td>
                                <select class="form-control form-control-sm selectpicker" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Unit" name="product_unit[]" id="po_unit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    <option>Pcs</option>
                                    <option>Bottle</option>
                                    <option>box</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control form-control-sm product-cost-price" type="text" name="product_unitprice[]" id="product_cost" pattern="[0-9]+(\.[0-9]{1,2})?" title="Please enter a valid price number">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="text" name="total_price[]" id="total_price" readonly>
                            </td>
                            <td>
                                <button class="btn btn-danger remove-category" onclick="removeProductRow(this)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Grand Total Cost:</strong></td>
                            <td id="total_cost" class="total-cost">₱0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer bg-transparent text-end">
                <input type="submit" value="Create" name="btn_create_pr" id="submit_pr" class="btn btn-primary btn-sm">
                <a href="<?php echo site_url('main/purchase_order'); ?>"><input type="button" value="Back" class="btn btn-primary btn-sm btn_save"></a>
            </div>
        </div>
    </form>
</div>

<script>
    function addProductRow() {
        // Clone the first row (assuming it's your template row)
        var newRow = document.querySelector('.row_content tr:first-child').cloneNode(true);

        // Clear the input values in the new row
        newRow.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });

        // Clear the selected product in the new row
        newRow.querySelector('select[name="product_name[]"]').selectedIndex = 0;

        // Append the new row to the table
        document.querySelector('#row_product').appendChild(newRow);

        // Update product options based on selected supplier for the new row
        updateProductOptions(newRow);

        // Initialize the selectpicker for the new row
        $(newRow).find('.selectpicker').selectpicker();

        // Attach event listeners to calculate and update totals for the new row
        newRow.addEventListener('input', function(event) {
            if (event.target.matches('input[name="po_product_quantity[]"], input[name="product_unitprice[]"]')) {
                calculateTotalPrice(newRow);
            }

            // Add this block to update the price field when a product is selected for the new row
            if (event.target.matches('select[name="product_name[]"]')) {
                var selectedOption = event.target.options[event.target.selectedIndex];
                var priceField = newRow.querySelector('input[name="product_unitprice[]"]');
                priceField.value = selectedOption.getAttribute('data-price') || '';
                calculateTotalPrice(newRow);
            }
        });
    }


    // Function to calculate the total cost for a specific row
    function calculateTotalPrice(row) {
        var quantity = parseFloat(row.querySelector('input[name="po_product_quantity[]"]').value);
        var price = parseFloat(row.querySelector('input[name="product_unitprice[]"]').value);
        var total = quantity * price;

        if (!isNaN(total)) {
            row.querySelector('input[name="total_price[]"]').value = '₱' + total.toFixed(2); // Display with ₱ and two decimal places
        } else {
            row.querySelector('input[name="total_price[]"]').value = '₱0.00'; // Set a default value for NaN
        }

        updateGrandTotal();
    }

    // Function to update the grand total cost
    function updateGrandTotal() {
        var totalCostElements = document.querySelectorAll('input[name="total_price[]"]');
        var grandTotal = 0;

        totalCostElements.forEach(function(element) {
            var total = parseFloat(element.value.replace('₱', '').replace(',', '')); // Remove the ₱ sign and handle thousands separators
            if (!isNaN(total)) {
                grandTotal += total;
            }
        });

        var grandTotalField = document.querySelector('#total_cost');
        grandTotalField.textContent = '₱' + grandTotal.toFixed(2); // Display with ₱ and two decimal places
    }

    // Attach event listeners to calculate and update totals
    document.addEventListener('input', function(event) {
        if (event.target.matches('input[name="po_product_quantity[]"], input[name="product_unitprice[]"]')) {
            calculateTotalPrice(event.target.closest('tr'));
        }
    });

    document.addEventListener('input', function(event) {
        if (event.target.matches('input[name="po_product_quantity[]"], input[name="product_unitprice[]"]')) {
            calculateTotalPrice(event.target.closest('tr'));
        }

        // Add this block to update the price field when a product is selected
        if (event.target.matches('select[name="product_name[]"]')) {
            var selectedOption = event.target.options[event.target.selectedIndex];
            var priceField = event.target.closest('tr').querySelector('input[name="product_unitprice[]"]');
            priceField.value = selectedOption.getAttribute('data-price') || '';
        }
    });

    $(document).ready(function() {
        // Store original product options for later use
        var originalProductOptions = $('#po_product_name').html();

        // Update product options based on selected supplier
        $('#po_supplier').on('change', function() {
            var selectedSupplierId = $(this).val();
            var productOptions = '';

            // Filter products based on the selected supplier
            <?php foreach ($product as $pro) { ?>
                if ('<?= $pro->supplier_id ?>' == selectedSupplierId) {
                    productOptions += '<option value="<?= $pro->product_name ?>" data-price="<?= $pro->product_price ?>"><?= $pro->product_name ?></option>';
                }
            <?php } ?>

            // If no products for the selected supplier, show default message
            if (productOptions === '') {
                productOptions = '<option value="" selected disabled>No products available for the selected supplier</option>';
            }

            // Update the product select options
            $('#po_product_name').html(productOptions);

            // Refresh the SelectPicker
            $('#po_product_name').selectpicker('refresh');
        });

        // Initialize product options with the original options
        $('#po_supplier').trigger('change');
    });

    // ... Your existing JavaScript code ...
</script>
<style>
    .bold-label {
        font-weight: bold;
    }

    @media (max-width: 767px) {
        h1 {
            margin-left: 0;
        }
    }
</style>

<div class="container mt-3">
    <h4>Product Registration</h4>
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this product?\')')); ?>

                <div class="section">
                    <h5>Product Information</h5>
                    <div class="form-group col-md-3 d-inline-block">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label for="date_created" class="bold-label">Date Created</label>
                        <input type="text" id="date_created" name="date_created" value="<?= date('m-d-Y'); ?>" readonly class="form-control">
                    </div>

                    <div class="form-group col-md-5 d-inline-block">
                        <label class="bold-label">Product Name</label>
                        <input type="text" placeholder="Product Name" name="product_name" value="<?= set_value('product_name'); ?>" class="form-control" required>
                        <?= form_error('product_name'); ?>
                    </div>

                    <div class="form-group col-3 d-inline-block">
                        <label class="bold-label">Preferred Supplier</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-outline-secondary" title="Select Supplier" name="supplier_id" required>
                            <option value="" selected hidden>Select Supplier</option>
                            <?php foreach ($suppliers as $supp) { ?>
                                <option value="<?= $supp->supplier_id ?>"><?= $supp->supplier_name ?> - <?= $supp->company_name ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Product Category</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-outline-secondary" title="Select category" name="product_category" required>
                            <option value="" selected hidden>Select Product Category</option>
                            <?php foreach ($procat as $pc) { ?>
                                <option value="<?= $pc->product_category ?>"><?= $pc->product_category ?> </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">VAT</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-outline-secondary" title="Select category" name="product_vat" required>
                            <option value="" selected hidden>Select Tax</option>
                            <option>12%</option>
                            <option>Non-VAT</option>
                        </select>
                    </div>



                    <div class="form-group col-md-2 d-inline-block">
                        <label class="bold-label">Margin (%)</label>
                        <input type="number" placeholder="Margin" name="product_margin" min="0" value="10" class="form-control" id="product-margin" required>
                        <?= form_error('product_margin'); ?>
                    </div>


                </div>

                <div class="section">
                    <h5>Inventory Information</h5>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Inbound Threshold <i class="fa fa-question-circle" title="* Minimum quantity to trigger reordering"></i></label>
                        <input type="number" placeholder="Enter Quantity" name="product_inbound_threshold" min="0" value="<?= set_value('product_inbound_threshold'); ?>" class="form-control" id="product_inbound_threshold" required>
                        <?= form_error('product_inbound_threshold'); ?>
                    </div>

                    <div class="form-group col-md-2 d-inline-block">
                        <label class="bold-label">Shelf life <i class="fa fa-question-circle" title="* Maximum no. of days this product can be stored"></i></label>
                        <input type="number" placeholder="Enter No. of Days" name="product_shelf_life" min="0" value="<?= set_value('product_shelf_life'); ?>" class="form-control" id="product_shelf_life" required>
                        <?= form_error('product_shelf_life'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Recall Threshold <i class="fa fa-question-circle" title="* No. of days from expiry to be returned to the supplier"></i></label>
                        <input type="number" placeholder="Enter Quantity" name="product_recall_threshold" min="0" value="<?= set_value('product_recall_threshold'); ?>" class="form-control" id="product_recall_threshold" required>
                        <?= form_error('product_recall_threshold'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_quantity" value="<?= set_value('product_minimum_quantity'); ?>" class="form-control" id="product_minimum_quantity" required>
                        <?= form_error('product_minimum_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Required Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_required_quantity" value="<?= set_value('product_required_quantity'); ?>" class="form-control" id="product_required_quantity" required>
                        <?= form_error('product_required_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Maximum Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_maximum_quantity" value="<?= set_value('product_maximum_quantity'); ?>" class="form-control" id="product_maximum_quantity" required>
                        <?= form_error('product_maximum_quantity'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Order Quantity</label>
                        <input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_order_quantity" value="<?= set_value('product_minimum_order_quantity'); ?>" class="form-control" id="product_minimum_order_quantity" required>
                        <?= form_error('product_minimum_order_quantity'); ?>
                    </div>
                </div>

                <!--div class="form-group col-md-3 d-inline-block">
                    <label class="bold-label">Barcode per Piece</label>
                    <input type="text" placeholder="Barcode per Piece" name="product_barcode" min="0" value="<?= set_value('product_barcode'); ?>" class="form-control" id="product_barcode" required>
                    <//?= form_error('product_barcode'); ?>
                </div-->


                <div class="section">
                    <h5>Image</h5>
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="product_image" class="bold-label">Product Image</label>
                        <input type="file" id="product_image" name="product_image" value="<?= set_value('product_image'); ?>" class="form-control <?= form_error('product_image') ? 'is-invalid' : ''; ?>" required>
                        <span style="color: red;"><?= form_error('product_image'); ?></span>
                    </div>
                </div>

                <div class="section">
                    <h4>Barcode</h4>
                    <div class="card mb-4">

                        <div class="card-body">
                            <table class="table table-bordered text-center" id="table_field">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Unit</th>
                                        <th style="width: 15%;">Barcode</th>

                                        <th style="width: 20%;">Price</th>

                                        <th style="width: 10%;">
                                            <button type="button" class="btn btn-info" id="btn_po" onclick="addProductRow()"><i class="fas fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="row_content" id="row_product">
                                    <tr>
                                        <td>
                                            <select class="form-control form-control-sm" name="product_unit[]" id="product_unit" title="Please enter unit" required>
                                                <option value="" selected hidden>Select Unit</option>
                                                <?php foreach ($unit as $pro) { ?>
                                                    <option value="<?= $pro->unit ?>"><?= $pro->unit ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="selected_product" id="selected_product" value="">
                                        </td>

                                        <td>
                                            <input class="form-control form-control-sm " value="<?= set_value('barcode'); ?>" type="text" name="product_barcode[]" id="product_barcode" title="Please enter barcode" placeholder="Enter Barcode">


                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm product-cost-price" type="text" name="product_price[]" id="product_cost" pattern="[0-9]+(\.[0-9]{1,2})?" placeholder="Enter Price">

                                        </td>
                                        <td>
                                            <button class="btn btn-danger remove-category" onclick="removeProductRow(this)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer bg-transparent text-end">
                <div class="form-group col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>
<script>
    function addProductRow() {
        // Clone the first row (assuming it's your template row)
        var newRow = document.querySelector('.row_content tr:first-child').cloneNode(true);

        // Clear the input values in the new row
        newRow.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });

        // Append the new row to the table
        document.querySelector('#row_product').appendChild(newRow);
    }

    function removeProductRow(button) {
        // Get the parent row (the <tr> element) of the clicked button
        var row = button.closest('tr');

        // Check if there's only one row left, don't remove it
        var rowCount = document.querySelectorAll('.row_content tr').length;
        if (rowCount > 1) {
            // Remove the row from the table
            if (row) {
                row.remove();
            }
        } else {
            alert("You can't delete the last row.");
        }
    }
</script>
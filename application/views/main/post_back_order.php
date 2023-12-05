<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Post Back Order</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('main/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Goods Received</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->

<?php echo form_open_multipart('main/post_back_order_submit', array('onsubmit' => 'return confirm(\'Are you sure you want to post this back order?\')')); ?>
<main class="content">
    <div class="container-fluid">
        <!--start select catergory-->
        <div class="row mb-3">
            <!--start purchase request no-->
            <input type="hidden" value="<?= $bo_no ?>" name="back_order_no" readonly class="form-control form-control-sm">

            <div class="col-3">
                <label>Purchase Order No</label>
                <input type="text" value="<?= $code->purchase_order_no ?>" readonly class="form-control form-control-sm">
                <input type="hidden" name="po_id" value="<?= $select->purchase_order_id ?>">
            </div>
            <div class="col-3">
                <label>Suplier</label>
                <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $select->supplier_name ?>" readonly>
                <input type="hidden" value="<?= $select->supplier_id ?>" name="supplier_id">
            </div>
            <div class="col-3">
                <label>Date Received</label>
                <input type="text" value="<?= date('m-d-Y h:i A'); ?>" name="date_received" readonly class="form-control form-control-sm">
            </div>
            <!--start purchase request no-->
        </div>
        <!--Start Table-->

        <div class="card border-success mb-3" style="max-width:100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" id="card">
            <div class="card-body">
                <table class="table table-bordered" id="table_field">
                    <thead>

                        <tr>
                            <th style="width: 215px;" id="table_style">Product Name</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Total Quantity</th>
                            <th id="table_style">Received Quantity</th>
                            <th id="table_style">Price</th>
                            <th id="table_style">Total Cost</th>
                            <th id="table_style">Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody class="row_content" id="row_product">
                        <?php foreach ($view as $row) {
                        ?>
                            <tr>
                                <input type="hidden" name="gr_code[]" value="<?= $row->purchase_order_id ?> ">
                                <td>
                                    <input class="form-control form-control-sm" value="<?= $row->gr_product_name ?>" name="product[]" readonly>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" value="<?= $row->gr_unit ?>" name="unit[]" readonly>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" value="<?= $row->gr_unserved_quantity ?>" name="quantity[]" min="0" readonly>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="number" name="received_quantity[]" id="receive_quantity" min="0" max="<?= $row->gr_total_quantity - $row->gr_received_quantity ?>" required>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" value="<?= $row->product_unitprice ?>" id="price" name="product_unitprice[]">
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="number" name="total_price[]" id="total_price_display" readonly>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="date" name="expiry_date[]">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Grand Total Cost:</strong></td>
                            <td id="total_cost" class="total_cost">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer bg-transparent border-success text-end">
                <?php if ($row->status == "Received") { ?>


                <?php
                } else {
                ?>
                    <input type="submit" value="Post" name="btn_post_bo" id="submit_pr" class="btn btn-sm btn-primary">

                <?php
                } ?>
                <a href="<?php echo site_url('main/back_order'); ?>"><input type="button" value="Back" class=" btn btn-primary btn-sm  btn_save"></a>
            </div>
            </ddiv>
            </form>
        </div>
</main>
<script>
    $(document).ready(function() {
        $('input[id^="receive_quantity"], input[id^="price"]').on('input', function() {
            var quantity = $(this).closest('tr').find('input[id^="receive_quantity"]').val();
            var price = $(this).closest('tr').find('input[id^="price"]').val();
            var totalQuantity = quantity;
            var totalPrice = (quantity * price).toFixed(2); // round to 2 decimal places
            $(this).closest('tr').find('input[id^="total_quantity"]').val(totalQuantity);
            $(this).closest('tr').find('input[id^="total_price"]').val(totalPrice);
            $(this).closest('tr').find('td[id^="total_price_display"]').text(totalPrice);
        }).trigger('input');
    });
</script>
<script>
    $(document).ready(function() {
        // Listen for changes in any relevant fields
        $('input[name="received_quantity[]"], input[name="product_unitprice[]"]').on('input', function() {
            var total_cost = 0;
            // Loop through all received_quantity and price fields
            $('input[name="received_quantity[]"]').each(function(index) {
                var received_quantity = parseInt($(this).val()) || 0;
                var product_unitprice = parseFloat($('input[name="product_unitprice[]"]').eq(index).val()) || 0;
                var cost = received_quantity * product_unitprice;
                total_cost += cost;
                // Update the cost for this row in the table
                $(this).parent().siblings('.cost').text(cost.toFixed(2));
            });
            // Update the total cost in the table footer
            $('#total_cost').text(total_cost.toFixed(2));
        });

        // Trigger the input event on page load
        $('input[name="received_quantity[]"], input[name="product_unitprice[]"]').trigger('input');
    });
</script>
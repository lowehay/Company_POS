<div class="container">
    <h4 class="text-white">View Purchase Request</h4>
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to add this purchase order?')">
        <div class="row mb-3">
            <div class="col-12 col-sm-3">
                <label for="purchase_order_no" class="form-label text-white">Purchase Request No</label>
                <input type="text" value=" <?= $code->purchase_order_no ?>" name="purchase_order_no" readonly class="form-control form-control-sm">
            </div>
            <div class="col-12 col-sm-3">
                <label for="date_created" class="form-label text-white">Date Created</label>
                <input type="text" id="date_created" name="date_created" value="<?= $code->date_created ?>" readonly class="form-control form-control-sm">
            </div>
            <div class="col-12 col-sm-3">
                <label for="supplier_id" class="form-label text-white">Supplier</label>
                <input type="text" id="supplier_id" name="supplier_id" value="<?= $select->supplier_name ?>" readonly class="form-control form-control-sm">
            </div>
            <div class="col-12 col-sm-3">
                <label for="payment_method" class="form-label text-white">Payment Method</label>
                <input type="text" id="payment_method" name="payment_method" value="<?= $code->payment_method ?>" readonly class="form-control form-control-sm">
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-bordered" id="table_field">
                    <thead>

                        <tr>
                            <th id="table_style">Product Name</th>
                            <th id="table_style">Quantity</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($view as $row) {
                        ?>
                            <tr>
                                <td><?= $row->product_name; ?></td>
                                <td><?= $row->po_product_quantity; ?></td>
                                <td><?= $row->product_unit; ?></td>
                                <td>₱<?= $row->product_unitprice; ?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Total Cost:</strong></td>
                            <td id="total_cost" class="total_cost">₱<?= $row->total_cost; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer bg-transparent text-end">
                <span class="badge bg-warning float-start" style="font-size: 1.2em;"><?= ucfirst($row->status) ?></span>
                <?php if ($row->status == "Received" || $row->status == "cancelled" || $row->status == "To Be Received" || $row->status == "Back Order") { ?>
                    <!-- Don't show the approve and cancel buttons if the PO is already received, cancelled, or on back order -->
                <?php } else { ?>
                    <a class="btn btn-success btn-sm" href="<?= site_url('main/approved_po/' . $row->purchase_order_no_id); ?>" onclick="return confirm('Are you sure you want to approve this PO?')" style="color:white; padding-left:6px;"><i class="fas  fa-check"></i> Approve</a>
                <?php } ?>

                <?php if ($row->status == "Received" || $row->status == "cancelled" || $row->status == "To Be Received" || $row->status == "Back Order") { ?>
                    <!-- Don't show the approve and cancel buttons if the PO is already received, cancelled, or on back order -->
                <?php } else { ?>
                    <a class="btn btn-danger btn-sm" href="<?= site_url('main/cancel_po/' . $row->purchase_order_no_id); ?>" onclick="return confirm('Are you sure you want to cancel this PO?')" style="color:white; padding-left:6px;"><i class="fas fa-ban"></i> Cancel</a>
                <?php } ?>
                <a class="btn btn-secondary btn-sm" href="<?= base_url('main/print_purchase_order/' . $row->purchase_order_no_id); ?>"><i class="fas fa-print"></i> Print</a>
                <a class="btn btn-secondary btn-sm" href="<?= base_url('main/purchase_order') ?>"><i class="fas fa-reply"></i> back</a>
            </div>
        </div>
    </form>
</div>
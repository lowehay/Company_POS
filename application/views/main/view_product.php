<style>
    label {
        font-weight: bold;
    }

    .bold-label {
        font-weight: bold;
    }

    .section {
        margin-bottom: 20px;
    }
</style>

<div class="container mt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-light">View Product</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Product Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="section">
                    <div class="form-group col-md-3 d-inline-block">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <p><?= $product->product_code; ?></p>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label for="date_created" class="bold-label">Date Updated</label>
                        <p><?= date('m-d-Y'); ?></p>
                    </div>

                    <div class="form-group col-md-5 d-inline-block">
                        <label class="bold-label">Product Name</label>
                        <p><?= $product->product_name; ?></p>
                        <?= form_error('product_name'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Preferred Supplier</label>
                        <p><?= $select->supplier_name; ?> - <?= $select->company_name; ?></p>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Barcode</label>
                        <p><?= $product->product_barcode; ?></p>
                        <?= form_error('product_barcode'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Product Category</label>
                        <p><?= $product->product_category; ?></p>
                    </div>

                    <div class="form-group col-md-2 d-inline-block">
                        <label class="bold-label">Margin (%)</label>
                        <p><?= $product->product_margin; ?></p>
                        <?= form_error('product_margin'); ?>
                    </div>

                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">VAT</label>
                        <p><?= $product->product_vat; ?></p>
                    </div>
                </div>
                <div class="section">
                    <h4>Inventory Information</h4>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Inbound Threshold</label>
                        <p><?= $product->product_inbound_threshold; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Shelf Life</label>
                        <p><?= $product->product_shelf_life; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Recall Threshold</label>
                        <p><?= $product->product_recall_threshold; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Quantity</label>
                        <p><?= $product->product_minimum_quantity; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Required Quantity</label>
                        <p><?= $product->product_required_quantity; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Maximum Quantity</label>
                        <p><?= $product->product_maximum_quantity; ?></p>
                    </div>
                    <div class="form-group col-md-3 d-inline-block">
                        <label class="bold-label">Minimum Order Quantity</label>
                        <p><?= $product->product_minimum_order_quantity; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-left">
                <a class="btn btn-secondary" href="<?= base_url('main/product') ?>">
                    <i class="fas fa-reply"></i> Back to Product
                </a>
            </div>
        </div>
    </div>
</div>
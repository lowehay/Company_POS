<style>
    .bold-label {
        font-weight: bold;
    }

    h1 {
        text-align: center;
    }

    .card {
        width: 95%;
        margin: 20px auto;
    }

    .card-body {
        padding: 20px;
    }
</style>

<div class="container mt-2x">
    <h1>Add Product</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <?php if ($this->session->flashdata('add_product_submit')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->flashdata('add_product_submit'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('add_product_error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('add_product_error'); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this product?\')')); ?>

                    <div class="form-group">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" class="form-control form-control-sm text" readonly>
                    </div>

                    <div class="form-group">
                        <label for="product_name" class="bold-label">Product Name</label>
                        <input type="text" id="product_name" placeholder="Product Name" name="product_name" value="<?php echo set_value('product_name'); ?>" class="form-control <?php echo form_error('product_name') ? 'is-invalid' : ''; ?>">
                        <span class="text-danger"><?php echo form_error('product_name'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="product_price" class="bold-label">Product Price</label>
                        <input type="number" id="product_price" placeholder="Product Price" name="product_price" value="<?php echo set_value('product_price'); ?>" class="form-control <?php echo form_error('product_price') ? 'is-invalid' : ''; ?>">
                        <span class="text-danger"><?php echo form_error('product_price'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="product_image" class="bold-label">Product Image</label>
                        <input type="file" id="product_image" name="product_image" value="<?php echo set_value('product_image'); ?>" class="form-control <?php echo form_error('product_image') ? 'is-invalid' : ''; ?>">
                        <span class="text-danger"><?php echo form_error('product_image'); ?></span>
                    </div>

                    <!-- Add the other form fields in a similar manner -->

                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>
                        <a class="btn btn-secondary" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
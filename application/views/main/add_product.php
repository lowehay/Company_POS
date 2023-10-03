<!-- views/add_product.php -->
<style>
    .bold-label {
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->

            <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this product?\')')); ?>
            <div class="form-group">
                <label for="product_code" class="bold-label">Product Code</label>
                <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" class="form-control form-control-sm text" readonly>
            </div>
            <div class="form-group">
                <label for="product_name" class="bold-label">Product Name</label>
                <input type="text" id="product_name" placeholder="Product Name" name="product_name" value="<?php echo set_value('product_name'); ?>" class="form-control <?php echo form_error('product_name') ? 'is-invalid' : ''; ?>">
                <span style="color: red;"><?php echo form_error('product_name'); ?></span>
            </div>
            <div class="form-group">
                <label for="product_price" class="bold-label">Product Price</label>
                <input type="number" id="product_price" placeholder="product_price Name" name="product_price" value="<?php echo set_value('product_price'); ?>" class="form-control <?php echo form_error('product_price') ? 'is-invalid' : ''; ?>">
                <span style="color: red;"><?php echo form_error('product_price'); ?></span>
            </div>
            <div class="form-group">
                <label for="product_image" class="bold-label">Product Image</label>
                <input type="file" id="product_image" name="product_image" value="<?php echo set_value('product_image'); ?>" class="form-control <?php echo form_error('product_image') ? 'is-invalid' : ''; ?>">
                <span style="color: red;"><?php echo form_error('product_image'); ?></span>
            </div>
            <!-- Add the other form fields in a similar manner -->
            <div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear</button>
                <a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
            </div>
            </form>
        </div>
    </div>
</div>
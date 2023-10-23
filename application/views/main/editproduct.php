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

<div class="container mt-2">
	<h1>Edit Product</h1>

	<!-- Flash Messages -->
	<?= $this->session->flashdata('add_user_submit'); ?>
	<?= $this->session->flashdata('add_user_error'); ?>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow">
				<div class="card-body">
					<?= form_open_multipart('main/edit_product_submit/' . $product->product_id, array('onsubmit' => 'return confirm(\'Are you sure you want to update this product?\')')); ?>

					<div class="form-group">
						<label for="product_code" class="bold-label">Product Code</label>
						<input type="text" id="product_code" name="product_code" class="form-control <?php echo form_error('product_code') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_code', $product->product_code); ?>" readonly>
					</div>

					<div class="form-group">
						<label for="product_name" class="bold-label">Product Name</label>
						<input type="text" id="product_name" name="product_name" class="form-control <?php echo form_error('product_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_name', $product->product_name); ?>">
						<?php echo form_error('product_name'); ?>
					</div>

					<div class="form-group">
						<label for="product_price" class="bold-label">Product Price</label>
						<input type="number" id="product_price" name="product_price" class="form-control <?php echo form_error('product_price') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_price', $product->product_price); ?>">
						<?php echo form_error('product_price'); ?>
					</div>

					<div class="form-group">
						<label for="product_image" class="bold-label">Product Image</label>
						<input type="file" id="product_image" name="product_image" class="form-control <?php echo form_error('product_image') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_image', $product->product_image); ?>">
						<?php echo form_error('product_image'); ?>
					</div>

					<input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
					<!-- Add the other form fields in a similar manner -->

					<div class="mt-4">
						<button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
						<a class="btn btn-secondary" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>
					</div>

					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
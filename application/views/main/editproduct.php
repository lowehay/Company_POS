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

	<h4>Edit Product</h4>

	<!-- Flash Messages -->
	<?= $this->session->flashdata('add_user_submit'); ?>
	<?= $this->session->flashdata('add_user_error'); ?>

	<div class="row justify-content-center">

		<div class="card">
			<div class="card-body">
				<?= form_open_multipart('main/edit_product_submit/' . $product->product_id, array('onsubmit' => 'return confirm(\'Are you sure you want to update this product?\')')); ?>
				<div class="section">
					<h5>Product Information</h5>
					<div class="form-group col-md-3 d-inline-block">
						<label for="product_code" class="bold-label">Product Code</label>
						<input type="text" id="product_code" name="product_code" value="<?= set_value('product_code', $product->product_code); ?>" class="form-control" readonly>

					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label for="date_created" class="bold-label">Date Updated</label>
						<input type="text" id="date_created" name="date_created" value="<?= date('m-d-Y'); ?>" readonly class="form-control">
					</div>

					<div class="form-group col-md-5 d-inline-block">
						<label class="bold-label">Product Name</label>
						<input type="text" placeholder="Product Name" name="product_name" value="<?= set_value('product_name', $product->product_name); ?>" class="form-control" required>
						<?= form_error('product_name'); ?>
						<?php $productname = $product->product_name; ?>

					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Preferred Supplier</label>
						<select class="form-control" data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Supplier" name="supplier_id" required>
							<option class="text-info invisible" value="<?= $select->supplier_id ?>"><?= $select->supplier_name ?> - <?= $select->company_name ?></option>
							<?php foreach ($supplier as $supp) { ?>
								<option value="<?= $supp->supplier_id ?>"><?= $supp->supplier_name ?> - <?= $supp->company_name ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Product Category</label>
						<select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" name="product_category" required>
							<option class="text-info invisible" value="<?= $product->product_category ?>"><?= $product->product_category ?></option>
							<?php foreach ($procat as $pc) {
								echo '<option value="' . $pc->product_category . '">' . $pc->product_category . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">VAT</label>
						<select class="form-control" name="product_vat" required>
							<option class="text-info invisible" value="<?= $product->product_vat ?>"><?= $product->product_vat ?></option>
							<option>12%</option>
							<option>Non-VAT</option>
						</select>
					</div>

					<div class="form-group col-md-2 d-inline-block">
						<label class="bold-label">Margin (%)</label>
						<input type="number" placeholder="Margin" value="<?= set_value('product_margin', $product->product_margin); ?>" name="product_margin" min="0" value="10" class="form-control" id="product-margin" required>
						<?= form_error('product_margin'); ?>
					</div>


				</div>

				<div class="section">
					<h5>Inventory Information</h5>
					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Inbound Threshold <i class="fa fa-question-circle" title="* Minimum quantity to trigger reordering"></i></label>
						<input type="number" placeholder="Enter Quantity" name="product_inbound_threshold" min="0" value="<?= set_value('product_inbound_threshold', $product->product_inbound_threshold); ?>" class="form-control" id="product_inbound_threshold" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
						<?= form_error('product_inbound_threshold'); ?>
					</div>

					<div class="form-group col-md-2 d-inline-block">
						<label class="bold-label">Shelf life <i class="fa fa-question-circle" title="* Maximum no. of days this product can be stored"></i></label>
						<input type="number" placeholder="Enter No. of Days" name="product_shelf_life" min="0" value="<?= set_value('product_shelf_life', $product->product_shelf_life); ?>" class="form-control" id="product_shelf_life" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
						<?= form_error('product_shelf_life'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Recall Threshold <i class="fa fa-question-circle" title="* No. of days from expiry to be returned to the supplier"></i></label>
						<input type="number" placeholder="Enter Quantity" name="product_recall_threshold" min="0" value="<?= set_value('product_recall_threshold', $product->product_recall_threshold); ?>" class="form-control" id="product_recall_threshold" pattern="[1-9][0-9]*([.,][0-9]+)?" title="Please enter a valid number" required>
						<?= form_error('product_recall_threshold'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Minimum Quantity</label>
						<input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_quantity" value="<?= set_value('product_minimum_quantity', $product->product_minimum_quantity); ?>" class="form-control" id="product_minimum_quantity" required>
						<?= form_error('product_minimum_quantity'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Required Quantity</label>
						<input type="number" placeholder="Enter Quantity" min="0" name="product_required_quantity" value="<?= set_value('product_required_quantity', $product->product_required_quantity); ?>" class="form-control" id="product_required_quantity" required>
						<?= form_error('product_required_quantity'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Maximum Quantity</label>
						<input type="number" placeholder="Enter Quantity" min="0" name="product_maximum_quantity" value="<?= set_value('product_maximum_quantity', $product->product_maximum_quantity); ?>" class="form-control" id="product_maximum_quantity" required>
						<?= form_error('product_maximum_quantity'); ?>
					</div>

					<div class="form-group col-md-3 d-inline-block">
						<label class="bold-label">Minimum Order Quantity</label>
						<input type="number" placeholder="Enter Quantity" min="0" name="product_minimum_order_quantity" value="<?= set_value('product_minimum_order_quantity', $product->product_minimum_order_quantity); ?>" class="form-control" id="product_minimum_order_quantity" required>
						<?= form_error('product_minimum_order_quantity'); ?>
					</div>
				</div>

				<div class="section">
					<h5>Image</h5>
					<div class="form-group col-md-6 d-inline-block">
						<label for="product_image" class="bold-label">Product Image</label>
						<input type="file" id="product_image" name="product_image" value="<?= set_value('product_image'); ?>" class="form-control <?= form_error('product_image') ? 'is-invalid' : ''; ?>">
						<span style="color: red;"><?= form_error('product_image'); ?></span>
					</div>
				</div>
			</div>
			<input type="hidden" name="product_id" value="<?= $product->product_id; ?>">
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
										<button type="button" class="btn btn-info" id="btn_po"><i class="fas fa-plus"></i></button>
									</th>
								</tr>
							</thead>
							<tbody class="row_content" id="row_product">
								<?php foreach ($barcodes as $bar) :
									if ($productname === $bar->product_name) : ?>
										<tr>
											<td>
												<select class="form-control form-control-sm" name="product_unit[]" id="product_unit" title="Please enter unit" required>
													<option select hidden><?= $bar->unit ?></option>
													<?php foreach ($unit as $pro) { ?>
														<option value="<?= $pro->unit ?>"><?= $pro->unit ?></option>
													<?php } ?>
												</select>
												<input type="hidden" name="selected_product" id="selected_product" value="">
											</td>
											<td>
												<input class="form-control form-control-sm " value="<?= set_value('barcode', $bar->barcode); ?>" type="text" name="product_barcode[]" id="product_barcode" title="Please enter barcode" placeholder="Enter Barcode">
											</td>
											<td>
												<input class="form-control form-control-sm product-cost-price" value="<?= set_value('barcode', $bar->price); ?>" type="text" name="product_price[]" id="product_cost" pattern="[0-9]+(\.[0-9]{1,2})?" placeholder="Enter Price">
											</td>
											<td>
												<button class="btn btn-danger remove-category" onclick="removeProductRow(this)"><i class="fas fa-trash"></i></button>
											</td>
										</tr>
										<input type="hidden" name="barcode_id" value="<?= $barcode->barcode_id; ?>">
									<?php endif; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

				</div>
				<div class="card-footer bg-transparent text-end">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
					<a class="btn btn-secondary btn-sm" href="<?= base_url('main/product') ?>"><i class="fas fa-reply"></i> Back</a>

				</div>
			</div>

		</div>

	</div>

</div>
<script>
	$(document).on('click', '#btn_po', function() {

		var selectedProduct = $('select[name="product_unit[]"]').last().val();
		var productAlreadyExists = false;

		// Check if the selected product already exists in the table
		$('select[name="product_unit[]"]').not(':last').each(function() {
			if ($(this).val() == selectedProduct) {
				productAlreadyExists = true;
			}
		});

		if (productAlreadyExists) {
			toastr.error('This unit has already been added.');
			return;
		}

		var newRow = '<tr>' +
			'<td>' +
			'<select class="form-control form-control-sm" name="product_unit[]" title="Please enter unit" required>' +
			'<option selected hidden>Select Unit</option>' +
			'<?php foreach ($unit as $pro) { ?>' +
			'<option value="<?= $pro->unit ?>"><?= $pro->unit ?></option>' +
			'<?php } ?>' +
			'</select><input type="hidden" name="selected_product" class="selected_product" value=""></td>' +
			'<td>' +
			'<input class="form-control form-control-sm " placeholder="Enter Barcode" type="text" name="product_barcode[]" title="Please enter barcode" placeholder="Enter Barcode">' +
			'</td>' +
			'<td>' +
			'<input class="form-control form-control-sm product-cost-price" placeholder="Enter Price" type="text" name="product_price[]" pattern="[0-9]+(\.[0-9]{1,2})?" placeholder="Enter Price">' +
			'</td>' +
			'<td>' +
			'<button class="btn btn-danger remove-category" onclick="removeProductRow(this)"><i class="fas fa-trash"></i></button>' +
			'</td>' +
			'</tr>';

		// Append the new row to the table
		$('#table_field tbody').append(newRow);

	});

	function removeProductRow(button) {
		// Remove the parent row of the clicked button
		$(button).closest('tr').remove();
	}
</script>
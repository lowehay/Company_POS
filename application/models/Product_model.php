<?php

class Product_model extends CI_Model
{

	function product_code()
	{
		$year = date('Y');

		$prefix = "P-";

		$query =  $this->db->query("SELECT max(product_code) as max_product_code FROM product where product_code LIKE '{$prefix}%'");
		$result = $query->row();


		if ($result->max_product_code) {
			$next_product_code = ++$result->max_product_code;
		} else {
			$next_product_code = $prefix . '0001';
		}
		return $next_product_code;
	}

	function insert_product($image_file_name)
	{
		$product_code = (string) $this->input->post('product_code');
		$product_name = (string) $this->input->post('product_name');
		$product_margin = (float) $this->input->post('product_margin'); // Convert to float for calculations
		$product_vat = (string) $this->input->post('product_vat');
		$product_category = (string) $this->input->post('product_category');
		$supplier_id = (string) $this->input->post('supplier_id');
		$product_inbound_threshold = (string) $this->input->post('product_inbound_threshold');
		$product_shelf_life = (string) $this->input->post('product_shelf_life');
		$product_recall_threshold = (string) $this->input->post('product_recall_threshold');
		$product_minimum_quantity = (string) $this->input->post('product_minimum_quantity');
		$product_required_quantity = (string) $this->input->post('product_required_quantity');
		$product_maximum_quantity = (string) $this->input->post('product_maximum_quantity');
		$product_minimum_order_quantity = (string) $this->input->post('product_minimum_order_quantity');
		$product_price = (float) $this->input->post('product_price'); // Convert to float for calculations
		$product_quantity = (string) $this->input->post('product_quantity');



		// Calculate selling price based on product margin and product price
		$product_sellingprice = $product_price + ($product_price * $product_margin);

		$product_unit =  $this->input->post('product_unit[]');
		$product_barcode =  $this->input->post('product_barcode[]');
		$product_price = $this->input->post('product_price[]');

		$data = array(
			'product_code' => $product_code,
			'product_name' => $product_name,

			'product_dateadded' => date('Y-m-d H:i:s'),
			'product_margin' => $product_margin,
			'product_vat' => $product_vat,
			'product_category' => $product_category,
			'supplier_id' => $supplier_id,
			'product_inbound_threshold' => $product_inbound_threshold,
			'product_shelf_life' => $product_shelf_life,
			'product_recall_threshold' => $product_recall_threshold,
			'product_minimum_quantity' => $product_minimum_quantity,
			'product_required_quantity' => $product_required_quantity,
			'product_maximum_quantity' => $product_maximum_quantity,

			'product_image' => $image_file_name,
			'product_price' => $product_sellingprice, // Add the calculated selling price to the data array


		);

		$response = $this->db->insert('product', $data);

		if ($response) {
			$last_product_id = $this->db->insert_id();

			foreach ($product_unit as $index => $product_unit) {
				$arr_unit = $product_unit;
				$arr_barcode = $product_barcode[$index];
				$arr_price = $product_price[$index];

				// Insert data into barcode table
				$data_barcode = [

					'unit' => $arr_unit,
					'product_id' => $last_product_id,
					'product_name' => $product_name,
					'barcode' => $arr_barcode,
					'price' => $arr_price,
				];
				$this->db->insert('barcode', $data_barcode);
			}
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}



	function get_all_product()
	{
		$this->db->where('isDelete', 'no');
		$query = $this->db->get('product');
		$result = $query->result();

		return $result;
	}
	function get_product($product_id)
	{
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('product');
		$row = $query->row();

		return $row;
	}

	function update_product($product_id, $update_image)
	{

		$product_code = (string) $this->input->post('product_code');
		$product_name = (string) $this->input->post('product_name');
		$supplier_id = (string) $this->input->post('supplier_id');
		$product_category = (string) $this->input->post('product_category');
		$product_margin = (string) $this->input->post('product_margin');
		$product_vat = (string) $this->input->post('product_vat');
		$product_inbound_threshold = (string) $this->input->post('product_inbound_threshold');
		$product_shelf_life = (string) $this->input->post('product_shelf_life');
		$product_recall_threshold = (string) $this->input->post('product_recall_threshold');
		$product_minimum_quantity = (string) $this->input->post('product_minimum_quantity');
		$product_required_quantity = (string) $this->input->post('product_required_quantity');
		$product_maximum_quantity = (string) $this->input->post('product_maximum_quantity');
		$product_dateadded = (string) $this->input->post('product_dateadded');
		$product_minimum_order_quantity = (string) $this->input->post('product_minimum_order_quantity');



		// Initialize the product_image variable
		$product_image = '';


		// Check if a new image file is uploaded or if we should retain the existing image
		if ($update_image) {
			$config['upload_path']   = './assets/images/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size']      = 2048;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('product_image')) {
				$image_data = $this->upload->data();
				$product = $this->get_product($product_id);

				// Delete the old image file if it exists
				if ($product && !empty($product->product_image)) {
					unlink('./assets/images/' . $product->product_image);
				}

				// Generate a unique filename based on the product name
				$product_name = $this->input->post('product_name');
				$unique_filename = strtolower(str_replace(' ', '', $product_name)) . '' . $product_id . '_' . time() . $image_data['file_ext'];

				// Rename the uploaded file to the unique filename
				$new_path = './assets/images/' . $unique_filename;
				rename($image_data['full_path'], $new_path);

				// Use the generated unique filename
				$product_image = $unique_filename;
			} else {
				// Handle image upload error
				$error_message = 'Image upload failed: ' . $this->upload->display_errors();
				$this->session->set_flashdata('error', $error_message);
				return FALSE;
			}
		} else {
			// If no new image is uploaded, retain the existing image filename
			$product = $this->get_product($product_id);
			$product_image = $product->product_image;
		}

		// Update product data in the database
		$data = array(
			'product_code' => $product_code,
			'product_name' => $product_name,
			'supplier_id' => $supplier_id,
			'product_category' => $product_category,
			'product_margin' => $product_margin,
			'product_vat' => $product_vat,
			'product_inbound_threshold' => $product_inbound_threshold,
			'product_shelf_life' => $product_shelf_life,
			'product_recall_threshold' => $product_recall_threshold,
			'product_minimum_quantity' => $product_minimum_quantity,
			'product_required_quantity' => $product_required_quantity,
			'product_maximum_quantity' => $product_maximum_quantity,
			'product_minimum_order_quantity' => $product_minimum_order_quantity,
			'product_dateadded' => $product_dateadded,
			'product_image' => $product_image, // Update the product image filename
		);

		$this->db->where('product_id', $product_id);
		$response = $this->db->update('product', $data);

		if ($response) {
			return $product_id;
		} else {
			return FALSE;
		}
	}


	function update_barcode($product_id)
	{

		$product_name = (string) $this->input->post('product_name');

		$product_unit = $this->input->post('product_unit[]');
		$product_barcode = $this->input->post('product_barcode[]');
		$product_price = $this->input->post('product_price[]');

		foreach ($product_unit as $index => $units) {
			$arr_unit = $units;
			$arr_barcode = $product_barcode[$index];
			$arr_price = $product_price[$index];

			// Check if the barcode already exists for the given product_id and unit
			$existing_record = $this->db->get_where('barcode', array('product_id' => $product_id, 'unit' => $arr_unit))->row();

			$data_barcode = [
				'unit' => $arr_unit,
				'product_id' => $product_id,
				'product_name' => $product_name,
				'barcode' => $arr_barcode,
				'price' => $arr_price,
			];

			if ($existing_record && $existing_record->product_id === $product_id && $existing_record->unit === $arr_unit) {
				$this->db->where('barcode_id', $existing_record->barcode_id);
				$this->db->update('barcode', $data_barcode);
			} else {
				$this->db->insert('barcode', $data_barcode);
			}
		}

		return $product_id;
	}


	function delete_product($product_id)
	{
		$data = array(
			'isDelete' => 'yes'
		);
		$this->db->where('product_id', $product_id);
		$response = $this->db->update('product', $data);
		if ($response) {
			return $product_id;
		} else {
			return false;
		}
	}

	function Select_one($id)
	{
		$this->db->select('*');
		$this->db->from('product AS pro');
		$this->db->join('suppliers AS supplier', 'pro.supplier_id = supplier.supplier_id', 'left');
		$this->db->where('pro.product_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}

	function get_barcode($id)
	{
		$this->db->select('*');
		$this->db->from('barcode AS bar');
		$this->db->join('product AS pro', 'bar.product_id = pro.product_id', 'left');
		$this->db->where('pro.product_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}
	function get_all_barcode()
	{
		$this->db->select('*');
		$this->db->from('barcode');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_total_products()
	{
		// Assuming your table is named 'product'
		$this->db->from('product');
		return $this->db->count_all_results();
	}
	public function getLowStockProductsCount()
	{
		// Calculate the total number of products with low stock
		$this->db->select('COUNT(*) as low_stock_count');
		$this->db->from('product');
		$this->db->where('isDelete', 'no'); // Assuming 'isDelete' is the column for deletion status
		$this->db->where('product_quantity < product_inbound_threshold');
		$query = $this->db->get();

		// Return the result
		return $query->row()->low_stock_count;
	}
	public function getLowStockProducts()
	{
		// Select products where the quantity is less than the inbound threshold
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_quantity < product_inbound_threshold');
		$query = $this->db->get();

		return $query->result();
	}
	public function countOutOfStockProducts()
	{
		// Assuming your product table is named 'product'
		$this->db->from('product');
		$this->db->where('product_quantity', 0);

		return $this->db->count_all_results();
	}
	function get_all_product_category()
	{
		$this->db->where('isCancel', 'no');
		$query = $this->db->get('product_category');
		$procat = $query->result();

		return $procat;
	}
	public function insert_added_product_category()
	{
		$product_category = (string) $this->input->post('product_category');

		$data = array(
			'product_category' => $product_category,
		);

		$response = $this->db->insert('product_category', $data);

		if ($response) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function update_added_product_category()
	{
		$procat_id = (int) $this->input->post('procat_id');
		$product_category = (string) $this->input->post('product_category');

		$data = array(
			'product_category' => $product_category,
		);

		$this->db->where('procat_id', $procat_id);
		$response = $this->db->update('product_category', $data);

		if ($response) {
			return $procat_id;
		} else {
			return FALSE;
		}
	}
	public function get_product_category($procat_id)
	{
		$this->db->where('procat_id', $procat_id);
		$query = $this->db->get('product_category');
		$row = $query->row();

		return $row;
	}
	public function delete_product_category($id)
	{
		$data = array(
			'isCancel' => 'yes'
		);
		$this->db->where('procat_id', $id);
		$response = $this->db->update('product_category', $data);
		if ($response) {
			return $id;
		} else {
			return false;
		}
	}
}

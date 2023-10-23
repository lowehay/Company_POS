<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Main extends CI_Controller
{
	function index()
	{
		$this->load->view('main/header');
		$this->load->view('main/dashboard');
		$this->load->view('main/footer');
	}

	function user()
	{
		$this->load->model('user_model');
		$this->data['result'] = $this->user_model->get_all_users();
		$this->load->view('main/header');
		$this->load->view('main/user', $this->data);
		$this->load->view('main/footer');
	}

	function add_user()
	{

		$this->add_user_submit();
		$this->load->view('main/header');
		$this->load->view('main/add_user');
		$this->load->view('main/footer');
	}
	function add_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|is_unique[user.first_name]', array('is_unique' => 'The username is already taken.'));
			$this->form_validation->set_rules('last_name', 'last_name', 'trim|required|is_unique[user.last_name]');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('role', 'role', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('user_model');
				$response = $this->user_model->insert1();
				if ($response) {
					$success_message = 'User added successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'User was not added.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}
	}

	function edit_user($user_id)
	{
		$this->edit_user_submit();
		$this->load->model('user_model');
		$this->data['user'] = $this->user_model->get_users($user_id);

		$this->load->view('main/header');
		$this->load->view('main/edituser', $this->data);
		$this->load->view('main/footer');
	}
	function edit_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password1', 'Confirm New Password', 'required|matches[password]');
			$this->form_validation->set_rules('role', 'role', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('user_model');

				$response = $this->user_model->update_user();

				if ($response) {
					$success_message = 'User updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'User was not updated successfully.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}
	}
	function delete_user($user_id)
	{
		$this->load->model('user_model');
		$response = $this->user_model->delete_user($user_id);

		if ($response) {
			$success_message = 'User deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'User was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/user');
	}
	function supplier()
	{

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();
		$this->load->view('main/header');
		$this->load->view('main/supplier', $this->data);
		$this->load->view('main/footer');
	}
	function add_supplier()
	{
		$this->add_supplier_submit();
		$this->load->view('main/header');
		$this->load->view('main/add_supplier');
		$this->load->view('main/footer');
	}


	function add_supplier_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('supplier_name', 'Supplier', 'trim|required|is_unique[suppliers.supplier_name]');
			$this->form_validation->set_rules('company_name', 'Company', 'trim|required|is_unique[suppliers.company_name]');
			$this->form_validation->set_rules('supplier_contact', 'Contact', 'trim|required|is_unique[suppliers.supplier_contact]');
			$this->form_validation->set_rules('supplier_street', 'Street', 'trim|required');
			$this->form_validation->set_rules('supplier_barangay', 'Barangay', 'trim|required');
			$this->form_validation->set_rules('supplier_city', 'City', 'trim|required');
			$this->form_validation->set_rules('supplier_province', 'Province', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('supplier_model');
				$response = $this->supplier_model->insertsupplier();
				if ($response) {
					$success_message = 'Supplier added successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Supplier was not added successfully.';
					$this->session->set_flashdata('success', $error_message);
				}
				redirect('main/supplier');
			}
		}
	}
	function view_supplier($supplier_id)
	{

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_supplier($supplier_id);
		$this->load->view('main/header');
		$this->load->view('main/view_supplier', $this->data);
		$this->load->view('main/footer');
	}

	function editsupplier($supplier_id)
	{
		$this->edit_supplier_submit();
		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_supplier($supplier_id);

		$this->load->view('main/header');
		$this->load->view('main/edit_supplier', $this->data);
		$this->load->view('main/footer');
	}

	function edit_supplier_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('supplier_contact', 'Supplier Contact', 'trim|required');
			$this->form_validation->set_rules('supplier_street', 'Supplier Street', 'trim|required');
			$this->form_validation->set_rules('supplier_barangay', 'Supplier Barangay', 'trim|required');
			$this->form_validation->set_rules('supplier_city', 'Supplier City', 'trim|required');
			$this->form_validation->set_rules('supplier_province', 'Supplier Province', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('supplier_model');

				$response = $this->supplier_model->update_added_supplier();

				if ($response) {
					$success_message = 'Supplier updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Supplier was not updated successfully.';
				}
				redirect('main/supplier');
			}
		}
	}

	public function delete_supplier($id)
	{

		$this->load->model('supplier_model');
		$response = $this->supplier_model->delete_supplier($id);

		if ($response) {
			$success_message = 'Supplier deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Supplier was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/supplier');
	}
	function purchase_order()
	{
		$this->load->model('purchase_order_model');
		$this->data['po'] = $this->purchase_order_model->get_all_po();

		$this->load->view('main/header');
		$this->load->view('main/purchase_order', $this->data);
		$this->load->view('main/footer');
	}
	function add_purchase_order()
	{
		$this->add_purchase_order_submit();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_all_product();

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();

		$this->load->model('purchase_order_model');
		$this->data['po_no'] = $this->purchase_order_model->po_no();
		$this->load->view('main/header');
		$this->load->view('main/add_purchase_order', $this->data);
		$this->load->view('main/footer');
	}

	function add_purchase_order_submit()
	{
		if ($this->input->post('btn_create_pr')) {

			$this->load->model('purchase_order_model');
			$response = $this->purchase_order_model->insertpurchaseorder();
			if ($response) {

				$success_message = 'Purchase order created successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Purchase order was not created successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/purchase_order');
		}
	}

	function goods_received()
	{
		$this->load->view('main/header');
		$this->load->view('main/goods_received');
		$this->load->view('main/footer');
	}
	function back_order()
	{
		$this->load->view('main/header');
		$this->load->view('main/back_order');
		$this->load->view('main/footer');
	}
	function product()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/product', $this->data);
		$this->load->view('main/footer');
	}

	function add_product()
	{
		$this->add_product_submit();
		$this->load->model('product_model');
		$this->data['product_code'] = $this->product_model->product_code();
		$this->load->view('main/header');
		$this->load->view('main/add_product', $this->data);
		$this->load->view('main/footer');
	}
	function add_product_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|is_unique[product.product_code]');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[product.product_name]', array('is_unique' => 'The Product Name is already taken.'));
			$this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$config['upload_path'] = './assets/images/'; // Set the upload directory
				$config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
				$config['max_size'] = 2048; // Maximum file size in kilobytes
				$config['encrypt_name'] = TRUE; // Encrypt the file name for security

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('product_image')) {
					$image_data = $this->upload->data();

					// Generate a unique filename based on the product name
					$product_name = $this->input->post('product_name');
					$product_code = $this->input->post('product_code');
					$unique_filename = strtolower(str_replace(' ', '', $product_name)) . '' . $product_code . '_' . time() . $image_data['file_ext'];

					// Rename the uploaded file to the unique filename
					$new_path = './assets/images/' . $unique_filename;
					rename($image_data['full_path'], $new_path);

					// Now, you can save $unique_filename into your database.
					// Make sure you have a column in your database table to store the file name.

					$this->load->model('product_model');
					$response = $this->product_model->insert_product($unique_filename); // Pass the unique filename to the model

					if ($response) {
						$success_message = 'Product added successfully.';
						$this->session->set_flashdata('success', $success_message);
					} else {
						$error_message = 'Product was not added.';
						$this->session->set_flashdata('error', $error_message);
					}
				} else {
					$error_message = 'Image upload failed: ' . $this->upload->display_errors();
					$this->session->set_flashdata('error', $error_message);
				}

				redirect('main/product');
			}
		}
	}

	function edit_product($product_id)
	{
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_product($product_id);

		$this->load->view('main/header');
		$this->load->view('main/editproduct', $this->data);
		$this->load->view('main/footer');
	}

	function edit_product_submit($product_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('product_model');

				// Check if a new image is being uploaded
				$update_image = false;

				if ($_FILES['product_image']['name']) {
					$update_image = true;
					$config['upload_path'] = './assets/images/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = 2048;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('product_image')) {
						$image_data = $this->upload->data();
						$product = $this->product_model->get_product($product_id);

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

						// Update the product with the new image filename
						$this->input->post('product_image', $unique_filename);
					} else {
						$error_message = 'Image upload failed: ' . $this->upload->display_errors();
						$this->session->set_flashdata('error', $error_message);
						redirect('main/product'); // Stop further processing if image upload fails
					}
				}

				// Update the product data
				$response = $this->product_model->update_product($product_id, $update_image);

				if ($response) {
					$success_message = 'Product updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Product was not updated successfully.';
					$this->session->set_flashdata('error', $error_message);
				}

				// Redirect to the product listing page
				redirect('main/product');
			}
		}
	}

	function delete_product($product_id)
	{
		$this->load->model('product_model');
		$response = $this->product_model->delete_product($product_id);

		if ($response) {
			$success_message = 'Product deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Product was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/product');
	}
	function inventory_adjustment()
	{
		$this->load->view('main/header');
		$this->load->view('main/inventory_adjustment');
		$this->load->view('main/footer');
	}
	function inventory_ledger()
	{
		$this->load->view('main/header');
		$this->load->view('main/inventory_ledger');
		$this->load->view('main/footer');
	}
	function stock_requisition()
	{
		$this->load->view('main/header');
		$this->load->view('main/stock_requisition');
		$this->load->view('main/footer');
	}
	function reports()
	{
		$this->load->view('main/header');
		$this->load->view('main/reports');
		$this->load->view('main/footer');
	}
	function backup()
	{
		$this->load->view('main/header');
		$this->load->view('main/backup');
		$this->load->view('main/footer');
	}
	public function export()
	{
		//load helpers
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
		//load database
		$this->load->dbutil();
		//create format
		$db_format = array('format' => '.sql', 'filename' => 'pos.sql');
		$backup = &$this->dbutil->backup($db_format);
		// file name
		$dbname = 'pos.sql';
		$save = '.assets/db_backup/' . $dbname;
		// write file
		write_file($save, $backup);

		// and force download
		force_download($dbname, $backup);
	}
	public function import()
	{

		if ($this->input->post('btn_import')) {
			$config['upload_path'] = './upload/database/';
			$config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('import')) {
				$error_message = 'Backup was not restored.';
				$this->session->set_flashdata('error', $error_message);
			} else {
				$this->import2();
				$success_message = 'Backup was restored successfully.';
				$this->session->set_flashdata('success', $success_message);
			}
			redirect('visitor_portal/backup_and_restore');
		}
	}


	public function import2()
	{

		$host = 'localhost'; //DB Hosting Name
		$UN = 'root'; //Db Username
		$pwd = ''; // Db Password
		$database_name = 'inventory'; // Db Name
		$db_file = $this->input->post('back');
		$connection = mysqli_connect($host, $UN, $pwd, $database_name);

		$filename = 'C:/xampp/htdocs/ETPI/upload/database/inventory.sql';
		$handle = fopen($filename, "r+");
		$contents = fread($handle, filesize($filename));

		$sql = explode(';', $contents);
		foreach ($sql as $query) {
			$result = mysqli_query($connection, $query);
		}
		fclose($handle);
	}

	function payment()
	{
		$this->load->view('main/header');
		$this->load->view('main/payment');
		$this->load->view('main/footer');
	}
	function receipt()
	{
		$this->load->view('main/header');
		$this->load->view('main/receipt');
		$this->load->view('main/footer');
	}
	function pos()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/pos', $this->data);
		$this->load->view('main/footer');
	}
}

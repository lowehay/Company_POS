<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{
	function index()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/dashboard', $this->data);
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
	function deactivate_user($user_id)
	{
		
		$this->load->model('user_model');

		$response = $this->user_model->deactivate_user($user_id);

		if ($response) 
		{
			$success_message = 'User deactivated successfully.';
			$this->session->set_flashdata('success', $success_message);
		}
		else
		{
			$error_message = 'User was not deactivated successfully.';
			$this->session->set_flashdata('error', $error_message);
		}
		redirect('main/user');
	}

	function reactivate_user($user_id)
	{

		$this->load->model('user_model');

		$response = $this->user_model->reactivate_user($user_id);

		if ($response) 
		{
			$success_message = 'User activated successfully.';
			$this->session->set_flashdata('success', $success_message);
		}
		else
		{
			$error_message = 'User was not activated successfully.';
			$this->session->set_flashdata('error', $error_message);
		}
		redirect('main/user');
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
				$config['upload_path']   = './assets/images/';  // Set the upload directory
				$config['allowed_types'] = 'jpg|jpeg|png|gif';  // Allowed file types
				$config['max_size']      = 2048;  // Maximum file size in kilobytes
				$config['encrypt_name']  = TRUE;  // Encrypt the file name for security

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('product_image')) {
					$image_data = $this->upload->data();

					// Generate a unique filename based on the product name
					$product_name = $this->input->post('product_name');
					$product_code = $this->input->post('product_code');
					$unique_filename = strtolower(str_replace(' ', '_', $product_name)) . '_' . $product_code . '_' . time() . $image_data['file_ext'];

					// Rename the uploaded file to the unique filename
					$new_path = './assets/images/' . $unique_filename;
					rename($image_data['full_path'], $new_path);

					// Now, you can save $unique_filename into your database.
					// Make sure you have a column in your database table to store the file name.

					$this->load->model('product_model');
					$response = $this->product_model->insert_product($unique_filename);  // Pass the unique filename to the model

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
					$config['upload_path']   = './assets/images/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size']      = 2048;
					$config['encrypt_name']  = TRUE;

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
						$unique_filename = strtolower(str_replace(' ', '_', $product_name)) . '_' . $product_id . '_' . time() . $image_data['file_ext'];

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
	function payment()
	{
		$this->load->view('main/header');
		$this->load->view('main/payment');
		$this->load->view('main/footer');
	}
}

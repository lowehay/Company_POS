<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary model(s) here
        $this->load->model('Customer_model');
    }
    public function registerCustomer() {
        // Get the form data from the Walk-In Modal
        $customer_fname = $this->input->post('customer_fname');
        $customer_lname = $this->input->post('customer_lname');
        $contact_no = $this->input->post('contact_no');
    
        // Validate input fields
        if (empty($customer_fname) || empty($customer_lname) || empty($contact_no)) {
            // One or more fields are empty
            $this->session->set_flashdata('register_customer_error', 'Error: Please fill in all fields.');
            redirect('main'); // Exit the method
        }
    
        // Regular expression pattern for a valid Philippine mobile or landline number
        $valid_ph_contact_pattern = '/^(09\d{9}|0\d{1,2}-\d{6,8}(?:-\d{1,5})?)$/';
    
        // Check if the contact_no matches the pattern
        if (!preg_match($valid_ph_contact_pattern, $contact_no)) {
            $this->session->set_flashdata('register_customer_error', 'Error: Invalid Philippine contact number.');
            redirect('main'); // Exit the method
        }
    
        // Prepare the data to be inserted into the database
        $data = array(
            'customer_fname' => $customer_fname,
            'customer_lname' => $customer_lname,
            'contact_no' => $contact_no,
            // Add other fields here
        );
    
        // Insert the customer data into the database using the Customer_model
        if ($this->Customer_model->insert_customer($data)) {
            $this->session->set_flashdata('register_customer_success', 'Customer registered successfully.');
            redirect('main'); // Redirect to the dashboard.php
        } else {
            $this->session->set_flashdata('register_customer_error', 'Error: Customer registration failed.');
            redirect('main');
        }
    }
    
    
    
    
    public function getCustomers() {
        // Load the Customer_model
        $this->load->model('Customer_model');
    
        // Retrieve all customer data using the model
        $customers = $this->Customer_model->get_all_customers();
    
        // Return customers as JSON
        echo json_encode(['customers' => $customers]);
    }
    
}

<?php
class Customer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library if not already loaded
        $this->load->database();
    }

    public function insert_customer($data) {
        // Insert the customer data into the 'customer' table
        return $this->db->insert('customer', $data);
    }
	public function get_all_customers() {
        // Select all records from the "customer" table
        return $this->db->get('customer')->result();
    }
    
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{
    public function generate_reference_number()
    {
        $prefix = date('Ymd');

        $query =  $this->db->query("SELECT max(reference_no) as max_product_code FROM sales_no where reference_no LIKE '{$prefix}%'");
        $result = $query->row();


        if ($result->max_product_code) {
            $next_product_code = ++$result->max_product_code;
        } else {
            $next_product_code = $prefix . '0001';
        }
        return $next_product_code;
    }

    function insert_sales()
    {
        $sales = [
            'reference_no' => $this->input->post('reference_no'),
            'date_created' => $this->input->post('date_created'),
            'payment_method' => $this->input->post('payment_method')
        ];

        $this->db->insert('sales_no', $sales);

        $last_id = $this->db->insert_id();

        $product = $this->input->post('product');
        $quantity = $this->input->post('quantity');
        $product_price = $this->input->post('product_price');

        $total_cost = 0; // Initialize total cost variable

        foreach ($product as $index => $product_name) {
            $quantity_value = $quantity[$index];
            $product_price_value = $product_price[$index];

            $data = [
                'reference_no' => $last_id,
                'product_name' => $product_name,
                'quantity' => $quantity_value,
                'product_price' => $product_price_value,
            ];

            // Calculate total cost for each product and add to the overall total cost
            $total_cost += ($quantity_value * $product_price_value);

            $this->db->insert('sales', $data);

            // Update product_quantity in the product table
            // First, get the current product_quantity
            $this->db->select('product_quantity');
            $this->db->from('product');
            $this->db->where('product_name', $product_name);
            $query = $this->db->get();
            $current_quantity = $query->row()->product_quantity;

            // Calculate the new product quantity
            $new_quantity = $current_quantity - $quantity_value;

            // Update product_quantity in the product table
            $this->db->set('product_quantity', $new_quantity);
            $this->db->where('product_name', $product_name);
            $this->db->update('product');
        }

        // Update total_cost in the sales_no table
        $this->db->where('sales_no_id', $last_id);
        $this->db->update('sales_no', ['total_cost' => $total_cost]);

        return $last_id;
    }
    function get_all_sales()
    {
        $this->db->select('*');
        $this->db->from('sales_no');
        $query = $this->db->get()->result();
        return $query;
    }
    function code($id)
    {
        $this->db->select('*');
        $this->db->from('sales_no');
        $this->db->where('sales_no_id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function view_all_sales($id)
    {
        $this->db->select('sa.*, P.*, sn.*');
        $this->db->from('sales_no AS sn');
        $this->db->join('sales AS sa', 'sn.sales_no_id = sa.reference_no');
        $this->db->join('product AS P', 'sa.product_name = P.product_name');
        $this->db->where('sales_no_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
}

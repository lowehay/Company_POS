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

    function get_all_sales()
    {
        $this->db->select('*');
        $this->db->from('sales_no');
        $this->db->where('sales_no.isCancel', 'no');
        $query = $this->db->get()->result();
        return $query;
    }
    function get_all_sales1()
    {
        $this->db->select('*');
        $this->db->from('sales_no');
        $this->db->where('sales_no.isCancel', 'no');
        $this->db->where('sales_no.status', 'sold');
        $query = $this->db->get()->result();
        return $query;
    }
    function code($id)
    {
        $this->db->select('*');
        $this->db->from('sales_no');
        $this->db->where('sales_id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    function code1($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    function view_all_sales($id)
    {
        $this->db->select('*');
        $this->db->from('sales_no AS sale');
        $this->db->join('sales AS s', 'sale.sales_id = s.reference_no');
        $this->db->join('product AS p', 's.product_name = p.product_name');
        $this->db->where('sales_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

 


    function insert_sales()

    {
        $sales = [
            'reference_no' => $this->input->post('reference_no'),
            'date_created' => $this->input->post('date_created'),

            'prepared_by' => $_SESSION['name'],

            'payment_method' => $this->input->post('payment_method')

        ];

        $this->db->insert('sales_no', $sales);


        $last_id = $this->db->insert_id();

        $product = $this->input->post('product');
        $quantity = $this->input->post('quantity');

        $unit = $this->input->post('product_unit');
        $product_sellingprice = $this->input->post('product_sellingprice');
        $total_cost = 0;

        foreach ($product as $index => $product) {
            $arr_product = $product;
            $arr_quant = $quantity[$index];
            $arr_unit = $unit[$index];
            $arr_price = $product_sellingprice[$index];

            // check if the quantity entered by the user is higher than the quantity in the product table
            $product_data = $this->db->select('product_quantity')->from('product')->where('product_name', $arr_product)->get()->row();
            if ($product_data && $arr_quant > $product_data->product_quantity) {
                return false; // quantity entered is too high, return false to indicate an error
            }

            $data = [
                'reference_no' => $last_id,
                'product_name' => $arr_product,
                'unit' => $arr_unit,
                'quantity' => $arr_quant,
                'product_sellingprice' => $arr_price,
            ];

            $this->db->insert('sales', $data);

            // update product_quantity in product table
            $this->db->set('product_quantity', "product_quantity - $arr_quant", FALSE);
            $this->db->where('product_name', $arr_product);
            $this->db->update('product');

            // calculate total cost
            $total_cost += $arr_quant * $arr_price;

            // insert data into inventory ledger table
            $inventory_data = [
                'product_name' => $arr_product,
                'unit' => $arr_unit,
                'quantity' => $arr_quant,
                'price' => $arr_price,
                'activity' => 'sold',
                'date_posted' => date('Y-m-d'),
            ];

            $this->db->insert('inventory_ledger', $inventory_data);
        }

        // update sales order with total cost
        $this->db->set('total_cost', $total_cost);
        $this->db->where('sales_id', $last_id);
        $this->db->update('sales_no');

        return $last_id;
    }

    public function get_total_rows($sales)
    {
        $query = $this->db->get($sales);
        return $query->num_rows();

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

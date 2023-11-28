<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_adjustment_model extends CI_Model
{
    public function updateQuantity()
    {
        $product_id = (int) $this->input->post('product_id');
        $product_quantity = (int) $this->input->post('product_quantity');
        $product = $this->db->get_where('product', array('product_id' => $product_id))->row();

        $this->db->trans_start();

        // Update product quantity
        $this->db->set('product_quantity', $product_quantity);
        $this->db->where('product_id', $product_id);
        $response = $this->db->update('product');

        // Insert inventory adjustment record
        $data = array(
            'product_name' => $product->product_name,
            'old_quantity' => $product->product_quantity,
            'new_quantity' => $product_quantity,
            'date_adjusted' => date('m-d-Y h:i A'),
            'reason' => $this->input->post('reason')
        );
        $this->db->insert('inventory_adjustment', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return $product_id;
        }
    }

    function get_all_adjustment()
    {
        $query = $this->db->get('inventory_adjustment');
        $adjustment = $query->result();

        return $adjustment;
    }
    function get_all_adjust()
    {
        $this->db->select('*');
        $this->db->from('inventory_adjustment');
        $query = $this->db->get()->result();
        return $query;
    }
}

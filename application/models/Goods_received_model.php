<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods_received_model extends CI_Model
{
    public function post_goods_received()
    {
        $this->updatestatus();
        $purchase_id = (int) $this->input->post('purchase_id');
        $goods = [
            'goods_received_no' => $this->input->post('goods_received_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'date_received' => $this->input->post('date_received'),
            'purchase_order_no_id' => $this->input->post('gr_id')
        ];

        $this->db->insert('goods_received_no', $goods);

        $last_id = $this->db->insert_id();

        $product_name = $this->input->post('product_name');
        $po_product_quantity = $this->input->post('po_product_quantity');
        $product_unit = $this->input->post('product_unit');
        $product_unitprice = $this->input->post('product_unitprice');
        $received_quantity = $this->input->post('received_quantity');
        $expiry_date = $this->input->post('expiry_date');

        $total_cost = 0; // Initialize total cost variable

        foreach ($product_name as $index => $product_name) {
            $arr_product = $product_name;
            $arr_quant = $po_product_quantity[$index];
            $arr_unit = $product_unit[$index];
            $arr_price = $product_unitprice[$index];
            $arr_rec = $received_quantity[$index];
            $arr_exp = $expiry_date[$index];

            // Calculate cost for this product
            $cost = $arr_price * $arr_rec;
            $total_cost += $cost; // Add cost to total cost variable

            // Insert data into goods_received table
            $data_goods_received = [
                'goods_received_no' => $last_id,
                'gr_product_name' => $arr_product,
                'gr_total_quantity' => $arr_quant,
                'gr_unit' => $arr_unit,
                'gr_product_unitprice' => $arr_price,
                'gr_received_quantity' => $arr_rec,
                'gr_expiry_date' => $arr_exp,
            ];

            $this->db->insert('goods_received', $data_goods_received);
        }
        // Insert total cost into goods_received_no table
        $this->db->set('gr_total_cost', $total_cost);
        $this->db->where('goods_received_no_id', $last_id);
        $this->db->update('goods_received_no');

        return $last_id;
    }
    public function updatestatus()
    {
        $gr_id = $this->input->post('gr_id');
        $ref = array(
            'status' => 'Received'
        );
        $this->db->where('purchase_order_no_id', $gr_id);
        $this->db->update('purchase_order_no', $ref);
        return $gr_id;
    }
    function get_all_gr1()
    {
        $this->db->select('*');
        $this->db->from('purchase_order_no');
        $this->db->join('suppliers', 'purchase_order_no.supplier_id = suppliers.supplier_id');
        $this->db->where('purchase_order_no.is_Delete', 'no');
        $this->db->where('purchase_order_no.status', 'Received');
        $query = $this->db->get()->result();
        return $query;
    }
}

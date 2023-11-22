<?php

class Purchase_order_model extends CI_Model
{
    public function po_no()
    {

        $year = date('Y');
        $text = "PO" . '-' . $year;
        $query = "SELECT max(purchase_order_no) as code_auto from purchase_order_no";
        $data = $this->db->query($query)->row_array();
        if ($data["code_auto"] != NULL) {
            $max_code = $data['code_auto'];
            $max_code2 = (int) substr($max_code, 8, 5);
            $codecount = $max_code2 + 1;
            $code_auto = $text . '-' . sprintf('%03s', $codecount);
            return $code_auto;
        } else {
            return $text . '-' . sprintf('%03s', 1);
        }
    }

    function insertpurchaseorder()
    {
        $purchase = [
            'purchase_order_no' => $this->input->post('purchase_order_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'date_created' => $this->input->post('date_created'),
            'payment_method' => $this->input->post('payment_method'),
        ];

        $this->db->insert('purchase_order_no', $purchase);

        $last_purchase_id = $this->db->insert_id();

        $product_name = $this->input->post('product_name');
        $po_product_quantity = $this->input->post('po_product_quantity');
        $product_unit = $this->input->post('product_unit');
        $product_unitprice = $this->input->post('product_unitprice');
        $total_cost = 0;

        foreach ($product_name as $index => $product_name) {
            $arr_product = $product_name;
            $arr_quant = $po_product_quantity[$index];
            $arr_unit = $product_unit[$index];
            $arr_price = $product_unitprice[$index];

            // insert data to purchase_order table
            $data_purchase_order = [
                'purchase_order_no' => $last_purchase_id,
                'product_name' => $arr_product,
                'po_product_quantity' => $arr_quant,
                'product_unit' => $arr_unit,
                'product_unitprice' => $arr_price,
            ];
            $this->db->insert('purchase_order', $data_purchase_order);


            // calculate total cost
            $total_cost += $arr_quant * $arr_price;
        }


        $this->db->set('total_cost', $total_cost);
        $this->db->where('purchase_order_no_id', $last_purchase_id);
        $this->db->update('purchase_order_no');

        return $last_purchase_id;
    }

    function get_all_po()
    {
        $this->db->select('*');
        $this->db->from('purchase_order_no');
        $this->db->join('suppliers', 'purchase_order_no.supplier_id = suppliers.supplier_id');
        $this->db->where('purchase_order_no.is_Delete', 'no');
        $query = $this->db->get()->result();
        return $query;
    }
}

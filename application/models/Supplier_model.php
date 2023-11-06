<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    function get_all_suppliers()
    {
        $this->db->where('isCancel', 'no');
        $query = $this->db->get('suppliers');
        $suppliers = $query->result();

        return $suppliers;
    }
}

<?php

class Debtor_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

	
	
	function get_rate_plans($company_id)
	{
		$this->db->select('
						rp.rate_plan_id, 
						r.adult_1_rate, 
						rp.rate_plan_name, 
						rp.description,
						cu.currency_code, 
						rp.charge_type_id,
						cu.currency_id, 
						rt.id as room_type_id, 
						rp.image_group_id');
		$this->db->from('rate_plan as rp, room_type as rt, currency as cu');		
		$this->db->join('rate as r', 'r.rate_id = rp.base_rate_id', 'left');

		$this->db->where('rt.company_id', $company_id);
		$this->db->where('rp.room_type_id = rt.id');
		$this->db->where('IF(rp.currency_id, rp.currency_id, '.DEFAULT_CURRENCY.') = cu.currency_id');
		$this->db->where('rp.is_deleted != "1"');
		$this->db->where('rp.is_selectable = "1"');
		$this->db->where('rt.is_deleted != "1"');
		
		
		$query = $this->db->get();
		
		if ($this->db->_error_message()) // error checking
					show_error($this->db->_error_message());
					
		//echo $this->db->last_query();
		if ($query->num_rows >= 1) 
		{
			$result =  $query->result_array();
			return $result;
		}
		return NULL;
	}

   
}

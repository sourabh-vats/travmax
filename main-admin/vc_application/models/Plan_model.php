<?php 
class Plan_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    /**
    * Get plan by his is
    * @param int $plan_id 
    * @return array
    */
    public function get_all_plan()
    {
		$this->db->select('*');
		$this->db->from('operator_plan');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_plan1($id)
    {
		$this->db->select('*');
		$this->db->from('operator_plan');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_plan_id($id)
    {
		$this->db->select('*');
		$this->db->from('operator_plan');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_plan($data)
    {
		$insert = $this->db->insert('operator_plan', $data);
	    return $insert;
	}

    /**
    * Update operator_plan
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_plan($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('operator_plan', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete operator_plan
    * @param int $id - operator_plan id
    * @return boolean
    */
	   public function get_list_circle() {
               $this->db->select('*');
		$this->db->from('operator_circle'); 
                $this->db->where('cir_status','active');
		        $query = $this->db->get();
		return $query->result_array(); 
}

   public function get_operator() {
               $this->db->select('*');
		$this->db->from('mobile_operator'); 
                $this->db->where('oper_status','active');
		        $query = $this->db->get();
		return $query->result_array(); 
}
	
	function delete_plan($id){
		$this->db->where('id', $id);
		$this->db->delete('operator_plan'); 
	}
}
?>
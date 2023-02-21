<?php 
class Category_model extends CI_Model {
 
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
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_all_category()
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_category1($id)
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_category_id($id)
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_category($data)
    {
		$insert = $this->db->insert('categorys', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_category($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('categorys', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('categorys'); 
	}
	
		public function get_all_contingency()
    {
		$this->db->select('*');
		$this->db->from('referall_ids');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	    function store_contingency($data)
    {
		$insert = $this->db->insert('referall_ids', $data);
	    return $insert;
	}
	
public function get_parent_contingency()
    {
		$this->db->select('*');
		$this->db->from('referall_ids');
		$this->db->where('p_id','0');
		//$this->db->where('position','');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	    function update_contingency($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('referall_ids', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

	  function update_customer_data($where, $data)
    {
		$this->db->where($where);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	  public function get_all_contingency_id($id)
    {
		$this->db->select('*');
		$this->db->from('referall_ids');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		function delete_contingency($id){
		$this->db->where('id', $id);
		$this->db->delete('referall_ids'); 
	}
	
}
?>
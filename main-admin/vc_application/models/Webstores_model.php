<?php 
class Webstores_model extends CI_Model {
 
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
    * Get webstores by his is
    * @param int $webstores_id 
    * @return array
    */
    public function get_all_webstores()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_webstores1($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_webstores_id($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_webstores($data)
    {
		$insert = $this->db->insert('mobile_operator', $data);
	    return $insert;
	}

    /**
    * Update webstores
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_webstores($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('webstores', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete webstores
    * @param int $id - webstores id
    * @return boolean
    */
	
	
	function delete_webstores($id){
		$this->db->where('id', $id);
		$this->db->delete('webstores'); 
	}
}
?>
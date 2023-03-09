<?php 
class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{  
                $this->db->select('*');
		$this->db->from('membership');
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
		/*return $query->result_array(); */
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['user_id'] = $row->id;
    			$return['full_name'] = $row->first_name;
    			$return['email'] = $row->email_addres;
    			$return['user_level'] = $row->user_level;
                $return['permission'] = $row->permission; 
			 }
			return $return;
                }
                else { return false ; }
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('membership');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function get_customer_data_by_id($blissid)
	{
		$this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.direct as ddirect');
		$this->db->from('customer as c');
		$this->db->from('customer as d', 'd.customer_id = c.customer_id', 'left');
		$this->db->where('c.customer_id', $blissid);
		$query = $this->db->get();
		return $query->result_array();
	}

	function profile($id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_package($id)
	{
		$this->db->select('*');
		$this->db->from('package_purchase');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_package_data($id)
	{
		$this->db->select('*');
		$this->db->from('package');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function update_wallet($id, $amount, $column)
	{
		$sql = "update `customer` set $column = $column - $amount where id='$id'";
		$this->db->query($sql);
	}

	function update_profile($id, $data_to_store)
	{
		$this->db->where('id', $id);
		$this->db->update('customer', $data_to_store);
		return TRUE;
	}

	function add_transactional_wallet($data)
	{
		$insert = $this->db->insert('transaction_wallet', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
}


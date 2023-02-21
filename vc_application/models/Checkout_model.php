<?php 
class Checkout_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
   public function add_order($data){
	   
	   $insert = $this->db->insert('orders', $data);
	   $insert_id = $this->db->insert_id();
	    return $insert_id;
   }
   public function bliss_web_stores(){
         
		$this->db->select('*');
		$this->db->from('webstores');
		//$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
	public function parent_bliss_result($parent_customer_id){
	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	public function update_distribution_status($order_id){
         
		$data = array('status'=>'Active');
		$this->db->where('order_id', $order_id);
		$this->db->update('distribution_amount', $data);
		
		$data_order = array('status'=>'Accepted');
		$this->db->where('id', $order_id);
		$this->db->update('orders', $data_order);
		
		$this->db->select('user_id,amount');
		$this->db->from('distribution_amount');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get();
            if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row) {
				if($row->user_id != '' && $row->user_id != 0 && $row->amount != '' && $row->amount != 0) {
					$this->add_bliss_amount_in_customer($row->user_id,$row->amount);
					 /***************** SMS Registration ******************/ 
			    $this->db->select('id,phone');
				$this->db->from('customer');
				$this->db->where('id', $row->user_id); 
				$smsquery = $this->db->get();
                if(count($smsquery->result_array())==1) {  
					foreach ($smsquery->result() as $smsrow) { 
				    $sms_msg = urlencode("Congratulations!
Your BSA Account has a credit by update of ".$row->amount." Bliss Perks on ".date('d F Y').". You may Log In & Redeem your perks.\n
Thank you
Team Blisszon");
					$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$smsrow->phone."&source=BLISSZ&message=".$sms_msg;
					file_get_contents($smstext);
					} 
                }
				/***************** SMS ******************/
				}
			 }
			}
	} 
	
	function update_order_status($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('orders', $data_to_store);	
            return TRUE;
       }

	public function update_emi_status($order_id){
          
		
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $order_id);
		$query = $this->db->get();
            if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row) {
				if($row->emi!='no') {
					$emi_info = json_decode($row->emi_info,true);
					$emi_info['last_date'] = date('Y-m-d h:i:s');
					$emi_info['total_payment'] = $row->total_amount .'-'. $row->emi;
					$emiinfoarray = json_encode($emi_info);
					$data_to_store_order = array('total_amount'=>$emi_info['total_amount'],'status'=>'Accepted','emi' => 'yes','emi_info'=>$emiinfoarray); 
					$this->db->where('id', $order_id);
					$this->db->update('orders', $data_to_store_order);
				}
			 }
			}
	} 
	

	public function add_bliss_amount_in_customer($userid,$amount){
		  $this->db->select('id,bliss_amount');
		$this->db->from('customer');
		$this->db->where('id', $userid);
		$query = $this->db->get();
        if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row)
			 {
				 $bliss_amount = $row->bliss_amount + $amount;
				 $this->db->where('id', $userid);
				 $this->db->update('customer', array('bliss_amount'=>$bliss_amount));	
			 }
		}
	}
	public function add_distribution_amount($amount,$userid,$level,$order_id){
         
		$cust_id = $this->session->userdata('cust_id');
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Pending'					
			); 
		$this->db->insert('distribution_amount', $insert_data); 
	}
	
       public function get_distributer_amount_by_userid($userid){
         
		$this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function get_child_id($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function my_first_circle_order($myfriendid){ 
	
		$this->db->select('id,user_id,status');
		$this->db->from('orders'); 
		$this->db->where_in('user_id',$myfriendid);
		$query = $this->db->get();
		return $query->result_array();  
	}

	function get_order_by_id($oid){ 
	
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('id',$oid);
		$query = $this->db->get();
		return $query->result_array();  
	}

	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

       function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }

}
?>
<?php 
class Customer_model extends CI_Model {
 
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
    function get_fund_request_by_date() {
		
	 	 $this->db->select('p.*,c.customer_id');
		
		$this->db->from('fund_request as p');
		$this->db->join('customer as c','c.id=p.user_id','left');
		
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 function update_fund_request($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('fund_request', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	public function get_all_fund_request_id($id)
    {
		
		 $this->db->select('p.*,c.f_name,c.l_name,c.customer_id as cus');
		$this->db->from('fund_request as p');
		$this->db->join('customer as c','c.id = p.user_id','left');
		$this->db->where('p.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function add_transactional_wallet($data){
	    $this->db->insert('transaction_wallet', $data); 
	}

    public function get_all_wallet_transaction()
    {
		$this->db->select('w.*,c.f_name,c.customer_id');
		$this->db->from('transaction_wallet as w');
		$this->db->join('customer as c', 'c.id = w.userid', 'left'); 
		$this->db->where('w.status','Credit');
		$this->db->where('w.type','Wallet Update');
	    $this->db->order_by('w.id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_income_by_type($sdate,$edate,$type,$customer_id)
    {
		
		$this->db->select('i.*,c.f_name,c.l_name,c.customer_id');
		$this->db->from('incomes as i'); 
		$this->db->join('customer as c','c.id = i.user_id','left');
		$this->db->where('i.rdate >= ',$sdate);
		$this->db->where('i.rdate < ',$edate);
		if($type!='') { $this->db->where('i.type',$type); }
		if($customer_id!='') { $this->db->where('c.customer_id',$customer_id); }
		$query = $this->db->get();
		return $query->result_array();  
    }

     public function get_all_customer($macro='')
    {
		
		$this->db->select('c.*,d.c_name as city');
		$this->db->from('customer as c'); 
		$this->db->join('referall_ids as d','c.city = d.id','left');
		if($macro!='') { $this->db->where('macro',$macro); }
		$query = $this->db->get();
		return $query->result_array();  
    } 

    public function get_all_activity_log($zkey)
    {
		
		$this->db->select('*');
		$this->db->from('WorkWith'); 
		$this->db->where('zkey',$zkey);
		$query = $this->db->get();
		return $query->result_array();
    }
      public function get_all_customer_num()
    {
		
		$this->db->select('COUNT(id) as count,consume,macro');
		$this->db->from('customer'); 
		$this->db->group_by('consume');
		$this->db->group_by('macro');
		$query = $this->db->get();
		return $query->result_array();
    }
    
     public function get_all_customer_active_num()
    {
		
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('consume >',0);
		$query = $this->db->get();
		return $query->num_rows();  
    }

     public function get_all_customer_active_inactive($macro)
    {
		
		$this->db->select('COUNT(id) as count,consume');
		$this->db->from('customer'); 
		$this->db->where('macro',$macro);
		$this->db->group_by('consume');
		$query = $this->db->get();
		return $query->result_array();
    }


      public function get_all_purchases()
    {
			$this->db->select('*');
			$this->db->from('purchases');
			$query = $this->db->get();
			return $query->result_array();
    }

     public function get_all_purchases_by_user($id)
    {
			$this->db->select('*');
			$this->db->from('purchases');
			$this->db->where('user_id',$id);
			$query = $this->db->get();
			return $query->result_array();
    }

     public function get_all_user_purchases()
    {
			$this->db->select('p.*,c.id as cid,c.f_name,c.l_name,c.status as cstatus,c.customer_id');
			$this->db->from('purchases as p');
			$this->db->join('customer as c','c.id = p.user_id','left');
			$query = $this->db->get();
			return $query->result_array();
    }

     public function get_all_purchases_with_detail($id)
    {
			$this->db->select('p.*,c.id as cid,c.f_name,c.l_name,c.status as cstatus,c.customer_id');
			$this->db->from('purchases as p');
			$this->db->join('customer as c','c.id = p.user_id','left');
			$this->db->where('p.user_id',$id);
			$query = $this->db->get();
			return $query->result_array();
    }

       public function get_all_incomes($role)
    {
		
		$this->db->select('SUM(amount) as tamount,type,status');
		$this->db->from('incomes'); 
		$this->db->where('role',$role);
		$this->db->group_by('type');
		$this->db->group_by('status');
		$query = $this->db->get();
		return $query->result_array();
    }
      public function get_all_manual_num($table,$where='')
    {
		
		$this->db->select('id');
		$this->db->from($table); 
		if($where!=''){ $this->db->where($where); }
		$query = $this->db->get();
		return $query->num_rows();  
    }
    
       public function get_all_manual_sum($table,$col,$where='')
    {
		
		$this->db->select('SUM('.$col.') as amount');
		$this->db->from($table); 
		if($where!=''){ $this->db->where($where); }
		$query = $this->db->get();
		return $query->result_array();
    }
    	function checkuserid($data)
    {
		$this->db->select('customer_id,bliss_amount,id,income_wallet');
		$this->db->from('customer');
		$this->db->where('customer_id', $data);
		$query = $this->db->get();
        return $query->result_array(); 
	
	}
	
		function wallet_update_customer($id, $data)
    {
		$this->db->where('customer_id', $id);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
    
    function update_income($id, $data)
    {
		$this->db->where('order_id', $id);
		$this->db->update('incomes', $data);
	}

	 function get_all_approved_income($order_id,$pay_type=''){
	   $this->db->select('*');
		$this->db->from('incomes');
		$this->db->where('order_id',$order_id);
		if($pay_type!='') { $this->db->where('pay_type',$pay_type); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 function my_friends_in($cust_id){
	   $this->db->select('customer_id,f_name,l_name,rdate,direct_customer_id,parent_customer_id,macro,consume');
		$this->db->from('customer');
		$this->db->where_in('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	 function my_friends_in_with_purchase($cust_id){
	   $this->db->select('c.id,c.customer_id,c.f_name,c.l_name,c.rdate,c.direct_customer_id,c.parent_customer_id,c.macro,c.consume,SUM(p.amount) as tamount,COUNT(p.id) as count');
		$this->db->from('customer as c');
		$this->db->join('purchases as p','p.user_id = c.id','left');
		$this->db->where_in('parent_customer_id',$cust_id);
		$this->db->group_by('c.customer_id');
		$query = $this->db->get();
		return $query->result_array(); 
	}


	function get_user_total_income_type($cust_id){
	   $this->db->select('SUM(amount) as tamount,type');
		$this->db->from('incomes');
		$this->db->where_in('user_id',$cust_id);
		$this->db->group_by('type');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	 function total_incomes($id){
	$this->db->select('SUM(amount) as tamount,type,status');
	$this->db->from('incomes');
	$this->db->where('user_id',$id);
	$this->db->group_by('type');
	$this->db->group_by('status');
	$query=$this->db->get();
	return $query->result_array(); 
 }
    
	    public function get_all_customer1($id)
    {
		$this->db->select('*');
		$this->db->from(customer);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_customer_id($id)
    {
		
		$this->db->select('c.*,d.f_name as df_name,d.l_name as dl_name');
		$this->db->from('customer as c');
		$this->db->join('customer as d','d.customer_id = c.direct_customer_id','left');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		public function activity_log()
    {
		
		$this->db->select('*');
		$this->db->from('WorkWith'); 
		//$this->db->where('id_no',$id);
		//$this->db->join('customer','customer.customer_id = w.zkey','left');
		//$this->db->group_by('zkey');
		$this->db->order_by('id_no','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	
	public function activity_log_by_id($id)
    {
		
		$this->db->select('w.*,customer.f_name,customer.l_name');
		$this->db->from('WorkWith as w'); 
		//$this->db->where('id_no',$id);
		$this->db->join('customer','customer.customer_id = w.zkey','left');
		$this->db->where('w.zkey',$id);
		$query = $this->db->get();
		return $query->result_array();  
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_customer($data)
    {
		$insert = $this->db->insert('customer', $data);
	    return $insert;
	}

	 function insert_income($data)
    {
		$insert = $this->db->insert('incomes', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_customer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

	function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	function parent_profile($blissid){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	 public function get_all_card(){
		$this->db->select('credit_card_request.*,customer.f_name,customer.l_name,customer.customer_id');
		$this->db->from('credit_card_request');
		$this->db->join('customer','customer.id = credit_card_request.user_id','left');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 function update_card($id, $data){
		$this->db->where('id', $id);
		$this->db->update('credit_card_request', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 public function get_all_card_id($id) {
		$this->db->select('credit_card_request.*,customer.f_name,customer.l_name,customer.customer_id');
		$this->db->from('credit_card_request');
		$this->db->join('customer','customer.id = credit_card_request.user_id','left');
		$this->db->where('credit_card_request.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function delete_card($id){
		$this->db->where('id', $id);
		$this->db->delete('credit_card_request'); 
	}
	
	
	public function delete_customer($id){
		$this->db->where('id', $id);
		$this->db->delete('customer'); 
	}
	
		
	public function getall_receipt_order (){
		$this->db->select('o.*,c.f_name,c.l_name,c.customer_id,c.status as cstatus,c.id as cid');
		$this->db->from('upload_receipt as o');
		$this->db->join('customer as c','c.customer_id=o.customer_id','left');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function getall_macro_purchases(){
		$this->db->select('t.*,c.f_name,c.l_name,c.customer_id,c.status as cstatus,c.id as cid');
		$this->db->from('transaction_wallet as t');
		$this->db->join('customer as c','c.id=t.userid','left');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getall_macro_purchases_by_id($id){
		$this->db->select('t.*,c.f_name,c.l_name,c.customer_id,c.status as cstatus,c.id as cid');
		$this->db->from('transaction_wallet as t');
		$this->db->join('customer as c','c.id=t.userid','left');
		$this->db->where('t.userid',$id);
		$this->db->where('t.type','Activate Account');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function get_user_upload_receipt($id){
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public	function getsingle_receipt_order($id){
		$this->db->select('r.*,c.f_name,c.l_name,c.customer_id,c.parent_customer_id,c.Franchise_customer_id');
		$this->db->from('upload_receipt as r');
		$this->db->join('customer as c','c.customer_id=r.customer_id','left');
		$this->db->where('r.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function update_receipt($id,  $data){
		$this->db->where('id', $id);
		$this->db->update('upload_receipt', $data);		
		$error = $this->db->error();
		if(empty($error['message'])) { return true; }
		else { return false; }

	}	

	public function delete_upload_receipt($id){
		$this->db->where('id', $id);
		$this->db->delete('upload_receipt'); 
		
	}
	
}
?>
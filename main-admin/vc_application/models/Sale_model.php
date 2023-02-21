<?php 
class Sale_model extends CI_Model {
 
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
    * Get sale by his is
    * @param int $sale_id 
    * @return array
    */
    public function get_all_sale($sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('tdate >=',$sdate);
		$this->db->where('tdate <=',$edate); 
		//$this->db->where('dis_amount','0'); 
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_all_fourtypercent()
    {
		$this->db->select('*');
		$this->db->from('fortypprecent_dis_amt');
		//$this->db->where('edate >=',$sdate);
		//$this->db->where('edate <=',$edate); 
		$this->db->where('status','active'); 
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_total_sale($sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('tdate >=',$sdate);
		$this->db->where('tdate <=',$edate);  
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 
   public function get_all_diamond_bdm(){
	   $this->db->select('c.id,p.id as pid,p.bsacode as pbsacode,p.bsacode');
		$this->db->from('customer as c');
		$this->db->join('customer as p','p.customer_id=c.direct_customer_id','left');
		$this->db->where('c.bsacode','Diamond BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function add_distribution_amount($amount,$userid,$level,$order_id,$cust_id){
         
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Active'					
			); 
		$this->db->insert('distribution_amount', $insert_data); 
	}
	    public function get_all_sale1($id)
    {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_sale_id($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 
public function get_customer_info($id)
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_merchant_id($id)
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('merchant_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_sale($data)
    {
		$insert = $this->db->insert('total_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
    function store_distribution_amount($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
   function update_customer_distribution_amount($amount,$customer){
    $this->db->query("update customer set bliss_amount = bliss_amount + ".$amount." where customer_id='".$customer."'");
   }
   
   function update_total_sale($id){
     $this->db->query("update total_sale set dis_amount = '1' where id='".$id."'");
   }
   
   function update_total_forty($id){
     $this->db->query("update fortypprecent_dis_amt set status = 'deactive' where id='".$id."'");
   }

    /**
    * Update sale
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_table($id, $data,$table)
    {
		$this->db->where('id', $id);
		$this->db->update($table, $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
    function update_sale($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete sale
    * @param int $id - sale id
    * @return boolean
    */
	
	
	function delete_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('orders'); 
	}
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	
	public function update_product_qty($id,$qty) {
       $this->db->query("update product set p_qty = p_qty - ".$qty." where id='".$id."'");
  }

/*	public function add_distribution_amount($amount,$userid,$level,$order_id){
         $admin_db = $this->load->database('ADMINDB', TRUE);
		$cust_id = $this->session->userdata('cust_id');
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Pending'
			); 
		$admin_db->insert('distribution_amount', $insert_data); 
	}
*/
   public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
                //$this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
	public function parent_bliss_result($parent_customer_id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }

	function my_friends($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_parent($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_customer_package($cust_id){
	   $this->db->select('id,parent_customer_id,customer_id,package');
		$this->db->from('customer'); 
		$this->db->where('customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function distribution_by_rank($cust_id,$rank){
	   $this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$cust_id);
		$this->db->where('rank',$rank);
		$query = $this->db->get();
		return $query->result_array(); 
	}
}
?>
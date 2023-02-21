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
    */	function validate($user_name, $password)
	{  
         $this->db->select('*');
		$this->db->from('customer');
		//$this->db->where('customer_id', $user_name);
		$this->db->where("(email='".$user_name."' OR customer_id='".$user_name."' OR phone='".$user_name."')");
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['cust_id'] = $row->id;
    			$return['full_name'] = $row->f_name.' '.$row->l_name;
    			$return['email'] = $row->email;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
                       if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
                       else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
			 }
			return $return;
                }
                else { return false ; }
	}
	
	public function get_all_installment($id)
    {
		$this->db->select('*');
		$this->db->from('installment as i');
		//$this->db->join('pins as p','i.order_id=p.id','left');
		$this->db->where('i.user_id',$id);
		$this->db->order_by('i.pay_date','asc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 

	  public function get_all_purchases($id)
    {
			$this->db->select('*');
			$this->db->from('purchases');
			$this->db->where('user_id',$id);
			$query = $this->db->get();
			return $query->result_array();
    }

public function insert_fund_request($data){
	  $this->db->insert('fund_request',$data);
	  return TRUE;

	} 

	public function add_purchases($data){
	  $this->db->insert('purchases',$data);
	  $insert_id = $this->db->insert_id();
	  return $insert_id;

	}  
	function get_neft($neft){
		$this->db->select('*');
		$this->db->from('fund_request');
		$this->db->where('neft', $neft);
		$query = $this->db->get();
		return $query->result_array(); 
	}
		function get_transactional_wallet($customer_id)
    {
		$this->db->select('w.*,c.customer_id,d.customer_id as dcustomer_id,a.customer_id as acustomer_id');
		$this->db->from('transaction_wallet as w');
		$this->db->join('customer as c', 'c.id = w.send_to', 'left');
		$this->db->join('customer as d', 'd.id = w.send_by', 'left');
		$this->db->join('customer as a', 'a.id = w.activate_id', 'left');
		$this->db->where('w.userid',$customer_id);
		$this->db->where('w.wallet_type','Activation Wallet');
		$query = $this->db->get();
		return $query->result_array();  
    }
    function wallet_summery_history($id)
    {
		$this->db->select('cr as tamount,status,coupon as acustomer_id,coupon as dcustomer_id,coupon as customer_id,dis as type,e_date as rdate,qty');
		$this->db->from('transaction_summery');
		$this->db->where('user_id',$id);
		$this->db->where('status','Approved');
		$query = $this->db->get();
		return $query->result_array();  
    }
		public function wallet_history($cid)
    {
		$this->db->select('t.*,c.customer_id,c.f_name');
		$this->db->from('transaction_wallet as t');
		$this->db->join('customer as c','c.id=t.activate_id','left');
		$this->db->where('userid',$cid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    	public function recharge_history($cid)
    {
		$this->db->select('*');
		$this->db->from('recharge_orders');
		$this->db->where('user_id',$cid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	 public function get_all_manual_sum($table,$col,$where='')
    {
		
		$this->db->select('SUM('.$col.') as amount');
		$this->db->from($table); 
		if($where!=''){ $this->db->where($where); }
		$query = $this->db->get();
		return $query->result_array();
    }
	
	 public function add_order($data_to_store){
		
	   $this->db->insert('transaction_summery', $data_to_store); 
	   $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update_order_status($id,$data_to_store){
		$this->db->where('id', $id);
	    $this->db->update('transaction_summery', $data_to_store);	
        return TRUE;
    }
	public function update_ins_status($id,$data_to_store){
		$this->db->where('id', $id);
	    $this->db->update('installment', $data_to_store);	
        return TRUE;
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
 
  function get_first_moneyback($id){
	$this->db->select('*');
	$this->db->from('incomes');
	$this->db->where('user_id',$id);
	$this->db->order_by('id','desc');
	$this->db->limit(1);
	$query=$this->db->get();
	return $query->result_array(); 
 }
  function show_incomes($id){
	$this->db->select('i.*,c.customer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c', 'c.id = i.user_send_by','left');
	$this->db->where('i.user_id',$id);
	$query=$this->db->get();
	return $query->result_array(); 
 }
 function get_income_by_type($id,$type){
	$this->db->select('i.*,c.customer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c', 'c.id = i.user_send_by','left');
	$this->db->where('i.user_id',$id);
	$this->db->where('i.type',$type);
	$query=$this->db->get();
	return $query->result_array(); 
 }
 function my_friends_in($cust_id){
	   $this->db->select('customer_id,f_name,l_name,rdate,direct_customer_id,parent_customer_id,macro,consume');
		$this->db->from('customer');
		$this->db->where_in('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	 function get_referal_location($customer_id){
	$this->db->select('*');
	$this->db->from('referall_ids');
	$this->db->where('code_no',$customer_id);
	$query=$this->db->get();
	return $query->result_array(); 
 }

		function super_admin_validate($user_name){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $user_name); 
		$query = $this->db->get();
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['cust_id'] = $row->id;
    			$return['full_name'] = $row->f_name.' '.$row->l_name;
    			$return['email'] = $row->email;
    			$return['rdate'] = $row->rdate;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
                       if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
                       else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
			 }
			return $return;
                }
                else { return false ; }
	}
	 public function check_autopool($user_id)
    {
		$this->db->select('*');
		$this->db->from('matrix');
		$this->db->where('user_id',$user_id);
		$this->db->order_by("id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();  
    }
    function friends_by_position_in_array($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,status,parent_customer_id,direct_customer_id,rdate,var_status,macro');
		$this->db->from('customer');
		$this->db->where_in('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function friends_by_position_direct_in_array($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,status,parent_customer_id,direct_customer_id,rdate,var_status,macro');
		$this->db->from('customer');
		$this->db->where_in('direct_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
    function my_friends_auto_pool($cust_id){

	    $this->db->select('d.customer_id as dcustomer_id,p.*,c.f_name,c.l_name,c.customer_id,c.status');
		$this->db->from('matrix as p');
		$this->db->join('customer as c', 'c.id = p.user_id','left');
		$this->db->join('customer as d', 'd.id = p.parent_id','left');
		$this->db->where('p.parent_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array();
	}
      public function autopool_team($placement_id)
    {
		$this->db->select('*');
		$this->db->from('matrix');
		$this->db->where_in('parent_id',$placement_id);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();  
    }
     public function autopool_direct_team($placement_id)
    {
		$this->db->select('c.customer_id,c.id,d.macro');
		$this->db->from('customer as c');
		$this->db->join('customer as d', 'c.direct_customer_id = d.customer_id','left');
		$this->db->where_in('c.parent_customer_id',$placement_id);
		$this->db->order_by("c.id", "asc");
		$query = $this->db->get();
		return $query->result_array();  
    }
      public function get_autopool_placement($package)
    {
		$this->db->select('*');
		$this->db->from('matrix');
		$this->db->where('children <',2);
		$this->db->where('package',$package);
		$this->db->order_by("id", "asc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();  
    }
    function insert_autopool_data($data_to){
		$this->db->insert('matrix',$data_to);
	}
	function update_autopool_child_num($placement_id){
	$sql="UPDATE matrix SET children=children+1 WHERE id=".$placement_id."";    
    $query = $this->db->query($sql);
		
	}
	
	function create_member()
	{

		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('customer');

		$this->db->where('customer_id', $this->input->post('bliss_code'));
		//$this->db->where('status', 'Active');
		$bliss_code_query = $this->db->get('customer');
		   
        //if($query->num_rows > 0){
         if(count($query->result_array()) > 0) { 
        	return 'false';
		} elseif($this->input->post('bliss_code')!='' && (count($bliss_code_query->result_array()) == 0)) { 
		   return 'false bliss_code';
		} else { 
			$new_member_insert_data = array(
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'state' => $this->input->post('constituency'),
				'city' => $this->input->post('city'),
				'status' => 'active',
				'pass_word' => md5($this->input->post('password'))						
			);
		
			

			
			  $this->db->insert('customer', $new_member_insert_data); 
              $insert_id = $this->db->insert_id();
			  $f_name = $this->input->post('f_name');
			  $phone = $this->input->post('phone');

				$bls_cod = $this->input->post('bliss_code');
				$customer_n = $insert_id.substr($f_name,0,3).substr($phone,-4);
                $customer_id = strtoupper($customer_n);
       
        $this->db->where('id', $insert_id);
		$this->db->update('customer', array('customer_id'=>$customer_id));	
		
		/* $this->db->where('cr_no', $bls_cod);
		$this->db->update('credit_card', array('status'=>'used', 'used_by'=>$insert_id));*/
		
		
/***************** SMS ******************/
$sms_msg = urlencode("Thank you for joining us today! Below is your login information:
Dear : ".$f_name."
User ID: ".$customer_id."
Password: ".$this->input->post('password')."
Email: ".$this->input->post('email')."\n
Thank you 
Team zoogol");

        $smstext = "http://sms.hypecreationz.com/vendorsms/pushsms.aspx?user=orderkaro_panchukula&123456@=xyz&msisdn=".$phone."&sid=WISZON&msg=".$sms_msg."&fl=0 ";
		
	//	file_get_contents($smstext);
					
					
					
					
					 $to = $this->input->post('email');
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: zoogol  <Info@zoogol.com>' . "\r\n"; 
				$subject = 'Thank you for joining the zoogol.';
				$message = '
				Respected  <b style="color:orange">'.$f_name.'</b><br>
I would like to welcome you to the zoogol personally. It has been a pleasure to be able to talk to you about our products. It is a tremendous honor for us to be working with you. We are looking forward to do more business deals with you. Your registration details is as below.<br><br>
ID-NO:- <b style="color:orange">'.$customer_id.'</b><br>
Password:- <b style="color:orange">'.$this->input->post('password').'</b><br>
<br>
Thank you for joining the zoogol.<br>
Looking forward to a continuous and a faithful business partnership with you.
<br>
Regards,
<br>
zoogol.';
		//		mail($to,$subject,$message,$headers);
				

								
					
/***************** SMS ******************/

			 return array('id'=>$insert_id,'customer_id'=>$customer_id);
		} 
	      
	}//create_member
	
	
function verify_customer(){
        $otp=$this->input->post('otp');
		$otp_exist=$this->session->userdata('otp_number');

		
		   
		   $this->db->where('parent_customer_id', $this->input->post('phone'));
		$query1 = $this->db->get('customer');
		$card_no = $query1->result_array(); 
		   
        //if($query->num_rows > 0){
        
		if(count($query1->result_array()) > 2) { 
        	return 'false al_phone';
		} 
		 elseif ($otp=='') {
			$phone = $card_no[0]['phone'];
			//$phone = 9888995669;
			$this->session->set_userdata('no_veryfied','no');
			 if($phone != '') {
				 $otp_crt = rand(1000,9999);
				 $data['veryfied_msg_otp'] = $otp_crt;
				 $this->session->set_userdata('otp_number',$otp_crt);
			 $sms_msg = urlencode("Your OTP is ".$otp_crt.".\n
Thank you
Team Wishzon");
				//echo '<script>alert("hello");</script>';
					
					$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-adwin&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=ADWINH&message=".$sms_msg;

					
					file_get_contents($smstext);
					

					
					
		}
			$data['veryfied_msg']="true";
			return 'send_otp';
		} 
		 elseif ($otp!=$otp_exist) {
			 
			 return 'wrong_otp';
			 
		 } elseif ($otp == $otp_exist) { 
				$user_id = $card_no[0]['id'];
				$cr_no = $card_no[0]['parent_customer_id'];
				$phone = $card_no[0]['phone'];
				$data_to_store = array(
				'user_id' => $user_id,
				'cr_no' => $cr_no,
				'phone' => $phone,
				'status' => 'pending'
				);
				$this->db->insert('credit_card_request',$data_to_store);
				$this->session->set_userdata('auth',$otp);
				return 'auth_verify';
			}
		 
		
	      
	}
	
	
	/*function get_bliss_code_by_phone($phone){
	   $this->db->select('code_no');
		$this->db->from('referall_ids');
		$this->db->where('code_no',$phone);
		$this->db->where('status','Active');
		$query = $this->db->get();
		return $query->result_array(); 
	}*/
	
	function get_bliss_code_by_phone($phone){
	   $this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$phone);
		//$this->db->where('status','Active');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function bliss_perk_history($id){
	   $this->db->select('*');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
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
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('customer');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 public function show_directs($customer_id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('direct_customer_id',$customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function show_member($customer_id){
		$this->db->select('c.*,d.*');
		$this->db->from('family_tree as c');
		$this->db->join('customer as d','d.id = c.family_id','left');
		$this->db->where('c.user_id',$customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_friends($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,status,parent_customer_id,rdate,macro');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
		function my_Franchise_customer_id($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,status,parent_customer_id,rdate');
		$this->db->from('customer');
		$this->db->where('Franchise_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_orders($uid){
	  
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	function get_order_by_id($id){
	  
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('id',$id);
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
		
	function my_bliss_amount($uid){
	  
		$this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('order_id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
		
	function bliss_perk_redeem_amount($id){ 
  $this->db->select('SUM(redeem) as total');
  $this->db->from('redeem_bliss');
  $this->db->where('user_id',$id);
  $this->db->where('redeem_status','approved');
  $query=$this->db->get();
  return $query->row()->total;
 }
	
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }

       function update_manual($table,$where, $data_to_store){ 
             $this->db->where($where);
	     $this->db->update($table, $data_to_store);	
            return TRUE;
       }
	   function update_profile_by_customer($id, $data_to_store){ 
             $this->db->where('customer_id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
    function update_order($id, $data_to_store){          
		$this->db->where('id', $id);
		$this->db->update('orders', $data_to_store);	
            return TRUE;
       }
 
 function validate_upl_credentials($data){
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}

	function validate_review($data){
		$insert = $this->db->insert('reviews', $data);
		return $insert;
	}  
	   
	  function redeem_bliss_request($data){
		$insert = $this->db->insert('redeem_bliss', $data);
		return $insert;
	}  
	
	function bliss_request($id){
	   $this->db->select('*');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
		$this->db->like('rdate',date("Y-m-d")); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function upgrade_accout_request($data,$id){
		$insert = $this->db->insert('upgrade_acc', $data);
		$this->db->where('id', $id);
		 $this->db->update('customer', array('up_req' => '1'));
		 
		
		return $insert;
	} 

//funtion to get email of user to send password
 function forgotPassword($phone) {
        $this->db->select('phone,customer_id,email');
        $this->db->from('customer'); 
        $this->db->where('customer_id', $phone); 
        $query=$this->db->get();
        return $query->row_array();
 }
 
 public function sendpassword($data){
        $phone = $data['phone'];
        $email = $data['email'];
        $customer_id = $data['customer_id'];
        $query1=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass = md5($passwordplain);
      
        $this->db->query("update customer set pass_word='".$newpass."' where customer_id = '".$customer_id."' ");       
                 $message='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";

		
		$sms_msg = urlencode('Dear '.$row[0]['f_name'].", Your New Password : ".$passwordplain."\r\nThanks for contacting regarding to forgot password! Team https://www.wishzon.com");
        
        //    $smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=".$phone."&message=".$sms_msg."&senderid=CANADA&accusage=1";
             $smstext = "http://sms.hypecreationz.com/vendorsms/pushsms.aspx?user=orderkaro_panchukula&123456@=xyz&msisdn=".$phone."&sid=WISZON&msg=".$sms_msg."&fl=0 ";
					//file_get_contents($smstext);


			$to = $email;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: travmaxholidays <info@travmaxholidays.com>' . "\r\n"; 
				$subject = 'Forgot password at travmaxholidays';
				
				$message='Dear '.$row[0]['f_name'].','. "\r\n";
        $message.='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";
        $message.='<br>Please update your password.';
        $message.='<br><br>Thanks & Regards';
        $message.='<br>travmaxholidays'; 
				$mail= mail($to,$subject,$message,$headers);
					
					  return 'true';
}
else {  return 'error'; }
} 
 
  

 function add_transactional_wallet($data)
    {
		$insert = $this->db->insert('transaction_wallet', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	function insert_manual($table,$data)
    {
		$insert = $this->db->insert($table, $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}

public function changePassword($pass)
{
	$customer_id = $this->session->userdata('bliss_id');
        $query=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' and pass_word = '".md5($pass)."' ");
		
		$row=$query->result_array();
        if ($query->num_rows()>0){ 
            return "true";
        }else{
            return "false";
        }
    }
	
	function update_wallet($id,$amount,$column)
    {
   $sql = "update `customer` set $column = $column - $amount where id='$id'";
    $this->db->query($sql); 
	}
	function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
	public function update_changePassword($data_to_store)
{
	$customer_id = $this->session->userdata('bliss_id');
	 $this->db->where('customer_id', $customer_id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
    }

    	public function add_income($data){ 
		$this->db->insert('incomes', $data); 
	}

	public function family_tree($data){ 
		$this->db->insert('family_tree', $data); 
	}

function parent_profile($blissid){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 

	 }
	
	 function get_customer_data_by_id($blissid){
		$this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.direct as ddirect');
		$this->db->from('customer as c');
		$this->db->from('customer as d','d.customer_id = c.customer_id','left');
		$this->db->where('c.customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 

	 }
	 
	 function add_installment($data)
    {
		$insert = $this->db->insert('installment', $data);
		return $insert;
	}

	function customer_card_request($id){
		$this->db->select('*');
		$this->db->from('credit_card_request');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function add_receipt($data){
		
	$this->db->insert('upload_receipt', $data);	
	$insert_id = $this->db->insert_id();
	return $insert_id;
	}
	
	function get_receipt_order ($id){
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function select_manual_num($table,$where){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows(); 
	}
	
	function redeem_online_purchase ($id){
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$this->db->where('customer_id',$id);
		$this->db->where('status','Redeem');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_alteady_family_detail ($id,$fid){
		$this->db->select('*');
		$this->db->from('family_tree');
		$this->db->where('user_id',$id);
		$this->db->where('family_id',$fid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function activity_log($id)
    {
		$this->db->select('*');
		$this->db->from('WorkWith'); 
		$this->db->where('zkey',$id);
		$this->db->order_by('id_no', 'DESC');

		//$this->db->join('customer','customer.customer_id = w.zkey','left');
		//$this->db->group_by('zkey');
		$query = $this->db->get();
		return $query->result_array();  
    }
}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pin extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('coupon_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
	  
    	
		 if ($this->input->server('REQUEST_METHOD') === 'POST') {
         
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		       $status = $this->input->post('st'); 
        }else{
			
			 $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
             $status = ''; 			 
			
		}
		
		$data['pin'] = $this->coupon_model->get_all_pin($sdate, $edate ,$status);
	
	//load the view
      $data['main_content'] = 'admin/pin_list';
      $this->load->view('includes/admin/template', $data);   
  }
   public function reward() {
	   
	   
   
		 if ($this->input->server('REQUEST_METHOD') === 'POST') {
         
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('s_name')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('e_name'))); 
		      
        }else{
			
			 $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
            	 
			
		}
	$data['reward'] = $this->coupon_model->get_reward_by_date($sdate, $edate);
	
	//load the view
      $data['main_content'] = 'admin/reward';
      $this->load->view('includes/admin/template', $data);   
  }
   
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('pins', 'No of pins', 'required|trim');
			$this->form_validation->set_rules('pinid', 'Plan Package', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		$no_of_pin=$this->input->post('pins');
		$package=explode("~",$this->input->post('pinid'));
		$order_id='';
		
		for ($x = 1; $x <= $no_of_pin; $x++) {
			
			$data_to_store = array(
				    'pinid' => random_string('alnum',6).random_string('alnum',4),
                    'p_amount' => $package[1],
                    'b_volume' => $package[2],
                    'package' => $package[0],
                    're_purchase' => $package[3]
					);
     $order_id = $this->coupon_model->store_pin($data_to_store);
        } 
		
				if(is_numeric($order_id)){
					
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/pin/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                
				
            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/pin_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  

  public function update(){
	  	
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			$this->form_validation->set_rules('pins', 'No. of E-Pin', 'required|trim|numeric');
			
			
			
             $user = $this->coupon_model->get_customer_by_id($this->input->post('assign_to'));
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } 
			if(!empty($user) && $user[0]['consume']=='1' && $this->input->post('pinid')=='0') {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is already active'); 
            } 
			if(!empty($user) && $this->input->post('pins') > 1 && $this->input->post('pinid')=='0') {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'You can not send 0 pin more then 1'); 
            } 
			
			$pinid=$this->input->post('pinid');
			$number_of_pins=$this->input->post('pins');
			$countpin = $this->coupon_model->count_available_pins($pinid,$number_of_pins);
			
			//print_r($countpin);
            if(count($countpin)<$number_of_pins) {
		       $this->form_validation->set_rules('epins', '', 'required'); 
		       $this->form_validation->set_message('required', 'Pins not available'); 
            }
			
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		
		
		if(!empty($countpin)){ 
      foreach ($countpin as $value) {
	         
			 $data_to_store = array(
                    'assign_to' => $user[0]['customer_id'],
                    'status' => 'Active',
					);
			if($value['p_amount']=='0') {
				$data_to_store['status'] = 'Used';  
				$data_to_store['used_by'] = $user[0]['customer_id'];  
				$data_to_store['used_on'] = date('Y-m-d');  
				$user_data = array('consume'=>'1');
				$this->coupon_model->update_profile_by_customer_id($user[0]['customer_id'], $user_data);
			}
			 $return = $this->coupon_model->update_pin($value['id'], $data_to_store);
			 
            }
		}

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/pin/edit');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        //$data['pin'] = $this->coupon_model->get_all_pin_id($); 
        //load the view
        $data['main_content'] = 'admin/pin_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->coupon_model->delete_pin($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/pin');
 }  

		  public function payouts() {
		   $last_saturday = date('Y-m-d 00:00:01',strtotime("last monday"));
		  $week_end = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_saturday)));
		  $data['error_msg'] = '';
		  $payouts = $this->coupon_model->get_all_payout('Weekly Closing');
		  
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$user_ids = $this->input->post('userid');
				if(empty($user_ids) || empty($payouts)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				} else {
					
					//foreach($user_ids as $uid) {
					foreach($payouts as $userinfo) {
					  if(in_array($userinfo['id'],$user_ids)) { 
						//$this->coupon_model->update_income_status($userinfo[0]);
						$tr_log = array('status'=>'Bank Process');
						$this->coupon_model->update_transactional_log_byid($userinfo['id'],$tr_log);
						/***************** transectional email ******************/
			if($userinfo['email']!='') {
				$tds = (5 / 100) * $userinfo['amount'];
				$payable = $userinfo['amount'] - $tds - $tds;
				$payable = round($payable,2);
				 $to = $userinfo['email'];
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: divinoindia <info@divinoindia.in>' . "\r\n"; 
				$subject = 'divinoindia weekly closing.';
$message = 'Congratulation <strong>'.$userinfo['f_name'].' '.$userinfo['l_name'].'</strong> total payout for A/C '.$userinfo['account_no'].' is <strong>Rs. '.$payable.'</strong> weekly has been transferred and will be credited within 48 hours in your bank.
</b><br> 
From - divinoindia<br>
Date: '.date('d F Y h:i:s A').'
';
				//mail($to,$subject,$message,$headers);
			}
			
					  }
					}
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Payout Successfully.</strong></div>';
					$payouts = $this->coupon_model->get_all_payout('Weekly Closing');
				}
			}
		
		
		if(!empty($payouts)) { 
			for($i=0;$i<count($payouts);$i++){
				$total_income = $this->coupon_model->get_total_income($payouts[$i]['user_id']);
				$payouts[$i]['total_income'] = $total_income[0]['total_amount'] + 0;
			}
		}	
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/payouts';
		  $this->load->view('includes/admin/template', $data);   
	  }
	 
	 public function bank_process() { 
		  $data['error_msg'] = '';
		  $payouts = $this->coupon_model->get_all_payout('Bank Process');
		  
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$user_ids = $this->input->post('userid');
				$banktrid = $this->input->post('banktrid');
				if(empty($user_ids) || empty($payouts)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				} else {
					
					//foreach($user_ids as $uid) {
					for($p=0;$p<count($payouts);$p++) {
					    $userinfo = $payouts[$p];
					  if(in_array($userinfo['id'],$user_ids)) {  
						$tr_log = array('status'=>'Clear','bank_tran'=>$banktrid[$p]);
						//echo '<pre>';print_r($tr_log);echo '</pre>';
						$this->coupon_model->update_transactional_log_byid($userinfo['id'],$tr_log);
						$this->coupon_model->update_income_status_clear($userinfo['userid']);
					  }
					}
					/*foreach($payouts as $userinfo) {
					  if(in_array($userinfo['userid'],$user_ids)) {  
						$tr_log = array('status'=>'Clear');
						$this->coupon_model->update_transactional_log($userinfo['userid'],$tr_log);
						$this->coupon_model->update_income_status_clear($userinfo['userid']);
					  }
					}*/
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Bank Process Compleded Successfully.</strong></div>';
					$payouts = $this->coupon_model->get_all_payout('Bank Process');
				}
			}
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/bank_process';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  public function bank_statement() { 
		  $data['error_msg'] = '';
		  
		   if ($this->input->server('REQUEST_METHOD') === 'POST') {
			 
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));  
			}else{ 
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59'); 
			}
			
		  $payouts = $this->coupon_model->get_all_payout('Clear',$sdate,$edate);
		  
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/bank_statement';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
	   public function moneyback_closing() {
			$last_monday = date('Y-m-d 00:00:01',strtotime("previous monday"));
		   if(date('l')=='Tuesday') { $last_monday = date('Y-m-d 00:00:01'); } 
		  $week_end = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_monday)));
		  $data['error_msg'] = '';
		  $payouts = $this->coupon_model->get_payout_by_date('',$week_end,'Pending','MoneyBack');
		 //	echo '<pre>'; print_r($payouts); die();
		  
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$user_ids = $this->input->post('userid');
				if($week_end > date('Y-m-d H:i:s') && 1==2) {
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>You can not close week before Monday 12 AM.</strong></div>';
				} 
				/*elseif(empty($user_ids)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				}*/ 
				else {
					$all_users = array();
					foreach($payouts as $con){ 
					    $all_users[] = $con['user_id'];
						$total_amount = $con['total_amount'];
						$g_total_amount = round($total_amount,2);
						$caping = 0;
						$tds = (5 / 100) * $total_amount;
						$payable = $total_amount - $tds - $tds;
						$payable = round($payable,2);
						//$description = $con['user_id'].'~~'.$con['email'].'~~'.$con['phone'].'~~'.$con['f_name'].' '.$con['l_name'].'~~'.$con['account_no'].'~~'.$con['bank_name'].'~~'.$con['ifsc'].'~~'.$con['pancard'].'~~'.$total_amount.'~~'.$tds;
						/*$description = $con['user_id'].'~~'.$g_total_amount.'~~'.$total_amount.'~~'.$tds;
						$tr_log = array('user_id'=>$con['user_id'],'amount'=>$total_amount,'type'=>'Weekly closing','description'=>$description,'caping'=>$g_total_amount,'status'=>'Weekly Closing');
						$this->coupon_model->add_transactional_log($tr_log);*/
						
						$this->coupon_model->load_wallet($con['user_id'],$con['total_amount'],'money_wallet');
					}
					if(!empty($all_users)) {
						//echo '<pre>'; print_r($all_users);
					    $this->coupon_model->update_income_status_all_user($all_users,'MoneyBack');
					   // die();
					}
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Weekly Closing Successfully.</strong></div>';
				}
				$payouts = $this->coupon_model->get_payout_by_date('',$week_end,'Pending','MoneyBack');
			}
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/weekly_closing';
		  $this->load->view('includes/admin/template', $data);   
	  }


   public function used_pins() {

		 if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='Search') {
		       $sdate = date('Y-m-d',strtotime($this->input->post('sdate')));
		      $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		       $status = $this->input->post('st');
        }else{
			 $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
            		 
		}
				$data['distributeall'] = '';
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('destribute')=='Distribute amount') {
		$distribution_amount = $this->input->post('dis_amt');
		 if($distribution_amount!='') {
		  $all_royal_member = $this->coupon_model->get_all_royal_club();
			if(!empty($all_royal_member) && count($all_royal_member) > 0) {
				$dis_amount = (1 / 100) * $distribution_amount;
				$final_dis_amount = $dis_amount / count($all_royal_member);
				$final_dis_amount = round($final_dis_amount,2);
				foreach($all_royal_member as $uid) {
			 $this->coupon_model->add_royalti_club_amount($final_dis_amount,$uid['id']); 
				}
				$data['distributeall'] = 'done';
			}
		 }
		}

		$data['pin'] = $this->coupon_model->get_all_used_pin($sdate,$edate);
	//load the view
      $data['main_content'] = 'admin/pin_list';
      $this->load->view('includes/admin/template', $data);   
  }


}
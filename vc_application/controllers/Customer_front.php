<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('search_model');	
        $this->load->model('customer_model');
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'home';
                $data['page_title'] = 'Wishzon';
				
            
				
        	$data['operator'] = $this->customer_model->get_operator();
			  $data['circle'] = $this->customer_model->get_list_circle();

			  $data['operator_plan'] = $this->customer_model->get_operator_plan();
			  
				
			  $all_operator = array();
			  $oper_type = array();
			    if(!empty($data['operator'])) {
				foreach($data['operator'] as $value) {
					$all_operator[$value['Operator_Code']] = $value['oper_name'];
					$oper_type[$value['Operator_Code']] = $value['oper_type'];
				}
			  }  
		//	echo '<pre>'; print_r($data['operator_plan']); die();
        $data['msg'] = '';
		$return = 'Failure';
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('confirm')=='Confirm') { 
    			
   
            $cust_id = $this->session->userdata('cust_id');
		    $this->form_validation->set_rules('phone', 'phone', 'required|trim|numeric');
			$this->form_validation->set_rules('operator', 'operator', 'required|trim');
			$this->form_validation->set_rules('circle', 'circle', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required|trim|numeric');
			
			$cust_info = $this->customer_model->get_customer_credit($cust_id);
			if(empty($cust_info)) {
				$this->form_validation->set_rules('customerror', 'login', 'required|trim');
				$this->form_validation->set_message('required', 'Please login first.');
			} else {
				/* if($cust_id !=1) {
					$this->form_validation->set_rules('wedrftg', 'login', 'required');
				    $this->form_validation->set_message('required', 'You are not eligible for this transaction.');
				} */
					if($this->input->post('paytype') == 'Wallet') {
				if($this->input->post('amount') > $cust_info[0]['bliss_amount']) {
					$this->form_validation->set_rules('dfdfgdfs', 'login', 'required|trim');
				    $this->form_validation->set_message('required', 'You can not use more than your wallet Amount.');
				}
				$howtopay="wallet";
			}
			
		
			}
			
           $my_array1 = array('user_id' => $cust_id); 
            
			//$this->form_validation->set_rules('customerror', 'pin', 'required|trim');
			//$this->form_validation->set_message('required', 'Recharge server is down right now please try after 1 hour.');
           $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            
             
            if ($this->form_validation->run()) { 
				 $data_to_store = array(				
                    'amount' => $this->input->post('amount'),				
                    'status' => 'Dr.',
                    'desc' => 'Amount Dr. for recharge on '.$this->input->post('phone').' for ( '.$all_operator[$this->input->post('operator')].' )',
                ); 
	$redeemid = $this->customer_model->add_redeem_bliss($data_to_store);
				  
				  if(is_numeric($redeemid)) {
				      
				 
				  $usertx = $redeemid; 
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'https://myrc.in/recharge/api?username=502102&pwd=717880&circlecode=2&operatorcode='.$this->input->post('operator').'&number='.$this->input->post('phone').'&amount='.$this->input->post('amount').'&orderid='.$usertx.'&format=json');

curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
$query = curl_exec($curl_handle);
curl_close($curl_handle);

$api_result = json_decode($query,true);
 /*echo '<pre>'; print_r($api_result);echo '</pre>';
die();*/ 
$data['message'] = $api_result['status'];
if($api_result['status']=='Failure') { 
	$return = 'false';
if (array_key_exists('opid', $api_result)) {
		/************ add in order *****************/
	  $recharge_msg = "Rs. ".$this->input->post('amount')." recharge at ".$this->input->post('phone')." this number. for  ".$all_operator[$this->input->post('operator')]." ";
	  
	  $data_to_add_order_arr = array('items'=>'recharge','p_name'=>$cust_info[0]['f_name'].' '.$cust_info[0]['l_name'],'p_phone'=>$cust_info[0]['phone'],'p_address'=>'Failure','p_address2'=>$api_result['opid'],'spl_note' => $recharge_msg,'total_amount'=>$this->input->post('amount'),'status'=>'Failed','comm_dis'=>$this->input->post('operator_commision')); 
      $data_to_add_order = array_merge($data_to_add_order_arr, $my_array1); 
	  $order_id = $this->customer_model->add_recharge_in_order($data_to_add_order);
}
} 
elseif($api_result['status']=='Success' || $api_result['status']=='Pending') { 

  $return = 'true';
  if($api_result['status']=='Pending') { $return = 'Pending'; }
  
  //if($api_result['status']=='SUCCESS' && $api_result['Transid']!='' && $api_result['Transid']!='0') {
  if($api_result['orderid']!='' && $api_result['orderid']!='0') {
	  $tranref = $api_result['orderid'];
  } else { $tranref = $redeemid; }
  
  $url_status = 'http://myrc.in/recharge/status?username=501806&pwd=560323&orderid='.$tranref.'&format=json';
  $xml_status_content = file_get_contents($url_status); 
  //print_r($xml_status_content);
  //die();
 $xml_status_result = json_decode($xml_status_content,true);
  if(empty($xml_status_result['status'])) { $order_status = $api_result['status']; }
  elseif($xml_status_result['status']=='Success') { $order_status = $api_result['status']; $return = 'true'; }
  else { $order_status = $xml_status_result['status']; }
  
  
  //$this->customer_model->update_customer_bliss($cust_id,$this->input->post('amount'));
  
  /************ add in order *****************/
  $recharge_msg = "Rs. ".$this->input->post('amount')." recharge at ".$this->input->post('phone')." this number. for  ".$all_operator[$this->input->post('operator')]." ";
  
  $data_to_add_order_arr = array('items'=>'recharge','p_name'=>$cust_info[0]['f_name'].' '.$cust_info[0]['l_name'],'p_phone'=>$cust_info[0]['phone'],'p_address'=>$order_status,'p_address2'=>$tranref,'spl_note' => $recharge_msg,'total_amount'=>$this->input->post('amount'),'status'=>'Pending','comm_dis'=>$this->input->post('operator_commision'),'rec_type'=>'online','how_to_pay'=>$howtopay); 
  
   $data_to_add_order = array_merge($data_to_add_order_arr, $my_array1); 
  
  //echo '<pre>'; print_r($data_to_add_order);echo '</pre>';
  
  $order_id = $this->customer_model->add_recharge_in_order($data_to_add_order);
 
  if($this->input->post('paytype') == 'Credit') {
       $this->customer_model->update_customer_credit_am($cust_id,$this->input->post('amount'));
	  }elseif($this->input->post('paytype') == 'Wallet') {
	   $this->customer_model->update_customer_bliss($cust_id,$this->input->post('amount'));
	  }
 
  if(is_numeric($order_id)) {
	  $data_to_update1 = array('order_id' => $order_id); 
	  $data_to_update = array_merge($data_to_update1, $my_array1); 
	  $this->customer_model->update_redeem_bliss($redeemid,$data_to_update);
	  
	  
  }
  
  if($oper_type[$this->input->post('operator')]==0){
  /**************** SMS *******************/
  //$phone = '8528907107'; 
  $phone = '8360307059'; 
	    if($phone != '') {
$sms_msg = urlencode("Received request of ".$this->input->post('optradio')." recharge Rs.".$this->input->post('amount')."  operator ".$all_operator[$this->input->post('operator')]." on phone ".$this->input->post('phone').".\n
Thank you
Team payearn");  
			
			$smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=".$phone."&message=".$sms_msg."&senderid=CANADA&accusage=1";
			file_get_contents($smstext); 
		}
		
  }

  /**************** SMS *******************/
  
  $phone = $cust_info[0]['phone'];
	    if($phone != '') {
			$sms_msg = urlencode("Recharge of Rs.".$this->input->post('amount')."  for (mobile or dth number) via payearn.com is being processed You will be notified by operator on registered phone number.\n
Thank you
Team payearn");  
			$smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=".$phone."&message=".$sms_msg."&senderid=CANADA&accusage=1";
			file_get_contents($smstext); 
		}
		
} 
}
	$return = trim($return);
    if($return == 'true'){ $this->session->set_flashdata('recharge', 'updated'); $recharge = 'updated'; }
    elseif($return == 'Pending'){ $this->session->set_flashdata('recharge', 'Pending'); $recharge = 'Pending'; }
	else { $this->session->set_flashdata('recharge', 'Failure'); $recharge = 'Failure'; }
			$this->session->set_userdata('recharge',$recharge);
	       $this->session->set_flashdata('recharge_msg', $data['message']);
			//redirect(base_url('recharge'));	
            }//validation run

           // echo '<pre>'; print_r($this->session->flashdata()); die();
        }  
			 
		/* 	if ($this->input->server('REQUEST_METHOD') === 'POST') { */  

			$data['state'] = $this->customer_model->state();
			$data['constituency'] = $this->customer_model->fetch_constituency();
			$data['category_list'] = $this->customer_model->get_category_list();
			//echo '<pre>'; print_r($data['category_list']);die();
            $data['b_d_coupon'] = $this->customer_model->b_d_coupon();
            $data['category_food_list'] = $this->customer_model->get_category_food_list();			
            $data['slider'] = $this->customer_model->slider(); 
			$data['featured_product'] = $this->customer_model->get_featured_product();
			$data['featured_admin_product'] = $this->customer_model->get_featured_admin_product();
			$data['merchant'] = $this->customer_model->merchant_data();
	        $data['main_content'] = 'home_page';
            $this->load->view('includes/front/front_template', $data); 	
		/* } else{ 
			$data['slider'] = $this->customer_model->dealslider(); 
			$data['slider1'] = $this->customer_model->dealslider1(); 
		    $data['featured_admin_product'] = $this->customer_model->get_featured_deal_product();
		    $data['featured_admin_product_top'] = array_slice($data['featured_admin_product'], 0, 8); 
		    $data['featured_admin_product_med'] = array_slice($data['featured_admin_product'], 8); 
            $this->load->view('front_deal_page', $data); 
	}  */
		
		
	/*
			 if($this->session->userdata('deal') == 'web deals'){
			$data['category_list'] = $this->customer_model->get_category_list();
            $data['b_d_coupon'] = $this->customer_model->b_d_coupon();
            $data['category_food_list'] = $this->customer_model->get_category_food_list();			
            $data['slider'] = $this->customer_model->slider(); 
			$data['featured_product'] = $this->customer_model->get_featured_product();
			$data['featured_admin_product'] = $this->customer_model->get_featured_admin_product();
			$data['merchant'] = $this->customer_model->merchant_data();
	        $data['main_content'] = 'home_page';
            $this->load->view('includes/front/front_template', $data); 		
			}else{
			$data['slider'] = $this->customer_model->slider(); 
		    $data['featured_admin_product'] = $this->customer_model->get_featured_deal_product();
		    $data['featured_admin_product_top'] = array_slice($data['featured_admin_product'], 0, 8); 
		    $data['featured_admin_product_med'] = array_slice($data['featured_admin_product'], 8); 
            $this->load->view('front_deal_page', $data); 
			 } */
	}
	
	
		public function city_search()
	{
		
		
			$get_city = $this->customer_model->get_city(); 
			echo '<option value="" selected="selected">Select City</option>';
              if(!empty($get_city)) { 
foreach($get_city as $city) {
	if($city['city']!='') {
	echo '<option class="city" value="'.$city['city'].'"';
					  if($city['city']!='' && $city['city']==$this->input->post('city')) { echo ' selected="selected" '; }
					  echo '>'.strtoupper($city['city']).'</option>';
} }
} 

 

	}
	
public function place_search()
	{
		
		
			$get_city = $this->customer_model->get_place($this->input->post('place')); 
              if(!empty($get_city)) { 
			  
foreach($get_city as $city) {
	echo '<option value="'.$city['sector'].'"';
					  if($city['sector']==$this->input->post('place')) { echo ' selected="selected" '; }
					  echo '>'.strtoupper($city['sector']).'</option>';
	}
} 


	
    
		  

	}


}

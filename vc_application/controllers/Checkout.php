<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
	    $this->load->library('form_validation');
		$this->load->library('cart');
        $this->load->model('customer_model');	
        $this->load->model('checkout_model');	
		$cart = $this->cart->contents();
		
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emi_payment')=='Online') {}
		elseif(isset($_POST['encResp']) && $_POST['encResp']!='') {}
        elseif(empty($cart)) { redirect(base_url().'cart'); }
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'checkout';
                $data['page_title'] = 'Checkout';  
				
		$cust_id = $this->session->userdata('cust_id');
 
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('city', 'city', 'required|trim');
            $this->form_validation->set_rules('state', 'state', 'required|trim');
            $this->form_validation->set_rules('zip', 'zip', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$this->session->set_userdata('p_name',$this->input->post('name'));
				$this->session->set_userdata('p_email',$this->input->post('email'));
				$this->session->set_userdata('p_phone',$this->input->post('phone'));
				$this->session->set_userdata('p_address',$this->input->post('address'));
				$this->session->set_userdata('p_address2',$this->input->post('address2'));
				$this->session->set_userdata('p_city',$this->input->post('city'));
				$this->session->set_userdata('p_state',$this->input->post('state'));
				$this->session->set_userdata('p_zip',$this->input->post('zip'));
				$this->session->set_userdata('spl_note',$this->input->post('message'));
				redirect(base_url().'payment');
			}
			
		}
		    $data['category_list'] = $this->customer_model->get_category_list();
		    $data['customer_add'] = $this->customer_model->get_customer_address($cust_id);
	        $data['main_content'] = 'checkout';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function payment()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'payment';
                $data['page_title'] = 'Payment';  
        
		$cust_id = $this->session->userdata('cust_id');
	 if($cust_id!='') { 
			$data['profile'] = $this->checkout_model->profile($cust_id);
		} else {
                   $this->session->set_flashdata('flash_message', 'need_login');
	           redirect(base_url().'checkout');
                } 
		 	
			
		$ccavenue = $razorpay = 'false'; 
		
		$data['veryfied_msg']="false"; $data['veryfied_msg_otp'] = ''; $data['veryfied_no_expire'] = '';
		
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('verify_otp')=='true') {
			if($this->input->post('otp_num')==$this->input->post('otp')){
				$this->session->set_userdata('no_veryfied','yes');
				$data['veryfied_msg']="verifyed";
			} else {
				$data['veryfied_msg']="true";
				$this->session->set_userdata('no_veryfied','no');
				$data['veryfied_no_expire'] = 'true';
			}
		}
		elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('bliss_perk_payment_input')=='true') {
			$amount_without_coupon = $this->session->userdata('order_total');
			if($this->session->userdata('coupon_val') > 0) {
				$amount_without_coupon = $this->session->userdata('order_total') + $this->session->userdata('coupon_val');
			   }
			    $this->session->set_userdata('order_total',$amount_without_coupon);
				$coupon = $this->session->set_userdata('coupon_code','');
				$coupon_val = $this->session->set_userdata('coupon_val','');
				$this->session->set_userdata('no_veryfied','');
				$this->session->set_userdata('otp_number','');
		}
		elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('cod_payment_input')=='true') {
			$phone = $this->input->post('phone');
			$this->session->set_userdata('no_veryfied','no');
			 if($phone != '') {
				 $otp = rand(1000,9999);
				 $data['veryfied_msg_otp'] = $otp;
				 $this->session->set_userdata('otp_number',$otp);
			 $sms_msg = urlencode("Your OTP is ".$otp.".\n
Thank you
Team Dnd");  
					//$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=BLISSZ&message=".$sms_msg;
					//file_get_contents($smstext);
		}
			$data['veryfied_msg']="true";
			
		}
		elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emi_payment')=='Online') {
			$emi_error = 'false'; 
			    $order_id = $this->input->post('order_id');
		        $order_result = $this->checkout_model->get_order_by_id($order_id);
			$emi_payment = 0;
		    if(!empty($order_result)) {
				if($order_result[0]['emi']!='no') {
					$emi_info = json_decode($order_result[0]['emi_info'],true);
					$emi_payment = $emi_info['total_amount'] - $order_result[0]['emi'];
				} 
				if($this->input->post('amount')==$emi_payment || $emi_payment!='0') {
					$emi_error = 'true'; 
				}
			}
			
				if($emi_error == 'true'){
					$this->session->set_userdata('how_to_payment','emi_payment');
					$this->session->set_userdata('order_total',$emi_payment);
					$this->session->set_userdata('last_order_id',$order_id);
                    $ccavenue = 'true';
                } else {
                    $this->session->set_flashdata('flash_message', 'emi_payment_error');
				    redirect(base_url().'admin');
                } 
				$this->session->set_userdata('no_veryfied','');
				$this->session->set_userdata('otp_number','');
		}
		elseif ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			$emi = $this->input->post('emi');
			$emiinfo = 'no';
			$this->session->set_userdata('emi_payment',$emi);
			if($emi=='yes') {
			  $emiinfo_array = array('orderid'=>'','total_amount'=>$this->session->userdata('order_total'),'last_date'=>'');
			  $emiinfo = json_encode($emiinfo_array);
			  $emi_amount = round(($this->session->userdata('order_total') / 2),2);
			  $this->session->set_userdata('order_total',$emi_amount);
			  $emi = $emi_amount;
			}
			
            //form validation
            $this->form_validation->set_rules('p_name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('p_email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('p_phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('p_address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('p_city', 'city', 'required|trim');
            $this->form_validation->set_rules('p_state', 'state', 'required|trim');
            $this->form_validation->set_rules('p_zip', 'zip', 'required|trim|numeric');
			
          /*  if($this->input->post('how_to_pay')=='cod') {
			   if($this->session->userdata('no_veryfied')!='yes'){
				 $this->form_validation->set_rules('bliss_perk_error', 'bliss_perk_error', 'required|trim');
				 $this->form_validation->set_message('required', 'Please verify your phone number.');
			   }
		   } */
		   
           if($this->input->post('how_to_pay')=='blissperks') {
			   if($this->session->userdata('coupon_val') > 0) {
				$amount_without_coupon = $this->session->userdata('order_total') + $this->session->userdata('coupon_val');
			    $this->session->set_userdata('order_total',$amount_without_coupon);
				$coupon = $this->session->set_userdata('coupon_code','');
				$coupon_val = $this->session->set_userdata('coupon_val','');
			   }
			   if($data['profile'][0]['bliss_amount'] < $this->session->userdata('order_total')) {
				$this->form_validation->set_rules('bliss_perk_error', 'bliss_perk_error', 'required|trim');
				$this->form_validation->set_message('required', 'Your  amount is less then your order.');
              }
		   }
		   
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
				$cart = $this->cart->contents();
                $items = json_encode($cart);
				$coupon = $this->session->userdata('coupon_code');
				$coupon_val = $this->session->userdata('coupon_val');
				//$distribution_amount = $this->session->userdata('comm_dis') + 0;
				$distribution_amount = $this->session->userdata('order_sub_total') + 0;
				if($cust_id =='' || $cust_id ==' ') { $cust_id = 0; }
				
				if($this->input->post('how_to_pay')=='razorpay') {$status= 'Process';}else{$status= 'Pending';}
				
		        $data_to_store = array(
					'user_id' => $cust_id,
                     'p_name' => $this->input->post('p_name'),
					 'p_email' => $this->input->post('p_email'), 
					 'p_phone' => $this->input->post('p_phone'),
					 'p_address' => $this->input->post('p_address'),
					 'p_address2' => $this->input->post('p_address2'),
					 'p_city' => $this->input->post('p_city'),
					 'p_state' => $this->input->post('p_state'),
					 'p_zip' => $this->input->post('p_zip'),
					 'spl_note' => $this->input->post('message'),
					 'how_to_pay' => $this->input->post('how_to_pay'),
                     'shipping' => $this->session->userdata('order_shipping'),
                     'tax' => $this->session->userdata('order_tax'),
                     'total_amount' => $this->session->userdata('order_total'),
					 'emi_info' => $emiinfo,
					 'comm_dis' => $distribution_amount,
					 'items' => $items,
					 'coupon_val' => $coupon_val,
					 'coupon' => $coupon,
					 'status' => $status,
					 ); 
			  $order_id = $this->checkout_model->add_order($data_to_store);
			  if($this->input->post('how_to_pay')=='razorpay') { $razorpay = 'true'; }
			  elseif($this->input->post('how_to_pay')=='ccavenue') { $ccavenue = 'true'; }
			  
				if($this->session->userdata('order_total')=='0' && $this->session->userdata('coupon_val') > 500) {  
					$this->session->set_userdata('how_to_payment','coupon');
					$this->session->set_userdata('last_order_id',$order_id);
					$phone = $this->input->post('p_phone');
					$this->session->set_userdata('phone_msg',$phone);
					
					redirect(base_url().'thankyou');
				}
				elseif($this->input->post('how_to_pay')=='blissperks') { 
				    $updated_amount = $data['profile'][0]['bliss_amount'] - $this->session->userdata('order_total') + 0;
				    $data_profile_array = array('bliss_amount'=>$updated_amount);
				    $this->checkout_model->update_profile($cust_id,$data_profile_array);
					$this->session->set_userdata('how_to_payment','blissperks');
					$this->session->set_userdata('last_order_id',$order_id);
					$phone = $this->input->post('p_phone');
					$this->session->set_userdata('phone_msg',$phone);
					
					redirect(base_url().'thankyou');
				}
				elseif($this->input->post('how_to_pay')=='cod') {
					$this->session->set_userdata('how_to_payment','cod');
					$this->session->set_userdata('last_order_id',$order_id);
					$phone = $this->input->post('p_phone');
					$this->session->set_userdata('phone_msg',$phone);
					redirect(base_url().'thankyou');
				}
				elseif($ccavenue == 'false' && $razorpay=='false') { redirect(base_url().'thankyou'); }
			}
			
		}
		
		
		
		
		$data['category_list'] = $this->customer_model->get_category_list();
		
		if($ccavenue == 'true') {   
		 $production_url = 'tid='.date('Ymdhis').'&merchant_id=164049&order_id='.$order_id.'&amount='.$this->session->userdata('order_total').'&currency=INR&redirect_url='.base_url().'thankyou&cancel_url='.base_url().'thankyou&language=EN&billing_name='.$this->input->post('p_name').'&billing_address='.$this->input->post('p_address').'&billing_city='.$this->input->post('p_city').'&billing_state='.$this->input->post('p_state').'&billing_zip='.$this->input->post('p_zip').'&billing_country=India&billing_tel='.$this->input->post('p_phone').'&billing_email='.$this->input->post('p_email').'&delivery_name='.$this->input->post('p_name').'&delivery_address='.$this->input->post('p_address').'&delivery_city='.$this->input->post('p_city').'&delivery_state='.$this->input->post('p_state').'&delivery_zip='.$this->input->post('p_zip').'&delivery_country=India&delivery_tel='.$this->input->post('p_phone').'&merchant_param1=&promo_code=&customer_identifier=&integration_type=iframe_normal&';
		 
		$working_key = '183540A0CF27B20FE31C1667F2366FAE';//Shared by CCAVENUES
		$access_code='AVHQ75FA80CA01QHAC';//Shared by CCAVENUES
		
		$encrypted_data = $this->encrypt($production_url,$working_key); // Method for encrypting the data.
		 
		$data['production_url'] = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
		
		
		//$data['production_url'] = 'http://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
		
		
		$data['main_content'] = 'ccavenue'; 
		}
		elseif($razorpay == 'true') {   
		 $data['order_id'] = $order_id;
		 $data['order_amt'] = $this->session->userdata('order_total');
		 $data['oname'] = $this->input->post('p_name');
		 $data['phone'] = $this->input->post('p_phone');
		 $data['email'] = $this->input->post('p_email'); 
		
		$data['main_content'] = 'razorpay'; 
		}
		else { $data['main_content'] = 'payment'; }
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	public function thankyou()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'thankyou';
                $data['page_title'] = 'Thank you';  
				$send_msg = 'false';
				$send_msg_order = '';
				
				$data['message'] = 'Thank you for shopping with us. We will be shipping your order to you soon.';
				
		if($this->session->userdata('how_to_payment')=='coupon' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. We will be shipping your order to you soon. Your order ID is #".$order_id;
		
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }
		 elseif($this->session->userdata('how_to_payment')=='blissperks' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your Bliss Perks has been charged and your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }	
		 elseif($this->session->userdata('how_to_payment')=='cod' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }
		 elseif($this->session->userdata('how_to_payment')=='razorpay' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 //$this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }
         elseif(isset($_POST['encResp']) && $_POST['encResp']!='') {
			 $working_key = '183540A0CF27B20FE31C1667F2366FAE';//Shared by CCAVENUES
			$encResponse = $_POST["encResp"];	//This is the response sent by the CCAvenue Server
			
			$rcvdString = $this->decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
			$order_status = $order_id = "";
			$decryptValues = explode('&', $rcvdString);
			$dataSize = sizeof($decryptValues);
			for($i = 0; $i < $dataSize; $i++) {
				$information = explode('=',$decryptValues[$i]);
				if($i==0) {	$order_id = $information[1]; }
				if($i==3) {	$order_status=$information[1]; }
			}

			if($order_status==="Success") {
				$emi_payment_msg = $this->session->userdata('emi_payment');
				
					$data['message'] = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
				
		    $this->checkout_model->update_merchant_order_status($order_id);
			$this->cart->destroy();
			$send_msg = 'true';  $send_msg_order = $order_id;
			}
			else if($order_status==="Aborted") {
				$data['message'] = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			}
			else if($order_status==="Failure") {
				$data['message'] = "Thank you for shopping with us.However,the transaction has been declined.";
			}
			else {
				$data['message'] = "Security Error. Illegal access detected"; 
			} 
		 }
		 
		  $phone = $this->session->userdata('phone_msg');
	    if($send_msg == 'true' && $phone != '') {
			 $sms_msg = urlencode("Your order has been successfully placed. Order ID is #".$send_msg_order.".\n
Thank you
Team DND");  
					$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-demandsandd&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=ADWINH&message=".$sms_msg;
file_get_contents($smstext);
					
					
					 $sms_msg1 = urlencode("New order placed successfully. Order ID is #".$send_msg_order."
					 Payment type :-".$this->session->userdata('how_to_payment').".\n From DND");  
					$smstext1 = "http://103.16.101.52/sendsms/bulksms?username=bsz-demandsandd&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=9023584943&source=ADWINH&message=".$sms_msg1;
file_get_contents($smstext1);
							
		}
	  
		
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'thankyou';
            $this->load->view('includes/front/front_template', $data); 
	}
	 

	public function get_user_limit($userid) {
		$bliss_code =  $this->session->userdata('bliss_id');
		$cust_id = $this->session->userdata('cust_id');
		$distributor_amount = $this->checkout_model->get_distributer_amount_by_userid($userid);
		$dist_amount = 0;
		if(!empty($distributor_amount)) {
			foreach($distributor_amount as $val) {
				if($val['status']!='Pending') { $dist_amount = $dist_amount + $val['amount']; }
			}
		}
		
		$orderId = '';
		$child_id_array = array();
		$ciruserlimit = 0;
		$child_ids = $this->checkout_model->get_child_id($bliss_code);
		foreach($child_ids as $childid) {
			$child_id_array[] = $childid['id']; 
		}
		if(!empty($child_id_array)){
        $circle_order = $this->checkout_model->my_first_circle_order($child_id_array);
		$cirorder = array(); 
		if(!empty($circle_order)) {
			foreach($circle_order as $cir_oder) {
			  if($cir_oder['status']!='Pending') {
				if(in_array($cir_oder['user_id'],$cirorder)){ $ciruserlimit = $ciruserlimit + 2000; } 
				else {	$cirorder[] = $cir_oder['user_id'];
				$ciruserlimit = $ciruserlimit + 4000; } 
				$orderId .= $cir_oder['id'].'('.$cir_oder['user_id'].') '; 
			  }
			}
		} 
		}
		
		return array('limit'=>$ciruserlimit,'amount'=>$dist_amount,'order'=>$orderId);
	}
	

	
    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }
        
    // callback method
    public function callback() {        
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {                
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
              
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    echo $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;//echo 'success ';
							$this->session->set_userdata('last_order_id',$merchant_order_id);
							$phone = $this->input->post('merchant_phone');
							$this->session->set_userdata('phone_msg',$phone);
							$this->session->set_userdata('how_to_payment','razorpay');
							$data_profile_array = array('status'=>'Pending');
				            $this->checkout_model->update_order_status($merchant_order_id,$data_profile_array);
					
                        } else {
                            $success = false;echo 'filed ';
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
						//echo "<pre>";print_r($response_array);//exit;
                }
                //close connection 
                curl_close($ch);//die();
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
		redirect(base_url('checkout/failed'));
    }
    
	public function success() {
        redirect(base_url().'thankyou');
    }
    public function failed() {
         $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'failed';
                $data['page_title'] = 'Order failed';  
				$send_msg = 'false';
				$send_msg_order = '';
				
				$data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'failed';
            $this->load->view('includes/front/front_template', $data); 
			
    }

	
	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0) { $binString = $packedString; } 
        	    else { $binString .= $packedString; }  
		    $count+=2; 
        	} 
  	        return $binString; 
    	  } 
	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}
	function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	function encrypt($plainText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}
}
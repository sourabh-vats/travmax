<?php
/*
* Developer Name: Ravinder Singh Mehta
* Developed For : ZOOGOL
* Development Com : 33infotech
* Version 1.0
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('session');
        // Load the user model
        $this->load->model('user');
        $this->load->helper('viewcont');
        $this->load->helper('notification');
    }
    
   public function login_post() {
        // Get the post data
        $email = $this->post('email');
        $password = md5($this->post('password'));
        $device_id = $this->post('device_id');
        // Validate the post data
        if(!empty($email) && !empty($password)){
            $user = $this->user->login($email,$password);
            if($user){
                
                if($user['status']=='deactive')
        { $this->response([
                    'status' => FALSE,
                    'message' => 'Your account suspended please contact to administrator..',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
        }else{
                  
                 $userimage = '';
                     if($user['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$user['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     //$result = array('id'=>$user['id'],'name'=>$user['f_name'],'customer_id'=>$user['customer_id'],'email'=>$user['email'],'phone'=>$user['phone'],'status'=>$user['status'],'device_id'=>$user['device_id']); 
                
                $this->user->update_customerdeviceid($user['id'],$device_id);
				
				
				$result = array('id'=>$user['id'],'phone'=>$user['phone'],'token'=>$user['device_id'],'email'=>$user['email'],'name'=>$user['f_name'],'zkey'=>$user['customer_id']);
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => 'User login successful.',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
        }
            }else{
				
				 $this->response([
                        'statusCode' => 200,
                        'message' => 'Wrong username or password.',
                        'data' =>'',
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
					
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
              /*   $this->response([
                    'status' => FALSE,
                    'message' => 'Wrong username or password.',
                    'data' => ''
                ],REST_Controller::HTTP_OK); */
            }
        }else{
            // Set the response and exit
             $this->response([
                    'status' => FALSE,
                    'message' => 'Provide email and password.',
                    'data' => ''
                ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }
 
  
    public function userforgot_post() {
        // Get the post data
        $email = $this->post('email');
     
        // Validate the post data
        if(!empty($email)){
            
            $user = $this->user->userforgot($email);
            
            if($user){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'New Password has been sent to your registered email address and Mobile Number',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => 'Wrong email or phone.',
                    'data' => $user
                ],REST_Controller::HTTP_OK);
                
            }
        }else{
            // Set the response and exit
            
             $this->response([
                    'status' => FALSE,
                    'message' => 'Provide email or phone.',
                    'data' => $user
                ],REST_Controller::HTTP_OK);
        }
    }

  
   public function registration_post() {
        // Get the post data
        $first_name = strip_tags($this->post('name'));
        //$email = strip_tags($this->post('email'));
        $email = str_replace(' ','',$this->post('email')); 
        $phone = strip_tags($this->post('phone'));
        $otp=$this->post('otp');
        
        if(!empty($this->post('referal'))) {
            $referal=$this->post('referal');
        } else {
            $referal='';
        }


       // $this->user->insert_manual('newsletter',json_encode($this->post()));
        
        // Validate the post data
        if(!empty($first_name) && !empty($phone)){
            
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
            
            $con1['returnType'] = 'count';
            $con1['conditions'] = array(
                'phone' => $phone,
            );
            
            $userCount = $this->user->getRows($con);
            $userCount1 = $this->user->getRows($con1);
            
            if($otp!=''){
                $otp_exist=$this->user->otp_veryfy($phone,$otp);
            }
            
            if(is_numeric($phone)) {
              } else{
				  
                  $this->response([
                    'status' => FALSE,
                    'message' => 'Enter Correct Phone Number.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
              }
            
            if($userCount > 0){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'The given email already exists.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
                
            }
            elseif($userCount1 > 0){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'The given Phone already exists please login.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
                
            }
            elseif ($otp=='') {
                $phone = $this->post('phone');
                //$this->session->set_userdata('no_veryfied','no');
                if($phone != '') {
                    $otp_crt = rand(1000,9999);
                    
                    $otpdata = array(
                     'phone' => $phone,
                     'otp' => $otp_crt,);
                    $this->user->insert_manual('otp_verification',$otpdata);
                   // $sms_msg = urlencode("Your OTP is ".$otp_crt."\nThank you\nTeam My Talent Hunt");
                    $sms_msg = urlencode("Your OTP for ".$first_name." registration is ".$otp_crt."\nThank you\nTeam My Talent Hunt");
                    //$smstext = "http://weberleads.in/http-api.php?username=".$this->config->item('sms_user')."&password=".$this->config->item('sms_pass')."&senderid=MTHUNT&route=2&number=".$phone."&message=".$sms_msg;
                    
                
                $smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
                    file_get_contents($smstext);

                    $to = $this->post('email');
                    $subject ="OTP for Zoogol Registration";
                    $txt = "Your OTP for My Talent Hunt registration is ".$otp_crt.""; 
                    $headers = "From: info@Zoogol.in"."\r\n";
                    $headers = "MIME-Version: 1.0" . "\r\n";     
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
                    mail($to,$subject,$txt,$headers);
                }
				
				
			  $result = array('phone'=>$phone,'token'=>'dbhsvdhsvdhsvsgdshgd','email'=>$email,'name'=>$first_name);
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => 'OTP Sent to your Email or phone',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK); 
                
               /*  $this->response([
                    'status' => TRUE,
                    'message' => 'OTP Sent to your Email or phone',
                    'data' => $otp_crt,
                ],REST_Controller::HTTP_OK); */
            } 
            elseif ($otp_exist!=1) {

              
				 $this->response([
                        'statusCode' => 200,
                        'message' => 'The OTP entered is incorrect',
                        'data' => '',
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK); 

            }
            else{
                // Insert user data
                
                $userData = array(
                'f_name' => $first_name,
                'email' => $email,
                'phone' => $phone,
                'parent_customer_id' => $referal,
                'device_id' => $this->post('device_id'),
                'status' => 'active',   
                );
                $insert = $this->user->insert($userData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    //$result= $insert; 
                    $result = array('phone'=>$phone,'token'=>'dbhsvdhsvdhsvsgdshgd','email'=>$email,'name'=>$first_name);
                
					 $this->response([
                        'statusCode' => 200,
                        'message' => 'The user has been added successfully.',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK); 
					
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);   
                }
            }
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
            
        }
    }
	
	  public function sliderimage_get($id=0) {
                $userslider = $this->user->active_slider('slider');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/banner/'.$val['image']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'status'=>$val['status'],'banner_image'=>$userimage,'created_at'=>$val['date'],'updated_at'=>$val['date']); 
                 }
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
      public function videolist_get($id=0) {
                $userslider = $this->user->active_slider('video');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/banner/'.$val['image']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'status'=>$val['status'],'slider_video'=>$userimage,'created_at'=>$val['date'],'updated_at'=>$val['date']); 
                 }
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function zoogolblockvideos_get($id=0) {
                $userslider = $this->user->active_slider('zoogolblock');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/banner/'.$val['image']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'status'=>$val['status'],'image_name'=>$val['name'],'image'=>$userimage,'created_at'=>$val['date'],'updated_at'=>$val['date']); 
                 }
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
      public function homewebsites_get($id=0) {
                $userslider = $this->user->websites('6');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['web_img']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/webstores/'.$val['web_img']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'url'=>$val['web_url'],'click_url'=>$val['web_url'],'image'=>$userimage,'name'=>$val['web_name'],'status'=>$val['web_status'],'offer_id'=>$val['id']); 
                 }
                
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
      public function allwebsites_get($id=0) {
                $userslider = $this->user->websites('all');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['web_img']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/webstores/'.$val['web_img']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'url'=>$val['web_url'],'click_url'=>$val['web_url'],'image'=>$userimage,'name'=>$val['web_name'],'status'=>$val['web_status'],'offer_id'=>$val['id']); 
                 }
               
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
   public function merchants_get($id=0) {
                $userslider = $this->user->get_merchants('24');
              
        if(!empty($userslider)){
                $result = array();
                 foreach($userslider as $val) {
                  $userimage = '';
                     if($val['brand_proof']!='') { $userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/business_details/'.$val['brand_proof']; }else{$userimage = 'https://www.zoogol.blissinfosys.com/main-admin/images/product/default_img.png';}
            
                 $result[] = array('id'=>$val['id'],'store_name'=>$val['d_name'],'store_type'=>$val['brands'],'image'=>$userimage,'contact_person'=>$val['d_name'],'email'=>$val['email'],'phone'=>$val['phone'],'city'=>$val['city'],'state'=>$val['state'],'address'=>$val['address_s_1'],'created_at'=>$val['rdate'],'updated_at'=>$val['rdate']); 
                 }
               
                 $this->response([
                        'statusCode' => 200,
                        'message' => '',
                        'data' => $result,
                        'has_data' => TRUE,
                    ], REST_Controller::HTTP_OK);
			
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Slider was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function category_get() {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $users = $this->user->category_all();
        
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) {
                     
                      if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/main-admin/images/category/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     $result[] = array('id'=>$val['id'],'name'=>$val['c_name'],'image'=>$userimage);
                 }
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
                $this->response([
                'status' => FALSE,
                'message' => 'No Category was found.'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function user_post() {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
		$userid = $this->post('userid');
        //$con = $userid?array('userid'=>$userid):'';
        $users = $this->user->getuserdata($userid);
        
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) {
                      $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                   
                     $result[] = array('id'=>$val['id'],'name'=>$val['f_name'],'email'=>$val['email'],'zkey'=>$val['customer_id'],'phone'=>$val['phone'],'dob'=>$val['dob'],'occupation'=>$val['occupation'],'user_type'=>$val['role'],'city'=>$val['city'],'state'=>$val['state'],'qualification'=>$val['qualification'],'user_image'=>$userimage,'address'=>$val['address'],'pin'=>$val['pincode']); 
                 }
				 
				  //$this->response(['videodetail'=>$result,'othervideo'=>$videos,'comment'=>$comment], REST_Controller::HTTP_OK);
                 
                //print_r($videos);
                 
         $this->response(['statusCode' => 200,'message' => 'data found','data' => $result,'has_data' => TRUE,], REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
	
	
	   public function state_post() {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $users = $this->user->state();
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
			
			$result = array();
                 foreach($users as $val) {
                   $result[] = array('id'=>$val['id'],'name'=>$val['name'],'country_id'=>$val['country_id']); 
                 }
			
			$this->response(['statusCode' => 200,
			'message' => 'data found',
			'data' => $result,
			'has_data' => TRUE,],
			REST_Controller::HTTP_OK);
			
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No state was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function city_post() {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $this->post('state_id');
        $users = $this->user->city_all($con);
		
        
        // Check if the user data exists
        if(!empty($users)){
          $result = array();
                 foreach($users as $val) {
                   $result[] = array('id'=>$val['id'],'name'=>$val['name'],'country_id'=>$val['state_id'],'state_id'=>$val['state_id']); 
                 }
			
			$this->response(['statusCode' => 200,
			'message' => 'data found',
			'data' => $result,
			'has_data' => TRUE,],
			REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No city was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
        
    }
   

	// old apis  data
	
	  public function permission_post() {
            
        // Get the post data
        $type = $this->post('type');
        if($type=='image') {
            $video_id = $this->post('video_id');
            $permission = $this->post('permission');
            $this->user->update_manual('gallery',array('id'=>$video_id),array('permission'=>$permission));
             $this->response([
                    'status' => TRUE,
                    'message' => 'Updated Successfully',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
        }
        if($type=='video') {
            $video_id = $this->post('video_id');
            $permission = $this->post('permission');
            $this->user->update_manual('videos',array('id'=>$video_id),array('permission'=>$permission));
            $this->response([
                    'status' => TRUE,
                    'message' => 'Updated Successfully',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
        }
        if($type=='channel_video') {
            $video_id = $this->post('video_id');
            $permission = $this->post('permission');
            $this->user->update_manual('channel_videos',array('id'=>$video_id),array('permission'=>$permission));
             $this->response([
                    'status' => TRUE,
                    'message' => 'Updated Successfully',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
        }



        // Validate the post data
        
    }
   
    public function registerwithgoogle_post() {
        // Get the post data
        $first_name = strip_tags($this->post('name'));
        $email = strip_tags($this->post('email'));
        $device_id = $this->post('device_id');
         if(!empty($this->post('referal'))) {
            $referal=$this->post('referal');
        } else {
            $referal='';
        }


        // Validate the post data
        if(!empty($email)){
            $con1['returnType'] = 'count';
            $con1['conditions'] = array(
                'email' => $email,
            );
             $userCount = $this->user->getRows($con1);
            
         if($userCount > 0){
              $user = $this->user->loginwithemail($email);
              $userimage = '';
                     if($user['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$user['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     $result = array('id'=>$user['id'],'d_name'=>$user['d_name'],'f_name'=>$user['f_name'],'l_name'=>$user['l_name'],'customer_id'=>$user['customer_id'],'email'=>$user['email'],'phone'=>$user['phone'],'gender'=>$user['gender'],'dob'=>$user['dob'],'address'=>$user['address'],'city'=>$user['city'],'state'=>$user['state'],'pincode'=>$user['pincode'],'image'=>$userimage,'bliss_amount'=>$user['bliss_amount'],'status'=>$user['status'],'device_id'=>$user['device_id'],'bio'=>$user['info']); 
                $this->user->update_customerdeviceid($user['id'],$device_id);
                 
            //$this->response($result, REST_Controller::HTTP_OK);
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }
            else
            {
                // Insert user data
                $userData = array(
                'd_name' => $first_name,
                'f_name' => $first_name,
                'email' => $email,
                'parent_customer_id' => str_replace('/', '', str_replace('https://', '', $referal)),
                'phone' => '',
                'status' => 'active',
                );
                $insert = $this->user->insert($userData);
                 $this->user->update_customerdeviceid($insert,$device_id);
                // Check if the user data is inserted
                if($insert){
                   $user = $this->user->loginwithemail($email);
             $userimage = '';
                     if($user['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/'.$user['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     $result = array('id'=>$user['id'],'d_name'=>$user['d_name'],'f_name'=>$user['f_name'],'l_name'=>$user['l_name'],'customer_id'=>$user['customer_id'],'email'=>$user['email'],'phone'=>$user['phone'],'gender'=>$user['gender'],'dob'=>$user['dob'],'address'=>$user['address'],'city'=>$user['city'],'state'=>$user['state'],'pincode'=>$user['pincode'],'image'=>$userimage,'bliss_amount'=>$user['bliss_amount'],'status'=>$user['status'],'device_id'=>$user['device_id'],'bio'=>$val['info']); 
                $this->user->update_customerdeviceid($user['id'],$device_id);
                 
            //$this->response($result, REST_Controller::HTTP_OK);
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);   
                }
            }
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
   
    public function addcount_get($slug=0,$device_id='') {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.

       // load cookie helper
    $this->load->helper('cookie');
// this line will return the cookie which has slug name
  $check_visitor = $this->input->cookie(urldecode($slug), FALSE);
// this line will return the visitor ip address
    $ip = $this->input->ip_address();
// if the visitor visit this article for first time then //
 //set new cookie and update article_views column  ..
//you might be notice we used slug for cookie name and ip 
//address for value to distinguish between articles  views
    if ($check_visitor == false) {
        $cookie = array(
            "name"   => urldecode($slug),
            "value"  => "$ip",
            "expire" =>  time() + 7200,
            "secure" => false
        );
        $this->input->set_cookie($cookie);
        $this->user->update_video_count(urldecode($slug),1,'views');
        $url= $_SERVER['REQUEST_URI'];
        $data_to_store = array('ip'=>$ip,'url'=>$url,'device_id'=>$device_id);

        $this->user->insert_analytics($data_to_store);
         $this->response([
                'status' => 'Success',
                'message' => 'View Counted.'
            ], REST_Controller::HTTP_OK);
       //die();
    }  else {
          $this->response([
                'status' => 'Success',
                'message' => 'View Already Counted.'
            ], REST_Controller::HTTP_OK);
    }
        
        
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
              
        
    }

    public function contest_get($type = 'null') {
         $con = array('type'=>$type);
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.

        $users = $this->user->contest_all($con);
        // Check if the user data exists
        if(!empty($users)){

            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) {
                      $thumb_image = '';
                     if($val['thum_image']!='') { $thumb_image = 'https://www.mytalenthunt.in/main-admin/images/contest/'.$val['thum_image']; }

                     $big_image = '';
                     if($val['image']!='') { $big_image = 'https://www.mytalenthunt.in/main-admin/images/contest/'.$val['image']; }
                     
                     $result[] = array('id'=>$val['id'],'name'=>$val['c_name'],'thumb_image'=>$thumb_image,'big_image'=>$big_image,'status'=>$val['status'],'type'=>$val['type'],'last_date'=>$val['last_date'],'round'=>$val['round'],'contest_id'=>'0');
                 }
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Contast found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
  
  public function videobycategory_get($id = 0, $userid = 0, $limit = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        
        
        $con = $id?array('vid' => 0,'id' => $id,'userid'=>$userid,'loadmore'=>$limit):'';

        $users = $this->user->getvideohomeload($con);
        
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            
            $result = array();
                 foreach($users as $val) {
                      $video = '';
                     //  if($val['video']!='') { $video = 'https://output-ar.s3.amazonaws.com/output/'.$val['video']; }
                      if($val['video']!='') { $video = 'https://d1cyr474z8h5ux.cloudfront.net/output/'.$val['video']; }
                     // if($val['video']!='') { $video = 'http://d1cyr474z8h5ux.cloudfront.net/'.$val['video']; }
                    // if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                    /* $video_thumb = '';
                     if($val['thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/video_thumb/'.$val['thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }


                          $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }*/
                     
                      $thumb = '';
                     if($val['thumb']!='') { 
                        $thumb = 'https://www.mytalenthunt.in/assets/videos/video_thumb/'.$val['thumb']; 
                       // $thumb = 'https://d1cyr474z8h5ux.cloudfront.net/thumbnail/'.$val['thumb']; 
                        

                    }else{
                    //$thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     
                     $result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,32),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'point'=>$val['point'],'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$thumb,'thumb'=>$thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']); 


                      //$result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>substr($val['title'],0,25),'status'=>$val['status'],'views'=>$val['views'],'votes'=>$val['votes'],'point'=>$val['point'],'likes'=>$val['likes'],'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$contest_ii,'liked'=>$val['lid'],'voted'=>$val['gid']); 
                 }
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }
    public function videobycategorybyid_post($id = 0, $userid = 0, $limit = 0, $type = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        if($this->post('user_id')!=''){
        $userid = strip_tags($this->post('user_id'));
        }else{
            $userid = 3;
        }
        $video_id = strip_tags($this->post('videoid'));
        $loadmore = strip_tags($this->post('loadmore'));
        $type = strip_tags($this->post('type'));
        //die();

        $con = $userid?array('id' => $video_id,'userid'=>$userid):'';
        $users = $this->user->getvideo_by_id($con);
        
        if($type=='profile'){
        $con = $video_id?array('vid' => $video_id,'id' => $users[0]['user_id'],'userid'=>$userid,'loadmore'=>$loadmore):'';
        $users1 = $this->user->getuservideo($con);
        $users = array_merge($users,$users1);
        }else{
        $con = $video_id?array('vid' => $video_id,'id' => $users[0]['category'],'userid'=>$userid,'loadmore'=>$loadmore):'';
        $users1 = $this->user->getvideo($con);
        
        if($video_id!=1){
        $users = array_merge($users,$users1);
        }else{
        $users = $users1;   
        }
        }
        

        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            
            $result = array();
                 foreach($users as $val) {
                      $video = '';
                     if($val['video']!='') { $video = 'http://d1cyr474z8h5ux.cloudfront.net/output/'.$val['video']; }
                   //  if($val['video']!='') { $video = 'https://output-ar.s3.amazonaws.com/output/'.$val['video']; }
                    // if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $thumb = '';
                     if($val['thumb']!='') { 
                        $thumb = 'https://www.mytalenthunt.in/assets/videos/video_thumb/'.$val['thumb'];
                       // $thumb = 'https://d1cyr474z8h5ux.cloudfront.net/thumbnail/'.$val['thumb']; 
                         }else{
                    //$thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     
                     $result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$thumb,'thumb'=>$thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']); 
                 }
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }
    public function getallvideossearch_post(){
        
        $user_id = $this->post('search');
        $type = strip_tags($this->post('type'));
        $id = strip_tags($this->post('userid'));
        $result = array();
    
    if($type=='video'){

        $videos = $this->user->get_all_video_by_search($user_id,$id);
        //echo '<pre>'; print_r($videos); die();
        if(!empty($videos)) { 
        foreach($videos as $val) {
            $video = '';
            if($val['status'] =='Approved') {
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     $video_thumb = '';
                     if($val['thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
       $result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']);

       // $result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']); 

       
        } 
        }
        
            //$this->response($result, REST_Controller::HTTP_OK);
            $this->response([
                'status' => TRUE,
                'message' => 'Record found.',
                'data' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
                $this->response([
                'status' => FALSE,
                'message' => 'No record found.',
                'data' => ''
            ], REST_Controller::HTTP_OK);
        }
        
    }

    if($type=='image'){
    
        $users = $this->user->get_alle_imag_by_search($user_id,$id);
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            
            
            $result = array();
                 foreach($users as $val) {
                      $video = '';
                     if($val['image']!='') { $video = 'https://www.mytalenthunt.in/assets/gallery/'.$val['image']; }
                     $video_thumb = '';
                     if($val['image']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/gallery/thumbs/'.$val['image']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $userimage = '';
                     if($val['cimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['cimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     
                     $result[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'date'=>$val['date'],'image'=>$video,'image_thumb'=>$video_thumb,'uimage'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']); 
                 }
            //$this->response($result, REST_Controller::HTTP_OK);
            
            $this->response([
                'status' => TRUE,
                'message' => 'Record found.',
                'data' => $result
            ], REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
                $this->response([
                'status' => FALSE,
                'message' => 'No record found.',
                'data' => ''
            ], REST_Controller::HTTP_OK);
        }

}   
        
    if($type=='chitchat'){
    
        $chitchat = $this->user->get_alle_chitchat_by_search($user_id,$id);
        // Check if the user data exists
        if(!empty($chitchat)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            
            
                $result = array();
                 foreach($chitchat as $val) {
                       $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/chitchat/user/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     $result[] = array('id'=>$val['id'],'uid'=>$val['merchant_id'],'d_name'=>$val['d_name'],'city'=>$val['city'],'image'=>$userimage); 
                 }
            //$this->response($result, REST_Controller::HTTP_OK);
            $this->response([
                'status' => TRUE,
                'message' => 'Record found.',
                'data' => $result
            ], REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
                $this->response([
                'status' => FALSE,
                'message' => 'No record found.',
                'data' => ''
            ], REST_Controller::HTTP_OK);
        }

}  

    if($type=='social'){
    
        $chitchat = $this->user->get_alle_social_by_search($user_id,$id);
        // Check if the user data exists
        if(!empty($chitchat)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            
            
                $result = array();
                 foreach($chitchat as $val) {
                       $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     $result[] = array('id'=>$val['id'],'uid'=>$val['customer_id'],'d_name'=>$val['d_name'],'city'=>$val['city'],'image'=>$userimage); 
                 }
            //$this->response($result, REST_Controller::HTTP_OK);
            
            $this->response([
                'status' => TRUE,
                'message' => 'Record found.',
                'data' => $result
            ], REST_Controller::HTTP_OK);
            
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
                $this->response([
                'status' => FALSE,
                'message' => 'No record found.',
                'data' => ''
            ], REST_Controller::HTTP_OK);
        }

} 
      
    }
    
  
   public function contestbyid_get($id = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
    //  $con = $id?array('id' => $id,'userid'=>$userid):'';
        $con=array('id' => $id);
        $users = $this->user->get_contest_all($con);
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
                $result = array();
                 foreach($users as $val) {
                      $thumb_image = '';
                     if($val['thum_image']!='') { $thumb_image = 'https://www.mytalenthunt.in/main-admin/images/contest/'.$val['thum_image']; }

                     $big_image = '';
                     if($val['image']!='') { $big_image = 'https://www.mytalenthunt.in/main-admin/images/contest/'.$val['image']; }
                     
                     $result[] = array('id'=>$val['id'],'name'=>$val['c_name'],'thumb_image'=>$thumb_image,'big_image'=>$big_image,'status'=>$val['status'],'type'=>$val['type'],'last_date'=>$val['last_date']);
                 }
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }

    public function timeslot_get($id = 0,$date='') {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
    //  $con = $id?array('id' => $id,'userid'=>$userid):'';
        $con=array('id' => $id);
        $users = $this->user->chitchatuserdata($con);
       // $users = $this->user->get_contest_all($con);
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $data_to = array(
            '12am'=>'00:00',
            '1am'=>'01:00',
            '2am'=>'02:00',
            '3am'=>'03:00',
            '4am'=>'04:00',
            '5am'=>'05:00',
            '6am'=>'06:00',
            '7am'=>'07:00',
            '8am'=>'08:00',
            '9am'=>'09:00',
            '10am'=>'10:00',
            '11am'=>'11:00',
            '12pm'=>'12:00',
            '1pm'=>'13:00',
            '2pm'=>'14:00',
            '3pm'=>'15:00',
            '4pm'=>'16:00',
            '5pm'=>'17:00',
            '6pm'=>'18:00',
            '7pm'=>'19:00',
            '8pm'=>'20:00',
            '9pm'=>'21:00',
            '10pm'=>'22:00',
            '11pm'=>'23:00',
            '12am'=>'24:00',
        );



                 $time_slot = array();
                     $time_slab = json_decode($users[0]['attribute'],true);

                     $days = array_column($time_slab, 0);
                   $dat = date('l',strtotime($date));

                    // echo '<pre>'; print_r($time_slab); echo '</pre>';
                     if(!empty($time_slab)) {
                        foreach($time_slab as $slab) {
                            $start = strtolower($slab[1]);
                            $end = strtolower($slab[2]);

                            $time_slot[$slab[0]] = array('start'=>$data_to[$start],'end'=>$data_to[$end]);
                        }
                     }
                     //echo '<pre>'; print_r($time_slot); echo '</pre>';
                     if(array_key_exists($dat, $time_slot)) {
                        $time_duration = array();
                        $stat_date = $time_slot[$dat]['start'];
                        $end_date = $time_slot[$dat]['end'];
                        $p = 0;
                        while($p < 20) {
                            $time_duration[] = $stat_date;
                            if($stat_date==$end_date) { $p=50;  }
                            $stat_date = date('H:i',strtotime('+30 minutes',strtotime($stat_date)));
                            $p++;
                        }

                        $this->response($time_duration, REST_Controller::HTTP_OK);
                     }
                     else {
                        $this->response(array(), REST_Controller::HTTP_OK);
                     }
                
                 
            
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }

     public function primefee_get() {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
    //  $con = $id?array('id' => $id,'userid'=>$userid):'';
        
        $users = $this->user->select_manual('prime_fee');

        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
                $result = $users;
                 
            $this->response($result, REST_Controller::HTTP_OK);
            
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }

	
    public function mycontent_get($type='',$id = 0, $userid = 0, $status = '') {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $id?array('id' => $id,'userid'=>$userid):'';
        
        

        if($type=='profile') {
            $users = $this->user->getuserdata($con);
            $total_video = $this->user->count_manual('videos','id',array('user_id'=>$id));
            $total_channel_video = $this->user->count_manual('channel_videos','id',array('user_id'=>$id));
            $total_images = $this->user->count_manual('gallery','id',array('user_id'=>$id));
            $contest = $this->user->select_manual('contest',array('status'=>'open'));
            
            if(!empty($contest)) {
                $contest = array_column($contest, 'id');
            } else { $contest = array(99999999999); }
            //print_r($contest);
            $total_video_votes = $this->user->sum_manual_wherein('videos','votes',array('user_id'=>$id),'contest_id',$contest);
            $total_video_votes = $total_video_votes[0]['votes']+0;

            $total_image_votes = $this->user->sum_manual_wherein('gallery','votes',array('user_id'=>$id),'contest_id',$contest);
            $total_image_votes = $total_image_votes[0]['votes']+0;

            $total_video_likes = $this->user->sum_manual('videos','likes',array('user_id'=>$id));
            $total_video_likes = $total_video_likes[0]['likes']+0;

            $total_channel_video_likes = $this->user->sum_manual('channel_videos','likes',array('user_id'=>$id));
            $total_channel_video_likes = $total_channel_video_likes[0]['likes']+0;

            $total_image_likes = $this->user->sum_manual('gallery','likes',array('user_id'=>$id));
            $total_image_likes = $total_image_likes[0]['likes']+0;

            $total_income = $this->user->sum_manual('income','amount',array('user_id'=>$id));
            $total_income = $total_income[0]['amount']+0;


            $total_likes = $total_image_likes + $total_video_likes;
            $total_votes = $total_image_votes + $total_video_votes;
            // Check if the user data exists

            if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) {
                    if($val['frstatus']==1 && $val['req_status']==1) {
                        $status = 3;
                    } 
                    elseif($val['frstatus']==1 && $val['req_status']==0) {
                        if($val['user_id']==$userid) {
                            $status = 1;
                        }
                        else {
                            $status = 2;
                        }
                        


                    }  else {
                            $status = 0;
                     }
                      $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     $cover_pic = '';
                     if($val['cover_pic']!='') { $cover_pic = 'https://www.mytalenthunt.in/images/user/'.$val['cover_pic']; }else{$cover_pic = 'https://www.mytalenthunt.in/assets/front/images/author/cover.png';}
                     
                     $result[] = array('id'=>$val['id'],'d_name'=>$val['d_name'],'f_name'=>$val['f_name'],'l_name'=>$val['l_name'],'email'=>$val['email'],'phone'=>$val['phone'],'gender'=>$val['gender'],'bio'=>$val['info'],'dob'=>$val['dob'],'city'=>$val['city'],'state'=>$val['state'],'image'=>$userimage,'cover_pic'=>$cover_pic,'incentive'=>$val['bliss_amount'],'total_incentive'=>$total_income,'total_video'=>$total_video,'total_image'=>$total_images,'followings'=>$val['followings'],'followers'=>$val['followers'],'channel_followers'=>$val['follow_count'],'myfriends'=>$val['friends'],'friendrequest'=>$val['friends_request'],'link_count'=>$val['link_count'],'views'=>$val['views'],'likes'=>number_format_short($total_likes),'video_likes'=>number_format_short($total_video_likes),'image_likes'=>number_format_short($total_image_likes),'channel_likes'=>number_format_short($total_channel_video_likes),'total_votes'=>number_format_short($total_votes),'is_follow'=>$val['is_follow'],'is_friend'=>$status,'prime'=>$val['prime'],'channel_video'=>$total_channel_video); 
                 }

                 $this->response($result,REST_Controller::HTTP_OK);
        } else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }


        if($type=='video') {
			if($status!='') {
				$con['status'] = $status;
			}
                
                $usersvideo = $this->user->uservideobyid($con);
                $videos = array();
                 foreach($usersvideo as $val) {
                      $video = '';
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     
                      $video_thumb = '';
                     if($val['thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/video_thumb/'.$val['thumb']; }else{
                   // $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}

                     $videos[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid'],'permission'=>$val['permission']); 
                     
                     
                 }
                 $this->response($videos,REST_Controller::HTTP_OK);
        }

        if($type=='image') {
			if($status!='') {
				$con['status'] = $status;
			}
                
                $usersimages = $this->user->userimagesbyid($con);
                $images = array();
                 foreach($usersimages as $val) {
                     $video = '';
                      $largimage = '';
                     if($val['image']!='') { $largimage = 'https://www.mytalenthunt.in/assets/gallery/'.$val['image']; }
                     $video_thumb = '';
                     if($val['image']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/gallery/thumbs/'.$val['image']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $userimage = '';
                     if($val['cimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['cimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     $images[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'date'=>$val['date'],'image'=>$largimage,'image_thumb'=>$video_thumb,'uimage'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid'],'permission'=>$val['permission']);
                     
                     
                 }
                 $this->response($images,REST_Controller::HTTP_OK);
        }

        if($type=='channel') {
                if($status!='') {
				$con['status'] = $status;
			}
                $userschannel = $this->user->userchannelbyid($con);
                $channel = array();
                 foreach($userschannel as $val) {
                      $video = '';
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     
                      $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}

                     $channel[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>0,'liked'=>$val['lid'],'voted'=>0,'follow'=>$val['follow'],'followers'=>$val['followers'],'permission'=>$val['permission']); 
                     
                     
                 }
                 $this->response($channel,REST_Controller::HTTP_OK);
        }

        if($type=='social') {
            $timeline = $this->user->get_my_timeline_post($userid,$id);
        
            // Check if the user data exists
            if(!empty($timeline)){
                // Set the response and exit
                //OK (200) being the HTTP response code
                $result = array();
                     foreach($timeline as $val) {
                          $userimage = '';
                         if($val['userimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['userimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                         
                         $image='';
                         $video='';
                         $type='';
                         if(!empty($val['image'])) { $video = 'https://www.mytalenthunt.in/assets/timeline/post/'.$val['image'];$type='image'; }
                         
                         if(!empty($val['video'])) { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; $type='video';}
                         
                         if(!empty($val['video_thumb'])) { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{$video_thumb = '';}
                         
                        
                         $result[] = array('id'=>$val['id'],'user_id'=>$val['user_id'],'d_name'=>$val['d_name'],'f_name'=>$val['f_name'],'l_name'=>$val['l_name'],'userimage'=>$userimage,'views'=>$val['views'],'comment'=>$val['comment'],'likes'=>$val['likes'],'postimage'=>$image,'video'=>$video,'video_thumb'=>$video_thumb,'content'=>$val['content'],'rdate'=>timelinetimeAgo($val['rdate']),'liked'=>$val['lid'],'type'=>$type); 
                     }
                     
                $this->response($result,REST_Controller::HTTP_OK);
                //$this->response($result,REST_Controller::HTTP_OK);
            }
        }

        if($type=='family') {
            $profile = $this->user->profile($id);
             $directs = $this->user->my_directs($profile[0]['customer_id']);
             $ids = array_column($directs, 'customer_id');
             $myteam = $directs;
              $p=0;
              if(!empty($myteam)) {
              while($p<1) {
                $myfriends = $this->user->my_friends_in($ids);
                if(!empty($myfriends)) {
                $myteam = array_merge($myteam,$myfriends);

                $ids = array_column($myfriends, 'customer_id');
                } else { $p++; }
              }
            }
             $userimage = '';
                         if($profile[0]['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$profile[0]['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
            $result[] = array('id'=>$profile[0]['id'],'name'=>$profile[0]['d_name'],'referal_name'=>$profile[0]['ddname'],'f_name'=>$profile[0]['f_name'],'l_name'=>$profile[0]['l_name'],'userimage'=>$userimage,'direct'=>count($directs),'team'=>count($myteam)); 
             $this->response($result,REST_Controller::HTTP_OK);
        }

         if($type=='ledger') {
            $profile = $this->user->profile($id);
            $income = $this->user->select_manual('income',array('user_id'=>$id));
            $affiliate_income = $this->user->select_manual('affiliate_income',array('user_id'=>$id));
            $income = array_merge($income,$affiliate_income);


            $rdate = array_column($income, 'r_date');
            array_multisort($rdate, SORT_ASC,$income);
            $total = array_sum(array_column($income, 'amount'));
            $response = array();
            if(!empty($income)) {
                foreach($income as $inc) {
                    $response[] = array('type'=>$inc['type'],'amount'=>$inc['amount'],'status'=>'Credit');
                }
            }

             $result = array('total'=>$total,'balance'=>$profile[0]['bliss_amount'],'ledger'=>$response); 
             $this->response($result,REST_Controller::HTTP_OK);
        }




    }
    public function video_get($id = 0, $userid = 0) {
       
         $con = $id?array('id' => $id,'userid'=>$userid):'';
         $users = $this->user->getvideobyid($con);
         $usersvideo = $this->user->getrecomandedvideo();
         $userscomment = $this->user->getvideocomment($con);
         $result = array();
                 foreach($users as $val) {
                      $video = '';
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     
                     $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                    
                     $result[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'views'=>$val['views'],'votes'=>$val['votes'],'likes'=>$val['likes'],'user_name'=>$val['d_name'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'followers'=>$val['followers'],'user_id'=>$val['user_id'],'description'=>$val['description'],'liked'=>$val['lid'],'voted'=>$val['votid']); 
                 }
                 
                  $videos = array();
                 foreach($usersvideo as $val) {
                      $video = '';
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     
                      $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $videos[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'status'=>$val['status'],'views'=>$val['views'],'votes'=>$val['votes'],'likes'=>$val['likes'],'user_name'=>$val['d_name'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest_id']); 
                 }
                 
                 
                   $comment = array();
                 foreach($userscomment as $val) {
                     
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     
                     $comment[] = array('id'=>$val['u_id'],'comment'=>$val['comment'],'user_name'=>$val['d_name'],'c_date'=>$val['c_date'],'image'=>$userimage); 
                 }
                 
                 
            $this->response(['videodetail'=>$result,'othervideo'=>$videos,'comment'=>$comment], REST_Controller::HTTP_OK);
        
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
           
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Job was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function uservideos_get($id = 0, $type = 0, $prime=0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $id?array('id' => $id,'type'=>$type,'prime'=>$prime):'';
        $users = $this->user->uservideobytype($con);
        $contest = $this->user->contest_all($con);
        $contest_ids = array_column($contest, 'id');

        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) { 
                    if(in_array($val['contest_id'],$contest_ids)) {
                        $contest_ii = 1;
                    } else { 
                    $contest_ii = 0; }
                      $video = '';
                     if($val['video']!='') { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; }
                     
                      $video_thumb = '';
                     if($val['video_thumb']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                          $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}

                         $result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>substr($val['title'],0,25),'status'=>$val['status'],'views'=>$val['views'],'votes'=>$val['votes'],'point'=>$val['point'],'likes'=>$val['likes'],'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$contest_ii,'liked'=>$val['lid'],'voted'=>$val['gid']); 

                         //$result[] = array('id'=>$val['id'],'vid'=>$val['v_id'],'title'=>mb_substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'userid'=>$val['userid'],'date'=>$val['date'],'video'=>$video,'video_thumb'=>$video_thumb,'image'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest'],'liked'=>$val['lid'],'voted'=>$val['gid']); 


                 }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Job was found.',
                'data' => array(),
            ], REST_Controller::HTTP_OK);
        }
    }
    public function rank_get($id = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $users = $this->user->getuserpdata($id);
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            if($users[0]['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$users[0]['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
            $this->response([
                'status' => TRUE,
                'rank' => $users[0]['bsacode'],
                'name' => $users[0]['d_name'],
                'image' => $userimage,
                'data' => array(),
            ], REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'rank' => 'No data was found.',
                'data' => array(),
            ], REST_Controller::HTTP_OK);
        }
    }

    public function permission_get($id = 0) {
            // Set the response and exit
            //OK (200) being the HTTP response code
            $this->response([
                'status' => TRUE,
                'result' => 'yes',
            ], REST_Controller::HTTP_OK);
        
    }
    public function userimages_get($id = 0, $type = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $id?array('id' => $id,'type'=>$type):'';
        $users = $this->user->userimagesbytype($con);
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($users as $val) {
                      $video = '';
                     if($val['image']!='') { $video = 'https://www.mytalenthunt.in/assets/gallery/'.$val['image']; }
                     $video_thumb = '';
                     if($val['image']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/gallery/thumbs/'.$val['image']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                         
                         $userimage = '';
                     if($val['usrimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['usrimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                         
                     $result[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'comment'=>number_format_short($val['comment']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'date'=>$val['date'],'image'=>$video,'image_thumb'=>$video_thumb,'userimage'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest_id'],'liked'=>'0','voted'=>'0'); 
                      
                 }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No images was found.',
                'data' => array(),
            ], REST_Controller::HTTP_OK);
        }
    }
 
   public function redeemrequest_post() {
        // Get the post data
        $user_id = strip_tags($this->post('user_id'));
        $redeem = strip_tags($this->post('redeem'));
        // Validate the post data
        if(!empty($user_id) && !empty($redeem)){
            
            $con['conditions'] = array(
                'id' => $user_id,
            );
            
            $ciruserlimit = 5000;
            $minlimit = 500;
            
           $profile = $this->user->getRows($con);
        
           if($profile[0]['bliss_amount'] < $redeem) {
                $this->response([
                        'status' => TRUE,
                        'message' => 'Your redeem maximum Amount is '.$profile[0]['bliss_amount'].'',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
              
           }elseif($ciruserlimit < $redeem) {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Your maximum redeem limit is '.$ciruserlimit.'',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
              
           }elseif($minlimit > $redeem) {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Your minimum redeem limit is '.$minlimit.'',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
              
           }else{
              $data_to_store = array(
                    'balance' => $profile[0]['bliss_amount']-$this->input->post('redeem'),
                    'redeem' => $this->post('redeem'),
                    'my_bliss_req' => 'amount',
                    'user_id' => $user_id
                ); 
                
            $insert_id = $this->user->insert_manual('redeem_bliss ',$data_to_store);
             $this->user->bliss_amount_update($user_id,$this->input->post('redeem'),'bliss_amount');
             
              $this->response([
                        'status' => TRUE,
                        'message' => 'Redeem Request Added Successfully',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
             
           }
            
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function user_put() {
        $id = $this->put('id');
        $first_name = strip_tags($this->put('d_name'));
        $city = strip_tags($this->put('city'));
        $state = strip_tags($this->put('state'));
        $gender = strip_tags($this->put('gender'));
        $pincode = strip_tags($this->put('pincode'));
        $dob = strip_tags($this->put('dob'));
        $bio = strip_tags($this->put('bio'));
        $phone = strip_tags($this->put('phone'));
        $password = strip_tags($this->put('password'));
        $country = strip_tags($this->put('country'));
        // Validate the post data
        
        
        if(!empty($id)){
            
            $con1['returnType'] = 'count';
            $con1['conditions'] = array(
                'phone' => $phone,
            );
            
            
            $userCount1 = $this->user->getRows($con1);
            
            /* if($userCount1 > 0){
                $this->response([
                    'status' => FALSE,
                    'message' => 'The given Phone already exists',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
                
            } */
            // Update user's account data
            $userData = array();
            if(!empty($first_name)){
                $userData['d_name'] = $first_name;
            }
            if(!empty($city)){
                $userData['city'] = $city;
            }
            if(!empty($pincode)){
                $userData['pincode'] = $pincode;
            }
            if(!empty($dob)){
                $userData['dob'] = $dob;
            }
            if(!empty($gender)){
                $userData['gender'] = $gender;
            }
            
            if(!empty($state)){
                $userData['state'] = $state;
            }
            if(!empty($bio)){
                $userData['info'] = $bio;
            }
            
            if(!empty($phone)){
                $userData['phone'] = $phone;
            }
            if(!empty($country)){
                $userData['country'] = $country;
            }
            if(!empty($password)){
                $userData['pass_word'] = md5($password);
            }

            $permission = array(
                'image_mode'=>strip_tags($this->put('image_mode')),
                'share_mode'=>strip_tags($this->put('share_mode')),
                'channel_mode'=>strip_tags($this->put('channel_mode')),
                'video_mode'=>strip_tags($this->put('video_mode')),
                'create_mode'=>strip_tags($this->put('create_mode'))
            );
            

             $update = $this->user->update($userData, $id);
            
             $user = $this->user->select_manual('permission',array('user_id'=>$id));
             if(empty($user)) {
                $permission['user_id']=$id;
                $this->user->insert_manual('permission',$permission);
             } else {
                $this->user->update_manual('permission',array('user_id'=>$id),$permission);
             }
            // Check if the user data is updated
            if($update){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user info has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            // Set the response and exit
            $this->response([
                    'status' => FALSE,
                    'message' => 'Provide at least one user info to update.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function uploadvideo_post() {
        // Get the post data
        $user_id = strip_tags($this->post('user_id')); 
         $title = trim($this->post('title'), '"');
         $category = trim($this->post('category'), '"');
         $description = trim($this->post('description'), '"');
        // Validate the post data
        if(!empty($user_id)){
        $this->load->helper(array('form', 'url'));

        $upload_path = 'assets/videos/';
        //$upload_path = 'images/video/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'wmv|mp4|avi|mov|m4v|mov|hevc|qt|flv|webm|3gp';
        $config['max_size'] = '100000';
        $config['max_filename'] = '200';
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $video_data = array();
        $is_file_error = FALSE;
        
            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                   $this->response([
                        'status' => TRUE,
                        'message' => 'video not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
                    $is_file_error = TRUE;
                   // $this->aws3->sendFile('input-b',$_FILES['video']);
                } else {
                 $video_data = $this->upload->data();
                 
            $userData = array(
              'user_id' => $user_id,
              'title' => $title,
              'category' => $category,
              'video' => $video_data['file_name'],
              'description' => $description,
                );
                $insert = $this->user->insert_video($userData);
                 //$update = $this->user->insert($userData, $user_id);
                 $path='https://www.mytalenthunt.in/assets/videos/'.$video_data['file_name'];
                  $this->response([
                        'status' => TRUE,
                        'message' => 'video uploaded successfully.',
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
                }
            }
            else
    {
        $error = array('error' => $this->upload->display_errors());
        $this->response([
                        'status' => TRUE,
                        'message' => 'video not uploaded',
                        'data' => $error,
                    ], REST_Controller::HTTP_OK);
    }
        
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }

    public function uploadthumbimage_post() {
        //$this->load->library('aws3'); 
        // Get the post data
        $videoid = strip_tags($this->post('videoid')); 
        $check_data = $this->user->select_manual('videos',array('id'=>$videoid),array('thumb'=>''));
        // Validate the post data
        if(!empty($check_data)){
        $this->load->helper(array('form', 'url'));

        $upload_path = 'assets/videos/video_thumb/';
        //$upload_path = 'images/video/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '100000';
        $config['max_filename'] = '200';
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $video_data = array();
        $is_file_error = FALSE;
        
            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                   $this->response([
                        'status' => TRUE,
                        'message' => 'image not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
                    $is_file_error = TRUE;
                } else {
                 $video_data = $this->upload->data();
                 
                //$this->aws3->sendFile('output-ar','thumbnail/'.$_FILES['image']);  
                $this->user->update_manual('videos',array('id'=>$videoid),array('thumb'=>$video_data['file_name']));
                 //$update = $this->user->insert($userData, $user_id);
                 $path='https://www.mytalenthunt.in/assets/videos/video_thumb/'.$video_data['file_name'];
                  $this->response([
                        'status' => TRUE,
                        'message' => 'Image uploaded successfully.',
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
                }
            }
            else
    {
        $error = array('error' => $this->upload->display_errors());
        $this->response([
                        'status' => TRUE,
                        'message' => 'Image not uploaded',
                        'data' => $error,
                    ], REST_Controller::HTTP_OK);
    }
        
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function timelinepost_post() {
        // Get the post data
        $path = '';
        $user_id = strip_tags($this->post('user_id'));
        // Validate the post data
        if(!empty($user_id)){
        $this->load->helper(array('form', 'url'));
		$title = strip_tags($this->post('title'));
        $userData = array(
              'user_id' => $user_id,
              'content' => $title
                );
        if(!empty($_FILES)) {
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if ($ext == 'wmv' || $ext == 'mp4' || $ext == 'avi'|| $ext == 'mov'|| $ext == 'm4v'|| $ext == 'hevc' || $ext == 'qt' ) {
        $upload_path = 'assets/videos/';
        //$upload_path = 'images/video/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'wmv|mp4|avi|mov|m4v|mov|hevc|qt|';
        $config['max_size'] = '40000';
        $config['max_filename'] = '200';
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $image_data = array();
        $is_file_error = FALSE;
        
            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                   $this->response([
                        'status' => TRUE,
                        'message' => 'video not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
                    $is_file_error = TRUE;
                } else {
                 $image_data = $this->upload->data();
                 //$update = $this->user->insert($userData, $user_id);
                 $path='https://www.mytalenthunt.in/assets/videos/'.$image_data['file_name'];
                  $userData['video'] = $image_data['file_name'];
                }
            }

        }

       if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {


    $upload_path = 'assets/timeline/post/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '4000';
        //$config['max_filename'] = '200';
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $video_data = array();
        $is_file_error = FALSE;
        
            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                   $error = array('error' => $this->upload->display_errors());
                  $this->response([
                        'status' => TRUE,
                        'message' => 'Image not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
                    $is_file_error = TRUE;
                } else {
                 $video_data = $this->upload->data();
                 $path='https://www.mytalenthunt.in/assets/gallery/'.$video_data['file_name'];
                  $userData['image'] = $video_data['file_name'];
                 

                }
            }
         }
        }
         $userData['rdate'] = time();
        $this->user->insert_manual('timeline_post',$userData);
        $this->response([
                        'status' => TRUE,
                        'message' => 'Post Updated successfully.',
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function uploadimagesplash_post() {
        // Get the post data
        $user_id = strip_tags($this->post('user_id'));
         $title = trim($this->post('title'), '"');
         $description = trim($this->post('description'), '"');
        // Validate the post data
        if(!empty($user_id)){
        $this->load->helper(array('form', 'url'));
        
        $upload_path = 'assets/gallery/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['max_filename'] = '200';
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $video_data = array();
        $is_file_error = FALSE;
        



            if (!$is_file_error) {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                   $error = array('error' => $this->upload->display_errors());
                  $this->response([
                        'status' => TRUE,
                        'message' => 'Image not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
                    $is_file_error = TRUE;
                } else {
                 $video_data = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
                $file_name = $data['upload_data']['file_name'];
                $target_path = 'assets/gallery/thumbs/';     
                /*$imgConfig = array();                       
                $imgConfig['image_library'] = 'GD2';                        
                $imgConfig['source_image']  = './assets/gallery/'.$file_name;
                $imgConfig['wm_type']   = 'overlay';                    
                $imgConfig['wm_overlay_path'] = './assets/front/images/Watermark.png';
                 $imgConfig['wm_vrt_alignment'] = 'bottom';
                $imgConfig['wm_hor_alignment'] = 'left';
                $imgConfig['wm_opacity'] = '50';
                
                $this->load->library('image_lib', $imgConfig);                      
                $this->image_lib->initialize($imgConfig);                       
                $this->image_lib->watermark();  */
                
                 $q['name']=$data['upload_data']['file_name'];
                 $configi['image_library'] = 'gd2';
                 $configi['source_image']   = './assets/gallery/'.$file_name;
                 $configi['new_image']   = $target_path;
                 $configi['maintain_ratio'] = TRUE;
                 $config['quality'] = '60%';
                 $configi['width']  = 500; // new size
                 $configi['height'] = 500;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);    
                $this->image_lib->resize();
                



                $userData = array(
              'user_id' => $user_id,
              'title' => $title,
              'image' => $video_data['file_name'],
              'description' => $description,
                );
                $insert = $this->user->insert_imagesplash($userData);
                 $path='https://www.mytalenthunt.in/assets/gallery/'.$video_data['file_name'];
                  $this->response([
                        'status' => TRUE,
                        'message' => 'Image uploaded successfully.',
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
                }
            }
            else
    {
        $error = array('error' => $this->upload->display_errors());
       $this->response([
                        'status' => FALSE,
                        'message' => 'Image not uploaded',
                        'data' => $this->upload->display_errors(),
                    ], REST_Controller::HTTP_OK);
    }
        
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    } 
    public function uploadimage_post() {
        // Get the post data
        $user_id = strip_tags($this->post('user_id'));
        // Validate the post data
        if(!empty($user_id)){
    $this->load->helper(array('form', 'url'));
        $config = array(
        'upload_path' => "images/user/profile_pick/",
        'allowed_types' => "jpg|png|jpeg",
        'overwrite' => FALSE,
        'encrypt_name' => TRUE,
      //  'max_size' => "1000",
        //'max_height' => "768",
        //'max_width' => "1024"
    );
    $this->load->library('upload',$config);
    

    if($this->upload->do_upload('image'))
    {
        $data = array('upload_data' => $this->upload->data());
         $userData['image'] = $data['upload_data']['file_name'];
         $update = $this->user->update($userData, $user_id);
       
         if(!empty($user_id)){
             $imgname=$data['upload_data']['file_name'];
       $resize= $this->_create_thumbs($imgname);
       }
         
         
         $path='https://www.mytalenthunt.in/images/user/profile_pick/'.$data['upload_data']['file_name'];
        
        //$this->set_response($data,'imagepath' => 'http://saraogroup.33demo.com/images/career-cv/'.$path.'', REST_Controller::HTTP_CREATED);
        
         $this->response([
                        'status' => TRUE,
                        'message' => 'Profile uploaded successfully.',
                        'resize' => $resize,
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
    }
    else
    {
        $error = array('error' => $this->upload->display_errors());
        $this->response($error, REST_Controller::HTTP_BAD_REQUEST);
    }
            
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
            
        }
    }
    public function uploadbanner_post() {
        // Get the post data
        //$user_id = '2';
        $user_id = $this->post('user_id');
        // Validate the post data
        if(!empty($user_id)){
            
         // echo 'rahul'; die();
    $this->load->helper(array('form', 'url'));
        $config = array(
        'upload_path' => "images/user/",
        'allowed_types' => "jpg|png|jpeg",
        'overwrite' => FALSE,
        'encrypt_name' => TRUE,
       // 'max_size' => "1000",
        //'max_height' => "768",
        //'max_width' => "1024"
    );
    $this->load->library('upload',$config);

    if($this->upload->do_upload('image'))
    {
        $data = array('upload_data' => $this->upload->data());
        
         $userData['cover_pic'] = $data['upload_data']['file_name'];
         $update = $this->user->update($userData, $user_id);
         
         $path='https://www.mytalenthunt.in/images/user/'.$data['upload_data']['file_name'];
        
        //$this->set_response($data,'imagepath' => 'http://saraogroup.33demo.com/images/career-cv/'.$path.'', REST_Controller::HTTP_CREATED);
        
         $this->response([
                        'status' => TRUE,
                        'message' => 'Banner uploaded successfully.',
                        'data' => $path,
                    ], REST_Controller::HTTP_OK);
    }
    else
    {
        $error = array('error' => $this->upload->display_errors());
        $this->response($error, REST_Controller::HTTP_OK);
    }
            
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
        }
    }   
    public function socialporch_get($id = 0, $userid = 0, $limit = 0) {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
         $con = $id?array('id' => $id,'userid'=>$userid,'limit'=>$limit):'';
        
         $friends = $this->user->get_user_friend_ids($userid); 
         $friends_second = $this->user->get_user_friend_ids_second($userid);
         $friends = array_merge($friends,$friends_second);
         $following = $this->user->my_following_list($userid);
         
         $user_ids = array($id);
         if(!empty($friends)) {
             foreach($friends as $friend){
                 $user_ids[] = $friend['friend_id'];
             }
         }
         if(!empty($following)) {
             foreach($following as $friend){
             $user_ids[] = $friend['follow_id'];
             }
         }
        $timeline = $this->user->get_timeline_post($user_ids,$userid,$limit);
        
        // Check if the user data exists
        if(!empty($timeline)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();
                 foreach($timeline as $val) {
                      $userimage = '';
                     if($val['userimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['userimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     
                     $image='';
                     $video='';
                     $type='';
                     
                     if(!empty($val['image'])) { $video = 'https://www.mytalenthunt.in/assets/timeline/post/'.$val['image'];$type='image'; }
                     
                     if(!empty($val['video'])) { $video = 'https://www.mytalenthunt.in/assets/videos/'.$val['video']; $type='video';}
                     
                    
                     if(!empty($val['video_thumb'])) { $video_thumb = 'https://www.mytalenthunt.in/assets/videos/thumbnail/'.$val['video_thumb']; }else{$video_thumb = '';}
                     
                    
                     $result[] = array('id'=>$val['id'],'user_id'=>$val['user_id'],'d_name'=>$val['d_name'],'f_name'=>$val['f_name'],'l_name'=>$val['l_name'],'userimage'=>$userimage,'views'=>$val['views'],'comment'=>$val['comment'],'likes'=>$val['likes'],'postimage'=>$image,'video'=>$video,'video_thumb'=>$video_thumb,'content'=>$val['content'],'rdate'=>timelinetimeAgo($val['rdate']),'liked'=>$val['lid'],'type'=>$type); 
                 }
                  
                  
                 /*
                 
                    $images = array();
                 foreach($usersimages as $val) {
                      $largimage = '';
                     if($val['image']!='') { $largimage = 'https://www.mytalenthunt.in/assets/gallery/'.$val['image']; }
                     $video_thumb = '';
                     if($val['image']!='') { $video_thumb = 'https://www.mytalenthunt.in/assets/gallery/thumbs/'.$val['image']; }else{
                    $video_thumb = 'https://www.mytalenthunt.in/assets/front/images/vid-back.jpg';
                         }
                     
                     $userimage = '';
                     if($val['cimage']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/small/'.$val['cimage']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
                     $images[] = array('id'=>$val['id'],'title'=>substr($val['title'],0,15),'status'=>$val['status'],'views'=>number_format_short($val['views']),'votes'=>number_format_short($val['votes']),'likes'=>number_format_short($val['likes']),'user_name'=>$val['d_name'],'date'=>$val['date'],'image'=>$largimage,'image_thumb'=>$video_thumb,'uimage'=>$userimage,'user_id'=>$val['user_id'],'description'=>$val['description'],'contest_id'=>$val['contest_id'],'liked'=>'0','voted'=>'0'); 
                 } */
                 
                //$this->response($timeline,REST_Controller::HTTP_OK); 
                 
            $this->response(['postdata'=>$result],REST_Controller::HTTP_OK);
            //$this->response($result,REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function kyc_get($id = 0) {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        
         $user = $this->user->select_manual('customer',array('id'=>$id));
        
        // Check if the user data exists
        if(!empty($user)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $result = array();

            $result[] = array('id'=>$user[0]['id'],'name'=>$user[0]['account_name'],'gpay'=>$user[0]['gpay'],'paytm'=>$user[0]['paytm'],'bank_name'=>$user[0]['bank_name'],'account_no'=>$user[0]['account_no'],'ifsc'=>$user[0]['ifsc'],'bank_image'=>$user[0]['bank_image']); 
                 
            $this->response($result,REST_Controller::HTTP_OK);
            //$this->response($result,REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 
   
    
    public function addorder_post() {
        // Get the post data
        $user_id =$this->post('user_id');
        $video_id = $this->post('video_id');  
        $image_id = $this->post('image_id'); 
        $contest_id =$this->post('contest_id');
        $coupon = $this->post('coupon');
        $order_type = $this->post('order_type');
        $round = $this->post('round');
        $total_amount = strip_tags($this->post('total_amount'));
        
        if(!empty($this->post('video_id'))){
            if(count($this->post('video_id')) > 2) {
            $this->response([
                        'status' => TRUE,
                        'message' => 'You can select only 2 videos at a time for the selected contest',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
            }
            elseif(count($this->post('video_id')) == 0) {
                $this->response([
                        'status' => TRUE,
                        'message' => 'Select any Video',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
            }
        }
        
        if(!empty($this->post('image_id'))){
            if(count($this->post('image_id')) > 2) {
            $this->response([
                        'status' => TRUE,
                        'message' => 'You can select only 2 Images at a time for the selected contest',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
            }
            elseif(count($this->post('image_id')) == 0) {
                $this->response([
                        'status' => TRUE,
                        'message' => 'Select any Image',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
            }
        }
            
            if(!empty($this->post('coupon'))){
                
        if(strtolower($this->post('coupon')) != 'fr55mth') {
            $this->response([
                        'status' => TRUE,
                        'message' => 'Invalid Coupon Code',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        } 
                
                if($order_type=='video'){
            $payment = $this->user->select_manual('videos',array('user_id'=>$user_id),array('coupon'=>$this->post('coupon')));
                }elseif($order_type=='image'){
             $payment = $this->user->select_manual('gallery',array('user_id'=>$user_id),array('coupon'=>$this->post('coupon')));
                }
            if(count($payment)>=1) {
                $this->response([
                        'status' => TRUE,
                        'message' => 'Coupon Code already used',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
            }
            
            }  
            
            if($order_type=='video'){
            $previouscontestvideo = $this->user->select_manual('videos',array('user_id'=>$user_id),array('contest_id'=>$this->post('contest_id')));
            $previouscontestvideo= count($previouscontestvideo) + count($this->post('video_id'));
            if($round == 1){ if($previouscontestvideo>4) {
                  $this->response([
                        'status' => TRUE,
                        'message' => 'you can participate with upto 4 videos only',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        } }
            if($round == 2){  if($previouscontestvideo>3) {
                  $this->response([
                        'status' => TRUE,
                        'message' => 'you can participate with upto 3 videos only',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        }}
            if($round == 3){if($previouscontestvideo>2) {
                  $this->response([
                        'status' => TRUE,
                        'message' => 'you can participate with upto 2 videos only',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        }}
            if($round == 4){ if($previouscontestvideo>2) {
                  $this->response([
                        'status' => TRUE,
                        'message' => 'you can participate with upto 2 videos only',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        } }
           
            } 
            
            if($order_type=='image'){
            $previouscontestvideo = $this->user->select_manual('gallery',array('user_id'=>$user_id),array('contest_id'=>$this->post('contest_id')));
            $previouscontestvideo= count($previouscontestvideo) + count($this->post('image_id'));
            if($previouscontestvideo>10) {
                  $this->response([
                        'status' => TRUE,
                        'message' => 'you can participate with upto 10 images',
                        'data' => '',
                    ], REST_Controller::HTTP_OK);
        }
            }
        
        
        
        // Validate the post data
        if(!empty($user_id) && !empty($contest_id) && !empty($order_type)){
            $result=0;
            if($round > 1){
                
// Prepare new cURL resource
$ch = curl_init('https://www.mytalenthunt.in/razorpay/pay.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,"auth=Codex@123&amount=".$total_amount."");
// Submit the POST request
$result = curl_exec($ch);
// Close cURL session handle
curl_close($ch);
        }
        
        if($order_type=='video'){ 
                // Insert user data
                $userData = array(
                'user_id' => $user_id,
                'order_id' => $result,
                'contest' => $contest_id,
                'cr' => $total_amount,
                'status' => 'Process',
                'dis' => 'Contest Handling Fee',
                'how_to_pay' => 'razorpay',
                'videos' => $video_id,
                );
        }
        
        if($order_type=='image'){ 
                // Insert user data
                $userData = array(
                'user_id' => $user_id,
                'order_id' => $result,
                'contest' => $contest_id,
                'cr' => $total_amount,
                'status' => 'Process',
                'dis' => 'Contest Handling Fee',
                'how_to_pay' => 'razorpay',
                'image' => $image_id,
                );
        }
        
        
        if($total_amount > 0){
                $insert = $this->user->addorder($userData);
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'order Added successfully.',
                        'data' => $result
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);    
                }
        
        
        }else{
          
          
          $insert = $this->user->addorder($userData);
                // Check if the user data is inserted
                if($insert){
                    
                     if($order_type=='video'){
            $tags = json_decode($video_id, true);
              foreach($tags as $key) {    
               $this->user->update_manual('videos',array('id'=>$key),array('contest_id'=>$contest_id)); 
              }
                }elseif($order_type=='image'){
            $tags = json_decode($image_id, true);
              foreach($tags as $key) {    
               $this->user->update_manual('gallery',array('id'=>$key),array('contest_id'=>$contest_id)); 
              }
                }
                
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Participated successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);    
                }
          
      }
        }
      
      if(!empty($user_id) && !empty($order_type) && $order_type=='chitchat'){
        
            // Prepare new cURL resource
        $ch = curl_init('https://www.mytalenthunt.in/razorpay/pay.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"auth=Codex@123&amount=".$total_amount."");
        // Submit the POST request
        $result = curl_exec($ch);
        // Close cURL session handle
        curl_close($ch);

        if($order_type=='chitchat'){ 

                $json_encode = json_encode(array('id'=>$this->post('client_id'),'date'=>$this->post('date'),'time'=>$this->post('time')));
                // Insert user data
                $userData = array(
                'user_id' => $user_id,
                'order_id' => $result,
                'cr' => $total_amount,
                'status' => 'Process',
                'dis' => 'Chitchat Handling Fee',
                'how_to_pay' => 'razorpay',
                'chitchat' => $json_encode
                );
        }
                $insert = $this->user->addorder($userData);
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'order Added successfully.',
                        'data' => $result
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);    
                }

        }
      
      if(!empty($user_id) && !empty($order_type) && $order_type=='prime'){
        
            // Prepare new cURL resource
        $ch = curl_init('https://www.mytalenthunt.in/razorpay/pay.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"auth=Codex@123&amount=".$total_amount."");
        // Submit the POST request
        $result = curl_exec($ch);
        // Close cURL session handle
        curl_close($ch);

        if($order_type=='prime'){ 
                // Insert user data
                $userData = array(
                'user_id' => $user_id,
                'order_id' => $result,
                'cr' => $total_amount,
                'status' => 'Process',
                'dis' => 'Prime Handling Fee',
                'how_to_pay' => 'razorpay'
                );
        }
                $insert = $this->user->addorder($userData);
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'order Added successfully.',
                        'data' => $result
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);    
                }

        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
        }
    
        
    
    }
    public function verifyorder_post() {
        // Get the post data
        if($this->post('user_id')){$user_id = strip_tags($this->post('user_id'));  }
        
        $order_id = strip_tags($this->post('order_id'));
        $status = strip_tags($this->post('status'));
        $amount = strip_tags($this->post('amount'));
        $payment_id = strip_tags($this->post('payment_id'));
        $type = $this->post('type');
        $contest_type = $this->post('contest_type');
        
        //type prime contest
        
        // Validate the post data
        if(!empty($user_id) && !empty($order_id)){
        if($this->post('user_id')){ 
        $insert = $this->user->verifycustomerorder($order_id,$status,$user_id,$payment_id,$amount);
        }

                // Check if the user data is inserted
                if($insert){

                    // Set the response and exit
                    if($status=='Failed'){

                        $this->response([
                        'status' => TRUE,
                        'message' => 'Payment Failed.',
                        'data' => 'Done'
                    ], REST_Controller::HTTP_OK);
                        
                        
                    }else{
                       
                if($type=='contest')  {
                     $summery = $this->user->select_manual('transaction_summery',array('order_id'=>$order_id));
                     $contest_ids = json_decode($summery[0]['videos'],true);
                    if(!empty($contest_ids)) {

            $contest_id = $summery[0]['contest'];
            
          foreach($contest_ids as $con_id) {
            if($con_id!='') {
               if($contest_type=='video'){

                 $this->user->update_manual('videos',array('id'=>$con_id),array('contest_id'=>$contest_id));

                  }else{

                   $this->user->update_manual('gallery',array('id'=>$con_id),array('contest_id'=>$contest_id)); 
                   

                  } 
            }
              

          }


      }
      $this->response([
                        'status' => TRUE,
                        'message' => 'Payment successfully.',
                        'data' => 'Done'
                    ], REST_Controller::HTTP_OK);
                    
                }


                if($type=='chitchat')  {
                     $summery = $this->user->select_manual('transaction_summery',array('order_id'=>$order_id));
                    
                     $chitchat = json_decode($summery[0]['chitchat'],true);
                    if(!empty($chitchat)) {

                $chitchat_id = $chitchat['id'];
                $chitchat_date = $chitchat['date'];
                $chitchat_time = $chitchat['time'];
                $time = explode(' to ', $chitchat_time);
                $data_to_store = array(
                    'user_id'=>$summery[0]['user_id'],
                    'm_id'=>$chitchat_id,
                    'date'=>$chitchat_date,
                    'start_time'=>$time[0],
                    'end_time'=>$time[1],
                    'status'=>'Process',
                    'ap_status'=>'pending'
                );
                $this->user->insert_manual('appointments',$data_to_store);

      }
      $this->response([
                        'status' => TRUE,
                        'message' => 'Payment successfully.',
                        'data' => 'Done'
                    ], REST_Controller::HTTP_OK);
                    
                }


                /** prime member start**/
                if($type=='prime') {

                 $user = $this->user->profile($user_id);


                 $prime_limit = $this->user->select_manual('prime_limit',array('user_id'=>$user_id));
                if(empty($prime_limit)) {
                    $this->user->insert_manual('prime_limit',array('user_id'=>$user_id));
                    if($user[0]['parent_customer_id'] !='') {
                    $this->user->direct_update($user[0]['parent_customer_id'],1,'direct');
                        
                        if($user[0]['dprime']==1) {
                            $this->user->update_prime_eligibility_income($user[0]['did'],200);
                            $this->user->update_prime_eligibility_income($user[0]['id'],200);
                        }
                 }

                 $this->user->update_manual('customer',array('id'=>$user_id),array('prime'=>1));
                }
                 $last_prime_member = $this->user->get_prime_member();
                 $column = $last_prime_member[0]['column'];
                 $row = $last_prime_member[0]['row'];
                 if($column==3) {
                    $row = $row+1;
                    $column = 1;
                 } else {
                    $column = $column+1;
                 }

                 $data_to_store = array('user_id'=>$user_id,'column'=>$column,'row'=>$row);
                 $insert_id = $this->user->insert_prime_member($data_to_store);

                 /* Row Income Start */
                 if($column==3) {
                    $get_record = $this->user->get_prime_member_by_id($row);
                    if(!empty($get_record) && $get_record[0]['income'] < $get_record[0]['eligibility']) {
                        //  income
                        if($get_record[0]['income'] + 200 > $get_record[0]['eligibility']) { 
                        $income = $get_record[0]['eligibility'] - $get_record[0]['income'];
                        } else { $income = 200; }
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Row','status'=>'Active');
                        $this->user->insert_income($data_to_store);
                        $this->user->update_wallet($get_record[0]['user_id'],$income);
                        $this->user->update_prime_limit_income($get_record[0]['user_id'],$income);

                    } else {
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>200,'user_send_by'=>$insert_id,'type'=>'Row','status'=>'Hold');
                        $this->user->insert_income($data_to_store);
                    }
                    
                 }
                 /* Row Income End */

                  /* Column Income Start */
                 if(is_int($row/3) > 0) {
                    $get_column_income_id = $insert_id-(($row/3)*6);
                    $get_record = $this->user->get_prime_member_by_id($get_column_income_id);
                    if(!empty($get_record) && $get_record[0]['income'] < $get_record[0]['eligibility']) {
                        //  income
                        if($get_record[0]['income'] + 200 > $get_record[0]['eligibility']) { 
                        $income = $get_record[0]['eligibility'] - $get_record[0]['income'];
                        } else { $income = 200; }
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Column','status'=>'Active');
                        $this->user->insert_income($data_to_store);
                        $this->user->update_wallet($get_record[0]['user_id'],$income);
                        $this->user->update_prime_limit_income($get_record[0]['user_id'],$income);
                    } else {
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>200,'user_send_by'=>$insert_id,'type'=>'Column','status'=>'Hold');
                        $this->user->insert_income($data_to_store);
                    }

                    if(is_int($insert_id/9) > 0) {

                        $get_row_income = $insert_id/9;
                        $get_record = $this->user->get_prime_member_row($get_row_income);
                        if(!empty($get_record)) {
                            foreach ($get_record as $value) {
                                if($value['income'] < $value['eligibility']) {
                                    if($value['income'] + 180 > $value['eligibility']) { 
                                    $income = $value['eligibility'] - $value['income'];
                                    } else { $income = 180; }
                                    $data_to_store = array('user_id'=>$value['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Box Achiever','status'=>'Active');
                                    $this->user->insert_income($data_to_store);
                                    $this->user->update_wallet($value['user_id'],$income);
                                    $this->user->update_prime_limit_income($value['user_id'],$income);
                                } else {
                                    $data_to_store = array('user_id'=>$value['user_id'],'amount'=>180,'user_send_by'=>$insert_id,'type'=>'Box Achiever','status'=>'Hold');
                                    $this->user->insert_income($data_to_store);
                                }
                                
                                

                            }


                            $get_record = $this->user->get_prime_member_by_id($get_row_income);
                            $this->prime_memeber_matrix($get_record[0]['user_id']);

                        }


                    }

                 }

                 /* Column Income End */



          $this->session->unset_userdata('web_type');
          $this->session->unset_userdata('contest_type');
          $this->session->set_flashdata('flash_message', 'updated');
          

                    /** prime member end**/


                    $this->response([
                        'status' => TRUE,
                        'message' => 'Payment successfully.',
                        'data' => 'Done'
                    ], REST_Controller::HTTP_OK);
                    }
                }

                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);   
                }
        
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function primemember_post() {
        // Get the post data
        $user_id =$this->post('user_id');
        $order_type = $this->post('order_type');
        $total_amount = strip_tags($this->post('total_amount'));
        
        // Validate the post data
        if(!empty($user_id) && !empty($order_type)){
            
// Prepare new cURL resource
$ch = curl_init('https://www.mytalenthunt.in/razorpay/pay.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,"auth=Codex@123&amount=".$total_amount."");
// Submit the POST request
$result = curl_exec($ch);
// Close cURL session handle
curl_close($ch);
        
        if($order_type=='prime'){ 
                // Insert user data
                $userData = array(
                'user_id' => $user_id,
                'order_id' => $result,
                'cr' => $total_amount,
                'status' => 'Process',
                'dis' => 'Prime membership Fee',
                'how_to_pay' => 'razorpay',
                );
           }
           $insert = $this->user->addorder($userData);
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'order Added successfully.',
                        'data' => $result
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);    
                }
        
        }else{
            // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Provide complete user info to add.',
                    'data' => '',
                ],REST_Controller::HTTP_OK);
        }
    }

    public function prime_memeber_matrix($id) {

            
                 $last_prime_member = $this->user->get_prime_member();
                 $column = $last_prime_member[0]['column'];
                 $row = $last_prime_member[0]['row'];
                 if($column==3) {
                    $row = $row+1;
                    $column = 1;
                 } else {
                    $column = $column+1;
                 }

                 $data_to_store = array('user_id'=>$id,'column'=>$column,'row'=>$row);
                 $insert_id = $this->user->insert_prime_member($data_to_store);

                 /* Row Income Start */
                 if($column==3) {
                    $get_record = $this->user->get_prime_member_by_id($row);
                    if(!empty($get_record) && $get_record[0]['income'] < $get_record[0]['eligibility']) {
                        //  income
                        if($get_record[0]['income'] + 250 > $get_record[0]['eligibility']) { 
                        $income = $get_record[0]['eligibility'] - $get_record[0]['income'];
                        } else { $income = 250; }
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Matrix Row','status'=>'Active');
                        $this->user->insert_income($data_to_store);
                        $this->user->update_wallet($get_record[0]['user_id'],$income);
                        $this->user->update_prime_limit_income($get_record[0]['user_id'],$income);
                    } else {
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>250,'user_send_by'=>$insert_id,'type'=>'Matrix Row','status'=>'Hold');
                        $this->user->insert_income($data_to_store);
                    }
                    
                 }
                 /* Row Income End */

                  /* Column Income Start */
                 if(is_int($row/3) > 0) {
                    $get_column_income_id = $insert_id-(($row/3)*6);
                    $get_record = $this->user->get_prime_member_by_id($get_column_income_id);
                    if(!empty($get_record) && $get_record[0]['income'] < $get_record[0]['eligibility']) {
                        //  income
                        if($get_record[0]['income'] + 250 > $get_record[0]['eligibility']) { 
                        $income = $get_record[0]['eligibility'] - $get_record[0]['income'];
                        } else { $income = 250; }
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Matrix Column','status'=>'Active');
                        $this->user->insert_income($data_to_store);
                        $this->user->update_wallet($get_record[0]['user_id'],$income);
                        $this->user->update_prime_limit_income($get_record[0]['user_id'],$income);
                    } else {
                        $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>250,'user_send_by'=>$insert_id,'type'=>'Matrix Column','status'=>'Hold');
                        $this->user->insert_income($data_to_store);
                    }

                    if(is_int($insert_id/9) > 0) {


                        /*$get_record = $this->user->get_prime_member_matrix_by_id($get_row_income);
                        if(!empty($get_record)) {
                            //  income
                            $data_to_store = array('user_id'=>$get_record[0]['user_id'],'amount'=>800,'user_send_by'=>$insert_id,'type'=>'Matrix Box Income');
                            $this->user->insert_income($data_to_store);
                        }*/


                        $get_row_income = $insert_id/9;
                        $get_record = $this->user->get_prime_member_row($get_row_income);
                        if(!empty($get_record)) {
                            foreach ($get_record as $value) {
                                if($value['income'] < $value['eligibility']) {
                                    if($value['income'] + 300 > $value['eligibility']) { 
                                    $income = $value['eligibility'] - $value['income'];
                                    } else { $income = 300; }
                                    $data_to_store = array('user_id'=>$value['user_id'],'amount'=>$income,'user_send_by'=>$insert_id,'type'=>'Matrix Box Achiever','status'=>'Active');
                                    $this->user->insert_income($data_to_store);
                                    $this->user->update_wallet($value['user_id'],$income);
                                    $this->user->update_prime_limit_income($value['user_id'],$income);
                                } else {
                                    $data_to_store = array('user_id'=>$value['user_id'],'amount'=>300,'user_send_by'=>$insert_id,'type'=>'Matrix Box Achiever','status'=>'Hold');
                                    $this->user->insert_income($data_to_store);
                                }
                                
                                //$this->prime_memeber_matrix($value['user_id']);

                                
                            }

                            $get_record = $this->user->get_prime_member_by_id($get_row_income);
                            $this->prime_memeber_matrix($get_record[0]['user_id']);
                        }


                        


                    }

                 }

                 /* Column Income End */
                
                 
             

       }
    public function transferfund_post() {
        // Get the post data
        $user_id = $this->post('user_id');
        $redeem = $this->post('amount');
        
       $users = $this->user->getuserpdata($user_id);
       $wallet= $users[0]['bliss_amount'];
       $balance =$wallet-$redeem;
       
       $ciruserlimit = 5000;
       $minlimit = 500;
       
       
       if($ciruserlimit < $redeem) {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Your maximum redeem limit is '.$ciruserlimit.'',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
              
           }
           
           if($minlimit > $redeem) {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Your minimum redeem limit is '.$minlimit.'',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
              
           }
       
        if($wallet < $this->input->post('amount')) {
              $this->response([
                    'status' => FALSE,
                    'message' => 'Your maximum transfer Amount limit  is '.$wallet.'',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
           }
           
           
           
          if($users[0]['var_status']=='') {
              $this->response([
                    'status' => FALSE,
                    'message' => 'Please update your profile',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
           }
           
           if($users[0]['var_status']=='no') {
              $this->response([
                    'status' => FALSE,
                    'message' => 'Your profile is under review please wait 2 working days',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
           }
           
       
        if(!empty($user_id)){
             $data_to_store = array(
                    'balance' => $balance,
                    'redeem' => $this->input->post('amount'),
                    'after_tds' => $balance,
                    'my_bliss_req' => 'bliss_amount',
                    'user_id' => $user_id
                ); 
               $this->user->redeem_bliss_request($data_to_store);
               
               $this->user->update_wallet($user_id,$balance);

                $this->response([
                    'status' => TRUE,
                    'message' => 'Request updated successfully.',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
           
        }else{
            // Set the response and exit
             $this->response([
                    'status' => FALSE,
                    'message' => 'Something Went wrong',
                    'data' => ''
                ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function consultant_post() {
        // Get the post data
       
        
       if(!empty($this->post('user_id'))){
                // Insert user data
                $userData = array(
              'user_id' => $this->post('user_id'),
              'name' => $this->post('bcname'),
              'email' => $this->post('bcemail'),
              'phone' => $this->post('bcphone'),
              'address' => $this->post('bcadress'),
              'city' => $this->post('bccity'),
              'vanue1' => $this->post('bcvanue1'),
              'occup' => $this->post('bcoccup'),
              'vanue2' => $this->post('bcvanue2'),
              'status' => 'Pending',
                );
                $insert = $this->user->insert_manual('consultant_request', $userData);
                
                
                // Check if the user data is inserted
                if($insert){
                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data added successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                    
                    
                }
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Add some data.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }

    public function bankupdate_post() {
        
       if(strip_tags($this->post('user_id'))!=''){
                // Insert user data
        $userData = array(
              'account_name' => $this->post('name'),
              'gpay' => $this->post('gpay'),
              'paytm' => $this->post('paytm'),
              'bank_name' => $this->post('bank_name'),
              'account_no' => $this->post('account_no'),
              'ifsc' => $this->post('ifsc'),
              'info' => $this->post('bio'),
              'var_status' => 'no',
              //'bank_image' => $this->post('bank_image')
            );
                $insert = $this->user->update_manual('customer',array('id'=>$this->post('user_id')), $userData);
                
                
                // Check if the user data is inserted
                if($insert){
                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data updated successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                    
                    
                }
            } else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Add some data.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }

    public function advertisement_post() {
        // Get the post data
       
        
       if(!empty($this->post('user_id'))){
                // Insert user data
                $userData = array(
              'user_id' => $this->post('user_id'),
              'brand_name' => $this->post('brand_name'),
              'email' => $this->post('email'),
              'phone' => $this->post('phone'),
              'company_name' => $this->post('company_name'),
              'service' => $this->post('service'),
              'concuran_person' => $this->post('concuran_person'),
              'advertise_budget' => $this->post('advertise_budget'),
              //'advertise_type' => $this->post('advertise_type'),
              'status' => 'Pending',
                );
                $insert = $this->user->insert_manual('advertisement_request', $userData);
                
                
                // Check if the user data is inserted
                if($insert){
                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data added successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                    
                    
                }
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Add some data.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    
     public function contact_post() {
        // Get the post data
       
        
       if(!empty($this->post('user_id'))){
                // Insert user data
                $userData = array(
              'user_id' => $this->post('user_id'),
              'name' => $this->post('name'),
              'email' => $this->post('email'),
              'phone' => $this->post('phone'),
              'description' => $this->post('description'),
              'status' => 'Pending',
                );
                $insert = $this->user->insert_manual('contact_request', $userData);
                
                $to = "mytalenthuntteam@gmail.com";
                $subject ="contact_form :- mytalenthunt";
                $txt = "name :- ".$this->input->post('name')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>message :- ".$this->input->post('description')."<br/>Customer name :- ".$this->session->userdata('full_name')."<br/>customer id :- ".$this->session->userdata('bliss_id'); 
                $headers = "From: mytalenthunt.in" . "\r\n";
                $headers = "MIME-Version: 1.0" . "\r\n";     
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
                $headers .= 'From: <mytalenthunt.in>' . "\r\n"; 
                mail($to,$subject,$txt,$headers);
                
                // Check if the user data is inserted
                if($insert){
                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data added successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                    
                    
                }
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Add some data.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }

   

    public function prime_income_get($id = 0) {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
         $con = $id?array('id' => $id):'';
         $prime_member_row = $prime_member_column = $prime_member_box = array();
         $prime_member = $this->user->get_prime_member_by_userid($id);
         $profile = $this->user->profile($id);
         /*if(!empty($prime_member)) {
            $prime_member_row = $this->user->select_manual('prime_member',array('row'=>$prime_member[0]['id']));
            $row = ($prime_member[0]['row']-1)*3;
       $prime_member_column = $this->user->select_manual('prime_member',array('row >='=>$row+1,'row <'=>$row+4,'column'=>$prime_member[0]['column']));

            $row = $prime_member[0]['id']*3;
            $prime_member_box = $this->user->select_manual('prime_member',array('row'=>$row));
         }
         
          $count =  count($prime_member_row) + count($prime_member_column) + count($prime_member_box); $balance = 10-$count;  */
          $prime_member_inc = $this->user->select_manual('income',array('user_id'=>$id));
          
          $prime_limit = $this->user->select_manual('prime_limit',array('user_id'=>$id));

        // Check if the user data exists
        if(!empty($prime_member)){
            // Set the response and exit
            //OK (200) being the HTTP response code
          
        $result = array('royality_limit'=>$prime_limit[0]['eligibility'],'ledger_total'=>array_sum(array_column($prime_member_inc, 'amount')),'ledger_balance'=>$profile[0]['bliss_amount'],'royality'=>0,'pac'=>0,'monitization'=>0);
                 
                 
            //$this->response(['postdata'=>$result],REST_Controller::HTTP_OK);
            $this->response($result,REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
      public function processhandlingfees_get($type = 'null') {
         $con = array('type'=>$type);
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.

        $users = $this->user->process_fee($con);
        // Check if the user data exists
        if(!empty($users)){
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No data found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
   
     
    /**  Chat api **/
    
    public function chatpost_post() {
    
        $from = strip_tags($this->post('from'));
        $to = strip_tags($this->post('to'));
            if(!empty($from) && !empty($to)){
                $now = date('Y-m-d H:i:s');
                // Insert user data
                $userData = array(
                'from_user_id' => $this->post('from'),
                'to_user_id' => $this->post('to'),
                'chat_message' => $this->post('message'),
                'timestamp' => $now,
                );
                $insert = $this->user->add_chat_msg($userData);
                
                $get_from = $this->user->user_chat_data($from);
                $get_to = $this->user->user_chat_data1($to);
                if(!empty($get_to)){
                $this->sendNotification($from,$get_from[0]['f_name'],$get_to[0]['device_id']);
                }
            
                // Check if the user data is inserted
                if($insert){
                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Data added successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
                    
                    
                }else{
                    $this->response([
                    'status' => FALSE,
                    'message' => 'Some problems occurred, please try again.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);   
                }
                
        
                
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Add some data.',
                    'data' => '',
                ],REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    
    public function onebyonchat_get($id = 0, $userid = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
         
         $users = $this->user->get_chat_msg($id,$userid);   
        // Check if the user data exists
        if(!empty($users) ){
            
        $result = array();
        $prev = NULL;
        foreach($users as $val) {
        $time = new DateTime($val['timestamp']);
        $date = $time->format('n.j.Y');
        $datee = $time->format('j F Y');
        $time = $time->format('H:i');
        if ($datee != $prev) {
        $groupdate=$datee;
        $prev = $datee;
        }else{$groupdate='1';}

        $result[] = array('id'=>$val['id'],'from'=>$val['from_user_id'],'to'=>$val['to_user_id'],'message'=>$val['chat_message'],'sent'=>$time,'groupdate'=>$groupdate);  
        }
         $this->response($result, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }
       
    public function onebyonchatnew_get($id = 0, $userid = 0) {
       // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        
         $users = $this->user->get_chat_msg_new($id,$userid);
         
        // Check if the user data exists
        if(!empty($users) ){
            $this->user->update_chat($id,$userid);
        $result = array();
        foreach($users as $val) {
        $time = timeago($val['timestamp']);
        $result[] = array('id'=>$val['id'],'from'=>$val['from_user_id'],'to'=>$val['to_user_id'],'message'=>$val['chat_message'],'sent'=>$time);  
        }
         $this->response($result, REST_Controller::HTTP_OK);    
        }else{
            // Set the response and exit
            $this->response(array(), REST_Controller::HTTP_OK);
        }
    }
   
    
    public function sendNotification($uiid,$name,$device_id) {
        $token = $device_id; 
        $message = "Sent you a message";
        $pid = "0";
        $uid = $uiid;
        $this->load->library('fcm');
        $this->fcm->setTitle($name);
        $this->fcm->setMessage($message);
        $this->fcm->setUserid($uid);
        $this->fcm->setProductid($pid);
        /**
         * set to true if the notificaton is used to invoke a function
         * in the background
         */
        $this->fcm->setIsBackground(false);
        /**
         * payload is userd to send additional data in the notification
         * This is purticularly useful for invoking functions in background
         * -----------------------------------------------------------------
         * set payload as null if no custom data is passing in the notification
         */
        $payload = array('notification' => '');
        $this->fcm->setPayload($payload);
        /**
         * Send images in the notification
         */
        $this->fcm->setImage('https://www.mytalenthunt.in/assets/front/images/favicon.png');
        /**
         * Get the compiled notification data as an array
         */
        $json = $this->fcm->getPush();
        $p = $this->fcm->send($token, $json);
       // print_r($p);
    }
 
 
 
 /**  notification  ***/
 
 
  public function usernotificationcount_get($id = 0) {
        $user_id = $id;
        $users = newnotificationapi($user_id);
        $msgcount = newmsgnotificationapi($user_id);
        
        //if(!empty($users)){
        $this->response(['chat'=>$msgcount,'msg'=>$users],REST_Controller::HTTP_OK);
        /* }else{
        $this->response(['chat'=>'','msg'=>''],REST_Controller::HTTP_OK);
        } */
    }
   
  public function usernotification_get($id = 0) {
        $user_id = $id;
        $users = notificationapi($user_id);
        $result = array();
        foreach($users as $val) {
            
            if($val['type']=='Like Video'){$type="likes Your Video"; $screen="video"; }
            if($val['type']=='Like Image'){$type="likes Your Photo"; $screen="image";}
            if($val['type']=='Like Post'){$type="liked your post"; $screen="post";}
            if($val['type']=='Follow'){$type="started following you"; $screen="follow";}
            if($val['type']=='Friend Request'){$type="want to become friend."; $screen="friend";}
            if($val['type']=='Friend Request Accepted'){$type="has accepted your friend request."; $screen="friend accepted";}
            
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
            
        $time = timeago($val['date']);
        $result[] = array('id'=>$val['id'],'user_id'=>$val['user_id'],'user_id_by'=>$val['user_id_by'],'v_id'=>$val['v_id'],'p_id'=>$val['p_id'],'type'=>$type,'message'=>$val['message'],'status'=>$val['status'],'newnoti'=>$val['newnoti'],'readstatus'=>$val['readstatus'],'videoid'=>$val['videoid'],'d_name'=>$val['d_name'],'image'=>$userimage,'postid'=>$val['postid'],'screen'=>$screen,'date'=>$time);  
        }
         
        if(!empty($users)){
                  $this->response([
                'status' => TRUE,
                'data' => $result,
                'message' => 'Notification found'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'data' => '',
                'message' => 'No Notification was found.'
            ], REST_Controller::HTTP_OK);
        }
    }
   
    
    /** chat notification  ***/
    
   
     public function chatnotification_get($id = 0) {
        $user_id = $id;
        $users = newmessagesapi($user_id);
        
        $result = array();
        foreach($users as $val) {
            
                     $userimage = '';
                     if($val['image']!='') { $userimage = 'https://www.mytalenthunt.in/images/user/profile_pick/'.$val['image']; }else{$userimage = 'https://www.mytalenthunt.in/assets/front/images/author/user.png';}
            
        $time = timeago($val['timestamp']);
        $result[] = array('id'=>$val['id'],'name'=>$val['d_name'],'from_user_id'=>$val['from_user_id'],'type'=>'has sent you a message','message'=>$val['chat_message'],'image'=>$userimage,'date'=>$time);  
        }
        
        if(!empty($users)){
                  $this->response([
                'status' => TRUE,
                'data' => $result,
                'message' => 'Notification found'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'data' => '',
                'message' => 'No Notification was found.'
            ], REST_Controller::HTTP_OK);
        }
    }
  
    
    /*logout*/
    
public function logout_get($id = 0) {
        $user_id = $id;
        $users = $this->user->update_logoutid($user_id);
    }   
    
    /*Banner*/
    
 
   /*videoframes*/
   
   
   
    public function deletenotification_post() {
    
        $userid = strip_tags($this->post('uid'));
        $notificationid = strip_tags($this->post('notificationid'));
        
            if($notificationid > 0 && $userid == 0){
        $this->user->delete_manual('notifications',array('id'=>$this->post('notificationid')));
          $this->response([
                        'status' => TRUE,
                        'message' => 'Notification Deleted successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
            }
            
            if($notificationid == 0  && $userid > 0){
        $this->user->delete_manual('notifications',array('user_id'=>$this->post('uid')));
          $this->response([
                        'status' => TRUE,
                        'message' => 'Notification Deleted successfully.',
                        'data' => ''
                    ], REST_Controller::HTTP_OK);
            }
            
    }
    
    
            
    
    
    public function _create_thumbs($file_name){
// Image resizing config
$config = array(
// Large Image
array(
'image_library' => 'GD2',
'source_image'=> 'images/user/profile_pick/'.$file_name,
'maintain_ratio'=> FALSE,
'width'=> 300,
'height'=> 300,
'new_image'=> 'images/user/profile_pick/'.$file_name
),
// Medium Image
array(
'image_library' => 'GD2',
'source_image'=> 'images/user/profile_pick/'.$file_name,
'maintain_ratio'=> TRUE,
'width'=> 45,
'height'=> 45,
'new_image'=> 'images/user/medium/'.$file_name
),
// Small Image
array(
'image_library' => 'GD2',
'source_image'=> 'images/user/profile_pick/'.$file_name,
'maintain_ratio'=> TRUE,
'width'=> 35,
'height'=> 35,
'new_image'=> 'images/user/small/'.$file_name
));

$this->load->library('image_lib', $config[0]);
foreach ($config as $item){
$this->image_lib->initialize($item);
if(!$this->image_lib->resize()){
return  $this->image_lib->display_errors();;
}
$this->image_lib->clear();
}
}

  
 
    
    /**  unusefull api **/
    public function country_get() {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $users = $this->user->country();
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No Country was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
  
 
    
} 
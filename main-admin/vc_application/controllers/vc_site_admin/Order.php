<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('order_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['order'] = $this->order_model->get_all_order();
	
	//load the view
      $data['main_content'] = 'admin/order_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
    public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
           /*  $this->form_validation->set_rules('iname', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('qty', 'qty', 'required'); */
			$this->form_validation->set_rules('userid', 'userid', 'required');
			$iname = $this->input->post('iname');
			if(empty($iname)) {
				$this->form_validation->set_rules('reqfld', 'name', 'required');
				$this->form_validation->set_message('required', 'Please fill all name filed');
			}
			$price = $this->input->post('price');
			if(empty($price)) {
				$this->form_validation->set_rules('reqfld', 'price', 'required');
				$this->form_validation->set_message('required', 'Please fill all price filed');
			}
			$qty = $this->input->post('qty');
			if(empty($qty)) {
				$this->form_validation->set_rules('reqfld', 'qty', 'required');
				$this->form_validation->set_message('required', 'Please fill all qty filed');
			}
			
			$userid = $this->input->post('userid');
			$customer_info = $this->order_model->get_customer_cid($userid);
			if(empty($customer_info)) {
				$this->form_validation->set_rules('reqfld', 'userid', 'required');
				$this->form_validation->set_message('required', 'This customer id is not exist.');
			}
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
			$total_price = 0;
			foreach($price as $p) {
				if(is_numeric($p)) { $total_price = $total_price + $p; }
			}
			$all_name = implode('~-~',$iname);
			$all_price = implode('~-~',$price);
			$all_qty = implode('~-~',$qty);
			
			$items = $all_name.'~~--~~'.$all_price.'~~--~~'.$all_qty;
			
				$data_to_store = array(
                    'user_id' => $customer_info[0]['id'],
                    'p_name' => $customer_info[0]['f_name'].' '.$customer_info[0]['l_name'],
					'items' => $items,
					'status' => 'Pending',
					'total_amount' => $total_price
				); 
                //if the insert has returned true then we show the flash message
				if($this->order_model->store_order($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/order/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/order_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
 
  
   public function order_distribute(){ 
    $id = $this->uri->segment(4);
	$data['blissid'] = $return = '';
	if ($this->input->server('REQUEST_METHOD') == 'POST')
        {echo '  eeeeeeeeee ';
            /*form validation*/
              $this->form_validation->set_rules('oid', 'order id', 'required|trim|numeric'); 
              $this->form_validation->set_rules('uid', 'user id', 'required|trim|numeric'); 
              $this->form_validation->set_rules('bid', 'bliss id', 'required|trim'); 
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  	 
		
		/**************** payment distribution *******************/				
		$distribution_amount = $this->input->post('damount');				
		$order_id = $this->input->post('oid');				
		$bliss_code =  $this->input->post('bid');		        
		$cust_id = $this->input->post('uid');  
		echo $bliss_code. ' - '.$cust_id .' - ' .$this->input->post('how_to_pay');
        if($bliss_code != '' && $cust_id != '' && $this->input->post('how_to_pay')=='cod') { echo '  1sssssssss ';
				$parent_bliss = $this->order_model->parent_bliss($cust_id);
				$distribute_level = 0;
				$distribute_user_id_array = array();
				if(!empty($parent_bliss) && $parent_bliss[0]['parent_customer_id']!='' && $distribution_amount > 1) {
				   $distribute_level = $distribute_level + 1;
				   $distribute_user_id_array[] = $parent_bliss[0]['pid'];
					//echo $distribute_level.' '.$parent_bliss[0]['id'].' '.$parent_bliss[0]['parent_customer_id'].'<br>';
				   $parent_bliss_2 = $this->order_model->parent_bliss_result($parent_bliss[0]['parent_customer_id']);
				   if(!empty($parent_bliss_2) && $parent_bliss_2[0]['parent_customer_id']!='') {
					 $distribute_level = $distribute_level + 1;
				     $distribute_user_id_array[] = $parent_bliss_2[0]['pid'];
					 //echo $distribute_level.' '.$parent_bliss_2[0]['id'].' '.$parent_bliss_2[0]['parent_customer_id'].'<br>';
					 $parent_bliss_3 = $this->order_model->parent_bliss_result($parent_bliss_2[0]['parent_customer_id']);
				     if(!empty($parent_bliss_3) && $parent_bliss_3[0]['parent_customer_id']!='') {
				        $distribute_level = $distribute_level + 1;
				        $distribute_user_id_array[] = $parent_bliss_3[0]['pid'];
					    //echo $distribute_level.' '.$parent_bliss_3[0]['id'].' '.$parent_bliss_3[0]['parent_customer_id'].'<br>';
						$parent_bliss_4 = $this->order_model->parent_bliss_result($parent_bliss_3[0]['parent_customer_id']);
						if(!empty($parent_bliss_4) && $parent_bliss_4[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_4[0]['pid'];
					      //echo $distribute_level.' '.$parent_bliss_4[0]['id'].' '.$parent_bliss_4[0]['parent_customer_id'].'<br>';
						  $parent_bliss_5 = $this->order_model->parent_bliss_result($parent_bliss_4[0]['parent_customer_id']);
						  if(!empty($parent_bliss_5) && $parent_bliss_5[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_5[0]['pid'];
					     // echo $distribute_level.' '.$parent_bliss_5[0]['id'].' '.$parent_bliss_5[0]['parent_customer_id'].'<br>';
						  }
						 }
					   }
				   }
				}
				
				if($distribute_level == 1) { 
				    $dis_level_0 = (40 / 100) * $distribution_amount;
					$dis_level_0 = round($dis_level_0,2);
					$this->order_model->add_distribution_amount($dis_level_0,$distribute_user_id_array[0],1,$order_id,$cust_id);
				}
				if($distribute_level == 2) { 
				    $dis_level_1 = (40 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
					$dis_level_2 = (20 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
					$this->order_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id,$cust_id);
					
					$this->order_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id,$cust_id);
					
				}
				if($distribute_level == 3) { 
				    $dis_level_1 = (40 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (20 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
					$dis_level_3 = (15 / 100) * $distribution_amount;
					$dis_level_3 = round($dis_level_3,2);
					$this->order_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id,$cust_id); 
					
					$this->order_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id,$cust_id); 
					$this->order_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id,$cust_id); 
				}
				if($distribute_level == 4) { 
				    $dis_level_1 = (40 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (20 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
				    $dis_level_3 = (15 / 100) * $distribution_amount;
					$dis_level_3 = round($dis_level_3,2);
					$dis_level_4 = (10 / 100) * $distribution_amount;
					$dis_level_4 = round($dis_level_4,2);
					$this->order_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id,$cust_id); 
					$this->order_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id,$cust_id); 
					$this->order_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id,$cust_id);  
					$this->order_model->add_distribution_amount($dis_level_4,$distribute_user_id_array[3],4,$order_id,$cust_id);
				}
				if($distribute_level == 5) { 
				    $dis_level_1 = (40 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (20 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
				    $dis_level_3 = (15 / 100) * $distribution_amount;
					$dis_level_3 = round($dis_level_3,2);
				    $dis_level_4 = (10 / 100) * $distribution_amount;
					$dis_level_4 = round($dis_level_4,2);
					$dis_level_5 = (5 / 100) * $distribution_amount;
					$dis_level_5 = round($dis_level_5,2);
					$this->order_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id,$cust_id);
					$this->order_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id,$cust_id); 
					$this->order_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id,$cust_id);  
					$this->order_model->add_distribution_amount($dis_level_4,$distribute_user_id_array[3],4,$order_id,$cust_id);
					$this->order_model->add_distribution_amount($dis_level_5,$distribute_user_id_array[4],5,$order_id,$cust_id);
				}
				
				$this->order_model->update_distribution_status($order_id);
				$return = 'TRUE';
			  }
			  		
					  /**************** end payment distribution *******************/			  
            

             if($return == 'TRUE'){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/order/distribute/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                } 
            }/*validation run*/

        } 

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['order'] = $this->order_model->get_all_order_id($id); 
        $data['distribution'] = $this->order_model->get_order_distribution($id); 
        if(!empty($data['order'])) {
        $customerid = $this->order_model->get_customer_id($data['order'][0]['user_id']);
		if(!empty($customerid)) {
			$data['blissid'] = $customerid[0]['customer_id'];
		}
        }
        //load the view
        $data['main_content'] = 'admin/order_distribute'; 
        $this->load->view('includes/admin/template', $data); 
}

  public function order_view(){ 
	 
	  //order id 
        $id = $this->uri->segment(3);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
              $this->form_validation->set_rules('status', 'status', 'required|trim'); 
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  				  
                $data_to_store = array( 'status' => $this->input->post('status') ); 
				 
               $return = $this->order_model->update_order($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/order/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                } 
            }/*validation run*/

        } 

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        
        $data['order'] = $this->order_model->get_all_order_id($id); 
        $data['distribution'] = $this->order_model->get_order_distribution($id); 
        //load the view
        $data['main_content'] = 'admin/order_view'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->order_model->delete_order($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/order');
 }  
}
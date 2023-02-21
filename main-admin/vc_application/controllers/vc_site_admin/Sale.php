<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sale extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');	
        $this->load->model('sale_model');	 	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
	  
	   if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='Search') {
         
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		      
        }else{
			
			 //$sdate = date('Y-m-1 00:00:01');
		    // $edate = date('Y-m-t 23:59:59');
			
			$monday = strtotime("last monday");
       $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
		
		$sdate = date("Y-m-d",$monday);
        $edate = date("Y-m-d",$sunday);
 
            	 
			
		}
		
		$data['distributeall'] = '';
		
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('destribute')=='Distribute amount') {
		$saleid = $this->input->post('dis_id');
		$distribution_amount = $this->input->post('dis_amt');
		
		 if($saleid!='' && $distribution_amount!='') {
		  $all_diamond_bdm = $this->sale_model->get_all_diamond_bdm();
			$distribute_level = 0; 
			if(!empty($all_diamond_bdm) && count($all_diamond_bdm) > 0) {
				$dis_amount = (40 / 100) * $distribution_amount;
				$final_dis_amount = $dis_amount / count($all_diamond_bdm);
				$final_dis_amount = round($final_dis_amount,2);

				foreach($all_diamond_bdm as $uid) {
					$this->sale_model->add_distribution_amount($final_dis_amount,$uid['id'],'3','0','0'); 
				}
				if(strstr($saleid,',')) { $sale_array = explode(',',$saleid); }
				else { $sale_array = array($saleid); }
				foreach($sale_array as $sid) {
					if($sid > 0) {
						$this->sale_model->update_total_sale($sid);
					}
				}
				$data['distributeall'] = 'done';
			}
			
		 }
		}
		

		
    	 
	$data['sale'] = $this->sale_model->get_all_sale($sdate, $edate);
	
	//load the view
      $data['main_content'] = 'admin/sale_list';
      $this->load->view('includes/admin/template', $data);   
  }  
  
  public function fourtypercent() {
	  
	   /* if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='Search') {
         
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		      
        }else{
			
			
			$monday = strtotime("last monday");
       $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
		
		$sdate = date("Y-m-d",$monday);
        $edate = date("Y-m-d",$sunday);
 
            	 
			
		} */
		 //$all_diamond_bdm = $this->sale_model->get_all_diamond_bdm();
		 //echo '<pre>';print_r($all_diamond_bdm);echo '</pre>';
		$data['distributeall'] = '';
		
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('destribute')=='Distribute amount') {
		$saleid = $this->input->post('dis_id');
		$distribution_amount = $this->input->post('dis_amt');
		
		 if($saleid!='' && $distribution_amount!='') {
		  $all_diamond_bdm = $this->sale_model->get_all_diamond_bdm();
			$distribute_level = 0; 
			if(!empty($all_diamond_bdm) && count($all_diamond_bdm) > 0) {
				$dis_amount = $distribution_amount;
				$final_dis_amount = $dis_amount / count($all_diamond_bdm);
				$final_dis_amount = round($final_dis_amount,2);

				foreach($all_diamond_bdm as $uid) {
					$this->sale_model->add_distribution_amount($final_dis_amount,$uid['id'],'0','0','0'); 
					
					if($uid['pid']!='' && $uid['pbsacode']=='Diamond BDM') {
							$pamt = (10 / 100) * $final_dis_amount;
							$pamt = round($pamt,2);
							$this->sale_model->add_distribution_amount($pamt,$uid['pid'],'1','0',$uid['id']);
						}
					
				}
				if(strstr($saleid,',')) { $sale_array = explode(',',$saleid); }
				else { $sale_array = array($saleid); }
				foreach($sale_array as $sid) {
					if($sid > 0) {
						$this->sale_model->update_total_forty($sid);
					}
				}
				$data['distributeall'] = 'done';
			}
			
		 }
		}
		

		
    	 
	//$data['fourtypercent'] = $this->sale_model->get_all_fourtypercent($sdate, $edate);
	$data['fourtypercent'] = $this->sale_model->get_all_fourtypercent();
	
	//load the view
      $data['main_content'] = 'admin/fortyprecentpayout_list';
      $this->load->view('includes/admin/template', $data);   
  }

  
    public function allsale() {
	  
	   if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='Search') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        }else{
			$sdate = date('Y-m-1 00:00:01');
		    $edate = date('Y-m-t 23:59:59');
		}
		
		$data['distributeall'] = '';
		
    	 
	$data['sale'] = $this->sale_model->get_total_sale($sdate, $edate);
	
	//load the view
      $data['main_content'] = 'admin/all_sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
 
  
  public function invoice() {
      $id = $this->uri->segment(4);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
		
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['mid']);		
          }
	//load the view
      $data['main_content'] = 'admin/sale_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  
  
  
  
  public function add(){
    /*$myfriendss = $this->sale_model->my_friends('400002'); 
	echo '<pre>';print_r($myfriendss); echo '</pre>';*/
	$data['products'] = $this->sale_model->get_all_product();
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
                
				$customer = $this->input->post('customer');
				$gtotal = $this->input->post('gtotal');
				$customer_id = $this->sale_model->get_merchant_id($customer);
				if(empty($customer_id)) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'This customer id is not exist.');
				}
				/* if($gtotal < 8499) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'Minimum amount must be 8500');
				} */
				
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');	
                if ($this->form_validation->run() == FALSE) {}
                else {
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$bv = $this->input->post('bv');
					$mrp = $this->input->post('mrp');
					$dis = $this->input->post('dis');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$bv[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i].'~~'.$dis[$i].'~~'.$mrp[$i];
							$this->sale_model->update_product_qty($pid[$i],$qty[$i]);
						}
					//$products_array = array('pname'=>$pname,'qty'=>$qty,'qty_type'=>$qty_type,'qty_box'=>$qty_box,'price'=>$price);
					$products = json_encode($products_array);
					}
					
					
					
					
					$data_store = array(
                    'gtotal' => $this->input->post('gtotal'),
                   
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'total_gst' => $this->input->post('total_gst'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'mid' => $customer_id[0]['id']
					);
                //if the insert has returned true then we show the flash message
				$sale_id = $this->sale_model->store_sale($data_store);
				
				if(!empty($sale_id)){
				$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				

            }

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/sale_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
   public function lavel_distribution($parent_customer_id,$customer,$customer_rank,$sale_id,$grant_total){
	   
	   	$customer_id = $this->sale_model->my_parent($parent_customer_id);
		
		if($customer_rank=='3' && $customer_id[0]['p_rank']=='3' && $customer_id[0]['rank']=='3' ){ }
else{	
	   if($parent_customer_id != '' && $customer_id[0]['p_customer_id']!='') { 
	   
	    if($customer_id[0]['p_rank'] > $customer_rank) {
			$current_rank = $customer_id[0]['p_rank'] - $customer_id[0]['rank'];
			if($current_rank=='1') {
				$distribution_amount = (10 * $grant_total) / 100;
				$distribution_data = array(
				  'user_id'=> $customer_id[0]['p_customer_id'],
				  'amount'=> $distribution_amount,
				  'user_id_send_by'=> $customer,
				  'pay_level'=> '2',
				  'status'=>'active',
				  'order_id'=> $sale_id,
				  'rank'=> $customer_id[0]['p_rank']
				);
				$this->sale_model->store_distribution_amount($distribution_data);
				$this->sale_model->update_customer_distribution_amount($distribution_amount,$customer_id[0]['p_customer_id']);
			}
		}
	    
			  }
   }
  }
 
  
  
  
  public function update(){
	  	
	 
	  //sale id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                $data_to_store = array(
				    'user_id' => $this->input->post('user_id'),
				    'amount' => $this->input->post('amount'),
					'gst_val' => $this->input->post('gst_val'),
					'msd_val' => $this->input->post('msd_val'),
					'how_to_pay' => $this->input->post('how_to_pay'),
					'gst_amt' => $this->input->post('gst_amt'),
					'msd_amt' => $this->input->post('msd_amt'),
					'total_amount' => $this->input->post('total_amount'),
					); 
             $return = $this->Sale_model->update_sale($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['sale'] = $this->sale_model->get_all_sale_id($id); 
        //load the view
        $data['main_content'] = 'admin/sale_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->sale_model->delete_sale($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/sale');
 }  
}
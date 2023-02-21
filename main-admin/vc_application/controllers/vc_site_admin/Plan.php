<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plan extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('plan_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['plan'] = $this->plan_model->get_all_plan();
	
	//load the view
      $data['main_content'] = 'admin/plan_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('oper_name', 'operator name', 'required|trim');
			$this->form_validation->set_rules('oper_status', 'status', 'required');
			 $this->form_validation->set_rules('opr_comm', 'opr commession', 'trim|required');
			$this->form_validation->set_rules('Operator_Code', 'Operator Code', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/webstores/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = '';
			        }
			        //----- end file upload -----------
			
				$data_to_store = array(
          'oper_name' => $this->input->post('oper_name'),
					'oper_status' => $this->input->post('oper_status'),
					'Operator_Code' => $this->input->post('Operator_Code'),
					'Service_Type' => $this->input->post('Service_Type'),
					'opr_comm' => $this->input->post('opr_comm'),
					'opr_cash' => $this->input->post('opr_cash'),
					'm_comm' => $this->input->post('m_comm'),
					'oper_type' => $this->input->post('oper_type'),
					'oper_img' => $image,
				
				); 
                //if the insert has returned true then we show the flash message
				if($this->webstores_model->store_plan($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/plan/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/plan_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //webstores id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('oper_name', 'operator name', 'required|trim');
			 $this->form_validation->set_rules('oper_status', 'status', 'required');
			 $this->form_validation->set_rules('opr_comm', 'opr commession', 'trim|required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/webstores/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('avtar_exist')!='') unlink('images/webstores/'.$this->input->post('avtar_exist'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                         $errors = $this->upload->display_errors();
						$image = $this->input->post('avtar_exist');
			        }
			        //----- end file upload -----------
                $data_to_store = array(
          'oper_name' => $this->input->post('oper_name'),
					'oper_status' => $this->input->post('oper_status'),
					'Operator_Code' => $this->input->post('Operator_Code'),
					'Service_Type' => $this->input->post('Service_Type'),
					'opr_comm' => $this->input->post('opr_comm'),
					'opr_cash' => $this->input->post('opr_cash'),
					'm_comm' => $this->input->post('m_comm'),
					'oper_type' => $this->input->post('oper_type'),
					'oper_img' => $image,
				
				);  
             $return = $this->plan_model->update_plan($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/plan/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['plan'] = $this->plan_model->get_all_plan_id($id); 
        //load the view
        $data['main_content'] = 'admin/plan_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->plan_model->delete_plan($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/plan');
 }  
}
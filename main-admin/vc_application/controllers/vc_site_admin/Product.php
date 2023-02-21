<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('product_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['product'] = $this->product_model->get_all_product();
	
	//load the view
      $data['main_content'] = 'admin/product_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('product_type', 'product type', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
				// file upload start here
			$config['upload_path'] ='images/product/';
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
					
				$imagesArray = array();  
				 if(!empty($_FILES['p_image']['name'])){
            $filesCount = count($_FILES['p_image']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['p_image']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['p_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['p_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['p_image']['size'][$i];
				
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
   		    $this->load->library('upload', $config);
				if ($this->upload->do_upload('userFile')) { 
                     $image_data = $this->upload->data();
					 $imagesArray[] = $image_data['file_name'];
				} else { $errors = $this->upload->display_errors();  }
			}
				 }
			        //----- end file upload -----------
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
				$imagesValue = json_encode($imagesArray);
			        //----- end file upload -----------
			
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
					'e_date' => $this->input->post('e_date'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_description'),
					's_discription' => $this->input->post('s_discription'),
					'product_type' => $this->input->post('product_type'),
					'image' => $image,
					'attribute' => $attributeValue,
					'category' => $this->input->post('category'),
					'p_id' => $this->input->post('p_name'), 
					'url' => $this->input->post('url'), 
					'web_id' => $this->input->post('web_name'), 
				); 
                //if the insert has returned true then we show the flash message
				if($this->product_model->store_product($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['category'] = $this->product_model->get_all_category();
        $data['web'] = $this->product_model->get_all_tax();
        $data['main_content'] = 'admin/product_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('p_name', 'title', 'required|trim|min_length[4]');
		   if($this->input->post('sku') != $this->input->post('sku_old')) {
				$is_unique_sku =  '|is_unique[admin_product.sku]';
			} else { $is_unique_sku =  '';	}
			$this->form_validation->set_rules('product_type', 'product type', 'required|trim');
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		
		
		
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('images/product/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
				$imagesList = $this->input->post('images_old');
				if(empty($imagesList)) {    $imagesArray = array(); }
                else { $imagesArray = $this->input->post('images_old'); }
				
				 if(!empty($_FILES['p_image']['name'])){
            $filesCount = count($_FILES['p_image']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['p_image']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['p_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['p_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['p_image']['size'][$i];
				
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
   		    $this->load->library('upload', $config);
				if ($this->upload->do_upload('userFile')) { 
                     $image_data = $this->upload->data();
					 $imagesArray[] = $image_data['file_name'];
				} else { $errors = $this->upload->display_errors();  }
			}
				 }
			        //----- end file upload -----------
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
				$imagesValue = json_encode($imagesArray);
			        //----- end file upload -----------
					
					$string = str_replace(' ', '-', $this->input->post('p_name'));
					$productURL = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
					$productURL = strtolower($productURL.'-'.$id);
		
                $data_to_store = array(
					'p_id' => $productURL,
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
					'e_date' => $this->input->post('e_date'),
                    'status' => $this->input->post('status'),
					'visibility' => $this->input->post('visibility'),
					'description' => $this->input->post('p_discription'),
					's_discription' => $this->input->post('s_discription'),
					'product_type' => $this->input->post('product_type'),
					'image' => $image, 
					'attribute' => $attributeValue,
					'category' => $this->input->post('category'),
					'p_id' => $this->input->post('p_name'), 
					'url' => $this->input->post('url'), 
					'web_id' => $this->input->post('web_name'), 
				); 
             $return = $this->product_model->update_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
       $data['web'] = $this->product_model->get_all_tax();
        $data['product'] = $this->product_model->get_all_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/product_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
    public function merchant_product_list() {
    	
	$data['product'] = $this->product_model->get_all_merchant_product();
	
	//load the view
      $data['main_content'] = 'admin/merchant_product_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
    public function merchant_product_update(){
	//product id 
        $id = $this->uri->segment(4);
   /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('p_name', 'title', 'required|trim|min_length[4]');
		   if($this->input->post('sku') != $this->input->post('sku_old')) {
				$is_unique_sku =  '|is_unique[admin_product.sku]';
			} else { $is_unique_sku =  '';	}
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim'.$is_unique_sku);
			$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			//$this->form_validation->set_rules('t_class', 't_class', 'required|trim'); 
			$this->form_validation->set_rules('model', 'model', 'trim');
			$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			//$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('p_discription', 'discription', 'required');
			$this->form_validation->set_rules('p_price', 'Price', 'required');
			$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		 // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='../merchants/images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('../merchants/images/product/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
				$imagesList = $this->input->post('images_old');
				if(empty($imagesList)) {    $imagesArray = array(); }
                else { $imagesArray = $this->input->post('images_old'); }
				
				 if(!empty($_FILES['p_image']['name'])){
            $filesCount = count($_FILES['p_image']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['p_image']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['p_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['p_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['p_image']['size'][$i];
				
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
   		    $this->load->library('upload', $config);
				if ($this->upload->do_upload('userFile')) { 
                     $image_data = $this->upload->data();
					 $imagesArray[] = $image_data['file_name'];
				} else { $errors = $this->upload->display_errors();  }
			}
				 }
			        //----- end file upload -----------
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
				$imagesValue = json_encode($imagesArray);
			        //----- end file upload -----------
					
					$string = str_replace(' ', '-', $this->input->post('p_name'));
					$productURL = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
					$productURL = strtolower($productURL.'-'.$id);
		
                $data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_discription'),
					's_discription' => $this->input->post('s_discription'), 
					'weight' => $this->input->post('weight'),
					'sku' => $this->input->post('sku'),
					't_class' => $this->input->post('t_class'),
					'm_name' => $this->input->post('m_name'),
					'visibility' => $this->input->post('visibility'),
					'b_code' => $this->input->post('b_code'),
					'color' => $this->input->post('color'),
					'model' => $this->input->post('model'),
					'images' => $imagesValue,
					'image' => $image,
					'attribute' => $attributeValue,
					'price' => $this->input->post('p_price'),
					'cost' => $this->input->post('cost'),
					'p_qty' => $this->input->post('p_qty'),
					
					'category' => $this->input->post('category'),
					'p_id' => $productURL
				); 
             $return = $this->product_model->update_merchant_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/m_product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
        }/*validation run*/

        }
    //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        $data['product'] = $this->product_model->get_all_merchant_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/merchant_product_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
   
  
    public function remove_img (){
	  $img = $_POST['img'];
	  if($img !=''){
		  unlink('images/product/'.$img);
	  }
  }
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->product_model->delete_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/product');
 }  
 
  public function merchant_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->product_model->delete_merchant_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/m_product');
 }  
}
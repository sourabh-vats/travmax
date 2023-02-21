<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $this->load->model('product_model');	
        $this->load->model('customer_model');	
         $this->load->library('cart');
    }
	
	public function index()
	{
        redirect(base_url());
	}
	public function bliss_product_list(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'bliss_products';
                $data['page_title'] = 'Bliss products'; 
		$data['products'] = $this->product_model->get_bliss_product_list();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'bliss_products';
        $this->load->view('includes/front/front_template', $data); 
	}

	public function stores(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'stores';
                $data['page_title'] = 'Stores'; 
		$data['products'] = $this->product_model->get_stores_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'stores';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function deals_king(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'deals_king';
                $data['page_title'] = 'Deals King'; 
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'deals_king';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function new_arrivals(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'new-arrivals';
                $data['page_title'] = 'New Aarrivals'; 
		$data['products'] = $this->product_model->get_new_arrivals_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'new_arrivals';
        $this->load->view('includes/front/front_template', $data); 
	}
	public function search(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = '';
                $data['page_title'] = 'Search'; 

       $keyword = '';
       $city = '';
       $place = '';
       if ($this->input->server('REQUEST_METHOD') === 'POST'){ $keyword = $this->input->post('search'); $city = $this->input->post('city'); $place = $this->input->post('place'); }

		$data['products'] = $this->product_model->get_new_arrivals_product($keyword);
		//echo '<pre>'; print_r($data['products']); echo '</pre>';
		$data['webstore'] = $this->product_model->get_new_webstore($keyword);
		$data['merchant'] = $this->product_model->get_new_merchant($keyword,$city,$place);
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'search';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	
	public function bliss_product()
	{
		$productURL = $this->uri->segment(2);
		$data['products'] = '';
        $product = $this->product_model->get_product_by_url($productURL);
        if(!empty($product)) {  
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = $product[0]['p_id'];
                $data['page_title'] = $product[0]['pname']; 
                $data['products'] = $product;
         } else { 
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'not-found';
                $data['page_title'] = 'Not Found'; 
		 }		
if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('id', 'id', 'required|trim');
            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');
            $this->form_validation->set_rules('name', 'name', 'required|trim');
		//$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {    
			$price = $this->input->post('qty') * $product[0]['p_d_price'];
			$image = $this->input->post('image');
			$desc = $product[0]['s_discription'];
            $insert_data = array(
               'id' => $this->input->post('id'),
               'name' => substr($this->input->post('name'),10),
               'p_name' => $this->input->post('name'),
               'price' => $product[0]['p_d_price'],
               'qty' => $this->input->post('qty'), 
	       'comm_dis' => $product[0]['comm_dis'],
               'i_total' => $price, 
	       'options' => array('image' => $image, 'desc' => $desc)
             );
			  // This function add items into cart.
              $this->cart->insert($insert_data);
			  //redirect(base_url().'cart');
			  redirect(current_url());
			}  
		 }
 		 		 		 
		 
		   $id=explode("-",$product[0]['p_id']);
            $data['products'] = $this->product_model->get_product_by_url($product[0]['p_id']);
            //$data['review'] = $this->product_model->get_product_review(end($id));
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'product';
            $this->load->view('includes/front/front_template', $data); 

	}
}

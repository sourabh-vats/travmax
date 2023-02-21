<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		 $this->load->model('product_model');
        $this->load->model('merchant_model');
		$this->load->model('customer_model');
        $this->load->library('cart');			
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'merchant_page';
                $data['page_title'] = 'Wishzon Merchant';
				
				
				
				
				
				if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
			$productURL = $this->input->post('id');
        $product = $this->product_model->get_product_by_url($productURL);
			
			
            //form validation
            $this->form_validation->set_rules('id', 'id', 'required|trim');
            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');
            $this->form_validation->set_rules('name', 'name', 'required|trim');
		//$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

			
		    if($product[0]['p_d_price'] > 0) { $price = $product[0]['p_d_price']; }
			else { $price = $product[0]['price']; }
			
			$product_name = str_replace('/','',substr($this->input->post('name'),0,10));
			
			$tprice = $this->input->post('qty') * $price;
			$image = $this->input->post('image');
			$desc = $product[0]['s_discription'];
			
            $insert_data = array(
               'id' => $product[0]['id'],
                'tax' => $this->input->post('tax'),
               'name' => $product_name,
               'p_name' => $product[0]['pname'],
               'price' => $price,
               'qty' => $this->input->post('qty'), 
	       'comm_dis' => $product[0]['comm_dis'],
	       'del_chrg' => $product[0]['delivery_charge'],
	       'mid' => $product[0]['mid'],
               'i_total' => $tprice, 
	       'options' => array('image' => $image, 'desc' => $desc)
             );
			  // This function add items into cart.
              $this->cart->insert($insert_data); 
			  if($this->input->post('buynow')=='buynow'){
			  redirect(base_url().'cart');
			  }else{
			  redirect(current_url());
			  }
			}  
		 }
 		
			
		
		$merchant_id = $this->uri->segment(2);
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['review'] = $this->merchant_model->get_merchant_review($merchant_id);
		$data['merchant'] = $this->merchant_model->merchant_data($merchant_id);
		$data['products'] = $this->merchant_model->get_products($merchant_id);
		$data['p_cat'] = $this->merchant_model->get_products_cat($merchant_id);
		$data['similar'] = $this->merchant_model->get_similar_merchant($data['merchant'][0]['business_type']);
	    $data['main_content'] = 'merchant_page'; 
        $this->load->view('includes/front/front_template', $data); 
	}

}

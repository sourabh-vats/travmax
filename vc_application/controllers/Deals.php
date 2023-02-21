<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->model('product_model');	
        $this->load->model('customer_model');	
        //$this->load->library('cart');
    }
	
	public function index() {
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'deals';
                $data['page_title'] = 'Deals King'; 
		  $data['deals'] = $this->product_model->get_deals_list();
		  $data['b_d_coupon'] = $this->product_model->get_stores_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'deals';
        $this->load->view('includes/front/front_template', $data); 
	} 	
	
	public function best_cashback_offer() {		    
    $data['page_keywords'] = '';           
	$data['page_description'] = '';          
	$data['page_slug'] = 'best cashback offer';           
	$data['page_title'] = 'best_cashback_offer '; 		
	$data['b_c_Offers'] = $this->product_model->b_c_Offers();		
    $data['category_list'] = $this->customer_model->get_category_list();	
	$data['main_content'] = 'best_cashback_offer';     
	$this->load->view('includes/front/front_template', $data); 	}	
	
	public function best_deals_discount() {		

	$data['page_keywords'] = '';        
	$data['page_description'] = '';        
	$data['page_slug'] = 'best_deals_discount';          
	$data['page_title'] = 'best dealsmdiscount '; 	
	$data['b_d_discount'] = $this->product_model->best_deals_discount();		
    $data['category_list'] = $this->customer_model->get_category_list();	
	$data['main_content'] = 'best_deals_discount';    
    $this->load->view('includes/front/front_template', $data); 
 	}					
	
	public function best_discount_coupons() {		        
		$data['page_keywords'] = '';              
		$data['page_description'] = '';           
		$data['page_slug'] = 'best_discount_coupons';        
        $data['page_title'] = 'Best Discount Coupons'; 	
		$data['b_d_coupon'] = $this->product_model->b_d_coupon();	
	    $data['category_list'] = $this->customer_model->get_category_list();	
		$data['main_content'] = 'best_discount_coupons';    
		$this->load->view('includes/front/front_template', $data); 
	}	
	 
}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Uploadreceipts extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
	  public function index() {
		  echo "hello";
		  die();
   
  }


 
}
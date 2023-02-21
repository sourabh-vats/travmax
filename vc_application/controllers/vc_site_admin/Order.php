<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('order_model');
    $this->load->model('Users_model');

    if (!$this->session->userdata('is_customer_logged_in')) {
      redirect(base_url());
    }
  }

  public function index()
  {
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->Users_model->profile($id);

    $data['order'] = $this->order_model->get_all_order();

    //load the view
    $data['main_content'] = 'admin/order_list';
    $this->load->view('includes/admin/template', $data);
  }

  public function order_view()
  {
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->Users_model->profile($id);

    //order id 
    $id = $this->uri->segment(3);

    $data['order'] = $this->order_model->get_all_order_id($id);
    //load the view
    $data['main_content'] = 'admin/order_view';
    $this->load->view('includes/admin/template', $data);
  }

  public function activity_log()
  {
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->Users_model->profile($id);

    //order id 
    $id = $this->uri->segment(3);

    $data['order'] = $this->order_model->get_all_activity_log();



    //load the view
    $data['main_content'] = 'admin/activity_log';
    $this->load->view('includes/admin/template', $data);
  }

  public function add()
  {

    // $data['image_error'] = 'false';

    // $cimage = '';
    // if ($this->input->server('REQUEST_METHOD') === 'POST') {
    //   $iname = $this->input->post('iname');
    //   if (empty($iname)) {
    //     $this->form_validation->set_rules('reqfld', 'name', 'required');
    //     $this->form_validation->set_message('required', 'Please fill all name filed');
    //   }
    //   $price = $this->input->post('price');
    //   if (empty($price)) {
    //     $this->form_validation->set_rules('reqfld', 'price', 'required');
    //     $this->form_validation->set_message('required', 'Please fill all price filed');
    //   }
    //   $qty = $this->input->post('qty');
    //   if (empty($qty)) {
    //     $this->form_validation->set_rules('reqfld', 'qty', 'required');
    //     $this->form_validation->set_message('required', 'Please fill all qty filed');
    //   }

    //   $userid = $this->input->post('userid');
    //   $customer_info = $this->order_model->get_customer_cid($userid);
    //   if (empty($customer_info)) {
    //     $this->form_validation->set_rules('reqfld', 'userid', 'required');
    //     $this->form_validation->set_message('required', 'This customer id is not exist.');
    //   }

    //   $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
    //   //if the form has passed through the validation
    //   if ($this->form_validation->run()) {
    //     $total_price = 0;
    //     foreach ($price as $p) {
    //       if (is_numeric($p)) {
    //         $total_price = $total_price + $p;
    //       }
    //     }
    //     $all_name = implode('~-~', $iname);
    //     $all_price = implode('~-~', $price);
    //     $all_qty = implode('~-~', $qty);

    //     $items = $all_name . '~~--~~' . $all_price . '~~--~~' . $all_qty;

    //     $data_to_store = array(
    //       'user_id' => $customer_info[0]['id'],
    //       'p_name' => $customer_info[0]['f_name'] . ' ' . $customer_info[0]['l_name'],
    //       'items' => $items,
    //       'status' => 'Pending',
    //       'total_amount' => $total_price
    //     );
    //     //if the insert has returned true then we show the flash message
    //     if ($this->order_model->store_order($data_to_store) == TRUE) {
    //       $this->session->set_flashdata('flash_message', 'updated');
    //       redirect('admin/order/add');
    //     } else {
    //       $this->session->set_flashdata('flash_message', 'not_updated');
    //     }
    //   } //validation run

    //}


    //if we are updating, and the data did not pass trough the validation
    //the code below wel reload the current data

    //load the view
      echo "hi there";
    // $data['main_content'] = 'admin/order_addnew';
    // $this->load->view('includes/admin/template', $data);
  }
}

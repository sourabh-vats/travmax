<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('customer_model');

        if (!$this->session->userdata('is_admin_logged_in')) {
            redirect('admin');
        }
    }

    public function index()
    {
        $data['title'] = 'Partners';
        $data['customer'] = $this->customer_model->get_all_customer();

        //load the view
        $data['main_content'] = 'admin/customer_list';
        $this->load->view('includes/admin/template', $data);
    }

    public function wallet_history()
    {

        $data['summary'] = $this->customer_model->get_all_wallet_transaction();
        $data['main_content'] = 'admin/wallet_history';
        $this->load->view('includes/admin/template', $data);
    }
    public function fund_request_list()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));
            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));
        } else {
            $sdate = date('Y-m-1 00:00:01');
            $edate = date('Y-m-t 23:59:59');
        }
        $data['customer'] = $this->customer_model->get_fund_request_by_date($sdate, $edate);
        //print_r($data['customer1']); die();


        //$data['customer'] = $this->customer_model->get_all_customer();

        //load the view
        $data['main_content'] = 'admin/fund_request_list';
        $this->load->view('includes/admin/template', $data);
    }

    public function fund_request_update()
    {

        $id = $this->uri->segment(4);
        $data['category'] = $this->customer_model->get_all_fund_request_id($id);
        //category id 


        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id == $this->input->post('cid')) {
            /*form validation*/
            // $this->form_validation->set_rules('c_name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('status', 'status', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                //----- end file upload -----------
                $data_to_store = array(

                    'status' => $this->input->post('status')
                );
                $return = $this->customer_model->update_fund_request($id, $data_to_store);
                $phone = $this->input->post('phone');
                $status = $this->input->post('status');
                $reply = $this->input->post('reply');


                if ($status == 'Completed' && $data['category'][0]['status'] != 'Completed') {
                    $this->customer_model->load_wallet($data['category'][0]['user_id'], $data['category'][0]['amount'], 'income_wallet');
                }

                if ($return == TRUE) {
                    if ($status != 'active') {
                        if ($status == 'rejected') {
                            $message = 'Rejected';
                        } elseif ($status == 'accepted') {
                            $message = 'Accepted';
                        } else {
                            $message = 'Activated';
                        }


                        /***************** SMS ******************/
                        $sms_msg = urlencode("Thank you for Requesting ! Your Request is " . $message . ":
User ID: " . $this->input->post('customer_id') . "
Tr. Pin: " . $this->input->post('tr_pin') . "\n
" . $reply . "
Thank you 
Team Divinoindia");
                        $smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-shiromani&password=" . $this->config->item('sms_pass') . "&type=0&dlr=1&destination=" . $phone . "&source=SHIROM&message=" . $sms_msg;
                        //file_get_contents($smstext);
                        /***************** SMS ******************/
                    }
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/fund_request/edit/' . $id . '');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data


        //load the view
        $data['main_content'] = 'admin/fund_request_update';
        $this->load->view('includes/admin/template', $data);
    }

    public function wallet_summery()
    {

        $data['summary'] = $this->customer_model->get_all_wallet_transaction();
        $data['main_content'] = 'admin/wallet_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function a_webstore()
    {

        $a_webstore = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_OfferFile&Method=findAll&limit=20');
        $data['store'] = json_decode($a_webstore, TRUE);
        //echo '<pre>'; print_r($data['store']); die();
        //load the view
        $data['main_content'] = 'admin/a_webstore';
        $this->load->view('includes/admin/template', $data);
    }

    public function activity_report()
    {

        $activity_reports = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_Report&Method=getStats&fields[]=Stat.date&fields[]=Offer.name&fields[]=Stat.clicks&fields[]=Stat.affiliate_info1&fields[]=Browser.display_name&filters[Stat.date][conditional]=GREATER_THAN_OR_EQUAL_TO&filters[Stat.date][values]=2021-02-10&totals=1');
        $data['report'] = json_decode($activity_reports, TRUE);
        //echo '<pre>'; print_r($data['report']); die();
        //load the view
        $data['main_content'] = 'admin/activity_report';
        $this->load->view('includes/admin/template', $data);
    }


    public function affiliate_scheduled()
    {

        $affiliate_scheduled = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_ScheduledOfferChange&Method=findSchedules&limit=100&page=1');
        $data['affiliate'] = json_decode($affiliate_scheduled, TRUE);
        //echo '<pre>'; print_r($data['affiliate']); die();
        //load the view
        $data['main_content'] = 'admin/affiliate_scheduled';
        $this->load->view('includes/admin/template', $data);
    }


    public function myoffers()
    {

        $myoffers = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_Offer&Method=findMyOffers');
        $data['offer'] = json_decode($myoffers, TRUE);
        //echo '<pre>'; print_r($data['offer']); die();
        //load the view
        $data['main_content'] = 'admin/myoffers';
        $this->load->view('includes/admin/template', $data);
    }



    public function micro()
    {

        $data['customer'] = $this->customer_model->get_all_customer('0');
        //echo '<pre>'; print_r($data['customer']); die();
        $data['title'] = 'Micro Partners';
        //load the view
        $data['main_content'] = 'admin/customer_list';
        $this->load->view('includes/admin/template', $data);
    }
    public function macro()
    {

        $data['customer'] = $this->customer_model->get_all_customer(33);
        $data['title'] = 'Macro Partners';
        //load the view
        $data['main_content'] = 'admin/customer_list';
        $this->load->view('includes/admin/template', $data);
    }
    public function mega()
    {

        $data['customer'] = $this->customer_model->get_all_customer(1);
        $data['title'] = 'mega Partners';
        //load the view
        $data['main_content'] = 'admin/customer_list';
        $this->load->view('includes/admin/template', $data);
    }

    /*   public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('c_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('c_discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/customer/';
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
                    'c_name' => $this->input->post('c_name'),
					'c_description' => $this->input->post('c_discription'),
					'image' => $image,
				); 
                //if the insert has returned true then we show the flash message
				if($this->customer_model->store_customer($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/customer/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/customer_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  */


    public function activity_log()
    {

        $data['activity_log'] = $this->customer_model->activity_log();

        //load the view
        $data['main_content'] = 'admin/activity_log';
        $this->load->view('includes/admin/template', $data);
    }


    public function activity_log_by_id()
    {
        $url = $this->uri->segment(3);
        $data['activity_log'] = $this->customer_model->activity_log_by_id($url);
        //load the view
        $data['main_content'] = 'admin/activity_log';
        $this->load->view('includes/admin/template', $data);
    }

    public function update()
    {


        //customer id 
        $id = $this->uri->segment(4);

        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id == $this->input->post('cid')) {
            /*form validation*/
            $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('status', 'status', 'required|trim');
            $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');
            $this->form_validation->set_rules('declare', 'terms & condition', 'required');

            $var_status = 'no';

            /* $applied_pan = $this->input->post('applied_pan');
		    if($applied_pan!='yes') {
             //$this->form_validation->set_rules('pancard', 'pan card', 'required|trim|min_length[6]');
			}
			$applied_aadhar = $this->input->post('applied_aadhar');
		    if($applied_aadhar!='yes') {
             $this->form_validation->set_rules('aadhar', 'aadhar card', 'required|trim|min_length[6]');
			}*/


            //$this->form_validation->set_rules('bank_name', 'bank name', 'required|trim');
            //$this->form_validation->set_rules('branch', 'branch', 'required|trim');
            //$this->form_validation->set_rules('account_name', 'account name', 'required');
            //$this->form_validation->set_rules('account_type', 'account type', 'required|trim');
            //$this->form_validation->set_rules('account_no', 'account no', 'required|trim');
            //$this->form_validation->set_rules('ifsc', 'ifsc', 'required'); 


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                // file upload start here
                $image = '';
                $config['upload_path'] = 'images/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_width']  = '1024';
                $config['max_height']  = '1024';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    if ($this->input->post('image_old') != '') unlink('images/user/' . $this->input->post('image_old'));
                    $image_data = $this->upload->data();
                    $image = $image_data['file_name'];
                    $var_status = $this->input->post('var_status');
                } else {
                    $image = $this->input->post('image_old');
                }

                $panimage = '';
                $config['upload_path'] = 'images/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_width']  = '1024';
                $config['max_height']  = '1024';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('panimage')) {
                    if ($this->input->post('panimage_old') != '') unlink('images/user/' . $this->input->post('panimage_old'));
                    $image_data = $this->upload->data();
                    $panimage = $image_data['file_name'];
                } else {
                    $panimage = $this->input->post('panimage_old');
                }

                $aadharimage = '';
                $config['upload_path'] = 'images/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_width']  = '1024';
                $config['max_height']  = '1024';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('aadharimage')) {
                    if ($this->input->post('aadharimage_old') != '') unlink('images/user/' . $this->input->post('aadharimage_old'));
                    $image_data = $this->upload->data();
                    $aadharimage = $image_data['file_name'];
                } else {
                    $aadharimage = $this->input->post('aadharimage_old');
                }

                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'email' => $this->input->post('email'),
                    'gender' => $this->input->post('gender'),
                    'image' => $image,
                    //'gender' => $this->input->post('gender'), 
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'pincode' => $this->input->post('pincode'),
                    'pancard' => $this->input->post('pancard'),
                    'applied_pan' => $applied_pan,
                    'panimage' => $panimage,
                    'aadhar' => $this->input->post('aadhar'),
                    'applied_aadhar' => $applied_aadhar,
                    'aadharimage' => $aadharimage,
                    'bank_name' => $this->input->post('bank_name'),
                    'branch' => $this->input->post('branch'),
                    'account_name' => $this->input->post('account_name'),
                    'account_type' => $this->input->post('account_type'),
                    'account_no' => $this->input->post('account_no'),
                    'bank_city' => $this->input->post('bank_city'),
                    'bank_state' => $this->input->post('bank_state'),
                    'ifsc' => $this->input->post('ifsc'),
                    'franchisee' => $this->input->post('franchisee'),

                    'status' => $this->input->post('status'),
                    'var_status' => $var_status
                );

                //print_r($data_to_store);
                $return = $this->customer_model->update_customer($id, $data_to_store);

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/customer/edit/' . $id . '');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data


        $data['customer'] = $this->customer_model->get_all_customer_id($id);
        $data['parentid'] = $this->customer_model->parent_profile($data['customer'][0]['parent_customer_id']);
        //load the view
        $data['main_content'] = 'admin/customer_update';
        //$data['main_content'] = 'admin/personal-details'; 
        $this->load->view('includes/admin/template', $data);
    }


    public function purchase_master()
    {

        $data['orders_num'] = $this->customer_model->get_all_manual_num('orders');
        $data['orders_sum'] = $this->customer_model->get_all_manual_sum('orders', 'total_amount');
        $data['online_num'] = $this->customer_model->get_all_manual_num('upload_receipt');
        $data['online_sum'] = $this->customer_model->get_all_manual_sum('upload_receipt', 'amount');
        $data['macro_num'] = $this->customer_model->get_all_manual_num('transaction_wallet');
        $data['macro_sum'] = $this->customer_model->get_all_manual_sum('transaction_wallet', 'amount', array('type' => 'Activate Account'));
        $data['online_purchase'] = $this->customer_model->getall_receipt_order();
        $data['macro_purchase'] = $this->customer_model->getall_macro_purchases();

        $data['total_purchase'] = array_merge($data['online_purchase'], $data['macro_purchase']);
        $sort['rdate'] = array_column($data['total_purchase'], 'rdate');
        array_multisort($sort['rdate'], SORT_ASC, $data['total_purchase']);
        //echo '<pre>'; print_r($data['total_purchase']); die();


        $data['purchases'] = $this->customer_model->get_all_user_purchases();
        //load the view
        $data['main_content'] = 'admin/purchase_master';
        $this->load->view('includes/admin/template', $data);
    }
    public function online_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/online_purchase';
        $this->load->view('includes/admin/template', $data);
    }
    public function utility_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/utility_purchase';
        $this->load->view('includes/admin/template', $data);
    }
    public function services_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/services_purchase';
        $this->load->view('includes/admin/template', $data);
    }
    public function instore_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/instore_purchase';
        $this->load->view('includes/admin/template', $data);
    }
    public function macro_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/macro_purchase';
        $this->load->view('includes/admin/template', $data);
    }

    public function mega_purchase()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/mega_purchase';
        $this->load->view('includes/admin/template', $data);
    }

    public function online_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/online_commision';
        $this->load->view('includes/admin/template', $data);
    }


    public function utility_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/utility_commision';
        $this->load->view('includes/admin/template', $data);
    }
    public function service_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/service_commision';
        $this->load->view('includes/admin/template', $data);
    }
    public function instore_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/instore_commision';
        $this->load->view('includes/admin/template', $data);
    }


    public function macro_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/macro_commision';
        $this->load->view('includes/admin/template', $data);
    }

    public function mega_commision()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/mega_commision';
        $this->load->view('includes/admin/template', $data);
    }
    public function online_bills()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/online_bills';
        $this->load->view('includes/admin/template', $data);
    }

    public function company_friend_circle()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/company_friend_circle';
        $this->load->view('includes/admin/template', $data);
    }
    public function transaction_wise_commission()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/transaction_wise_commission';
        $this->load->view('includes/admin/template', $data);
    }
    public function support_master()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/support_master';
        $this->load->view('includes/admin/template', $data);
    }
    public function payout_report()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/payout_report';
        $this->load->view('includes/admin/template', $data);
    }
    public function Online_bills_api()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/Online_bills_api';
        $this->load->view('includes/admin/template', $data);
    }
    public function Online_bills_without_api()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/Online_bills_without_api';
        $this->load->view('includes/admin/template', $data);
    }

    public function product_master()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/product_master';
        $this->load->view('includes/admin/template', $data);
    }
    public function partners_master()
    {

        //$data['tax'] = $this->customer_model->get_all_card();
        //echo '<pre>'; print_r($data['micro_active_inactive']); die();
        $data['customers'] = $this->customer_model->get_all_customer_num();
        /*$data['macro'] = $this->customer_model->get_all_customer_num(33);
        $data['mega'] = $this->customer_model->get_all_customer_num(66);*/





        /* Micro online and offline purchase*/
        $data['micro_orders_num'] = $this->customer_model->get_all_manual_num('orders', array('role' => 'Micro'));
        $data['micro_orders_sum'] = $this->customer_model->get_all_manual_sum('orders', 'total_amount', array('role' => 'Micro'));
        $data['micro_online_num'] = $this->customer_model->get_all_manual_num('upload_receipt', array('role' => 'Micro'));
        $data['micro_online_sum'] = $this->customer_model->get_all_manual_sum('upload_receipt', 'amount', array('role' => 'Micro'));



        /* Macro online and offline purchase*/
        $data['macro_orders_num'] = $this->customer_model->get_all_manual_num('orders', array('role' => 'Macro'));
        $data['macro_orders_sum'] = $this->customer_model->get_all_manual_sum('orders', 'total_amount', array('role' => 'Macro'));
        $data['macro_online_num'] = $this->customer_model->get_all_manual_num('upload_receipt', array('role' => 'Macro'));
        $data['macro_online_sum'] = $this->customer_model->get_all_manual_sum('upload_receipt', 'amount', array('role' => 'Macro'));


        $data['macro_num'] = $this->customer_model->get_all_manual_num('transaction_wallet', array('type' => 'Activate Account'));
        $data['macro_sum'] = $this->customer_model->get_all_manual_sum('transaction_wallet', 'amount', array('type' => 'Activate Account'));



        $data['online_commission'] = $this->customer_model->get_all_manual_sum('upload_receipt', 'commission');

        $data['micro_incomes'] = $this->customer_model->get_all_incomes('Micro');
        $data['macro_incomes'] = $this->customer_model->get_all_incomes('Macro');
        //load the view
        $data['main_content'] = 'admin/partners_master';
        $this->load->view('includes/admin/template', $data);
    }
    public function TDS_Report()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/TDS_Report';
        $this->load->view('includes/admin/template', $data);
    }
    public function admin_charges_report()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/admin_charges_report';
        $this->load->view('includes/admin/template', $data);
    }
    public function direct_commission()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/direct_commission';
        $this->load->view('includes/admin/template', $data);
    }
    public function indirect_commission()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/indirect_commission';
        $this->load->view('includes/admin/template', $data);
    }
    public function replace_commission()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/replace_commission';
        $this->load->view('includes/admin/template', $data);
    }
    public function income_report()
    {

        $customer_id = '';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $sdate = date('Y-m-d 00:00:01', strtotime($this->input->post('sdate')));
            $edate = date('Y-m-d 23:59:59', strtotime($this->input->post('edate')));
            if ($this->input->post('customer_id') != '') {
                $customer_id = $this->input->post('customer_id');
            }
        } else {
            $sdate = date('Y-m-1 00:00:01');
            $edate = date('Y-m-t 23:59:59');
        }


        $url = $this->uri->segment(3);
        if ($url == 'Cashback') {
            $type = 'Cashback';
            $data['title'] = 'Cashback Report';
            $data['income'] = $this->customer_model->get_all_income_by_type($sdate, $edate, $type, $customer_id);
        } elseif ($url == 'MoneyBack') {
            $type = 'MoneyBack';
            $data['title'] = 'MoneyBack Report';
            $data['income'] = $this->customer_model->get_all_income_by_type($sdate, $edate, $type, $customer_id);
        } else {
            $data['income'] = $this->customer_model->get_all_income_by_type($sdate, $edate, '', $customer_id);
        }



        //load the view
        $data['main_content'] = 'admin/commission_report';
        $this->load->view('includes/admin/template', $data);
    }
    public function upgrade_mamber_commission()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/upgrade_mamber_commission';
        $this->load->view('includes/admin/template', $data);
    }
    public function commission_distribusion()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/commission_distribusion';
        $this->load->view('includes/admin/template', $data);
    }

    public function company_friend_circlee()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/company_friend_circlee';
        $this->load->view('includes/admin/template', $data);
    }
    public function friends_in_ciecle()
    {

        //$data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/friends_in_ciecle';
        $this->load->view('includes/admin/template', $data);
    }
    public function total_partners()
    {

        $id = $this->uri->segment(4);
        $data['profile'] = $this->customer_model->get_all_customer_id($id);
        $data['myfriends'] = array();
        $dis_level = 1;
        $team = array();
        $income_array = array();
        $ids = array($data['profile'][0]['customer_id']);
        $inc_ids = array($data['profile'][0]['id']);
        $p = 0;
        while ($p < 1) {
            $myfriends = $this->customer_model->my_friends_in_with_purchase($ids);
            $incomes = $this->customer_model->get_user_total_income_type($inc_ids);
            if (!empty($myfriends)) {
                $team[$dis_level] = $myfriends;
                $income_array[$dis_level]['MoneyBack'] = 0.00;
                $income_array[$dis_level]['Income'] = 0.00;
                if (!empty($incomes)) {
                    foreach ($incomes as $value) {

                        if ($value['type'] == 'MoneyBack') {
                            $income_array[$dis_level]['MoneyBack'] = $value['tamount'];
                        }
                        if ($value['type'] == 'Income') {
                            $income_array[$dis_level]['Income'] = $value['tamount'];
                        }
                    }
                }


                $dis_level++;
                $ids = array_column($myfriends, 'customer_id');
                $inc_ids = array_column($myfriends, 'id');
            } else {
                $p++;
            }
        }
        $data['total_partner'] = $team;
        $data['income_array'] = $income_array;


        //die();
        /* $left_count = array_column($team, 'macro');
        $team_consume = array_column($team, 'consume');
        $data['macro_partner'] = array_count_values($left_count);
        $data['team_consume'] = array_count_values($team_consume);
        $data['incomes'] = $this->customer_model->total_incomes($id);*/

        //  echo '<pre>'; print_r($income_array); die();
        //load the view
        $data['main_content'] = 'admin/total_partners';
        $this->load->view('includes/admin/template', $data);
    }
    public function total_purchase()
    {

        $id = $this->uri->segment(4);
        $data['tax'] = $this->customer_model->get_all_card();
        $data['profile'] = $this->customer_model->get_all_customer_id($id);

        $data['purchases'] = $this->customer_model->get_all_purchases_with_detail($id);
        //echo '<pre>'; print_r($data['purchases']); echo '</pre>';
        //$data['purchases'] = $this->customer_model->get_all_user_purchases($id);
        //load the view
        $data['main_content'] = 'admin/total_purchase';
        $this->load->view('includes/admin/template', $data);
    }



    public function info()
    {


        $id = $this->uri->segment(4);
        $data['tax'] = $this->customer_model->get_all_card();
        $data['profile'] = $this->customer_model->get_all_customer_id($id);
        $data['myfriends'] = array();
        $data['direct'] = array();
        $dis_level = 1;
        $team = array();
        $ids = array($data['profile'][0]['customer_id']);
        $p = 0;
        while ($p < 1) {
            $myfriends = $this->customer_model->my_friends_in($ids);
            if (!empty($myfriends)) {
                $team[$dis_level] = $myfriends;
                if ($dis_level == 1) {
                    $data['direct'] = $myfriends;
                }
                $ids = array_column($myfriends, 'customer_id');
                $dis_level++;
            } else {
                $p++;
            }
        }
        $data['myfriends'] = $team;

        $data['total_partner'] = $team;
        $left_count = array_column($team, 'macro');
        $team_consume = array_column($team, 'consume');
        $data['macro_partner'] = array_count_values($left_count);
        $data['team_consume'] = array_count_values($team_consume);
        $data['incomes'] = $this->customer_model->total_incomes($id);
        $data['online_purchase'] = $this->customer_model->get_user_upload_receipt($data['profile'][0]['customer_id']);
        $data['macro_purchase'] = $this->customer_model->getall_macro_purchases_by_id($data['profile'][0]['id']);
        $data['activity_log'] = $this->customer_model->get_all_activity_log($data['profile'][0]['customer_id']);

        $data['purchases'] = $this->customer_model->get_all_purchases_by_user($data['profile'][0]['id']);
        //load the view
        $data['main_content'] = 'admin/user_profile';
        $this->load->view('includes/admin/template', $data);
    }







    public function card_request_list()
    {

        $data['tax'] = $this->customer_model->get_all_card();

        //load the view
        $data['main_content'] = 'admin/card_request_list';
        $this->load->view('includes/admin/template', $data);
    }


    public function card_request_update()
    {

        $id = $this->uri->segment(4);
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id == $this->input->post('cid')) {
            /*form validation*/
            $this->form_validation->set_rules('status', 'status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'status' => $this->input->post('status')
                );

                $return = $this->customer_model->update_card($id, $data_to_store);
                if ($this->input->post('status') == 'approved') {
                    $cus_status = array('status' => 'active');
                    $this->customer_model->update_customer($this->input->post('user_id'), $cus_status);
                } else {
                    $cus_status = array('status' => 'deactive');
                    $this->customer_model->update_customer($this->input->post('user_id'), $cus_status);
                }
                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/card_request/edit/' . $id . '');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['tax'] = $this->customer_model->get_all_card_id($id);
        //load the view
        $data['main_content'] = 'admin/card_request_update';
        $this->load->view('includes/admin/template', $data);
    }

    public function card_request_del()
    {

        $id = $this->uri->segment(4);
        $return = $this->customer_model->delete_card($id);
        $this->session->set_flashdata('delete', 'true');
        redirect(base_url() . 'admin/card_request_list');
    }



    public function wallet()
    {
        if (!$this->session->userdata('is_admin_logged_in')) {
            redirect('admin');
        }
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            /*form validation*/


            $this->form_validation->set_rules('amount', 'Amount', 'required|trim');
            $chkid = $this->customer_model->checkuserid($this->input->post('bsacode'));
            if (count($chkid) == 0) {
                $this->form_validation->set_rules('hghff', 'User Id', 'required|trim');
                $this->form_validation->set_message('required', 'User Id not valid ');
            }


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                //$type = $this->input->post('type');
                $type = 'income_wallet';
                $data_to_store = array(
                    $type => $chkid[0][$type] + $this->input->post('amount'),
                );

                $return = $this->customer_model->wallet_update_customer($this->input->post('bsacode'), $data_to_store);
                $transactional = array(
                    'userid' => $chkid[0]['id'],
                    'send_to' => 0,
                    'credit' => $this->input->post('amount'),
                    'type' => 'Wallet Update',
                    'amount' => $this->input->post('amount'),
                    'tamount' => $this->input->post('amount'),
                    'status' => 'Credit'
                );
                $this->customer_model->add_transactional_wallet($transactional);

                /*$data_to_store = array('user_id'=>$chkid[0]['id'],'amount'=>$this->input->post('amount'),'type'=>'Referral Income','status'=>'Active');
                $this->customer_model->insert_income($data_to_store);*/

                if ($return == TRUE) {

                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/wallet/add');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['main_content'] = 'admin/gvc_update';
        $this->load->view('includes/admin/template', $data);
    }




    public function del()
    {

        $id = $this->uri->segment(4);
        $return = $this->customer_model->delete_customer($id);
        $this->session->set_flashdata('delete', 'true');
        redirect(base_url() . 'admin/customer');
    }

    public function uploadreceipts()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Receipt list';
        $data['page_title'] = 'Receipt list';
        $id = $this->session->userdata('cust_id');
        //$data['profile'] = $this->Users_model->profile($id);

        $customer_id = $this->session->userdata('bliss_id');

        $data['all_receipt'] =     $this->customer_model->getall_receipt_order($customer_id);
        $data['main_content'] = 'admin/receipts_list';
        $this->load->view('includes/admin/template', $data);
    }

    public function uploadreceipts_del()
    {

        $id = $this->uri->segment(4);
        $return = $this->customer_model->delete_upload_receipt($id);
        $this->session->set_flashdata('delete', 'true');
        redirect(base_url() . 'admin/uploadreceipts');
    }


    public function uploadreceipts_update()
    {

        $id = $this->uri->segment(4);
        $data['getsingle_receipt'] = $this->customer_model->getsingle_receipt_order($id);
        //  echo '<pre>'; print_r($data['getsingle_receipt']); die();
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id == $this->input->post('cid')) {
            $this->form_validation->set_rules('websites', 'Website Name', 'trim|required');
            $this->form_validation->set_rules('p_name', 'Product Name', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('p_discription', 'Description', 'required');
            //echo '<pre>'; print_r($this->input->post()); die();

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                /*$image = 'noimg.jpg';
			     $config['upload_path'] ='../images/receipt/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
                else { $imagesArray = $this->input->post('images_old'); }*/


                $data_to_store = array(
                    'website' => $this->input->post('websites'),
                    'product' => $this->input->post('p_name'),
                    'amount' => $this->input->post('amount'),
                    'status' => $this->input->post('status'),
                    'commission' => $this->input->post('commission'),
                    //'cashback' => $this->input->post('cashback'),
                    'description' => $this->input->post('p_discription'),
                    //	'image' => $image,
                );
                $return = $this->customer_model->update_receipt($id, $data_to_store);

                $user = $this->customer_model->parent_profile($data['getsingle_receipt'][0]['customer_id']);
                $commission = $this->input->post('commission');

                if ($this->input->post('status') == 'Pending' && $this->input->post('commission') > 0) {
                    $data_to_store = array('user_id' => $user[0]['id'], 'amount' => (35 / 100) * $commission, 'user_send_by' => $user[0]['id'], 'type' => 'Cashback', 'pay_type' => 'Online', 'order_id' => $id, 'status' => 'Pending');
                    $this->customer_model->insert_income($data_to_store);

                    if ($user[0]['consume'] == 0) {
                        $data_to_store = array(
                            'consume' => 1
                        );
                        $this->customer_model->wallet_update_customer($user[0]['customer_id'], $data_to_store);
                    }



                    $parent_customer_id = $user[0]['parent_customer_id'];
                    $dis_level = 1;
                    $p = 0;
                    while ($p < 12) {
                        $parent_data = $this->customer_model->parent_profile($parent_customer_id);
                        if (!empty($parent_data)) {
                            if ($parent_data[0]['macro'] > 0) {
                                $data_to_store = array('user_id' => $parent_data[0]['id'], 'amount' => round((5 / 100) * $commission), 'user_send_by' => $user[0]['id'], 'dist_level' => $dis_level, 'order_id' => $id, 'type' => 'MoneyBack', 'pay_type' => 'Online', 'status' => 'Pending');
                                $this->customer_model->insert_income($data_to_store);
                                //$this->customer_model->load_wallet($parent_data[0]['id'],round((5/100)*$commission),'income_wallet');
                            }

                            $parent_customer_id = $parent_data[0]['parent_customer_id'];
                            $dis_level = $dis_level + 1;
                        } else {
                            $p = 50;
                        }
                    }
                } elseif ($this->input->post('status') == 'Approved' && $this->input->post('commission') > 0) {



                    /*if(!empty($user)) {
              $direct_data = $this->customer_model->parent_profile($user[0]['parent_customer_id']);


              if(!empty($direct_data)) {
                $data_to_store = array('user_id'=>$direct_data[0]['id'],'amount'=>$commission/10,'type'=>'Referral Income','status'=>'Active');
                $this->customer_model->insert_income($data_to_store);
              }
              $franchise_data = $this->customer_model->parent_profile($user[0]['Franchise_customer_id']);

              if(!empty($franchise_data)) {
                $data_to_store = array('user_id'=>$franchise_data[0]['id'],'amount'=>(15/100)*$commission,'type'=>'Referral Income','status'=>'Active');
                $this->customer_model->insert_income($data_to_store);
                $data_to_store = array(
              'bliss_amount'=>$user[0]['bliss_amount']+(15/100)*$commission
            );
            $this->customer_model->wallet_update_customer($user[0]['Franchise_customer_id'],$data_to_store);
              }


            }*/
                    /*$data_to_store = array(
              'bliss_amount'=>$user[0]['bliss_amount']+$commission
            );
            $this->customer_model->wallet_update_customer($user[0]['customer_id'],$data_to_store);*/
                    $this->customer_model->update_income($id, array('status' => 'Approved'));
                } elseif ($this->input->post('status') == 'Redeem' && $this->input->post('commission') > 0) {
                    if ($user[0]['macro'] > 0) {
                        $data_to_store1['eligibility'] = $user[0]['eligibility'] + ((111 / 100) * $this->input->post('amount'));
                        $this->customer_model->wallet_update_customer($user[0]['customer_id'], $data_to_store1);
                    }
                    $this->customer_model->load_wallet($user[0]['id'], (35 / 100) * $commission, 'cash_wallet');
                    $approved_income = $this->customer_model->get_all_approved_income($id);
                    if (!empty($approved_income)) {
                        foreach ($approved_income as $value) {
                            $this->customer_model->load_wallet($value['user_id'], $value['amount'], 'income_wallet');
                        }
                    }
                    $this->customer_model->update_income($id, array('status' => 'Redeem'));
                }
                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/uploadreceipts/edit/' . $id . '');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }
        $data['main_content'] = 'admin/update_receiptst';
        $this->load->view('includes/admin/template', $data);
    }

    public function update_user()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Update User';
        $data['page_title'] = 'Update User';

        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('find_customer') != '') {
            $this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
            $find_user = $this->input->post('assign_to');
            $find_user = trim($find_user);
            $data['user'] = $this->Users_model->get_customer_data_by_id($find_user);
            if (empty($data['user'])) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'This user is not exist');
            }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
            }
        } else if ($this->input->server('REQUEST_METHOD') === 'POST') {
            /*form validation*/
            $this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
            $this->form_validation->set_rules('product', 'Package', 'required');
            $customer_id = $this->input->post('assign_to');
            $user = $this->Users_model->get_customer_data_by_id($customer_id);
            if (empty($user)) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'This user is not exist');
            } else {
                $data['user'] = $user;
            }


            if ($user[0]['macro'] > 0) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Already Activated.');
            } elseif (6050 > $data['profile'][0]['income_wallet']) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Wallet Amount must be greater than Package Amount');
            }



            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $return = FALSE;
                $this->income = array();
                $this->matching_amount = array();
                $cust_id = $user[0]['id'];
                $customer_id = $user[0]['customer_id'];
                $order_id = 0;
                $distribution_amount = 5500;
                $p_amount = 6050;

                if ($customer_id != '' && $cust_id != '') {
                    $this->Users_model->update_wallet($id, $p_amount, 'income_wallet');

                    $date = date('Y-m-d H:i:s');

                    $data_to_store = array('role' => 'Macro', 'package_used' => $date, 'macro' => 33, 'consume' => 1, 'package_amt' => 55000);

                    $this->Users_model->update_profile($cust_id, $data_to_store);

                    $this->Users_model->update_manual('upload_receipt', array('customer_id' => $customer_id), array('role' => 'Macro'));

                    $this->Users_model->update_manual('orders', array('user_id' => $cust_id), array('role' => 'Macro'));

                    $this->Users_model->update_manual('incomes', array('user_id' => $cust_id), array('role' => 'Macro'));

                    $package_history = array('userid' => $id, 'activate_id' => $cust_id, 'type' => 'Activate Account', 'amount' => $p_amount, 'debit' => $p_amount, 'status' => 'Debit', 'rdate' => date('Y-m-d H:i:s'));
                    $insert_id = $this->Users_model->add_transactional_wallet($package_history);

                    $add_income = array('amount' => 1100, 'user_id' => $user[0]['did'], 'type' => 'Direct', 'user_send_by' => $cust_id, 'status' => 'Approved');

                    $this->Users_model->add_income($add_income);

                    $add_cashback = array('amount' => 100, 'user_id' => $cust_id, 'type' => 'Cash Back', 'user_send_by' => $cust_id, 'status' => 'Approved');

                    $this->Users_model->add_income($add_cashback);

                    $add_purchases = array('amount' => 5500, 'user_id' => $cust_id, 'type' => 'Pack', 'order_type' => 'Macro', 'order_id' => $insert_id, 'role' => 'Macro', 'status' => 'Active');

                    $this->Users_model->add_purchases($add_purchases);

                    if ($user[0]['ddirect'] == 5) {
                        $this->Users_model->load_wallet($user[0]['did'], 555000, 'eligibility');
                    }

                    $insdate = date('Y-m-d');

                    $add_salary = array('user_id' => $cust_id, 'amount' => 5500, 'description' => $insdate, 'order_id' => $order_id, 'pay_date' => $insdate, 'installment_no' => 0, 'status' => 'Paid');
                    $this->Users_model->add_installment($add_salary);

                    for ($i = 1; $i <= 9; $i++) {

                        $pay_date = date('Y-m-d', strtotime("+ 1 month", strtotime($insdate)));
                        $add_salary = array('user_id' => $cust_id, 'amount' => 5500, 'description' => $insdate, 'order_id' => $order_id, 'pay_date' => $pay_date, 'installment_no' => $i, 'status' => 'Active');
                        $this->Users_model->add_installment($add_salary);
                        $insdate = $pay_date;
                    }

                    $this->Users_model->load_wallet($cust_id, 111000, 'eligibility');

                    $dis_level = 1;
                    $p = 0;
                    $parent_customer_id = $user[0]['parent_customer_id'];
                    while ($p < 11) {
                        $parent_user = $this->Users_model->parent_profile($parent_customer_id);
                        if (!empty($parent_user)) {
                            $booster_time = date('Y-m-d', strtotime('+15 days', strtotime($parent_user[0]['package_used'])));

                            if ($dis_level == 1) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 2) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 3) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 4) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 5) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 6) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 7) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 8) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 9) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 10) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 11) {
                                $percent = 330;
                                $direct = 5;
                            }

                            if ($parent_user[0]['macro'] >= $direct) {
                                $add_income = array('amount' => $percent, 'user_id' => $parent_user[0]['id'], 'type' => 'Level Income', 'user_send_by' => $cust_id, 'dist_level' => $dis_level, 'description' => 'Macro', 'status' => 'Approved');

                                $this->Users_model->add_income($add_income);
                            }

                            $parent_customer_id = $parent_user[0]['parent_customer_id'];
                            $dis_level = $dis_level + 1;
                            $p++;
                        } else {
                            $p = 80;
                        }
                    }
                    $return = TRUE;
                }
                /**************** end payment distribution *******************/

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'activated');
                    redirect('admin/upgrade_user');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['main_content'] = 'admin/update_user';
        $this->load->view('includes/admin/template', $data);
    }

    public function upgrade_user()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['user'] = $data['pin'] = array();
        $amount = $this->input->post('amount');

        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('find_customer') != '') {
            $this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
            $find_user = $this->input->post('assign_to');
            $find_user = trim($find_user);
            $data['user'] = $this->Users_model->get_customer_data_by_id($find_user);
            if (empty($data['user'])) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'This user is not exist');
            }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
            }
        } else if ($this->input->server('REQUEST_METHOD') === 'POST') {
            /*form validation*/
            $this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
            $this->form_validation->set_rules('product', 'Package', 'required');
            $customer_id = $this->input->post('assign_to');
            $user = $this->Users_model->get_customer_data_by_id($customer_id);
            if (empty($user)) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'This user is not exist');
            } else {
                $data['user'] = $user;
            }


            if ($user[0]['macro'] > 0) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Already Activated.');
            } elseif (6050 > $data['profile'][0]['income_wallet']) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Wallet Amount must be greater than Package Amount');
            }



            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $return = FALSE;
                $this->income = array();
                $this->matching_amount = array();
                $cust_id = $user[0]['id'];
                $customer_id = $user[0]['customer_id'];
                $order_id = 0;
                $distribution_amount = 5500;
                $p_amount = 6050;

                if ($customer_id != '' && $cust_id != '') {
                    $this->Users_model->update_wallet($id, $p_amount, 'income_wallet');

                    $date = date('Y-m-d H:i:s');

                    $data_to_store = array('role' => 'Macro', 'package_used' => $date, 'macro' => 33, 'consume' => 1, 'package_amt' => 55000);

                    $this->Users_model->update_profile($cust_id, $data_to_store);

                    $this->Users_model->update_manual('upload_receipt', array('customer_id' => $customer_id), array('role' => 'Macro'));

                    $this->Users_model->update_manual('orders', array('user_id' => $cust_id), array('role' => 'Macro'));

                    $this->Users_model->update_manual('incomes', array('user_id' => $cust_id), array('role' => 'Macro'));

                    $package_history = array('userid' => $id, 'activate_id' => $cust_id, 'type' => 'Activate Account', 'amount' => $p_amount, 'debit' => $p_amount, 'status' => 'Debit', 'rdate' => date('Y-m-d H:i:s'));
                    $insert_id = $this->Users_model->add_transactional_wallet($package_history);

                    $add_income = array('amount' => 1100, 'user_id' => $user[0]['did'], 'type' => 'Direct', 'user_send_by' => $cust_id, 'status' => 'Approved');

                    $this->Users_model->add_income($add_income);

                    $add_cashback = array('amount' => 100, 'user_id' => $cust_id, 'type' => 'Cash Back', 'user_send_by' => $cust_id, 'status' => 'Approved');

                    $this->Users_model->add_income($add_cashback);

                    $add_purchases = array('amount' => 5500, 'user_id' => $cust_id, 'type' => 'Pack', 'order_type' => 'Macro', 'order_id' => $insert_id, 'role' => 'Macro', 'status' => 'Active');

                    $this->Users_model->add_purchases($add_purchases);

                    if ($user[0]['ddirect'] == 5) {
                        $this->Users_model->load_wallet($user[0]['did'], 555000, 'eligibility');
                    }

                    $insdate = date('Y-m-d');

                    $add_salary = array('user_id' => $cust_id, 'amount' => 5500, 'description' => $insdate, 'order_id' => $order_id, 'pay_date' => $insdate, 'installment_no' => 0, 'status' => 'Paid');
                    $this->Users_model->add_installment($add_salary);

                    for ($i = 1; $i <= 9; $i++) {

                        $pay_date = date('Y-m-d', strtotime("+ 1 month", strtotime($insdate)));
                        $add_salary = array('user_id' => $cust_id, 'amount' => 5500, 'description' => $insdate, 'order_id' => $order_id, 'pay_date' => $pay_date, 'installment_no' => $i, 'status' => 'Active');
                        $this->Users_model->add_installment($add_salary);
                        $insdate = $pay_date;
                    }

                    $this->Users_model->load_wallet($cust_id, 111000, 'eligibility');

                    $dis_level = 1;
                    $p = 0;
                    $parent_customer_id = $user[0]['parent_customer_id'];
                    while ($p < 11) {
                        $parent_user = $this->Users_model->parent_profile($parent_customer_id);
                        if (!empty($parent_user)) {
                            $booster_time = date('Y-m-d', strtotime('+15 days', strtotime($parent_user[0]['package_used'])));

                            if ($dis_level == 1) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 2) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 3) {
                                $percent = 1100;
                                $direct = 1;
                            }
                            if ($dis_level == 4) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 5) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 6) {
                                $percent = 550;
                                $direct = 3;
                            }
                            if ($dis_level == 7) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 8) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 9) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 10) {
                                $percent = 330;
                                $direct = 5;
                            }
                            if ($dis_level == 11) {
                                $percent = 330;
                                $direct = 5;
                            }

                            if ($parent_user[0]['macro'] >= $direct) {
                                $add_income = array('amount' => $percent, 'user_id' => $parent_user[0]['id'], 'type' => 'Level Income', 'user_send_by' => $cust_id, 'dist_level' => $dis_level, 'description' => 'Macro', 'status' => 'Approved');

                                $this->Users_model->add_income($add_income);
                            }

                            $parent_customer_id = $parent_user[0]['parent_customer_id'];
                            $dis_level = $dis_level + 1;
                            $p++;
                        } else {
                            $p = 80;
                        }
                    }
                    $return = TRUE;
                }
                /**************** end payment distribution *******************/

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'activated');
                    redirect('admin/upgrade_user');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        //load the view

        $data['main_content'] = 'admin/upgrade_user';
        $this->load->view('includes/admin/template', $data);
    }
}

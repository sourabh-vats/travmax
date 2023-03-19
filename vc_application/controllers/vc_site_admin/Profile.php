<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        if (!$this->session->userdata('is_customer_logged_in')) {
            redirect(base_url() . '');
        }
    }

    public function index()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Dashboard';
        $data['page_title'] = 'Dashboard';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['total_sales'] = $this->Users_model->get_total_sales($id);
        $data['total_income'] = (int)$this->Users_model->get_total_income($id);
        $data['pending_income'] = (int)$this->Users_model->get_pending_income($id);
        $data['approved_income'] = (int)$this->Users_model->get_approved_income($id);
        $data['redeemed_income'] = (int)$this->Users_model->get_redeemed_income($id);
        $data['amount_paid'] = (int)$this->Users_model->get_amount_paid($id);
        $data['amount_remaining'] = (int)$this->Users_model->get_amount_remaining($id);
        $data['installments_paid'] = (int)$this->Users_model->get_installments_paid($id);
        $data['installments_remaining'] = (int)$this->Users_model->get_installments_remaining($id);
        $data['installments_total'] = $data['installments_paid'] + $data['installments_remaining'];
        $data['has_package'] = false;
        $data['package_information'] = $this->Users_model->get_package($id);
        if (empty($data['package_information'])) {
            $data['has_package'] = false;
        } else {
            $data['has_package'] = true;
        }

        $team = array();
        $ids = array($customer_id);
        $p = 0;
        while ($p < 1) {
            $myfriends = $this->Users_model->my_friends_in($ids);
            if (!empty($myfriends)) {
                $team = array_merge($team, $myfriends);
                $ids = array_column($myfriends, 'customer_id');
            } else {
                $p++;
            }
        }
        $data['total_partner'] = $team;
        $data['total_partners'] = count($team);
        
        //calculate my sales
        $my_sales = 0;
        $team_sales = 0;
        for ($i=0; $i < count($team); $i++) {
            if ($team[$i]["parent_customer_id"] == $customer_id) {
                $number_of_installments_paid = (int)$this->Users_model->get_installments_paid($team[$i]["id"]);
                echo $number_of_installments_paid . " ";
                $my_sales++;
            }else{
                $number_of_installments_paid = (int)$this->Users_model->get_installments_paid($team[$i]["id"]);
                echo $number_of_installments_paid . " ";
                $team_sales++;
            }
        }
        die();
        $data["my_sales"] = $my_sales;

        $data["package_data"] = "";
        if ($data['has_package']) {
            $data["package_data"] = $this->Users_model->get_package_data($data['package_information'][0]['package_id']);
        } else {
            redirect(base_url() . 'admin/select_package');
        }

        $data['main_content'] = 'admin/home';
        $this->load->view('includes/admin/template', $data);


        $data['myfriends'] = array();


        //Calculate Total Team Members


        $left_count = array_column($team, 'macro');
        $team_consume = array_column($team, 'consume');
        $data['macro_partner'] = array_count_values($left_count);
        $data['team_consume'] = array_count_values($team_consume);
        $data['card_request'] = $this->Users_model->customer_card_request($id);
        $data['products'] = $this->Users_model->my_orders($id);
        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['online_purchase'] = $this->Users_model->redeem_online_purchase($customer_id);
        //$data['macro_purchase'] = $this->Users_model->redeem_macro_purchase($id);
        $data['online_purchase_num'] = $this->Users_model->select_manual_num('upload_receipt', array('customer_id' => $customer_id));
        $data['macro_purchase_num'] = $this->Users_model->select_manual_num('transaction_wallet', array('userid' => $id, 'type' => 'Activate Account'));
        $data['macro_purchase_sum'] = $this->Users_model->get_all_manual_sum('transaction_wallet', 'amount', array('userid' => $id, 'type' => 'Activate Account'));
        $data['online_purchase_sum'] = $this->Users_model->get_all_manual_sum('upload_receipt', 'amount', array('customer_id' => $customer_id));
        $data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
        $data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);
        $data['show_direct'] = $this->Users_model->show_incomes($id);
        $data['incomes'] = $this->Users_model->total_incomes($id);        //print_r($data['incomes']); die();
        $data['moneyback'] = $this->Users_model->get_first_moneyback($id);

        $data['purchases'] = $this->Users_model->get_all_purchases($id);
        $data['redeem_error'] = '';
        $data['shopping_voucher_modal'] = '';
        $data['invite_email'] = '';
        // $data['main_content'] = 'admin/admin_welcome';
        // $this->load->view('includes/admin/template', $data);
    }

    public function select_package()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Select Package';
        $data['page_title'] = 'Dashboard';
        $data['js'] = '/assets/js/select_package.js';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['has_package'] = false;
        $data['package_information'] = $this->Users_model->get_package($id);
        if (empty($data['package_information'])) {
            $data['has_package'] = false;
        } else {
            $data['has_package'] = true;
            redirect(base_url() . 'admin');
        }
        if ($this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == "POST") {
            $package_id = $this->input->post('package_id');
            $payment_type = $this->input->post('payment_type');
            $package_data = $this->Users_model->get_package_data($package_id);
            $package_amount = $package_data[0]['total'];
            $data_to_store = array(
                'user_id' => $id,
                'package_id' => $package_id,
                'payment_type' => $payment_type,
                'amount_remaining' => $package_amount
            );
            $return = $this->Users_model->add_user_package($data_to_store);

            $date = date('Y-m-d H:i:s');
            $data_to_store = array('role' => 'Macro', 'package_used' => $date, 'macro' => 33, 'consume' => 1, 'package_amt' => $package_amount);
            $this->Users_model->update_profile($id, $data_to_store);

            if ($payment_type == "traveasy_plan") {
                $intallment_amount_left = $package_amount;
                $installment_amount = 6600;
                $installment_number = 1;
                $insdate = date('Y-m-d');
                while ($intallment_amount_left > 0) {
                    $pay_date = date('Y-m-d', strtotime("+ 1 month", strtotime($insdate)));
                    $add_installment = array('user_id' => $id, 'amount' => $installment_amount, 'description' => $insdate, 'pay_date' => $pay_date, 'installment_no' => $installment_number, 'status' => 'Active');
                    $this->Users_model->add_installment($add_installment);
                    $insdate = $pay_date;
                    $intallment_amount_left -= 6600;
                    $installment_number += 1;
                    if ($intallment_amount_left > 6600) {
                        $installment_amount = 6600;
                    } else {
                        $installment_amount = $intallment_amount_left;
                    }
                }
            }
            if ($return == TRUE) {
                redirect(base_url() . 'admin/package_selected_successfully');
            } else {
                $this->session->set_flashdata('flash_message', 'not_updated');
            }
        }
        $data['all_packages'] = $this->Users_model->get_all_packages();

        $data['main_content'] = 'admin/select_package';
        $this->load->view('includes/admin/template', $data);
    }

    public function package_selected_successfully()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Select Package';
        $data['page_title'] = 'Dashboard';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['has_package'] = false;
        $data['package_information'] = $this->Users_model->get_package($id);
        if (empty($data['package_information'])) {
            $data['has_package'] = false;
            redirect(base_url() . 'admin/select_package');
        } else {
            $data['has_package'] = true;
            $package_id = $data['package_information'][0]['package_id'];
            $data['package_data'] = $this->Users_model->get_package_data($package_id);
            $data['payment_amount'] = $this->Users_model->get_payment_amount($id);;
        }

        $data['main_content'] = 'admin/package_selected_successfully';
        $this->load->view('includes/admin/template', $data);
    }

    public function request_fund()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');

        $data['image_error'] = 'false';

        $cimage = '';
        $neft = $this->input->post('neft');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $data['request_pin'] = $this->Users_model->get_neft($neft);

            $this->form_validation->set_rules('amount', 'amount', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                // file upload start here
                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_width']  = '1600';
                //$config['max_height']  = '1600';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $image_data = $this->upload->data();
                    $image = $image_data['file_name'];
                } else {
                    $errors = $this->upload->display_errors();
                    $image = '';
                }
                //----- end file upload -----------

                $data_to_store = array(
                    'user_id' => $id,
                    'amount' => $this->input->post('amount'),
                    'mode' => $this->input->post('mode'),
                    'subject' => $this->input->post('subject'),
                    // 'payment_no' => $this->input->post('payment_no'),
                    //  'bank_name' => $this->input->post('bank_name'),
                    'neft' => $this->input->post('neft'),
                    'description' => $this->input->post('description'),
                    'status' => 'Pending',
                    'image' => $image
                );

                //  $this->Users_model->insert_pin_request($data_to_store);

                if ($this->Users_model->insert_fund_request($data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/request-fund');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            } //validation run
        }

        if (!empty($_GET['type']) && $_GET['type'] == "installment") {
            $data['payment_amount'] = $this->Users_model->get_payment_amount($id);
        }

        $data['profile'] = $this->Users_model->profile($id);
        $data['main_content'] = 'admin/request_fund';
        $this->load->view('includes/admin/template', $data);
    }

    public function transfer_master()
    {


        if (!$this->session->userdata('is_customer_logged_in')) {
            redirect(base_url() . '');
        }

        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Master Wallet';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {



            $this->form_validation->set_rules('amount', 'amount', 'required');


            if ($this->input->post('amount') > $data['profile'][0]['money_wallet']) {
                $this->form_validation->set_rules('sd', 'Your Wallet have less Amount', 'required');
                $this->form_validation->set_message('required', 'Your Wallet have less Amount');
            } elseif ($this->input->post('amount') <= 0) {
                $this->form_validation->set_rules('sd', 'Your Wallet have less Amount', 'required');
                $this->form_validation->set_message('required', 'Amount must be greater than 0');
            }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            if ($this->form_validation->run()) {

                $amount =   $this->input->post('amount');
                //$total_ded = $amount-(10/100)*$amount;
                $total_ded = 0;
                $data_to_store = array(
                    'income_wallet' => $data['profile'][0]['income_wallet'] + $total_ded,
                    'money_wallet' => $data['profile'][0]['money_wallet'] - $amount,
                );


                $this->Users_model->update_profile($id, $data_to_store);
                $data_to_store = array(
                    'userid' => $id,
                    'send_to' => $customer_id,
                    'send_by' => $customer_id,
                    'type' => 'Transfered From MoneyBack Wallet',
                    'amount' => $amount,
                    'amount' => $amount,
                    'status' => 'Credit',
                    'wallet_type' => 'Activation Wallet',
                    'rdate' => date('Y-m-d H:i:s')
                );
                $this->Users_model->add_transactional_wallet($data_to_store);
                $this->session->set_flashdata('flash_message', 'updated');
                redirect(base_url() . 'admin/transfer_master');
            }
        }

        $data['main_content'] = 'admin/transfer_master';
        $this->load->view('includes/admin/template', $data);
    }

    public function working_wallet()
    {


        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Working Wallet';
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->sale_model->profile($id);
        $working_wallet = $this->sale_model->get_transactional_wallet($id);
        $wallet_summery = $this->sale_model->wallet_summery_history($id);
        $data['working_wallet'] = array_merge($working_wallet, $wallet_summery);
        $sort['rdate'] = array_column($data['working_wallet'], 'rdate');
        array_multisort($sort['rdate'], SORT_ASC, $data['working_wallet']);

        $data['main_content'] = 'admin/working_wallet';
        $this->load->view('includes/admin/template', $data);
    }

    public function wallet_history()
    {


        $cid = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($cid);
        $data['wallet_history'] = $this->Users_model->wallet_history($cid);
        $data['main_content'] = 'admin/wallet_history';
        $this->load->view('includes/admin/template', $data);
    }

    public function recharge()
    {

        $cid = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($cid);
        $data['history'] = $this->Users_model->recharge_history($cid);

        $this->load->model('customer_model');
        $data['operator'] = $this->customer_model->get_operator();
        $data['circle'] = $this->customer_model->get_list_circle();
        $data['operator_plan'] = $this->customer_model->get_operator_plan();
        //echo '<pre>'; print_r($data['operator_plan']); die();

        $all_operator = array();
        $oper_type = array();
        if (!empty($data['operator'])) {
            foreach ($data['operator'] as $value) {
                $all_operator[$value['Operator_Code']] = $value['oper_name'];
                $oper_type[$value['Operator_Code']] = $value['oper_type'];
            }
        }

        $data['msg'] = '';
        $return = 'Failure';
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('confirm') == 'Confirm') {


            $cust_id = $this->session->userdata('cust_id');
            $this->form_validation->set_rules('phone', 'phone', 'required|trim|numeric');
            $this->form_validation->set_rules('operator', 'operator', 'required|trim');
            $this->form_validation->set_rules('circle', 'circle', 'required|trim');
            $this->form_validation->set_rules('amount', 'amount', 'required|trim|numeric');

            $cust_info = $this->customer_model->get_customer_credit($cust_id);
            if (empty($cust_info)) {
                $this->form_validation->set_rules('customerror', 'login', 'required|trim');
                $this->form_validation->set_message('required', 'Please login first.');
            } else {
                /* if($cust_id !=1) {
                    $this->form_validation->set_rules('wedrftg', 'login', 'required');
                    $this->form_validation->set_message('required', 'You are not eligible for this transaction.');
                } */
                if ($this->input->post('paytype') == 'Wallet') {
                    if ($this->input->post('amount') > $cust_info[0]['income_wallet']) {
                        $this->form_validation->set_rules('dfdfgdfs', 'login', 'required|trim');
                        $this->form_validation->set_message('required', 'You can not use more than your recharge wallet.Please update your Recharge wallet.');
                    }
                    $howtopay = "wallet";
                }
            }

            $my_array1 = array('user_id' => $cust_id);

            //$this->form_validation->set_rules('customerror', 'pin', 'required|trim');
            //$this->form_validation->set_message('required', 'Recharge server is down right now please try after 1 hour.');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation


            if ($this->form_validation->run()) {
                //echo '<pre>'; print_r($this->input->post()); die();
                $data_to_store = array(
                    'amount' => $this->input->post('amount'),
                    'status' => 'Dr.',
                    'desc' => 'Amount Dr. for recharge on ' . $this->input->post('phone') . ' for ( ' . $all_operator[$this->input->post('operator')] . ' )',
                );
                $redeemid = $this->customer_model->add_redeem_bliss($data_to_store);

                if (is_numeric($redeemid)) {


                    $usertx = $redeemid;
                    $curl_handle = curl_init();
                    curl_setopt($curl_handle, CURLOPT_URL, 'https://myrc.in/recharge/api?username=502102&pwd=717880&circlecode=2&operatorcode=' . $this->input->post('operator') . '&number=' . $this->input->post('phone') . '&amount=' . $this->input->post('amount') . '&orderid=' . $usertx . '&format=json');

                    //curl_setopt($curl_handle, CURLOPT_URL,'https://mrobotics.in/api/recharge_get?api_token=cc7abe6a-4f28-45fc-920c-e01a92e5c15a&mobile_no='.$this->input->post('phone').'&amount='.$this->input->post('amount').'&company_id='.$this->input->post('operator').'&order_id='.$usertx.'&is_stv=false');

                    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
                    $query = curl_exec($curl_handle);
                    curl_close($curl_handle);

                    $api_result = json_decode($query, true);
                    /* echo '<pre>'; print_r($api_result);echo '</pre>';
                die(); */
                    if (array_key_exists('status', $api_result)) {
                        $data['message'] = $api_result['status'];
                        if ($api_result['status'] == 'Failure') {
                            $return = 'false';
                            if (array_key_exists('opid', $api_result)) {
                                /************ add in order *****************/
                                $recharge_msg = "Rs. " . $this->input->post('amount') . " recharge at " . $this->input->post('phone') . " this number. for  " . $all_operator[$this->input->post('operator')] . " ";

                                $data_to_add_order_arr = array('items' => 'recharge', 'p_name' => $cust_info[0]['f_name'] . ' ' . $cust_info[0]['l_name'], 'p_phone' => $cust_info[0]['phone'], 'p_address' => 'Failure', 'p_address2' => $api_result['opid'], 'spl_note' => $recharge_msg, 'total_amount' => $this->input->post('amount'), 'status' => 'Failed', 'comm_dis' => $this->input->post('operator_commision'));
                                $data_to_add_order = array_merge($data_to_add_order_arr, $my_array1);
                                $order_id = $this->customer_model->add_recharge_in_order($data_to_add_order);
                            }
                        } elseif ($api_result['status'] == 'Success' || $api_result['status'] == 'Pending') {
                            $return = 'true';
                            if ($api_result['status'] == 'Pending') {
                                $return = 'Pending';
                            }

                            //if($api_result['status']=='SUCCESS' && $api_result['Transid']!='' && $api_result['Transid']!='0') {
                            if ($api_result['orderid'] != '' && $api_result['orderid'] != '0') {
                                $tranref = $api_result['orderid'];
                            } else {
                                $tranref = $redeemid;
                            }

                            $url_status = 'http://myrc.in/recharge/status?username=502102&pwd=717880&orderid=' . $tranref . '&format=json';
                            // $url_status = 'https://mrobotics.in/api/order_id_status?api_token=cc7abe6a-4f28-45fc-920c-e01a92e5c15a&order_id='.$tranref.'';
                            $xml_status_content = file_get_contents($url_status);
                            //print_r($xml_status_content);
                            //die();
                            $xml_status_result = json_decode($xml_status_content, true);
                            if (empty($xml_status_result['status'])) {
                                $order_status = $api_result['status'];
                            } elseif ($xml_status_result['status'] == 'Success') {
                                $order_status = $api_result['status'];
                                $return = 'true';
                            } else {
                                $order_status = $xml_status_result['status'];
                            }

                            //$order_status = $api_result['status'];
                            //$this->customer_model->update_customer_bliss($cust_id,$this->input->post('amount'));

                            /************ add in order *****************/
                            $recharge_msg = "Rs. " . $this->input->post('amount') . " recharge at " . $this->input->post('phone') . " this number. for  " . $all_operator[$this->input->post('operator')] . " ";

                            $data_to_add_order_arr = array('items' => 'recharge', 'p_name' => $cust_info[0]['f_name'] . ' ' . $cust_info[0]['l_name'], 'p_phone' => $cust_info[0]['phone'], 'p_address' => $order_status, 'p_address2' => $tranref, 'spl_note' => $recharge_msg, 'total_amount' => $this->input->post('amount'), 'status' => 'Pending', 'comm_dis' => $this->input->post('operator_commision'), 'rec_type' => 'online', 'how_to_pay' => $howtopay);

                            $data_to_add_order = array_merge($data_to_add_order_arr, $my_array1);

                            //echo '<pre>'; print_r($data_to_add_order);echo '</pre>';

                            $order_id = $this->customer_model->add_recharge_in_order($data_to_add_order);

                            if ($this->input->post('paytype') == 'Credit') {
                                $this->customer_model->update_customer_credit_am($cust_id, $this->input->post('amount'));
                            } elseif ($this->input->post('paytype') == 'Wallet') {

                                $add_purchases = array('amount' => $this->input->post('amount'), 'user_id' => $cust_id, 'type' => 'Purchase', 'purchase_type' => '', 'order_type' => 'Utility', 'order_id' => $order_id, 'role' => $data['profile'][0]['role'], 'structure' => 'recharge_orders', 'status' => 'Active');
                                $this->Users_model->add_purchases($add_purchases);
                                $this->customer_model->update_customer_bliss($cust_id, $this->input->post('amount'));
                            }

                            if (is_numeric($order_id)) {
                                $data_to_update1 = array('order_id' => $order_id);
                                $data_to_update = array_merge($data_to_update1, $my_array1);
                                $this->customer_model->update_redeem_bliss($redeemid, $data_to_update);
                            }

                            if ($oper_type[$this->input->post('operator')] == 0) {
                                /**************** SMS *******************/
                                //$phone = '8528907107'; 
                                $phone = '8360307059';
                                if ($phone != '') {
                                    $sms_msg = urlencode("Received request of " . $this->input->post('optradio') . " recharge Rs." . $this->input->post('amount') . "  operator " . $all_operator[$this->input->post('operator')] . " on phone " . $this->input->post('phone') . ".\n
                Thank you
                Team payearn");

                                    $smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=" . $phone . "&message=" . $sms_msg . "&senderid=CANADA&accusage=1";
                                    //file_get_contents($smstext); 
                                }
                            }

                            /**************** SMS *******************/

                            $phone = $cust_info[0]['phone'];
                            if ($phone != '') {
                                $sms_msg = urlencode("Recharge of Rs." . $this->input->post('amount') . "  for (mobile or dth number) via payearn.com is being processed You will be notified by operator on registered phone number.\n
                Thank you
                Team payearn");
                                $smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=" . $phone . "&message=" . $sms_msg . "&senderid=CANADA&accusage=1";
                                //file_get_contents($smstext); 
                            }
                        } else {
                            $data['message'] = $api_result['errorMessage'];
                        }
                    }
                    $return = trim($return);
                    if ($return == 'true') {
                        $this->session->set_flashdata('recharge', 'updated');
                        $recharge = 'updated';
                    } elseif ($return == 'Pending') {
                        $this->session->set_flashdata('recharge', 'Pending');
                        $recharge = 'Pending';
                    } else {
                        $this->session->set_flashdata('recharge', 'Failure');
                        $recharge = 'Failure';
                    }
                    $this->session->set_userdata('recharge', $recharge);
                    $this->session->set_flashdata('recharge_msg', $data['message']);
                    //redirect(base_url('recharge'));   
                }  //validation run
            }
        }


        $data['main_content'] = 'admin/recharge';
        $this->load->view('includes/admin/template', $data);
    }

    public function add_money()
    {


        $cid = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($cid);

        $data['main_content'] = 'admin/add_money';
        $this->load->view('includes/admin/template', $data);
    }
    public function macro_credits()
    {


        $cid = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($cid);

        $data['main_content'] = 'admin/macro_credits';
        $this->load->view('includes/admin/template', $data);
    }
    public function my_wallet()
    {


        $cid = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($cid);

        $data['main_content'] = 'admin/my_wallet';
        $this->load->view('includes/admin/template', $data);
    }

    public function get_friend_by_id($customer_id)
    {
        $return = array('name' => '', 'friends' => '', 'return' => 'false');
        $myfriends = $this->Users_model->my_friends($customer_id);
        if (!empty($myfriends)) {
            foreach ($myfriends as $friend) {
                $inner_friends_array = $this->Users_model->my_friends($friend['customer_id']);
                $inner_friends = count($inner_friends_array);
                $return = array('name' => $friend['f_name'] . ' ' . $friend['l_name'], 'friends' => $inner_friends, 'return' => 'true');
            }
        }
        return $return;
    }

    public function profile()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');

        if ($this->input->server('REQUEST_METHOD')) {
            /*form validation*/
            $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('l_name', 'last name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');


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



                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'image' => $image,
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'pincode' => $this->input->post('pincode'),
                    'gender' => $this->input->post('gender')
                );
                $return = $this->Users_model->update_profile($id, $data_to_store);

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/profile');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['profile'] = $this->Users_model->profile($id);
        //load the view
        $data['main_content'] = 'admin/profile';
        $this->load->view('includes/admin/template', $data);
    }

    public function kyc()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');

        if ($this->input->server('REQUEST_METHOD')) {
            $this->form_validation->set_rules('bank_name', 'bank name', 'required|trim');
            //$this->form_validation->set_rules('branch', 'branch', 'required|trim');
            $this->form_validation->set_rules('account_name', 'account name', 'required');
            //$this->form_validation->set_rules('account_type', 'account type', 'required|trim');
            $this->form_validation->set_rules('account_no', 'account no', 'required|trim');
            $this->form_validation->set_rules('ifsc', 'ifsc', 'required');


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {


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




                $cheque_img = '';
                $config['upload_path'] = 'images/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_width']  = '1024';
                $config['max_height']  = '1024';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('cheque_img')) {
                    if ($this->input->post('cheque_img_old') != '') unlink('images/user/' . $this->input->post('cheque_img_old'));
                    $image_data = $this->upload->data();
                    $cheque_img = $image_data['file_name'];
                } else {
                    $cheque_img = $this->input->post('cheque_img_old');
                }

                $data_to_store = array(

                    'pancard' => $this->input->post('pancard'),
                    'applied_pan' => $applied_pan,
                    'panimage' => $panimage,
                    'aadhar' => $this->input->post('aadhar'),
                    'applied_aadhar' => $applied_aadhar,
                    'aadharimage' => $aadharimage,
                    'cheque_img' => $cheque_img,
                    'gender' => $this->input->post('gender'),
                    'bank_name' => $this->input->post('bank_name'),
                    //  'branch' => $this->input->post('branch'), 
                    'account_name' => $this->input->post('account_name'),
                    //  'account_type' => $this->input->post('account_type'),  
                    'account_no' => $this->input->post('account_no'),
                    //   'bank_city' => $this->input->post('bank_city'),
                    //  'bank_state' => $this->input->post('bank_state'), 
                    'ifsc' => $this->input->post('ifsc'),
                    'var_status' => $var_status
                );
                $return = $this->Users_model->update_profile($id, $data_to_store);

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/kyc');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['profile'] = $this->Users_model->profile($id);
        //load the view
        $data['main_content'] = 'admin/kyc';
        $this->load->view('includes/admin/template', $data);
    }

    public function profile_details()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');

        if ($this->input->server('REQUEST_METHOD')) {
            /*form validation*/
            $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('l_name', 'last name', 'required|trim|min_length[2]');
            $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');


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



                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'image' => $image,
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'pincode' => $this->input->post('pincode'),
                    'gender' => $this->input->post('gender')
                );
                $return = $this->Users_model->update_profile($id, $data_to_store);

                if ($return == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/profile');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        $data['profile'] = $this->Users_model->profile($id);
        //load the view
        $data['main_content'] = 'admin/profile_details';
        $this->load->view('includes/admin/template', $data);
    }

    public function uploadreceipts()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Receipt list';
        $data['page_title'] = 'Receipt list';
        $id = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($id);

        $customer_id = $this->session->userdata('bliss_id');


        $data['all_receipt'] =     $this->Users_model->get_receipt_order($customer_id);
        $data['main_content'] = 'admin/receipts_list';
        $this->load->view('includes/admin/template', $data);
    }

    public function addreceipts()
    {

        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Add Receipt';
        $data['page_title'] = 'Add Receipt';
        $id = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($id);
        $customer_id = $this->session->userdata('bliss_id');


        if ($this->input->server('REQUEST_METHOD')) {

            $this->form_validation->set_rules('websites', 'Website Name', 'trim|required');
            $this->form_validation->set_rules('p_name', 'Product Name', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('p_discription', 'Description', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            $image = '';
            $config['upload_path'] = 'images/receipt/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $image_data = $this->upload->data();
                $image = $image_data['file_name'];
            }

            if ($this->form_validation->run() == FALSE) {
            } else {


                $data_to_store = array(
                    'website' => $this->input->post('websites'),
                    'product' => $this->input->post('p_name'),
                    'amount' => $this->input->post('amount'),
                    'description' => $this->input->post('p_discription'),
                    'customer_id' => $customer_id,
                    'image' => $image
                );
                $insert_id = $this->Users_model->add_receipt($data_to_store);

                $add_purchases = array('amount' => $this->input->post('amount'), 'user_id' => $id, 'type' => 'Purchase', 'order_type' => 'Online', 'order_id' => $insert_id, 'role' => $data['profile'][0]['role'], 'status' => 'Pending');
                $this->Users_model->add_purchases($add_purchases);
                $this->session->set_flashdata('flash_message', 'updated');
                redirect('admin/uploadreceipts/add');
            }
        }

        $data['main_content'] = 'admin/add_receiptst';
        $this->load->view('includes/admin/template', $data);
    }


    public function activity_log()
    {
        $id = $this->session->userdata('cust_id');
        $data['profile'] = $this->Users_model->profile($id);
        $customer_id = $this->session->userdata('bliss_id');

        $data['activity_log'] = $this->Users_model->activity_log($customer_id);

        //load the view
        $data['main_content'] = 'admin/activity_log';
        $this->load->view('includes/admin/template', $data);
    }

    public function franchisee()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);


        $data['total_incomes'] = $this->Users_model->total_incomes($id);
        $data['location'] = $this->Users_model->get_referal_location($customer_id);
        $data['income_page'] = $this->Users_model->my_friends($customer_id);
        $data['city_customer'] = $this->Users_model->my_Franchise_customer_id($customer_id);

        //load the view
        $data['main_content'] = 'admin/franchisee';
        $this->load->view('includes/admin/template', $data);
    }
    public function product()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);


        $data['total_incomes'] = $this->Users_model->total_incomes($id);
        $data['location'] = $this->Users_model->get_referal_location($customer_id);
        $data['income_page'] = $this->Users_model->my_friends($customer_id);

        //load the view
        $data['main_content'] = 'admin/product';
        $this->load->view('includes/admin/template', $data);
    }

    public function show_income()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['show_income'] = $this->Users_model->show_incomes($id);
        $data['title'] = 'Income';
        $data['main_content'] = 'admin/show_income';
        $this->load->view('includes/admin/template', $data);
    }

    public function installments()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['pin'] = $this->Users_model->get_all_installment($id);

        $razorpay = 'false';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('amount', 'amount', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            if ($this->form_validation->run()) {

                if ($this->input->post('how_to_pay') == 'razorpay') {
                    $status = 'Process';
                } else {
                    $status = 'Pending';
                }
                $data_to_store = array(
                    'user_id' => $id,
                    'dis' => 'Installment amount',
                    'cr' => $this->input->post('amount'),
                    'qty' => 1,
                    'how_to_pay' => $this->input->post('how_to_pay'),
                    'status' => $status,
                );
                $order_id = $this->Users_model->add_order($data_to_store);

                $razorpay = 'true';
            }
        }
        if ($razorpay == 'true') {
            $data['order_id'] = $order_id;
            $data['order_amt'] = $this->input->post('amount');
            $data['oname'] = $data['profile'][0]['f_name'];
            $data['phone'] = $data['profile'][0]['phone'];
            $data['email'] = $data['profile'][0]['email'];
            $data['contst'] = 'Installment';
            $data['returnuri'] = 'admin/installments';
            $this->session->set_userdata('insid', '' . $this->input->post('id') . '');
            $data['main_content'] = 'admin/razorpay';
            $this->load->view('includes/admin/template', $data);
        } else {
            $data['main_content'] = 'admin/installment';
        }

        $this->load->view('includes/admin/template', $data);
    }
    public function income()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);

        $url = $this->uri->segment(3);
        if ($url == 'MoneyBack') {
            $data['title'] = 'MoneyBack';
            $data['show_income'] = $this->Users_model->get_income_by_type($id, 'MoneyBack');
        } elseif ($url == 'Cashback') {
            $data['title'] = 'Cashback';
            $data['show_income'] = $this->Users_model->get_income_by_type($id, 'Cashback');
        } else {
            $data['title'] = 'Income';
            $data['show_income'] = $this->Users_model->show_incomes($id);
        }

        $data['main_content'] = 'admin/show_income';
        $this->load->view('includes/admin/template', $data);
    }

    public function customer_directs()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['show_direct'] = $this->Users_model->show_directs($customer_id);
        $data['main_content'] = 'admin/show_directs';
        $this->load->view('includes/admin/template', $data);
    }

    public function member()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['show_direct'] = $this->Users_model->show_member($id);
        $data['main_content'] = 'admin/member';
        $this->load->view('includes/admin/template', $data);
    }

    public function member_view()
    {
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'profile';
        $data['page_title'] = 'Profile';



        $data['myfriends'] = array();
        $id = $this->uri->segment(3);
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);


        $team = array();
        $ids = array($customer_id);
        $p = 0;
        while ($p < 1) {
            $myfriends = $this->Users_model->my_friends_in($ids);
            if (!empty($myfriends)) {
                $team = array_merge($team, $myfriends);

                $ids = array_column($myfriends, 'customer_id');
            } else {
                $p++;
            }
        }
        $data['total_partner'] = $team;

        $left_count = array_column($team, 'macro');
        $team_consume = array_column($team, 'consume');
        $data['macro_partner'] = array_count_values($left_count);
        $data['team_consume'] = array_count_values($team_consume);
        $data['card_request'] = $this->Users_model->customer_card_request($id);
        $data['products'] = $this->Users_model->my_orders($id);
        $data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
        $data['online_purchase'] = $this->Users_model->redeem_online_purchase($customer_id);
        //$data['macro_purchase'] = $this->Users_model->redeem_macro_purchase($id);
        $data['online_purchase_num'] = $this->Users_model->select_manual_num('upload_receipt', array('customer_id' => $customer_id));
        $data['macro_purchase_num'] = $this->Users_model->select_manual_num('transaction_wallet', array('userid' => $id, 'type' => 'Activate Account'));
        $data['macro_purchase_sum'] = $this->Users_model->get_all_manual_sum('transaction_wallet', 'amount', array('userid' => $id, 'type' => 'Activate Account'));
        $data['online_purchase_sum'] = $this->Users_model->get_all_manual_sum('upload_receipt', 'amount', array('customer_id' => $customer_id));
        $data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
        $data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);
        $data['show_direct'] = $this->Users_model->show_incomes($id);
        $data['incomes'] = $this->Users_model->total_incomes($id);        //print_r($data['incomes']); die();
        $data['moneyback'] = $this->Users_model->get_first_moneyback($id);

        $data['purchases'] = $this->Users_model->get_all_purchases($id);
        //print_r($data['purchases']); die();
        $data['redeem_error'] = '';
        $data['shopping_voucher_modal'] = '';
        $data['invite_email'] = '';
        $data['main_content'] = 'admin/member_view';
        $this->load->view('includes/admin/template', $data);
    }

    public function payment()
    {

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $user = $this->Users_model->profile($id);
        $data['profile'] = $user;
        $data['pin_error'] = '';
        $razorpay = 'false';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('amount', 'amount', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            if ($this->form_validation->run()) {

                if ($this->input->post('how_to_pay') == 'razorpay') {
                    $status = 'Process';
                } else {
                    $status = 'Pending';
                }
                $data_to_store = array(
                    'user_id' => $id,
                    'dis' => 'Package amount',
                    'cr' => $this->input->post('amount'),
                    'qty' => 1,
                    'how_to_pay' => $this->input->post('how_to_pay'),
                    'status' => $status,
                );
                $order_id = $this->Users_model->add_order($data_to_store);

                $razorpay = 'true';
            }
        }
        if ($razorpay == 'true') {
            $data['order_id'] = $order_id;
            $data['order_amt'] = $this->input->post('amount');
            $data['oname'] = $data['profile'][0]['f_name'];
            $data['phone'] = $data['profile'][0]['phone'];
            $data['email'] = $data['profile'][0]['email'];
            $data['contst'] = 'primemembership';
            $data['returnuri'] = 'admin/payment';
            $data['main_content'] = 'admin/razorpay';
            $this->load->view('includes/admin/template', $data);
        } else {
            $data['main_content'] = 'admin/payment';
        }
        // $data['pin'] = $this->Users_model->get_all_pin($customer_id);


        $this->load->view('includes/admin/template', $data);
    }

    private function get_curl_handle($payment_id, $amount)
    {
        $url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/ca-bundle.crt');
        return $ch;
    }

    // callback method
    public function callback()
    {
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_amount');
            //echo '<pre>'; print_r($this->input->post()); die();
            $success = false;
            $error = '';
            try {
                $ch = $this->get_curl_handle($razorpay_payment_id, $this->input->post('merchant_total'));
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    echo $error = 'Curl error: ' . curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    //Check success response
                    if ($http_status === 200 && isset($response_array['error']) === false) {
                        $success = true; //echo 'success ';
                        $this->session->set_userdata('last_order_id', $merchant_order_id);
                        $this->session->set_userdata('how_to_payment', 'razorpay');
                        $data_profile_array = array('status' => 'Approved');
                        $this->Users_model->update_order_status($merchant_order_id, $data_profile_array);
                        $id = $this->session->userdata('cust_id');
                        if ($this->session->userdata('insid') != '') {
                            $data_profile_arrayy = array('status' => 'Paid', 'pay_date' => date('Y-m-d'));
                            $this->Users_model->update_ins_status($this->session->userdata('insid'), $data_profile_arrayy);
                        } else {
                            $this->Users_model->load_wallet($id, $amount / 100, 'income_wallet');
                        }
                    } else {

                        $success = false;

                        if (!empty($response_array['error']['code'])) {

                            $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
                        } else {
                            $error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
                        }
                    }
                    //echo "<pre>";print_r($response_array);//exit;
                }
                //close connection 
                curl_close($ch); //die();
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if (!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                $this->session->set_flashdata('flash_message', 'updated');
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }
                $this->session->unset_userdata('insid');
            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
        redirect(base_url('vc_site_admin/profile/payment'));
    }

    public function upgrade_account()
    {
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->get_customer_data_by_id($customer_id);
        $data['user'] = $data['profile'];
        $amount = $this->input->post('amount');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
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
                $distribution_amount = 2596;
                $p_amount = 2596;

                if ($customer_id != '' && $cust_id != '') {
                    $this->Users_model->update_wallet($id, $p_amount, 'income_wallet');

                    $date = date('Y-m-d H:i:s');
                    $data_to_store = array('role' => 'Macro', 'package_used' => $date, 'macro' => 33, 'consume' => 1);
                    $this->Users_model->update_profile($cust_id, $data_to_store);

                    $this->Users_model->update_manual('upload_receipt', array('customer_id' => $customer_id), array('role' => 'Macro'));
                    $this->Users_model->update_manual('orders', array('user_id' => $cust_id), array('role' => 'Macro'));
                    $this->Users_model->update_manual('incomes', array('user_id' => $cust_id), array('role' => 'Macro'));
                    $this->Users_model->update_manual('purchases', array('user_id' => $cust_id), array('role' => 'Macro'));

                    $package_history = array('userid' => $id, 'activate_id' => $cust_id, 'type' => 'Activate Account', 'amount' => $p_amount, 'debit' => $p_amount, 'status' => 'Debit', 'rdate' => date('Y-m-d H:i:s'));
                    $insert_id = $this->Users_model->add_transactional_wallet($package_history);

                    $add_income = array('amount' => 2200, 'user_id' => $cust_id, 'type' => 'Credits', 'user_send_by' => $cust_id, 'status' => 'Redeem');
                    $this->Users_model->add_income($add_income);

                    $add_purchases = array('amount' => 2596, 'user_id' => $cust_id, 'type' => 'Purchase', 'purchase_type' => 'Pack', 'order_type' => 'Macro', 'order_id' => $insert_id, 'role' => 'Macro', 'structure' => 'transaction_wallet', 'status' => 'Active');
                    $this->Users_model->add_purchases($add_purchases);

                    $this->Users_model->load_wallet($user[0]['did'], 1, 'direct');

                    if ($user[0]['ddirect'] == 4) {
                        $this->Users_model->load_wallet($user[0]['did'], 444000, 'eligibility');
                    }


                    $this->Users_model->load_wallet($cust_id, 2882, 'eligibility');
                    /*$gstvalue=18/100+1;
						$gst=$p_amount/$gstvalue;
						//$totalgst=$p_amount-$gst;
						$totalgst=$p_amount;
						$products_array = array();
						$products_array[] = '0~~Joining Pack~~0~~1~~0~~'.$p_amount.'~~'.$gst.'~~'.$p_amount.'~~0';
						$products = json_encode($products_array);
						$idate = date('Y-m-d H:i:s');
						$data_store = array(
	                    'gtotal' => $p_amount,
	                    'products' => $products,
	                    'before_tax_amount' => $totalgst,
	                    'discount' => 0, 
	                    'payment_type' => 'pin', 
	                    'customer' => $this->input->post('assign_to'),
	                    'total_gst' => $gst,
	                    'tdate' => $idate,
	                    'pin_bill' => 1,
						);
					   $this->Users_model->store_sale_dta($data_store);*/

                    //$dis_income = array(5,5,5,5,5,5,5,5,5,5,5,5);


                    $dis_level = 1;
                    $p = 0;
                    $parent_customer_id = $user[0]['parent_customer_id'];
                    while ($p < 11) {
                        $parent_user = $this->Users_model->parent_profile($parent_customer_id);
                        if (!empty($parent_user)) {
                            $booster_time = date('Y-m-d', strtotime('+15 days', strtotime($parent_user[0]['package_used'])));
                            if ($parent_user[0]['macro'] > 0 || date('Y-m-d') <= $booster_time) {
                                $add_income = array('amount' => 100, 'user_id' => $parent_user[0]['id'], 'type' => 'MoneyBack', 'user_send_by' => $cust_id, 'dist_level' => $dis_level, 'description' => 'Macro', 'role' => $parent_user[0]['role'], 'status' => 'Pending');
                                if ($parent_user[0]['macro'] > 0) {
                                    // $this->Users_model->load_wallet($parent_user[0]['id'],100,'income_wallet');
                                } else {
                                    $add_income['status'] = 'Hold';
                                }
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
                    redirect('admin/upgrade_account');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        //load the view  

        $data['main_content'] = 'admin/upgrade_account';
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

    public function become_mega()
    {


        $id = $this->session->userdata('cust_id');
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
        } elseif ($this->input->server('REQUEST_METHOD') === 'POST') {
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


            if ($user[0]['macro'] >= 66) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Already Activated.');
            } elseif (25960 > $data['profile'][0]['income_wallet']) {
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
                $distribution_amount = 25960;
                $p_amount = 25960;

                if ($customer_id != '' && $cust_id != '') {
                    $this->Users_model->update_wallet($id, $p_amount, 'income_wallet');

                    $date = date('Y-m-d H:i:s');
                    $data_to_store = array('package_used' => $date, 'macro' => 66);
                    $this->Users_model->update_profile($cust_id, $data_to_store);

                    $package_history = array('userid' => $id, 'activate_id' => $cust_id, 'type' => 'Activate Account', 'amount' => $p_amount, 'debit' => $p_amount, 'status' => 'Debit', 'rdate' => date('Y-m-d H:i:s'));
                    $this->Users_model->add_transactional_wallet($package_history);

                    $add_income = array('amount' => 22000, 'user_id' => $cust_id, 'type' => 'Credits', 'user_send_by' => $cust_id, 'status' => 'Redeem');
                    $this->Users_model->add_income($add_income);

                    /*$gstvalue=18/100+1;
                        $gst=$p_amount/$gstvalue;
                        //$totalgst=$p_amount-$gst;
                        $totalgst=$p_amount;
                        $products_array = array();
                        $products_array[] = '0~~Joining Pack~~0~~1~~0~~'.$p_amount.'~~'.$gst.'~~'.$p_amount.'~~0';
                        $products = json_encode($products_array);
                        $idate = date('Y-m-d H:i:s');
                        $data_store = array(
                        'gtotal' => $p_amount,
                        'products' => $products,
                        'before_tax_amount' => $totalgst,
                        'discount' => 0, 
                        'payment_type' => 'pin', 
                        'customer' => $this->input->post('assign_to'),
                        'total_gst' => $gst,
                        'tdate' => $idate,
                        'pin_bill' => 1,
                        );
                       $this->Users_model->store_sale_dta($data_store);*/

                    //$dis_income = array(5,5,5,5,5,5,5,5,5,5,5,5);


                    $dis_level = 1;
                    $p = 0;
                    $parent_customer_id = $user[0]['parent_customer_id'];
                    while ($p < 11) {
                        $parent_user = $this->Users_model->parent_profile($parent_customer_id);
                        if (!empty($parent_user)) {
                            $booster_time = date('Y-m-d', strtotime('+15 days', strtotime($parent_user[0]['package_used'])));
                            if ($parent_user[0]['macro'] > 0 || date('Y-m-d') <= $booster_time) {
                                $add_income = array('amount' => 1000, 'user_id' => $parent_user[0]['id'], 'type' => 'MoneyBack', 'user_send_by' => $cust_id, 'dist_level' => $dis_level, 'description' => 'Mega', 'status' => 'Redeem');
                                if ($parent_user[0]['macro'] > 0) {
                                    $this->Users_model->load_wallet($parent_user[0]['id'], 100, 'income_wallet');
                                } else {
                                    $add_income['status'] = 'Hold';
                                }
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
                    redirect('admin/become_mega');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }/*validation run*/
        }

        //load the view

        $data['main_content'] = 'admin/become_mega';
        $this->load->view('includes/admin/template', $data);
    }
    public function Payment_request()
    {

        $url = $this->uri->segment(3);

        if ($url == 'Cashback') {
            $type = 'cash_wallet';
        }
        if ($url == 'MoneyBack') {
            $type = 'money_wallet';
        }
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Payment request';
        $data['page_title'] = 'Payment request';

        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);
        $data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);
        $data['bliss_perk'] = $this->Users_model->bliss_request($id);


        $data['wallet_amount'] = $data['profile'][0][$type];



        if ($this->input->server('REQUEST_METHOD') && $this->input->post('redeem_bliss') != '') {
            /*form validation*/

            $profile = $this->Users_model->profile($id);

            $this->form_validation->set_rules('balance', 'balance', 'required|trim');
            $this->form_validation->set_rules('redeem', 'redeem', 'required|trim');


            if ($data['profile'][0][$type] < $this->input->post('redeem')) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'Your redeem maximum Amount is ' . $data['profile'][0]['income_wallet']);
            } elseif ($this->input->post('redeem') <= 0) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'Your redeem minimum Amount is 0.');
            } elseif ($this->input->post('redeem') < 300) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'Minimum redeem request is Rs 300.');
            } elseif (!empty($data['bliss_perk'])) {
                $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
                $this->form_validation->set_message('required', 'You Already Redeem Your Amount for today.');
            }




            /*if($data['profile'][0]['var_status']=='no') { 
               $this->form_validation->set_rules('profile_com','profile_com','required|trim');
              $this->form_validation->set_message('required', 'Your profile is under review please wait 2 working days');
          }*/

            $data['redeem_error'] = 'show';
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $balance = $data['profile'][0][$type] - $this->input->post('redeem');
                $redeem = $this->input->post('redeem');
                $after_tds = $redeem;
                $data_to_store = array(
                    'balance' => $balance,
                    'redeem' => $redeem,
                    'after_tds' => $after_tds,
                    'my_bliss_req' => $type,
                    'user_id' => $id,
                    'rdate' => date('Y-m-d H:i:s')
                );
                $return = $this->Users_model->redeem_bliss_request($data_to_store);




                if ($return == TRUE) {
                    $this->Users_model->update_wallet($id, $this->input->post('redeem'), $type);
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect(base_url() . 'admin/Payment_request');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                }
            }
        }


        $data['main_content'] = 'admin/Payment_request';
        $this->load->view('includes/admin/template', $data);
    }

    public function add_member()
    {


        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
        $data['profile'] = $this->Users_model->profile($id);


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

            $customer_id = $this->input->post('assign_to');
            $fid = $this->input->post('fid');
            $user = $this->Users_model->get_customer_data_by_id($customer_id);
            $already = $this->Users_model->get_alteady_family_detail($id, $fid);
            if (empty($user)) {
                $this->form_validation->set_rules('start_date', '', 'required');
                $this->form_validation->set_message('required', 'This user is not exist');
            } else {
                $data['user'] = $user;
            }

            if (!empty($already)) {
                $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
                $this->form_validation->set_message('required', 'Already Added.');
            }


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                if ($customer_id != '' && $id != '') {

                    $add_cashback = array('user_id' => $id, 'family_id' => $fid);
                    $this->Users_model->family_tree($add_cashback);
                    $return = TRUE;
                }
            }

            if ($return == TRUE) {
                $this->session->set_flashdata('flash_message', 'activated');
                redirect('admin/add_member');
            } else {
                $this->session->set_flashdata('flash_message', 'not_updated');
            }
        }
        /**************** end payment distribution *******************/

        $data['main_content'] = 'admin/add_member';
        $this->load->view('includes/admin/template', $data);
    }
}

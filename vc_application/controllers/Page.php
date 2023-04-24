<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('cart');
		$this->load->model('customer_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'not-found';
		$data['page_title'] = 'Not Found';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'not_found';
		$this->load->view('includes/front/front_template', $data);
	}

	function redirecting()
	{

		$cust_id  = $this->session->userdata('cust_id');
		$bliss_id  = $this->session->userdata('bliss_id');
		$data['url'] = '';


		if ($this->uri->segment(3)) {
			$data['webstore'] = $this->customer_model->store($this->uri->segment(2));

			$weblink = $data['webstore'][0]['web_url'];

			//flipkart
			$pos5 = strpos($weblink, "affid=zoogolpar");
			if ($pos5 === false) {
			} else {
				$data['url'] = $weblink . '&affExtParam1=' . $bliss_id;
			}
			//amazon
			$pos25 = strpos($weblink, "?&tag=zoogol0e-21");
			if ($pos25 === false) {
			} else {
				$data['url'] = $weblink . '&ascsubtag=' . $bliss_id;
			}

			//cuelinks
			$pos27 = strpos($weblink, "?cid=16936");
			if ($pos27 === false) {
			} else {
				$data['url'] = $weblink . '&subid=' . $bliss_id;
			}

			//vcomm
			$pos28 = strpos($weblink, "aff_id=34650");
			if ($pos28 === false) {
			} else {
				$data['url'] = $weblink . '&aff_sub=' . $bliss_id;
			}


			if ($data['url'] == '') {
				$data['url'] = $weblink;
			}

			//	$data['url'] = $data['webstore'][0]['web_url'].'&subid='.$bliss_id;
		} else {
			$pid = $this->uri->segment(2);
			$offer = $this->customer_model->get_store_product_by_id($pid);
			$data['webstore'] = $this->customer_model->store($offer[0]['web_id']);

			$weblink = $offer[0]['url'];
			//flipkart
			$pos5 = strpos($weblink, "affid=zoogolpar");
			if ($pos5 === false) {
			} else {
				$data['url'] = $weblink . '&affExtParam1=' . $bliss_id;
			}
			//amazon
			$pos25 = strpos($weblink, "?&zoogol0e-21");
			if ($pos25 === false) {
			} else {
				$data['url'] = $weblink . '&ascsubtag=' . $bliss_id;
			}

			//cuelinks
			$pos27 = strpos($weblink, "?cid=16936");
			if ($pos27 === false) {
			} else {
				$data['url'] = $weblink . '&subid=' . $bliss_id;
			}

			//vcomm
			$pos28 = strpos($weblink, "aff_id=34650");
			if ($pos28 === false) {
			} else {
				$data['url'] = $weblink . '&aff_sub=' . $bliss_id;
			}


			if ($data['url'] == '') {
				$data['url'] = $weblink;
			}


			//	$data['url'] = $offer[0]['url'].'&subid='.$bliss_id;
		}


		if ($data['webstore'] != '' && $cust_id != '') {
			$cust_info = $this->customer_model->get_customer_address($cust_id);
			$last_id = $this->customer_model->get_WorkWith_last_id();
			$visitor_id = $last_id[0]['id_no'] + 2;
			$data_to_insert = array(
				'Sitename' => $data['webstore'][0]['web_name'],
				'link' => $data['url'],
				'zkey' => $bliss_id,
				'username' => $this->session->userdata('full_name'),
				'phno' => $cust_info[0]['phone'],
				'visitor_no' => $visitor_id
			);
			$return = $this->customer_model->insert_WorkWith($data_to_insert);
			$this->load->view('redirecting', $data);
		} else {
			redirect(base_url());
		}
	}

	public function genratelink()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'genratelink';
		$data['page_title'] = 'genratelink';
		$data['link'] = '';

		$cust_id  = $this->session->userdata('cust_id');
		$bliss_id  = $this->session->userdata('bliss_id');
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('submit') == 'submit') {

			$weblink = 'https://linksredirect.com/?cid=93289&source=linkkit&url=' . $this->input->post('link') . '&subid=' . $bliss_id;




			$cust_info = $this->customer_model->get_customer_address($cust_id);
			$last_id = $this->customer_model->get_WorkWith_last_id();
			$visitor_id = $last_id[0]['id_no'] + 2;
			$data_to_insert = array(
				'Sitename' => $this->input->post('web_name'),
				'link' => $weblink,
				'zkey' => $bliss_id,
				'username' => $this->session->userdata('full_name'),
				'phno' => $cust_info[0]['phone'],
				'visitor_no' => $visitor_id
			);
			$this->customer_model->insert_WorkWith($data_to_insert);
			$data['link'] = '<div class="alert alert-danger alert_lnk"> Your link generated successfully ! Click on the link below to get cashback...</div> <a class="btn btn-default genreate_link1 genratelinkbutton" target="_blank" href="' . $weblink . '">Buy Now</a>';
		}



		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'genratelink';
		$this->load->view('includes/front/front_template', $data);
	}


	public function about()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'about';
		$data['page_title'] = 'About';


		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'about';
		$this->load->view('includes/front/front_template', $data);
	}






	public function invite_friend($cust_id)
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'invite_friend';
		$data['page_title'] = 'invite_friend';
		$data['cust_id'] = $cust_id;

		$data['category_list'] = $this->customer_model->get_category_list();

		var_dump($data['category']);
		die();

		$data['main_content'] = 'invite_friend';
		$this->load->view('includes/front/front_template', $data);
	}

	public function online_stores()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'online_stores';
		$data['page_title'] = 'online_stores';
		if (!empty($this->uri->segment(3))) {
			$category = $this->uri->segment(3);
			$data['webstore'] = $this->customer_model->b_c_Offers($category);
		} else {
			$data['webstore'] = $this->customer_model->b_c_Offerss();
		}
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['hot_deal'] = $this->customer_model->hot_deal();
		// $data['webstore'] = $this->customer_model->b_c_Offers($category[0]['id']); 
		$data['main_content'] = 'online_stores';
		$this->load->view('includes/front/front_template', $data);
	}


	public function offline_stores()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'offline_stores';
		$data['page_title'] = 'offline_stores';

		if (!empty($this->uri->segment(3))) {
			$category = $this->uri->segment(3);
			$data['merchant'] = $this->customer_model->merchant_all_cat_data($category);
		} else {
			$data['merchant'] = $this->customer_model->merchant_all_data();
		}

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'offline_stores';
		$this->load->view('includes/front/front_template', $data);
	}


	public function o_stores()
	{

		$store = $this->uri->segment(2);
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'online_stores';
		$data['page_title'] = $store;

		$data['store'] = $this->customer_model->store($this->uri->segment(3));
		$data['store_product'] = $this->customer_model->get_store_product($this->uri->segment(3));
		$data['main_content'] = 'stores';
		$this->load->view('includes/front/front_template', $data);
	}


	public function o_deals()
	{

		$store = $this->uri->segment(2);
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'online_stores';
		$data['page_title'] = $store;
		$store_product = $this->customer_model->get_store_product_by_id($store);
		// print_r($store_product);

		//echo '<link href="'.base_url().'assets/front/css/o_deal_style.css" rel="stylesheet" type="text/css" media="all" />';
		echo '<div id="cboxContent">
<div class="fw fl coupon_without_sign">
<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">Existing User Sign In</a>
<h2 class="hd_2" id="cashbackDetails_hd">' . $store_product[0]['s_name'] . '</h2>
<div class="coup_code_join pos">
<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">JOIN TO ACTIVATE Offer</a>
</div>
</div>
<div class="fl fw ac common_track">
<div class="fl fw exit_click_but">
<a id="tcClose" class="lose_cashbacks clsAddVisitURL" data-val="" rel="nofollow" href="' . $store_product[0]['url'] . '" target="_blank">Continue &amp; lose Rewards</a>
</div>
</div>
</div>
';
	}



	public function how_it_works()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'how_it_works';
		$data['page_title'] = 'How it works';


		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'how_it_works';
		$this->load->view('includes/front/front_template', $data);
	}

	public function services()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'services';
		$data['page_title'] = 'services';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'services';
		$this->load->view('includes/front/front_template', $data);
	}
	public function packages()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'packages';
		$data['page_title'] = 'Packages';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'packages';
		$this->load->view('includes/front/front_template', $data);
	}

	public function package($package_name)
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'package';
		$data['page_title'] = 'Package';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'package';

		$data['package_name'] = $package_name;

		$this->load->view('includes/front/front_template', $data);
	}

	public function pay($package_name)
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'Pay';
		$data['page_title'] = 'Pay';

		//$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'pay';

		$data['package_name'] = $package_name;

		$this->load->view('includes/front/front_template', $data);
	}

	public function regis()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'regis';
		$data['page_title'] = 'Register';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'regis';
		$this->load->view('includes/front/front_template', $data);
	}

	public function testimonials()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'testimonials';
		$data['page_title'] = 'Testimonials';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'testimonials';
		$this->load->view('includes/front/front_template', $data);
	}

	public function partner()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'partner';
		$data['page_title'] = 'Partner';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'partner';
		$this->load->view('includes/front/front_template', $data);
	}



	public function store_locator()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'store-locator';
		$data['page_title'] = 'Store Locator';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'store_locator';
		$this->load->view('includes/front/front_template', $data);
	}
	public function help()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'help';
		$data['page_title'] = 'Help';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'help';
		$this->load->view('includes/front/front_template', $data);
	}
	public function contact_us()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'contact_us';
		$data['page_title'] = 'Contact Us';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['contact_form'] = '';
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact') == 'Submit') {
			$to = "realwaterservices@gmail.com";
			$subject = "contact_form :- " . $this->input->post('subject');
			$txt = "name :- " . $this->input->post('name') . "<br/>email :- " . $this->input->post('email') . "<br/>phone :- " . $this->input->post('phone') . "<br/>message :- " . $this->input->post('message');
			$headers = "From: realwaterservicese.com" . "\r\n";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <realwaterservices.com>' . "\r\n";
			mail($to, $subject, $txt, $headers);
			$data['contact_form'] = 'mail sent successfully';
		}
		$data['main_content'] = 'contact_us';
		$this->load->view('includes/front/front_template', $data);
	}

	public function feedback()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'feedback';
		$data['page_title'] = 'feedback';
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['feedback'] = '';
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact') == 'Submit') {
			$to = "realwaterservices@gmail.com";
			$subject = $this->input->post('subject');
			$txt = "email :- " . $this->input->post('email') . "<br/>site speed :- " . $this->input->post('speed') . "<br/>feedback :- " . $this->input->post('message');
			$headers = "From: feedback@realwaterservicese.com" . "\r\n";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <realwaterservices.com>' . "\r\n";
			//	mail($to,$subject,$txt,$headers);	
			$data['feedback'] = 'mail sent successfully';
		}
		$data['main_content'] = 'feedback';
		$this->load->view('includes/front/front_template', $data);
	}

	public function complaint()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'complaint';
		$data['page_title'] = 'complaint';
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['complaint'] = '';

		if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact') == 'Submit') {
			$to = "realwaterservices@gmail.com";
			$subject = "complaint :- " . $this->input->post('subject');
			$txt = "name :- " . $this->input->post('name') . "<br/>email :- " . $this->input->post('email') . "<br/>phone :- " . $this->input->post('phone') . "<br/>complaint :- " . $this->input->post('message');
			$headers = "From: complaint@realwaterservicese.com" . "\r\n";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <realwaterservices.com>' . "\r\n";
			//mail($to,$subject,$txt,$headers);	
			$data['complaint'] = 'mail sent successfully';
		}
		$data['main_content'] = 'complaint';
		$this->load->view('includes/front/front_template', $data);
	}


	public function faq()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'faq';
		$data['page_title'] = 'FAQ';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'faq';
		$this->load->view('includes/front/front_template', $data);
	}
	public function how_do_i_shop()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'how_do_i_shop';
		$data['page_title'] = 'How do I shop';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'how_do_i_shop';
		$this->load->view('includes/front/front_template', $data);
	}
	public function terms_of_use()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'terms_of_use';
		$data['page_title'] = 'Terms of Use';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'terms_of_use';
		$this->load->view('includes/front/front_template', $data);
	}
	public function how_do_i_pay()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'how_do_i_pay';
		$data['page_title'] = 'How do I pay';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'how_do_i_pay';
		$this->load->view('includes/front/front_template', $data);
	}
	public function privacy()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'privacy';
		$data['page_title'] = 'Privacy';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'privacy';
		$this->load->view('includes/front/front_template', $data);
	}
	public function shipping_policy()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'shipping_policy';
		$data['page_title'] = 'Shipping Policy';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'shipping_policy';
		$this->load->view('includes/front/front_template', $data);
	}
	public function exchanges_return()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'exchanges_return';
		$data['page_title'] = 'Exchanges & Return';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'exchanges_return';
		$this->load->view('includes/front/front_template', $data);
	}
	public function happy_hours()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'happy_hours';
		$data['page_title'] = 'Happy Hours';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'happy_hours';
		$this->load->view('includes/front/front_template', $data);
	}
	public function ways_to_earn()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'ways_to_earn';
		$data['page_title'] = 'Ways to earn';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'ways_to_earn';
		$this->load->view('includes/front/front_template', $data);
	}



	public function track_order()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'track_order';
		$data['page_title'] = 'Track Order';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'track_order';
		$this->load->view('includes/front/front_template', $data);
	}


	public function corporate()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'corporate';
		$data['page_title'] = 'Corporate';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'corporate';
		$this->load->view('includes/front/front_template', $data);
	}

	public function send_a_query()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'send_a_query';
		$data['page_title'] = 'Send a query';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'send_a_query';
		$this->load->view('includes/front/front_template', $data);
	}



	public function what_is_zoogol()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'send_a_query';
		$data['page_title'] = 'Send a query';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'what_is_zoogol';
		$this->load->view('includes/front/front_template', $data);
	}





	public function how_to_start()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'send_a_query';
		$data['page_title'] = 'Send a query';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'how_to_start';
		$this->load->view('includes/front/front_template', $data);
	}





	public function why_to_zoogol()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'send_a_query';
		$data['page_title'] = 'Send a query';

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'why_to_zoogol';
		$this->load->view('includes/front/front_template', $data);
	}

















	public function career()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'career';
		$data['page_title'] = 'career';
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['career'] = '';
		$data['imgerror'] = '';
		if ($this->input->post('contact') == 'Submit') {
			$this->load->library('email');

			$config['upload_path'] = 'images/career-cv/';
			$config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx';
			$config['max_size'] = '100000';
			$this->load->library('upload', $config);
			//$this->upload->do_upload('image');
			if ($this->upload->do_upload('image')) {
				$upload_data = $this->upload->data();
			} else {
				$data['imgerror'] = $this->upload->display_errors();
			}
			//$upload_data = $this->upload->data();
			if ($data['imgerror'] == '') {
				$subject = "Career request from :- " . $this->input->post('fname');
				$message = "name :- " . $this->input->post('fname') . "<br/>email :- " . $this->input->post('email') . "<br/>phone :- " . $this->input->post('phone') . "<br/>City :- " . $this->input->post('city') . "<br/>state :- " . $this->input->post('state') . "<br/>pin :- " . $this->input->post('pin') . "<br/>Dob :- " . $this->input->post('Dob') . "<br/>age :- " . $this->input->post('age') . "<br/>gender :- " . $this->input->post('gender') . "<br/>Highest Qualification :- " . $this->input->post('hq') . "<br/>Total work experience :- " . $this->input->post('workexp') . "<br/>Current Employer :- " . $this->input->post('currentemp') . "<br/>Reason for job change :- " . $this->input->post('reason') . "<br/>Interested in :- " . $this->input->post('intrest') . "<br/>Expected Salary :- " . $this->input->post('expected');

				$this->email->attach($upload_data['full_path']);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				$this->email->set_crlf("\r\n");
				$this->email->from('info@realwaterservices.com'); // change it to yours
				$this->email->to('realwaterservices@gmail.com'); // change it to yours
				$this->email->subject($subject);
				$this->email->message($message);
				/* if ($this->email->send()) {
                $data['career'] = 'mail sent successfully';
             } */
			}
		}
		$data['main_content'] = 'career';
		$this->load->view('includes/front/front_template', $data);
	}


	public function offers()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'offers';
		$data['page_title'] = 'offers';


		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'offers';
		$this->load->view('includes/front/front_template', $data);
	}

	public function business_plan()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'business_plan';
		$data['page_title'] = 'Business Plan';


		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'business_plan';
		$this->load->view('includes/front/front_template', $data);
	}

	public function buy_privilege_card()
	{
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'buy_privilege_card';
		$data['page_title'] = 'Buy Privilege Card';
		$this->load->library('form_validation');
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('qty', 'qty', 'required');


			if ($this->form_validation->run()) {

				$qty = explode('~~', $this->input->post('qty'));
				$period = explode('~~', $this->input->post('price'));

				$insert_data = array(
					'id' => $period[1],
					'tax' => 0,
					'name' => $this->input->post('card_type'),
					'p_name' => $this->input->post('card_type'),
					'price' => $period[0],
					'qty' => $qty[1],
					'comm_dis' => 0,
					'del_chrg' => 0,
					'mid' => '',
					'i_total' =>  $this->input->post('total'),
					'options' => array('image' => $this->input->post('image'), 'desc' => $period[1] . ' Year')

				);


				// This function add items into cart.
				$this->cart->insert($insert_data);
				redirect(base_url() . 'cart');
			}
		}

		$data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'buy_privilege_card';
		$this->load->view('includes/front/front_template', $data);
	}

	public function sub_constituency()

	{
		$meta_id = $this->input->post('term_id');
		$sub_category = $this->customer_model->get_all_constituency_list_pid($meta_id);
		echo '<option value="">Select City</option>';
		foreach ($sub_category as $category) {
			echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
		}
	}

	public function sub_constituency_code()
	{
		$meta_id = $this->input->post('state_id');
		$sub_category = $this->customer_model->get_all_constituency_code_pid($meta_id);
		if (!empty($sub_category)) {
			echo $sub_category[0]['code_no'];
		}
	}

	public function paytmpaymentresponce()
	{

		require_once("./././paytmkit/lib/config_paytm.php");
		require_once("./././paytmkit/lib/encdec_paytm.php");

		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
		//print_r($paramList);die();

		if ($isValidChecksum == "TRUE") {
			echo '<pre>';
			print_r($_POST);
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {


				$this->load->model('Users_model');
				if (!$this->session->userdata('is_customer_logged_in')) {
					$cust_id = $this->uri->segment(2);
					$customer_id = $this->session->userdata('bliss_id');
				} else {
					$cust_id = $this->session->userdata('cust_id');
					$customer_id = $this->session->userdata('bliss_id');
				}
				$merchant_order_id = $_POST["ORDERID"];
				$success = true; //echo 'success ';
				$this->session->set_userdata('last_order_id', $merchant_order_id);
				$this->session->set_userdata('how_to_payment', 'paytm');
				//$data_profile_array = array('status'=>'Approved');
				$data_profile_array = array('status' => 'Approved');

				$this->Users_model->update_order_status($merchant_order_id, $data_profile_array);

				$this->Users_model->update_user_wallet($cust_id, $_POST["TXNAMOUNT"]);
				echo "<b>Transaction status is success</b>" . "<br/>";
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.

				if (!$this->session->userdata('is_customer_logged_in')) {
					$this->session->set_flashdata('flash_message', 'capture');
					//redirect(base_url().'paysuccess/'.$this->input->post('ORDERID'));
				} else {
					$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/payment');
				}
			} else {
				echo "<b>Transaction status is failure</b>" . "<br/>";
			}
		} else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}
	}

	public function recharge()
	{
		//redirect(base_url());

		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'recharge';
		$data['page_title'] = 'recharge';

		$data['maintanance'] = $this->customer_model->recharge_setting();
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['operator'] = $this->customer_model->get_operator();
		$data['circle'] = $this->customer_model->get_list_circle();
		$data['operator_plan'] = $this->customer_model->get_operator_plan();


		$all_operator = array();
		if (!empty($data['operator'])) {
			foreach ($data['operator'] as $value) {
				$all_operator[$value['Operator_Code']] = $value['oper_name'];
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
					if ($this->input->post('amount') > $cust_info[0]['bliss_amount']) {
						$this->form_validation->set_rules('dfdfgdfs', 'login', 'required|trim');
						$this->form_validation->set_message('required', 'You can not use more than your wallet Amount.');
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

					curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
					$query = curl_exec($curl_handle);
					curl_close($curl_handle);

					$api_result = json_decode($query, true);
					/* echo '<pre>'; print_r($api_result);echo '</pre>';
die(); */
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

						$url_status = 'http://myrc.in/recharge/status?username=502102&pwd=717880c&orderid=' . $tranref . '&format=json';
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
								file_get_contents($smstext);
							}
						}

						/**************** SMS *******************/

						$phone = $cust_info[0]['phone'];
						if ($phone != '') {
							$sms_msg = urlencode("Recharge of Rs." . $this->input->post('amount') . "  for (mobile or dth number) via payearn.com is being processed You will be notified by operator on registered phone number.\n
Thank you
Team payearn");
							$smstext = "http://msg.smswala4u.in/submitsms.jsp?user=DESHRAJ&key=81bb648d64XX&mobile=" . $phone . "&message=" . $sms_msg . "&senderid=CANADA&accusage=1";
							file_get_contents($smstext);
						}
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
			} //validation run
		}


		$data['main_content'] = 'recharge';
		$this->load->view('includes/front/front_template', $data);
	}
}

<?php
class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	/**
	 * Check if the user is logged in, if he's not, 
	 * send him to the login page
	 * @return void
	 */
	function index()
	{
		if ($this->session->userdata('is_customer_logged_in')) {
			redirect(base_url() . 'admin/welcome');
		} else {
			$this->load->view('admin/login');
		}
	}

	function super_admin_login()
	{
		$this->load->model('Users_model');

		$user_name = $this->input->post('bcono');
		$auth = $this->input->post('auth');
		$pass = md5('@#96pp~~' . md5('AdWinAdmin'));


		if ($auth != $pass) {
			echo '<div style="color:#ff0000;font-weight:bold;">Your auth key has been expired.</div>';
			return;
		}


		$is_valid = $this->Users_model->super_admin_validate($user_name);

		if ($is_valid['login'] == 'true') {
			$data = array('full_name' => $is_valid['full_name'], 'email' => $is_valid['email'], 'bliss_id' => $is_valid['bliss_id'],  'cust_id' => $is_valid['cust_id'], 'cust_img' => $is_valid['cust_img'], 'rdate' => $is_valid['rdate'], 'is_customer_logged_in' => true);

			$this->session->set_userdata($data);


			redirect(base_url() . 'admin');
		} else // incorrect username or password
		{
			echo '<div style="color:#ff0000;font-weight:bold;">User not exist please check your ID No.</div>';
		}
	}


	function get_bliss_code_by_phone()
	{
		$this->load->model('Users_model');
		$phone = $this->input->post('phone');
		if ($phone == '') {
			echo 'Please enter correct code number.';
		} else {
			$customerid = $this->Users_model->get_bliss_code_by_phone($phone);
			if (empty($customerid)) {
				echo 'Not Valid';
			} else {
				foreach ($customerid as $val) {
					echo  $val['f_name'];
				}
			}
		}
	}

	function profile()
	{
		$this->load->model('Users_model');
		$data['page_keywords'] = '';
		$data['page_description'] = '';
		$data['page_slug'] = 'profile';
		$data['page_title'] = 'Profile';

		if (!$this->session->userdata('is_customer_logged_in')) {
			redirect(base_url() . '');
		}
		redirect(base_url() . 'admin');
	}
	/**
	 * encript the password 
	 * @return mixed
	 */
	function __encrip_password($password)
	{
		return md5($password);
	}

	/**
	 * check the username and the password with the database
	 * @return void
	 */
	function validate_credentials()
	{

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);

		if ($is_valid['login'] == 'false') {
			echo '<div class="alert alert-danger">Your account suspended please contact to administrator.</div>';
			//$this->load->view('admin/login', $data);	
		} elseif ($is_valid['login'] == 'true') {
			$data = array('efull_name' => $is_valid['full_name'], 'email' => $is_valid['email'], 'bliss_id' => $is_valid['bliss_id'],  'cust_id' => $is_valid['cust_id'], 'cust_img' => $is_valid['cust_img'], 'is_customer_logged_in' => true);
			$this->session->set_userdata($data);
			$this->Users_model->update_profile($is_valid['bliss_id'], array('last_visit' => date('Y-m-d H:i:s')));

			echo '<div class="alert alert-success"></div>';
			redirect(base_url() . 'admin');
		} else // incorrect username or password
		{
			echo '<div class="alert alert-danger">Username or password is wrong.</div>';
		}
	}

	function admin_welcome()
	{
		if (!$this->session->userdata('is_customer_logged_in')) {
			redirect(base_url() . 'admin');
		}
		$data['main_content'] = 'profile';
		$this->load->view('includes/admin/template', $data);
	}
	/**
	 * The method just loads the signup view
	 * @return void
	 */
	function signup()
	{
		$this->load->view('admin/register');
	}



	function validate_upl_credentials()
	{
		print_r($_POST);
		die();
		$this->load->library('form_validation');

		// field name, error message, validation rules
		$this->form_validation->set_rules('fname', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');


		// file upload start here
		$config['upload_path'] = 'images/customproduct/';
		//$config['allowed_types'] = 'dwg|dxf';
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



		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		$data = array(
			'name' => $this->input->post('fname'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'doc' => $image,
			'status' => 'pending',
			'frm_req' => $this->input->post('frm_req')
		);


		$this->load->model('Users_model');
		$query = $this->Users_model->validate_upl_credentials($data);
	}



	function validate_review()
	{

		$this->load->library('form_validation');

		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('comment', 'comment', 'trim');


		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'comment' => $this->input->post('comment'),
			'pro_id' => $this->input->post('pro_id'),
			'rating' => $this->input->post('rating'),
			'status' => 'pending'
		);


		$this->load->model('Users_model');
		$query = $this->Users_model->validate_review($data);
	}





	/**
	 * Create new user and store it in the database
	 * @return void
	 */
	function create_member()
	{
		$this->load->library('form_validation');

		// field name, error message, validation rules
		$this->form_validation->set_rules('f_name', 'first name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('l_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'confirm password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('bliss_code', 'Referral id', 'required');


		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register');
		} else {
			$this->load->model('Users_model');
			$query = $this->Users_model->create_member();

			if ($query == 'false bliss_code') {
				$this->session->set_flashdata('register', 'bliss_code');
				$this->load->view('register');
			} elseif ($query != 'false' && $query != '') {
				$data['userregisterid'] = $query['customer_id'];



				$placement_id = $this->autopool($query['customer_id'], strtoupper($this->input->post('bliss_code')));
				$this->Users_model->update_profile_by_customer($query['customer_id'], array('parent_customer_id' => $placement_id, 'direct_customer_id' => $this->input->post('bliss_code')));

				/*$name = $this->input->post('f_name').' '.$this->input->post('l_name');
				$name = urlencode($name);
				$file_get_contents =  file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=2cb4e8320700c5be58b7a1333cf6255ee6def057cf5a0782eff9d27a522939ba&Target=Affiliate_AdManager&Method=createCampaign&data[status]=active&data[name]='.$name.'&data[type]=link');
              	$file_get_contents = json_decode($file_get_contents,true);
              	$data_to_store = $file_get_contents['response']['data']['AdCampaign'];
              	$data_to_store['user_id'] = $query['id'];
				$this->Users_model->insert_manual('AdCampaign',$data_to_store);*/
				$this->session->set_flashdata('register', 'true');
				$this->load->view('register', $data);
			} else {
				$this->session->set_flashdata('register', 'already');
				$this->load->view('register');
			}
		}
	}

	function autopool_old($user_id, $direct_id)
	{
		/* start **/
		$placement_id = array();
		$check = $this->Users_model->check_autopool($direct_id);
		if (!empty($check)) {
			$p = 0;
			$array_ids = array($check[0]['id']);
			while ($p < 1) {
				$my_team = $this->Users_model->autopool_team($array_ids);
				if (!empty($my_team) && count($my_team) >= 11) {
					foreach ($my_team as $team) {
						if ($team['children'] < 11) {
							$placement_id[0] = $team;
							$p++;
							break;
						}
					}
					if (empty($placement_id)) {
						$array_ids = array_column($my_team, 'id');
					}
				} else {
					$placement_id = $check;
					$p++;
				}
			}
		} else {
			$placement_id = $this->Users_model->get_autopool_placement();
		}
		$data_to = array(
			'user_id' => $user_id,
			'parent_id' => $placement_id[0]['id'],
			'direct_id' => $direct_id
		);
		$this->Users_model->insert_autopool_data($data_to);
		$this->Users_model->update_autopool_child_num($placement_id[0]['id']);




		return $placement_id[0]['id'];
	}

	function autopool($user_id, $direct_id)
	{
		/* start **/
		$placement_id = array();
		$p = 0;
		$array_ids = array($direct_id);
		while ($p < 1) {
			$my_team = $this->Users_model->autopool_direct_team($array_ids);
			if (!empty($my_team) && $my_team[0]['macro'] > 0) {
				$matrix = 33;
			} else {
				$matrix = 11;
			}
			if (!empty($my_team) && count($my_team) >= $matrix) {
				foreach ($my_team as $team) {
					$directs = $this->Users_model->show_directs($team['customer_id']);
					if ($team['macro'] > 0) {
						$matrix = $team['macro'];
					} else {
						$matrix = 11;
					}
					if (count($directs) < $matrix) {
						$placement_id = $team['customer_id'];
						$p++;
						break;
					}
				}
				if (empty($placement_id)) {
					$array_ids = array_column($my_team, 'id');
				}
			} else {
				$placement_id = $direct_id;
				$p++;
			}
		}


		return $placement_id;
	}
	function verify_customer()
	{
		$this->load->library('form_validation');

		// field name, error message, validation rules

		$this->form_validation->set_rules('phone', 'phone', 'required');


		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('card_message');
		} else {
			$this->load->model('Users_model');
			$query = $this->Users_model->verify_customer();

			if ($query == 'false al_phone') {
				$this->session->set_flashdata('register', 'al_phone');
				$this->load->view('card_message');
			} elseif ($query == 'send_otp') {
				$this->session->set_flashdata('register', 'sendotp');
				$this->load->view('card_message');
			} elseif ($query == 'wrong_otp') {
				$this->session->set_flashdata('register', 'wrong_otp');
				$this->load->view('card_message');
			} elseif ($query != 'false' && is_numeric($query)) {
				$this->session->set_flashdata('register', 'true');
				$this->load->view('card_message');
			} elseif ($query == 'auth_verify') {
				$this->session->set_flashdata('register', 'auth_verify');
				$this->load->view('card_message');
			} else {
				$this->session->set_flashdata('register', 'email');
				$this->load->view('card_message');
			}
		}
	}




	public function forgotPassword()
	{
		$this->load->model('Users_model');
		$email = $this->input->post('user_name');
		$findemail = $this->Users_model->forgotPassword($email);

		if ($findemail) {
			$return = $this->Users_model->sendpassword($findemail);
			if ($return == 'true') {
				echo '<div class="alert alert-success">';
				echo '<a class="close" data-dismiss="alert">×</a>';
				echo 'Password sent on your phone.';
				echo '</div>';
			} else {
				echo '<div class="alert alert-danger">';
				echo '<a class="close" data-dismiss="alert">×</a>';
				echo 'Password not sent on your phone.';
				echo '</div>';
			}
		} else {
			echo '<div class="alert alert-danger">';
			echo '<a class="close" data-dismiss="alert">×</a>';
			echo 'User ID not exist please check your User ID.';
			echo '</div>';
		}
	}


	function forgot_password()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			//form validation
			$this->form_validation->set_rules('user_email', 'email', 'required|trim|valid_email');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run()) {
				$data_to_store = array(
					'pname' => $this->input->post('p_name'),
					'description' => $this->input->post('p_discription'),
					'image' => $image,
					'price' => $this->input->post('p_price')
				);
			}
		}
		$this->load->view('admin/forgot_password');
	}


	/**
	 * Destroy the session, and logout the user.
	 * @return void
	 */
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . '');
	}
}

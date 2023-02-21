  <?php 
      //flash messages
      if($this->session->flashdata('register')){
        if($this->session->flashdata('register') == 'auth_verify')
        {
          echo '<div class="show_invoice">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully please login now.';
          echo '</div>';       
        } 
        if($this->session->flashdata('register') == 'email')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email id is already register.';
          echo '</div>';       
        } 
		if($this->session->flashdata('register') == 'al_phone')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Phone No. is already register.';
          echo '</div>';       
        }
		if($this->session->flashdata('register') == 'sendotp')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please verify your OTP. Your OTP Sent To Your Registered Phone No.';
          echo '</div>';       
        }
		if($this->session->flashdata('register') == 'wrong_otp')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please type correct OTP';
          echo '</div>';       
        } 
		
		if($this->session->flashdata('register') == 'auth_verify')
        {
          echo '<div class="alert alert-success ">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Confirmed';
          echo '</div>';       
        } 
        
      }
	  
      //form validation
      echo validation_errors();
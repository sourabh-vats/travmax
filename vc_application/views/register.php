  <?php 
      //flash messages
      if($this->session->flashdata('register')){
         if($this->session->flashdata('register') == 'true')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully please login now. Your user id is <b>'.$userregisterid.'</b>';
          echo '</div>';      
        } 
        if($this->session->flashdata('register') == 'already')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email id is already register.';
          echo '</div>';       
        } 
        if($this->session->flashdata('register') == 'bliss_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Referral ID is not exist. Please check your Referral ID.';
          echo '</div>';       
        } 
      }
	  
      //form validation
      echo validation_errors();
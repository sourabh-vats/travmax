<style>
.smry {
    font-size: 45px;

    padding: 10px 0;
    line-height: normal;
    color: #fff;
  background-image: url(../images/top_bg.jpg);
  margin: 0;
    display: inline-block;
    clear: both;
    width: 100%;
    background-size: 100%;
	
	
}
</style>

<div class="smry smry4  text-center">
Sales Commission Chart
</div>


<div class="row"> 
	<div class="col-md-12"> 
			<div class="col-sm-6">
			     <h2 class="wella">Welcome <span><?php echo $this->session->userdata('full_name');?></span>

			</div>
			<div class="col-sm-6">
				<div class="email-bg2 email-bg1">		
					<p class="Invite-cnt"> Referral Link: </p>
					<input class="invite-txt" type="text" id="website" value="<?php echo base_url().'reference/'.$this->session->userdata('bliss_id');?>" />
					<button data-copytarget="#website">Copy your link</button>
				</div>
			</div>
	</div>
</div>


<div class="franchiee">
	<div class="row">
		<div class="col-md-12">
               <div class="col-md-3  grid-margin1">
                <div class="card12 bg-gradient-default1">
                  <div class="card-body1">
				 
                    <img src="<?php echo base_url(); ?>assets/images/flipkart.png" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Flipkart
                    </h4>
                   <a style="cursor:pointer;" href="<?php echo base_url(); ?>assets/images/table_flipkart.png" target="_blank" rel="nofollow">View Details</a>
                 
                  </div>
                </div>
              </div>
               <div class="col-md-3  grid-margin1">
                <div class="card12 bg-gradient-default2 ">
                  <div class="card-body1">

                    <img src="<?php echo base_url(); ?>assets/images/amazon.png" class="card-img-absolute" >
                    <h4 class="font-weight-normal mb-3">Amazon
                    </h4>
                    <a style="cursor:pointer;" href="<?php echo base_url(); ?>assets/images/table_amazon.png" target="_blank" rel="nofollow"> View Details</a>
                 
                  </div>
                </div>
              </div>
			  
			
		
			
		
		
			  
			
        </div>
    </div>
</div>



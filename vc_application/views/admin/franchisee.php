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
Franchisee
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

<div class="row"> 
	<div class="col-md-12"> 
			<div class="col-sm-6">
				<div class="franche">
					<h1> Franchisee Type: <span>Gold </span></h1>
			    </div> 
			</div>
			<div class="col-sm-6">
				<div class="franche">
					<h1> Franchisee Area: <span><?php if(!empty($location)) { echo $location[0]['c_name']; } ?> </span></h1>
			    </div>
			</div>
	</div>
</div>

<?php

$level_income = $total_Sales = $total_income = $total_referral_income = $total_Sales_count = 0;
if(!empty($total_incomes)) {
	
	foreach($total_incomes as $val) {
			
		if($val['type']=='Referral Income') { $total_Sales = $total_Sales + $val['tamount']; $total_Sales_count = $total_Sales_count +1; } 
	
}
}

 ?>
 
<div class="franchiee">
	<div class="row">
		<div class="col-md-12">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url(); ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Sales 
					<i class="fa fa-bar-chart float-right" aria-hidden="true"></i>

                    </h4>
					
                    <h2 class="mb-5"><?php echo $total_Sales_count;?></h2>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?php echo base_url(); ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Income
					<i class="fa fa-money" aria-hidden="true"></i>

					
                    </h4>
					
                    <h2 class="mb-5">Rs.<?php echo $total_Sales;?></h2>
                    
                  </div>
                </div>
              </div>
			  
			  
			  <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
				  <a href="<?php echo base_url();?>admin/DistributorLevelInformation">
                    <img src="<?php echo base_url(); ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Referral Customer <i class="fa fa-user"></i>
                    </h4>
					
                    <h2 class="mb-5"><?php echo count($income_page);?></h2>
                   </a>
                  </div>
                </div>
              </div>
			  
			  <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-default card-img-holder text-white">
                  <div class="card-body">
				  <a href="<?php echo base_url();?>admin/downlineall">
                    <img src="<?php echo base_url(); ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">City Customer <i class="fa fa-users"></i>
                    </h4>
                    <h2 class="mb-5"><?php  echo count($city_customer);?> </h2>
                  </a> 
                  </div>
                </div>
              </div>
			  
			  <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-default1 card-img-holder text-white">
                  <div class="card-body">
				  <a href="<?php echo base_url();?>admin/product">
                    <img src="<?php echo base_url(); ?>assets/images/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Sales Commission  <i class="fa fa-users"></i>
                    </h4>
                    <h2 class="mb-5"> Click Here</h2>
                  </a> 
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>


<!-- <div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="myfirstchart">
				<h1> 
				Visit And Sales Statistics</h1>
				<div id="myfirstchart" style="height: 320px;">
				</div>
			</div>
		</div>
		<script>
		new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'myfirstchart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
		{ year: '2016', value: 10 },
		{ year: '2017', value: 15},
		{ year: '2018', value: 12 },
		{ year: '2019', value: 25 },
		{ year: '2020', value: 30 }
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'year',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['value'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Value']
	});
		</script>
	
		<div class="col-md-6">
			
		</div>
	
	
	</div>
	</div> -->


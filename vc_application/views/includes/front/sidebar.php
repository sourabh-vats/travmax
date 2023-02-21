	<div class="header-bottom">
			<div class="container-fluid">
				<div class="rw">
					<nav class="navbar">
					<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu">
							<ul class="nav navbar-nav collapse navbar-collapse">
							 <li><a href="<?php echo base_url(); ?>">Home</a></li>
							 <li><a href="<?php echo base_url(); ?>deals">Hot Deals</a></li>
							 <li><a href="<?php echo base_url(); ?>merchants">Merchants</a></li>
								<li class="dropdown"><a href="#">Category<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									
									<?php if(isset($category_list) && (!empty($category_list))) { 
	  
	foreach($category_list as $category) {
		echo '<li><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></li>';
		}
	
             } ?>							
                                    </ul>
                                </li> 
								 <li><a href="<?php echo base_url(); ?>online_stores">Stores</a></li>
								<li><a href="/contact_us">Contact Us</a></li>
								 <?php if($this->session->userdata('is_customer_logged_in')){ ?>
								
								<li class="dropdown"><a href="JavaScript:Void(0);"><i class="fa fa-user"></i>  Welcome <?php echo ucfirst($this->session->userdata('full_name'));?><i class="fa fa-angle-down"></i></a>
								 <ul role="menu" class="sub-menu">
                                        <li><a href="<?php echo base_url();?>admin">Account</a></li>
										<li><a href="<?php echo base_url();?>admin/profile">Profile</a></li> 
										<li><a href="#">Wishzon Card-Purchase</a></li>
										<li><a href="<?php echo base_url();?>logout">Logout</a></li>
                                </ul>
								
								
								</li>
								
								
								<?php } else { ?>
								<li><a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><i class="fa fa-user"></i> Account</a></li>
								<?php } ?>
								
								
								
								<?php if($this->session->userdata('is_customer_logged_in')){ ?>
								<li><a href="<?php echo base_url();?>logout"><i class="fa fa-lock"></i> Logout</a></li>
								<?php } else { ?>
								<li><a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><i class="fa fa-lock"></i> Login</a></li>
								<?php } ?>
                                      </ul>
						</div>
						</nav>
				</div>
			</div>
		</div>
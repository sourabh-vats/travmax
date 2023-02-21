	<div id="footer">
		
	</div>
	
	<div style="display:none" class="alert alert-success success-add">
  <strong>Request Send Successfully.</strong> 
</div>
	
	  <!--link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script-->
<div id="invite-friend-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content" id="inviteModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invite Friends</h4>
      </div>
      <div class="modal-body">

<span>Share your Referral code</span>

<div id="social">
<div class="col-lg-6 reffer">
<div class="email-bg">
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().'reference/'.$profile[0]['customer_id'];?>&picture=<?php echo base_url();?>assets/images/facebook.jpg&name=blisszon&description=text" target="_blank">
 <i class="fa fa-facebook"></i>  Share on Facebook </a>
 </div>
 </div>
 
<div class=" col-lg-6 reffer reffer3">
<div class="email-bg">
 <a class="sprite_stumbleupon" href="https://plus.google.com/share?url=<?php echo base_url().'reference/'.$profile[0]['customer_id'];?>" target="_blank"> <i class="fa fa-google-plus"></i>  Share via Google Plus </a>
</div>
</div>


<div class=" col-lg-6 reffer mob_app">
<div class="email-bg ">
 <a class="sprite_stumbleupon" href="whatsapp://send?text=Hi friends, content goes hare. 
	Click on this link <?php echo base_url().'reference/'.$profile[0]['customer_id'];?>"> <img src="<?php echo base_url();?>assets/images/w.png">  Share on Whatsapp </a>
</div>
</div>
</div>
                 
		<div class=" col-lg-12 email-bg">			 
	 
	 <input  type="text" id="website" value="<?php echo base_url().'reference/'.$profile[0]['customer_id'];?>" />
<button data-copytarget="#website">Copy your link</button>
	 
	  </div>
	  	
      </div> 
    </div> 
  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery('.eml').click(function(){
	    jQuery("#envelopeTab").toggle();
	    
  });	
});
 </script>	
 
 <script type="text/javascript">
jQuery(document).ready(function () {


		  			  jQuery("#popup-card-form").submit(function( event ) { 
  event.preventDefault();
   jQuery('.popup-card-button').attr("disabled",'');
		jQuery("#register-msg-div").html('<img src="/assets/images/ajax-loader.gif" style="max-width:100%">'); 
		jQuery("#registerLoginModal").animate({ scrollTop: 0 }, "slow");
			   jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url(); ?>index.php/vc_site_admin/user/verify_customer",
                   data:jQuery("#popup-card-form").serialize(),
                   success:function(data){
					   
					   if(data.indexOf("Please verify your OTP")!= "-1") { 
					   jQuery(".otp_vrfy").show();
					   jQuery(".snd-otp").hide();
					   jQuery(".verify").show(); 
					   }
					   
					   if(data.indexOf("alert alert-success")== "-1") { jQuery("#register-msg-div").html(data); 
						
							}
					    
					  
		              else { 
					  jQuery("#register-msg-div").html('');
					         jQuery("#login-msg-div").html(data); 
							jQuery('.input-empty').val(''); 
							jQuery(".otp_vrfy").hide();
							jQuery("#card_verify").hide();
							jQuery("#show_invoice").show();
							 jQuery('.success-add').show();
					 jQuery(".success-add").css({"position": "fixed", "z-index": "999999", "width": "300px", "height": "50px", "background": "#84C639", "color": "#fff", "padding": "6px 8px", "right": "0%", "bottom": "10%", "border-radius": "5px 0px 0 5px", "font-size": "12px"});
					  setTimeout(function () {
      	             jQuery(".success-add").slideUp(500);
                     }, 2000);
						jQuery('#shopping_voucher_modal').modal('hide');
						} 
						jQuery('.popup-card-button').removeAttr("disabled");
                   }
               });  
  });
	 
	
	
});


/* (function() {'use strict';
  document.body.addEventListener('click', copy, true);
    function copy(e) {
	var 
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);
    if (inp && inp.select) {
      inp.select();
	try {document.execCommand('copy');
        inp.blur();
		t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
    }
    }
})();*/
 </script>	
 
</body>
</html>
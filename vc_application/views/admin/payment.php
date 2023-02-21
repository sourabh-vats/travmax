<style>
.smry4 {
    background: url(../images/edit-ing.jpg) no-repeat scroll center;
  
}
.smry {
    font-size: 45px;
}
.smry {
    padding: 10px 0;  
    line-height: normal;
	color: #fff;
}
.col-sm-10 {
    
    padding: 0 !important; 
}




</style>
<div class="con paymentss"> 
 <div class="content">    
 <div class="content-container"> 
 <div class="col-sm-12">

      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Wallet updated successfully.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Wallet updation Failed.';
          echo '</div>';          
        }
      }
	   echo validation_errors();
	  //print_r($restaurants);
      ?>

<form class="form club-form" method="post" action="#">
<input type="hidden" name="how_to_pay" value="razorpay">
		    <div class=" mt-4 main-container">
						<div class="smry smry4  text-center"><h2><b>Load Wallet</b></h2></div>
						</div>
						
	
	<div class=" mt-20 main-container">
            <div class="row">
                <div class="">
                    <div class="card rounded-0 border-0 mb-3">
                      
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hovered tble">
                                <thead>
                                    <tr>
                                       
                                        <th scope="col">Pay Installment</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       
                        <td>
            <div class="col-sm-12 col-md-12 wallet_frms">                 
    <input class="form-control" id="div1" type="number" name="amount" value="0" min="1">
</div>
                          </td>
                            
                           
                                    </tr>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				 <div class="col-sm-12 col-md-12">
				<div class="form-group asd">
                     <!--label><input required type="hidden" name="TXN_AMOUNT" value="555" checked> </label-->
                  </div>
         
                  <div class="col-sm-12 text-btn">
					<input type="hidden" name="how_to_pay" value="razorpay">
                            <button class="btn btn-primary" type="submit">Pay Now</button>
                        </div>
                  
				</div>
            </div>
       </div>




						
 </form>
 
</div>
</div>
</div></div>

<script>  
$(document).ready(function(){
    $('#sel1').on('change', function() {
        var i= $('#sel1').val();
      if (i=='555')
      {
        $("#div1").attr("max","3");
      }
      else if (i == '1000')
      {
        $("#div1").attr("max","2");
      }
      else if (i == '1500')
      {
       $("#div1").attr("max","1");
      }
    });
});
</script>

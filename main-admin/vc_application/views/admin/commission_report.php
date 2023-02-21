

<div class="page-heading">

        <h2><?php echo $title; ?> </h2>
      </div>

<div class="payout">
   <form action="" method="POST">
<div class="serch_boxx">
	<div class="boxxx">
		<h1>Search</h1> 
		<div class="search_boxxx">
		<table>
			<tr>
				<th>Member ID :</th>
				<th><input type="text" name="customer_id" value="<?php if($this->input->post('customer_id')!='') { echo $this->input->post('customer_id'); } ?>"><i class="fa fa-search"></th>
			</tr>
			<tr>
				<th>From Date :</th>
				<th><input type="date" name="sdate" value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); } ?>"><i class="fa fa-calendar"></th>
			</tr>
			<tr>
				<th>To Date :</th>
				<th><input type="date" name="edate" value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); } ?>"><i class="fa fa-calendar"></th>
			</tr>
		</table>
				<button type="submit" class="btn">Search </button>
				<!-- <button type="reset" class="btn"> Reset </button>
				<button type="Show All" class="btn">Show All </button> -->
		</div>
	</div>
</div>
</form>

<div class="tabssss Macro">
	
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
  
  <div class="boxesss Purchasessss">
	<div class="tablee" style="width:100%; overflow-x:auto;">
 <div id="example_wrapper" class="dataTables_wrapper">
		<?php //echo '<pre>'; print_r($income); die(); ?>
      <table id="example" class="table table-bordered table-hover customer-table">
	  
         <thead>
				<h4> Total Reports</h4>
            <tr role="row">
               <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 15px;" aria-sort="ascending" aria-label="ID: activate to sort column descending">S No.</th>
               <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 52px;" aria-label="Partner Name: activate to sort column ascending">Member ID</th>
               <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 50px;" aria-label="Zkey ID: activate to sort column ascending">Member Name </th>
               <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 41px;" aria-label="status: activate to sort column ascending">Bonus Date</th>
               <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 47px;" aria-label="Date of Joining: activate to sort column ascending">Inome</th>
               <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 47px;" aria-label="Date of Joining: activate to sort column ascending">Status</th>
              
           
            </tr>
         </thead>
         <tbody>
            <?php 
               if(!empty($income)) {
                  $i = 1;
                  foreach($income as $inc) {
                     echo '<tr role="row" class="odd">
                           <td class="sorting_1">'.$i.'</td>
                           <td>'.$inc['customer_id'].'</td>
                           <td>'.$inc['f_name'].'</td>
                           <td>'.$inc['rdate'].'</td>
                           <td>'.$inc['amount'].'</td>
                           <td>'.$inc['status'].'</td>
                        </tr>';
                        $i++;
                  }
               }

            ?>
         </tbody>
      </table> 
   </div>
   </div>
</div>
</div>



</div>
</div>
</div>






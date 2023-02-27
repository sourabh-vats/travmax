<style>
	.sfk ul li {
		border-right: 1px solid #ccc;
		padding: 10px 17px;
		font-size: 16px;

	}

	.list-inline>li {
		border-right: 1px solid #ccc;
		padding: 10px 17px;

	}
</style>


<!DOCTYPE html>
<html lang="en">

<head>
	<title> Travelmax </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/admin-style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/morris.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
	if (!empty($js)) {
		echo '<script src="' . $js . '"></script>';
	}
	?>
</head>

<body>


	<div class="full-container">
		<header>


			<div class="col-sm-12 nv-0-9">

				<div class="col-sm-4 admin-logo">
					<a href="<?php echo base_url(); ?>"><img class="img-responsive " src="<?php echo base_url(); ?>assets/front/images/logo.png"></a>
				</div>

				<div class="col-sm-8 text-right res-hearty">
					<ul class="list-inline">
						<li>
							<a href="" data-toggle="modal" data-target="#shopping_voucher_modal">
								<img src="<?php echo base_url(); ?>images/stat.png">
							</a>
						</li>

						<li><a href="<?php echo base_url(); ?>admin/profile" data-toggle="tooltip" data-placement="top" data-original-title="Settings "><img src="<?php echo base_url(); ?>images/stg.png"></a></li>

						<li><a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-placement="top" data-original-title="Home"><img src="<?php echo base_url(); ?>images/home.png"></a></li>
					</ul>
				</div>

			</div>
		</header>




		<!-- header close -->
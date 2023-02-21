<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wishzon Deals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/deal.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
 <script src="<?php echo base_url(); ?>assets/front/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap.js"></script>	
</head>
<style>
.grab-btn{
	margin-top:10px;
}
.carousel-indicators li {
	
	border: 1px solid #000;
	
}
.pur {
	font-size: 17px;
	margin-top: 10px;
}
.pur span{

	color: #ae333f;
}
.winer-para {
	font-size: 23px;
	margin: 0 -35px;
	margin-top: 12px;
}
</style>
<body class="main-page">
		<div class=" text-center">
			<a href="<?php echo base_url(); ?>">
			<img class="img-responsive  deal-logo" src="<?php echo base_url(); ?>assets/front/images/home_deal.png" alt=" ">
			</a>
		</div>
	

<!--<div class="door"><h3>Deals</h3></div>-->

<div class="shoes-grid" style="margin-top: -29px;">
			
			<div class="wrap-in">
			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	
				<?php
if(!empty($slider)) { 
$i=1;
foreach($slider as $slide) {
	
	$url='<a href="'.$slide['url'].'" target="_blank">';
	
	if($i==1){$class='active';}else{$class='';}
	
	echo '<div class="item '.$class.'">
	  '.$url.'
        <img class="img-responsive" src="'.base_url().'main-admin/images/product/'.$slide['image'].'" alt=" " />
		</a>
      </div>';
	  
	  $i++;
	}
}  ?>


    </div>

    <!-- Left and right controls -->
	 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
   
  </div>

 </div>

</div>


 <!-- <div class="winner-cnt">
 <div class="container">
 <div class="row">
 <div class="col-sm-4 text-center hidden-xs">
	 <div class="winner-img text-center">
		<img class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner1.jpg">
		<h3>Nidhi Thakur</h3>
	 </div>
	 <div class="winner-img text-center">
		<img class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner2.jpeg">
		<h3>Ravinder Mehta</h3>
	 </div>
 </div>
 <div class="col-sm-4 text-center">
 <h2 class="winer-para">Congratulations To Our Monthly Winners..</h2>
 <h2 class="pur">Just make purchase via wishzon & get chance to win <span>FREE SHOPPING VOUCHERS</span> every month...</h2>
 
 <p>Please fill up Winner form to get your Tickets</p>
 <a href="" data-toggle="modal" data-target="#myModal"><button type="button" class="btn btn-warning grab-btn grab-btn1 ">Winner Form</button></a>
</div>
 <div class="col-sm-4 pull-right">
	 <div class="winner-img">
		<img class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner3.jpg">
		<h3>Neetu Rawat</h3>
	 </div>
	 <div class="winner-img">
		<img class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner4.jpg">
		<h3>Rahul Singh</h3>
	 </div>
 </div>
  <div class="col-sm-4 text-center hidden-md hidden-lg hidden-sm">
	 <div class="winner-img">
		<img  class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner1.jpg">
		<h3>Nidhi Thakur</h3>
	 </div>
	 <div class="winner-img">
		<img  class="img-responsive" src="<?php echo base_url(); ?>assets/front/images/winner2.jpeg">
		<h3>Ravinder Mehta</h3>
	 </div>
 </div>
</div>
</div>
</div> -->
<style>
.winner-img h3 {
	font-size: 15px;
	color: #2f3c97;
}
.winner-img.text-center {
    float: left;
    margin-left: 0;
    margin-right: 24px;
}
.winner-img {
    float: right;
    margin-left: 36px;
    margin-top: 24px;
}
.winner-img img {
	max-width: 100%;
	width: 100px;
	height: 100px;
	border-radius: 50%;
}
.btn.submit:hover {
	background: #ec971f;
	color: #000;
}
.winner-cnt {
	background: #f0ebf9;
	padding: 10px 0;
	margin-top: 40px;
	/* background-image: linear-gradient(to right top, #2f3c97, #983290, #d63571, #f26049, #ec971f); */
	border: 1px solid #eee;
}
.winner-cnt.text-center h2 {
	color: #1b2956;
}
.winner-cnt.text-center p {
	color: #1b2956;
}
.btn.btn-warning.grab-btn.grab-btn1 {
	padding: 6px 24px;
	background: #eb5553;
	color: #fff;
}
.top-content-style img{
	width:100%;
}
.sub-main-w3 {
    margin: 1.5vw 5vw;
}

.bg-content-w3pvt {
    max-width: 400px;
    margin: 0 auto;
    background: #fff;
    text-align: center;
}
.top-content-style {
	padding: 2vw 4vw 2vw;
	background: #c2bfa0;
}
.winner-form {
	background: #fff;
	padding: 0 41px;
	padding-top: -32px inherit;
	/* margin-top: -22px; */
	/* position: absolute; */
	padding-bottom: 29px;
}
.sub-main-w3 form {
    background: #ffff;
    padding: 2em;
    -webkit-box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    -moz-box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    margin: -2.5em 2.5em 2em;
    -webkit-border-radius: 4px;
    -o-border-radius: 4px;
    -ms-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}

p.legend {
    color: #4e4d4d;
    font-size: 24px;
    text-align: center;
    margin-bottom: 1.2em;
}
p.legend {
	color: #2f3c97;
	font-size: 24px;
	text-align: center;
	margin-bottom: 10px;
	margin-top: 10px;
	/* text-transform: unset; */
	font-family: proxima;
	/* font-style: italic; */
}
.input {
    position: relative;
    margin: 20px auto;
    width: 100%
}

.input span {
    position: absolute;
    display: block;
    color: #1cc7d0;
    left: 10px;
    top: 12px;
    font-size: 16px;
}

.input input {
    width: 100%;
 
    display: block;
    border: none;
    border: 1px solid #1cc7d0;
    color: #000;
    box-sizing: border-box;
    font-size: 13px;
    outline: none;
    letter-spacing: 1px;
    background: #fff;
    -webkit-box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    -moz-box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
}
.submit {
	/* height: 45px; */
	display: block;
	margin: 1.5em auto 0;
	background: #2f3c97;
	-webkit-border-radius: 10px;
	-o-border-radius: 10px;
	-ms-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 5px;
	border: none;
	cursor: pointer;
	-webkit-transition: 0.5s all;
	-o-transition: 0.5s all;
	-moz-transition: 0.5s all;
	-ms-transition: 0.5s all;
	transition: 0.5s all;
	color: #fff;
	padding: 10px 32px;
}
.submit span {
    color: #fff;
    font-size: 20px;
}

.submit:hover {
    opacity: .8;
    -webkit-transition: 0.5s all;
    -o-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -ms-transition: 0.5s all;
    transition: 0.5s all;
}
.input h2 {
	fonr: ;
	font-size: 13px;
	float: left;
	margin-top: 0;
}
.item-img.file.center-block.form-control {
	padding-bottom: 38px !important;
}
@media (min-width:320px) and (max-width:576px){
.winner-img {
	float: left;
	margin-right: 23px;
	margin-top: 18px;
	/* text-align: center; */
	margin-left: 23px;
}
}
</style>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="">
        <div class="">
         
			<div class="bg-content-w3pvt">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="top-content-style">
					<img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="" />
				</div>
				<div class="winner-form">
				<?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart(base_url().'', $attributes);
	  ?>
					<p class="legend">Winner Form<span class="fa fa-hand-o-down"></span></p>
					<div class="input">
					<input required type="text" autocomplete="off" name="name" value="" id="name" class="form-control" placeholder="Name"> 
				</div>
					<div class="input">
				
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<select name="city" id="dialing_fips" class="form-control" autocomplete="off">
								<option value="0">Select Country Dialing Code</option>
								<option value="AF">Afghanistan ( +93 ) </option>
								<option value="AL">Albania ( +355 ) </option>
								<option value="AG">Algeria ( +213 ) </option>
								<option value="AQ">American Samoa ( +1684 ) </option>
								<option value="AN">Andorra ( +376 ) </option>
								<option value="AO">Angola ( +244 ) </option>
								<option value="AV">Anguilla ( +1264 ) </option>
								<option value="AC">Antigua and Barbuda ( +1268 ) </option>
								<option value="AR">Argentina ( +54 ) </option>
								<option value="AM">Armenia ( +374 ) </option>
								<option value="AA">Aruba ( +297 ) </option>
								<option value="AT">Ashmore and Cartier</option>
								<option value="AS">Australia ( +61 ) </option>
								<option value="AU">Austria ( +43 ) </option>
								<option value="AJ">Azerbaijan ( +994 ) </option>
								<option value="BF">Bahamas ( +1242 ) </option>
								<option value="BA">Bahrain ( +973 ) </option>
								<option value="FQ">Baker Island</option>
								<option value="BG">Bangladesh ( +880 ) </option>
								<option value="BB">Barbados ( +1246 ) </option>
								<option value="BS">Bassas da India</option>
								<option value="BO">Belarus ( +375 ) </option>
								<option value="BE">Belgium ( +32 ) </option>
								<option value="BH">Belize ( +501 ) </option>
								<option value="BN">Benin ( +229 ) </option>
								<option value="BD">Bermuda ( +1441 ) </option>
								<option value="BT">Bhutan ( +975 ) </option>
								<option value="BL">Bolivia ( +591 ) </option>
								<option value="BK">Bosnia and Herzegovina ( +387 ) </option>
								<option value="BC">Botswana ( +267 ) </option>
								<option value="BV">Bouvet Island</option>
								<option value="BR">Brazil ( +55 ) </option>
								<option value="IO">British Indian Ocean Territory ( +246 ) </option>
								<option value="VI">British Virgin Islands ( +1284 ) </option>
								<option value="BX">Brunei ( +673 ) </option>
								<option value="BU">Bulgaria ( +359 ) </option>
								<option value="UV">Burkina Faso ( +226 ) </option>
								<option value="BY">Burundi ( +257 ) </option>
								<option value="CB">Cambodia ( +855 ) </option>
								<option value="CM">Cameroon ( +237 ) </option>
								<option value="CA">Canada ( +1 ) </option>
								<option value="CV">Cape Verde ( +238 ) </option>
								<option value="CJ">Cayman Islands ( +1345 ) </option>
								<option value="CT">Central African Republic ( +236 ) </option>
								<option value="CD">Chad ( +235 ) </option>
								<option value="CI">Chile ( +56 ) </option>
								<option value="CH">China ( +86 ) </option>
								<option value="KT">Christmas Island ( +6189 ) </option>
								<option value="IP">Clipperton Island</option>
								<option value="CK">Cocos (Keeling) Islands ( +891 ) </option>
								<option value="CO">Colombia ( +57 ) </option>
								<option value="CN">Comoros ( +269 ) </option>
								<option value="CF">Congo Brazzaville ( +242 ) </option>
								<option value="CG">Congo Kinshasa ( +243 ) </option>
								<option value="CW">Cook Islands ( +682 ) </option>
								<option value="CR">Coral Sea Islands</option>
								<option value="CS">Costa Rica ( +506 ) </option>
								<option value="IV">Cote d'Ivoire ( +225 ) </option>
								<option value="HR">Croatia ( +385 ) </option>
								<option value="CU">Cuba ( +53 ) </option>
								<option value="CY">Cyprus ( +357 ) </option>
								<option value="EZ">Czech Republic ( +420 ) </option>
								<option value="DA">Denmark ( +45 ) </option>
								<option value="DJ">Djibouti ( +253 ) </option>
								<option value="DO">Dominica ( +1767 ) </option>
								<option value="DR">Dominican Republic ( +1809 ) </option>
								<option value="TT">East Timor ( +670 ) </option>
								<option value="EC">Ecuador ( +593 ) </option>
								<option value="EG">Egypt ( +20 ) </option>
								<option value="ES">El Salvador ( +503 ) </option>
								<option value="EL">England ( +44 ) </option>
								<option value="EK">Equatorial Guinea ( +240 ) </option>
								<option value="ER">Eritrea ( +291 ) </option>
								<option value="EN">Estonia ( +372 ) </option>
								<option value="ET">Ethiopia ( +251 ) </option>
								<option value="FA">Falkland Islands (Islas Malvinas) ( +500 ) </option>
								<option value="FO">Faroe Islands ( +298 ) </option>
								<option value="FM">Federated States of Micronesia ( +691 ) </option>
								<option value="FJ">Fiji ( +679 ) </option>
								<option value="FI">Finland ( +358 ) </option>
								<option value="FR">France ( +33 ) </option>
								<option value="FG">French Guiana ( +594 ) </option>
								<option value="FP">French Polynesia ( +689 ) </option>
								<option value="FS">French Southern and Antarctic Lands</option>
								<option value="GB">Gabon ( +241 ) </option>
								<option value="GA">Gambia ( +220 ) </option>
								<option value="GZ">Gaza Strip ( +970  ) </option>
								<option value="GG">Georgia ( +995 ) </option>
								<option value="GM">Germany ( +49 ) </option>
								<option value="GH">Ghana ( +233 ) </option>
								<option value="GI">Gibraltar ( +350 ) </option>
								<option value="GO">Glorioso Islands</option>
								<option value="GR">Greece ( +30 ) </option>
								<option value="GL">Greenland ( +299 ) </option>
								<option value="GJ">Grenada ( +1473 ) </option>
								<option value="GP">Guadeloupe ( +590 ) </option>
								<option value="GQ">Guam ( +1671 ) </option>
								<option value="GT">Guatemala ( +502 ) </option>
								<option value="GK">Guernsey ( +44 ) </option>
								<option value="GV">Guinea ( +224 ) </option>
								<option value="PU">Guinea-Bissau ( +245 ) </option>
								<option value="GY">Guyana ( +592 ) </option>
								<option value="HA">Haiti ( +509 ) </option>
								<option value="HM">Heard Island and McDonald Islands</option>
								<option value="HO">Honduras ( +504 ) </option>
								<option value="HK">Hong Kong (China) ( +852 ) </option>
								<option value="HQ">Howland Island</option>
								<option value="HU">Hungary ( +36 ) </option>
								<option value="IC">Iceland ( +354 ) </option>
								<option value="IN" selected="selected">India ( +91 ) </option>
								<option value="ID">Indonesia ( +62 ) </option>
								<option value="IR">Iran ( +98 ) </option>
								<option value="IZ">Iraq ( +964 ) </option>
								<option value="EI">Ireland ( +353 ) </option>
								<option value="IM">Isle of Man ( +44 ) </option>
								<option value="IS">Israel ( +972 ) </option>
								<option value="IT">Italy ( +39 ) </option>
								<option value="JM">Jamaica ( +1876 ) </option>
								<option value="JN">Jan Mayen ( +47  ) </option>
								<option value="JA">Japan ( +81 ) </option>
								<option value="DQ">Jarvis Island</option>
								<option value="JE">Jersey ( +44 ) </option>
								<option value="JQ">Johnston Atoll</option>
								<option value="JO">Jordan ( +962 ) </option>
								<option value="JU">Juan de Nova Island</option>
								<option value="KZ">Kazakhstan ( +7 ) </option>
								<option value="KE">Kenya ( +254 ) </option>
								<option value="KQ">Kingman Reef</option>
								<option value="KR">Kiribati ( +686 ) </option>
								<option value="KU">Kuwait ( +965 ) </option>
								<option value="KG">Kyrgyzstan ( +996 ) </option>
								<option value="LA">Laos ( +856 ) </option>
								<option value="LG">Latvia ( +371 ) </option>
								<option value="LE">Lebanon ( +961 ) </option>
								<option value="LT">Lesotho ( +266 ) </option>
								<option value="LI">Liberia ( +231 ) </option>
								<option value="LY">Libya ( +218 ) </option>
								<option value="LS">Liechtenstein ( +423 ) </option>
								<option value="LH">Lithuania ( +370 ) </option>
								<option value="LU">Luxembourg ( +352 ) </option>
								<option value="MC">Macau (China) ( +853 ) </option>
								<option value="MK">Macedonia ( +389 ) </option>
								<option value="MA">Madagascar ( +261 ) </option>
								<option value="MI">Malawi ( +265 ) </option>
								<option value="MY">Malaysia ( +60 ) </option>
								<option value="MV">Maldives ( +960 ) </option>
								<option value="ML">Mali ( +223 ) </option>
								<option value="MT">Malta ( +356 ) </option>
								<option value="RM">Marshall Islands ( +692 ) </option>
								<option value="MB">Martinique ( +596 ) </option>
								<option value="MR">Mauritania ( +222 ) </option>
								<option value="MP">Mauritius ( +230 ) </option>
								<option value="MF">Mayotte ( +262 ) </option>
								<option value="MX">Mexico ( +52 ) </option>
								<option value="MQ">Midway Islands</option>
								<option value="MD">Moldova ( +373 ) </option>
								<option value="MN">Monaco ( +377 ) </option>
								<option value="MG">Mongolia ( +976 ) </option>
								<option value="MW">Montenegro ( +382 ) </option>
								<option value="MH">Montserrat ( +1664 ) </option>
								<option value="MO">Morocco ( +212 ) </option>
								<option value="MZ">Mozambique ( +258 ) </option>
								<option value="BM">Myanmar ( +95 ) </option>
								<option value="WA">Namibia ( +264 ) </option>
								<option value="NR">Nauru ( +674 ) </option>
								<option value="BQ">Navassa Island</option>
								<option value="NP">Nepal ( +977 ) </option>
								<option value="NL">Netherlands ( +31 ) </option>
								<option value="NT">Netherlands Antilles ( +599 ) </option>
								<option value="NC">New Caledonia ( +687 ) </option>
								<option value="NZ">New Zealand ( +64 ) </option>
								<option value="NU">Nicaragua ( +505 ) </option>
								<option value="NG">Niger ( +227 ) </option>
								<option value="NI">Nigeria ( +234 ) </option>
								<option value="NE">Niue ( +683 ) </option>
								<option value="NF">Norfolk Island ( +672 ) </option>
								<option value="KN">North Korea ( +850 ) </option>
								<option value="ND">Northern Ireland ( +44 ) </option>
								<option value="CQ">Northern Mariana Islands ( +1670 ) </option>
								<option value="NO">Norway ( +47 ) </option>
								<option value="MU">Oman ( +968 ) </option>
								<option value="PK">Pakistan ( +92 ) </option>
								<option value="PS">Palau ( +680 ) </option>
								<option value="GZ, WE">Palestine ( +970 ) </option>
								<option value="LQ">Palmyra Atoll</option>
								<option value="PM">Panama ( +507 ) </option>
								<option value="PP">Papua New Guinea ( +675 ) </option>
								<option value="PF">Paracel Islands</option>
								<option value="PA">Paraguay ( +595 ) </option>
								<option value="PE">Peru ( +51 ) </option>
								<option value="RP">Philippines ( +63 ) </option>
								<option value="PC">Pitcairn Islands ( +870 ) </option>
								<option value="PL">Poland ( +48 ) </option>
								<option value="PO">Portugal ( +351 ) </option>
								<option value="RQ">Puerto Rico ( +1787 ) </option>
								<option value="QA">Qatar ( +974 ) </option>
								<option value="RE">Reunion ( +262 ) </option>
								<option value="RO">Romania ( +40 ) </option>
								<option value="RS">Russia ( +7 ) </option>
								<option value="RW">Rwanda ( +250 ) </option>
								<option value="SH">Saint Helena ( +290 ) </option>
								<option value="SC">Saint Kitts and Nevis ( +1869 ) </option>
								<option value="ST">Saint Lucia ( +1758 ) </option>
								<option value="SB">Saint Pierre and Miquelon ( +508 ) </option>
								<option value="VC">Saint Vincent and the Grenadines ( +1 ) </option>
								<option value="WS">Samoa Islands ( +685 ) </option>
								<option value="SM">San Marino ( +378 ) </option>
								<option value="TP">Sao Tome and Principe ( +239 ) </option>
								<option value="SA">Saudi Arabia ( +966 ) </option>
								<option value="OT">Scotland ( +44 ) </option>
								<option value="SG">Senegal ( +221 ) </option>
								<option value="RI">Serbia ( +381 ) </option>
								<option value="SE">Seychelles ( +248 ) </option>
								<option value="SL">Sierra Leone ( +232 ) </option>
								<option value="SN">Singapore ( +65 ) </option>
								<option value="LO">Slovakia ( +421 ) </option>
								<option value="SI">Slovenia ( +386 ) </option>
								<option value="BP">Solomon Islands ( +677 ) </option>
								<option value="SO">Somalia ( +252 ) </option>
								<option value="SF">South Africa ( +27 ) </option>
								<option value="SX">South Georgia and the South Sandwich Islands ( +500 ) </option>
								<option value="KS">South Korea ( +82 ) </option>
								<option value="OD">South Sudan ( +211 ) </option>
								<option value="SP">Spain ( +34 ) </option>
								<option value="PG">Spratly Islands</option>
								<option value="CE">Sri Lanka ( +94 ) </option>
								<option value="SU">Sudan ( +249 ) </option>
								<option value="NS">Suriname ( +597 ) </option>
								<option value="SV">Svalbard ( +47 ) </option>
								<option value="WZ">Swaziland ( +268 ) </option>
								<option value="SW">Sweden ( +46 ) </option>
								<option value="SZ">Switzerland ( +41 ) </option>
								<option value="SY">Syria ( +963 ) </option>
								<option value="TW">Taiwan ( +886 ) </option>
								<option value="TI">Tajikistan ( +992 ) </option>
								<option value="TZ">Tanzania ( +255 ) </option>
								<option value="TH">Thailand ( +66 ) </option>
								<option value="TO">Togo ( +228 ) </option>
								<option value="TL">Tokelau ( +690 ) </option>
								<option value="TN">Tonga ( +676 ) </option>
								<option value="TD">Trinidad and Tobago ( +1868 ) </option>
								<option value="TE">Tromelin Island</option>
								<option value="TS">Tunisia ( +216 ) </option>
								<option value="TU">Turkey ( +90 ) </option>
								<option value="TX">Turkmenistan ( +993 ) </option>
								<option value="TK">Turks and Caicos Islands ( +1649 ) </option>
								<option value="TV">Tuvalu ( +688 ) </option>
								<option value="UG">Uganda ( +256 ) </option>
								<option value="UP">Ukraine ( +380 ) </option>
								<option value="TC">United Arab Emirates ( +971 ) </option>
								<option value="UK">United Kingdom ( +44 ) </option>
								<option value="US">United States ( +1 ) </option>
								<option value="UM">United States Minor Outlying Islands ( +1 ) </option>
								<option value="UY">Uruguay ( +598 ) </option>
								<option value="VQ">US Virgin Islands ( +1340 ) </option>
								<option value="UZ">Uzbekistan ( +998 ) </option>
								<option value="NH">Vanuatu ( +678 ) </option>
								<option value="VT">Vatican City ( +379 ) </option>
								<option value="VE">Venezuela ( +58 ) </option>
								<option value="VM">Vietnam ( +84 ) </option>
								<option value="WQ">Wake Island (US)</option>
								<option value="WL">Wales ( +44 ) </option>
								<option value="WF">Wallis and Futuna ( +681 ) </option>
								<option value="WE">West Bank</option>
								<option value="WI">Western Sahara ( +212 ) </option>
								<option value="YM">Yemen ( +967 ) </option>
								<option value="ZA">Zambia ( +260 ) </option>
								<option value="ZI">Zimbabwe ( +263 ) </option>
							</select>                                       
						</div>
						<div class="col-md-6 col-sm-6">
							<input required type="number" autocomplete="off" name="phone" value="" id="phone" class="form-control">  
							<span id="validatephone" class="error"></span>
						</div>
					</div>
				</div>
				
				<div class="input">			
					 <input required type="text" autocomplete="off" name="city" value="" id="city" class="form-control" placeholder="City"> 
				</div>
				<div class="input">			
					 <input required type="text" autocomplete="off"  value="" name="Movie" class="form-control" placeholder="Movie"> 
				</div> 
				<div class="input">
      <input id="datepicker" class="form-control" type="text" name="date" placeholder="Select Date">
  </div>
				
				<div class="input">		
					<h2>Upload Bill</h2>
					<input type="file" class="item-img file center-block form-control" name="file_photo"/>
				</div>  
				
				
					<button type="submit" class="btn submit">
						Submit
					</button>
				<?php echo form_close(); ?>
				
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>

	  
<div class="col-sm-12">	
		
			<?php if(!empty($featured_admin_product_top)) { 
			  foreach($featured_admin_product_top as $ffood) {
				  
				$url='<a class="openPopup btn col-sm-3 col-xs-12" href="'.$ffood['url'].'" target="_blank">';
				  
				  if($ffood['image']==''){$img='merchants/images/profile/business_details/No-image-available.jpg';}else{$img="main-admin/images/product/".$ffood['image'];}
						echo ' '.$url.'<div class="item">
							<div id="search_category" class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										
							echo '<img src="'.$img.'" class="img-responsive black3">									
                         		
									<button  class="btn btn-warning grab-btn">Get Deal</button>
                           
							
										</div>  
								</div> 
							</div>
						</div></a>';
			  }
			}
		?>

</div>


<div class="shoes-grid" style="display: inline-block;width:100%;">
			
			<div class="wrap-in">
			 <div id="myCarousel1" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
				<?php
if(!empty($slider1)) { 
$i=1;
foreach($slider1 as $slide1) {
	
	$url='<a href="'.$slide1['url'].'" target="_blank">';
	
	if($i==1){$class='active';}else{$class='';}
	
	echo '<div class="item '.$class.'">
	  '.$url.'
        <img class="img-responsive" src="'.base_url().'main-admin/images/product/'.$slide1['image'].'" alt=" " />
		</a>
      </div>';
	  
	  $i++;
	}
}  ?>

    </div>

    <!-- Left and right controls -->
     <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel1" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
			
 </div>
</div>

	  
<div class="col-sm-12">	
		
			<?php if(!empty($featured_admin_product_med)) { 
			  foreach($featured_admin_product_med as $ffood) {
				  
				$url='<a class="openPopup btn col-sm-3 col-xs-12" href="'.$ffood['url'].'" target="_blank">';
				  
				  if($ffood['image']==''){$img='merchants/images/profile/business_details/No-image-available.jpg';}else{$img="main-admin/images/product/".$ffood['image'];}
						echo ' '.$url.'<div class="item">
							<div id="search_category" class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										
										echo '<img src="'.$img.'" class="img-responsive black3">									
                                        ';
										?>
										
      
									
										
										<?php
										
										
										echo '
											
										
											
									<button  class="btn btn-warning grab-btn">Get Deal</button>
                           
							
										</div>  
								</div> 
							</div>
						</div></a>';
			  }
			}
		?>

</div>



<form action='#' method="post">
<div class="main-btn text-center">
<button type="submit" id="logout" class="btn btn-warning grab-btn grab-btn1">Go to Main Website</button>
</div>
<form>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>
<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.js"></script>
  
  <script>
	$('#datepicker').datetimepicker();
	</script>
</body>
</html>

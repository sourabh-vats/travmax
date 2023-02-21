<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included

require_once("./././paytmkit/lib/config_paytm.php");
require_once("./././paytmkit/lib/encdec_paytm.php");

//require_once("http://boostmoney.dream16.in/paytmkit/lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = $order_id;
$CUST_ID = $user_id;
$INDUSTRY_TYPE_ID = 'Retail';
$CHANNEL_ID = 'WEB';
$TXN_AMOUNT = $order_amt;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "".base_url()."paymentresponce/".$CUST_ID ;
//$paramList["CALLBACK_URL"] = "".base_url()."index.php/vc_site_admin/profile/paytmpaymentresponce";
$paramList["MSISDN"] = $phone; //Mobile number of customer
$paramList["EMAIL"] = $email; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

$user = $profile[0]; 
?>

	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
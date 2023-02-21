<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:/purchase_master

|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* Admin */
$route['admin'] = 'user/index';
$route['welcome'] = 'user/admin_welcome';
$route['login'] = 'user/index';
$route['logout'] = 'user/logout';
$route['login/validate_credentials'] = 'user/validate_credentials';

/*Orders*/
$route['admin/member-login'] = 'vc_site_admin/user/member_login';
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/order/add'] = 'vc_site_admin/order/add';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';
$route['admin/order/distribute/(:num)'] = 'vc_site_admin/order/order_distribute/$1';

/*customers*/
$route['admin/customer'] = 'vc_site_admin/customer/index';
$route['admin/a_webstore'] = 'vc_site_admin/customer/a_webstore';
$route['admin/activity_report'] = 'vc_site_admin/customer/activity_report';
$route['admin/affiliate_scheduled'] = 'vc_site_admin/customer/affiliate_scheduled';
$route['admin/myoffers'] = 'vc_site_admin/customer/myoffers';

$route['admin/micro'] = 'vc_site_admin/customer/micro';
$route['admin/macro'] = 'vc_site_admin/customer/macro'; 
$route['admin/mega'] = 'vc_site_admin/customer/mega'; 
$route['admin/customer/info/(:any)'] = 'vc_site_admin/customer/info';
$route['admin/customer/purchase_master'] = 'vc_site_admin/customer/purchase_master';
$route['admin/customer/online_purchase'] = 'vc_site_admin/customer/online_purchase';
$route['admin/customer/utility_purchase'] = 'vc_site_admin/customer/utility_purchase';
$route['admin/customer/services_purchase'] = 'vc_site_admin/customer/services_purchase';
$route['admin/customer/instore_purchase'] = 'vc_site_admin/customer/instore_purchase';
$route['admin/customer/macro_purchase'] = 'vc_site_admin/customer/macro_purchase';
$route['admin/customer/mega_purchase'] = 'vc_site_admin/customer/mega_purchase';
$route['admin/online_commision'] = 'vc_site_admin/customer/online_commision';
$route['admin/utility_commision'] = 'vc_site_admin/customer/utility_commision';
$route['admin/service_commision'] = 'vc_site_admin/customer/service_commision';
$route['admin/instore_commision'] = 'vc_site_admin/customer/instore_commision';
$route['admin/macro_commision'] = 'vc_site_admin/customer/macro_commision';
$route['admin/mega_commision'] = 'vc_site_admin/customer/mega_commision'; 
$route['admin/customer/online_bills'] = 'vc_site_admin/customer/online_bills'; 
$route['admin/customer/company_friend_circle'] = 'vc_site_admin/customer/company_friend_circle'; 
$route['admin/customer/transaction_wise_commission'] = 'vc_site_admin/customer/transaction_wise_commission'; 
$route['admin/customer/support_master'] = 'vc_site_admin/customer/support_master'; 
$route['admin/customer/payout_report'] = 'vc_site_admin/customer/payout_report'; 
$route['admin/customer/Online_bills_api'] = 'vc_site_admin/customer/Online_bills_api'; 
$route['admin/customer/Online_bills_without_api'] = 'vc_site_admin/customer/Online_bills_without_api'; 
$route['admin/customer/Online Purchase'] = 'vc_site_admin/customer/Online Purchase'; 
$route['admin/customer/product_master'] = 'vc_site_admin/customer/product_master'; 
$route['admin/customer/partners_master'] = 'vc_site_admin/customer/partners_master'; 
$route['admin/customer/TDS_Report'] = 'vc_site_admin/customer/TDS_Report'; 
$route['admin/customer/admin_charges_report'] = 'vc_site_admin/customer/admin_charges_report'; 
$route['admin/customer/direct_commission'] = 'vc_site_admin/customer/direct_commission'; 
$route['admin/customer/indirect_commission'] = 'vc_site_admin/customer/indirect_commission'; 
$route['admin/customer/replace_commission'] = 'vc_site_admin/customer/replace_commission'; 
$route['admin/customer/upgrade_mamber_commission'] = 'vc_site_admin/customer/upgrade_mamber_commission'; 
$route['admin/customer/commission_distribusion'] = 'vc_site_admin/customer/commission_distribusion'; 
$route['admin/customer/company_friend_circlee'] = 'vc_site_admin/customer/company_friend_circlee'; 
$route['admin/customer/friends_in_ciecle'] = 'vc_site_admin/customer/friends_in_ciecle'; 
$route['admin/customer/total_partners/(:any)'] = 'vc_site_admin/customer/total_partners'; 
$route['admin/customer/total_purchase/(:any)'] = 'vc_site_admin/customer/total_purchase'; 
$route['admin/customer/add'] = 'vc_site_admin/customer/add';
$route['admin/customer/edit/(:num)'] = 'vc_site_admin/customer/update/$1';
$route['admin/customer/del/(:num)'] = 'vc_site_admin/customer/del/$1';
$route['admin/uploadreceipts'] = 'vc_site_admin/customer/uploadreceipts';
$route['admin/uploadreceipts/edit/(:num)'] = 'vc_site_admin/customer/uploadreceipts_update/$1';
$route['admin/uploadreceipts/del/(:num)'] = 'vc_site_admin/customer/uploadreceipts_del/$1';


$route['admin/report/(:any)'] = 'vc_site_admin/customer/income_report';

/*Framchises */

$route['admin/franchise'] = 'vc_site_admin/category/contingency_index';
$route['admin/franchise/add'] = 'vc_site_admin/category/contingency_add';
$route['admin/franchise/edit/(:num)'] = 'vc_site_admin/category/contingency_update/$1';
$route['admin/franchise/del/(:num)'] = 'vc_site_admin/category/contingency_del/$1';



$route['admin/card_request'] = 'vc_site_admin/customer/card_request_list';
$route['admin/card_request/edit/(:num)'] = 'vc_site_admin/customer/card_request_update/$1';
$route['admin/card_request/del/(:num)'] = 'vc_site_admin/customer/card_request_del/$1';

$route['admin/activity_log'] = 'vc_site_admin/customer/activity_log';
$route['admin/activity_log/(:any)'] = 'vc_site_admin/customer/activity_log_by_id/$1';



$route['admin/wallet/add'] = 'vc_site_admin/customer/wallet';
$route['admin/wallet/history'] = 'vc_site_admin/customer/wallet_history';
$route['admin/wallet'] = 'vc_site_admin/customer/wallet_summery';

/*from brains*/
$route['admin/fund_request_list'] = 'vc_site_admin/customer/fund_request_list';
$route['admin/fund_request/edit/(:num)'] = 'vc_site_admin/customer/fund_request_update/$1';

/*review*/
$route['admin/review'] = 'vc_site_admin/review/index';
$route['admin/review/add'] = 'vc_site_admin/review/add';
$route['admin/review/edit/(:num)'] = 'vc_site_admin/review/update/$1';
$route['admin/review/del/(:num)'] = 'vc_site_admin/review/del/$1';

/*redeem*/
$route['admin/redeam'] = 'vc_site_admin/redeam/index';
$route['admin/redeam/add'] = 'vc_site_admin/redeam/add';
$route['admin/redeam/edit/(:num)'] = 'vc_site_admin/redeam/update/$1';
$route['admin/redeam/del/(:num)'] = 'vc_site_admin/redeam/del/$1';

/*Upgrade*/
$route['admin/upgrade'] = 'vc_site_admin/upgrade/index';
$route['admin/upgrade/add'] = 'vc_site_admin/upgrade/add';
$route['admin/upgrade/edit/(:num)'] = 'vc_site_admin/upgrade/update/$1';
$route['admin/upgrade/del/(:num)'] = 'vc_site_admin/upgrade/del/$1';

/*doc verification*/
$route['admin/docverification'] = 'vc_site_admin/docverification/index';
$route['admin/docverification/add'] = 'vc_site_admin/docverification/add';
$route['admin/docverification/edit/(:num)'] = 'vc_site_admin/docverification/update/$1';
$route['admin/docverification/del/(:num)'] = 'vc_site_admin/docverification/del/$1';

/*product*/
$route['admin/product'] = 'vc_site_admin/product/index';
$route['admin/product/add'] = 'vc_site_admin/product/add';
$route['admin/product/edit/(:num)'] = 'vc_site_admin/product/update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1';



/*Merchant product*/
$route['admin/m_product'] = 'vc_site_admin/product/merchant_product_list';
$route['admin/m_product/add'] = 'vc_site_admin/product/add';
$route['admin/m_product/edit/(:num)'] = 'vc_site_admin/product/merchant_product_update/$1';
$route['admin/m_product/del/(:num)'] = 'vc_site_admin/product/merchant_del/$1';



/*tax*/
$route['admin/tax'] = 'vc_site_admin/tax/index';
$route['admin/tax/add'] = 'vc_site_admin/tax/add';
$route['admin/tax/edit/(:num)'] = 'vc_site_admin/tax/update/$1';
$route['admin/tax/del/(:num)'] = 'vc_site_admin/tax/del/$1';

$route['admin/card'] = 'vc_site_admin/tax/card_list';
$route['admin/card/add'] = 'vc_site_admin/tax/card_add';
$route['admin/tax/del/(:any)'] = 'vc_site_admin/tax/card_del/$1';




$route['admin/category'] = 'vc_site_admin/category/index';
$route['admin/category/add'] = 'vc_site_admin/category/add';
$route['admin/category/edit/(:num)'] = 'vc_site_admin/category/update/$1';
$route['admin/category/del/(:num)'] = 'vc_site_admin/category/del/$1';

$route['admin/coupon'] = 'vc_site_admin/coupon/index';
$route['admin/coupon/add'] = 'vc_site_admin/coupon/add';
$route['admin/coupon/edit/(:num)'] = 'vc_site_admin/coupon/update/$1';
$route['admin/coupon/del/(:num)'] = 'vc_site_admin/coupon/del/$1';


$route['admin/seo'] = 'vc_site_admin/seo/index';
$route['admin/seo/add'] = 'vc_site_admin/seo/add';
$route['admin/seo/edit/(:num)'] = 'vc_site_admin/seo/update/$1';
$route['admin/seo/del/(:num)'] = 'vc_site_admin/seo/del/$1';

$route['admin/webstores'] = 'vc_site_admin/webstores/index';
$route['admin/webstores/add'] = 'vc_site_admin/webstores/add';
$route['admin/webstores/edit/(:num)'] = 'vc_site_admin/webstores/update/$1';
$route['admin/webstores/del/(:num)'] = 'vc_site_admin/webstores/del/$1';

/*sale*/
$route['admin/sale'] = 'vc_site_admin/sale/index';
$route['admin/allsale'] = 'vc_site_admin/sale/allsale';
$route['admin/sale/add'] = 'vc_site_admin/sale/add';
$route['admin/sale/edit/(:num)'] = 'vc_site_admin/sale/update/$1';
$route['admin/sale/invoice/(:num)'] = 'vc_site_admin/sale/invoice/$1';
$route['admin/sale/del/(:num)'] = 'vc_site_admin/sale/del/$1';



$route['admin/merchant'] = 'vc_site_admin/merchant/index';
$route['admin/merchant/add'] = 'vc_site_admin/merchant/add';
$route['admin/merchant/edit/(:num)'] = 'vc_site_admin/merchant/update/$1';
$route['admin/merchant/del/(:num)'] = 'vc_site_admin/merchant/del/$1';
/* Search */
$route['admin/search'] = 'vc_site_admin/search';


$route['admin/plan'] = 'vc_site_admin/plan/index';
$route['admin/plan/add'] = 'vc_site_admin/plan/add';
$route['admin/plan/edit/(:num)'] = 'vc_site_admin/plan/update/$1';
$route['admin/plan/del/(:num)'] = 'vc_site_admin/plan/del/$1';




$route['admin/moneyback-closing'] = 'vc_site_admin/pin/moneyback_closing';
?>

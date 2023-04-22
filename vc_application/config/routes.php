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
| URL normally follow this pattern:
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
$route['default_controller'] = 'customer_front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* User login & Signup */
$route['login'] = 'vc_site_admin/user/validate_credentials';
$route['uploadreadymodal'] = 'vc_site_admin/user/validate_upl_credentials';
$route['review'] = 'vc_site_admin/user/validate_review';
$route['forgetpassword'] = 'vc_site_admin/user/forgotPassword';
$route['logout'] = 'vc_site_admin/user/logout';
$route['admin/logout'] = 'vc_site_admin/user/logout';
$route ['register'] = 'vc_site_admin/user/create_member';
$route ['profile'] = 'vc_site_admin/user/profile';
$route ['reference/(:any)'] = 'customer_front';
$route ['get-bliss-code-by-phone'] = 'vc_site_admin/user/get_bliss_code_by_phone';

$route['merchant/(:num)'] = 'merchant/index';


$route['genratelink'] = 'page/genratelink';

$route['buy_privilege_card'] = 'page/buy_privilege_card';
$route['about'] = 'page/about';
$route['recharge'] = 'page/recharge';
$route['invite_friend'] = 'page/invite_friend';
$route['invite_friend/(:any)'] = 'page/invite_friend/$1';
$route['online_stores'] = 'page/online_stores';
$route['online_stores_cat/(:any)/(:num)'] = 'page/online_stores/$1';
$route['offline_stores'] = 'page/offline_stores';
$route['offline_stores_cat/(:any)/(:num)'] = 'page/offline_stores';
$route['how_it_works'] = 'page/how_it_works';
$route['services'] = 'page/services';
$route['packages'] = 'page/packages';
$route['regis'] = 'page/regis';
$route['testimonials'] = 'page/testimonials';
//$route['partner'] = 'page/partner';

  
$route['business_plan'] = 'page/business_plan';
$route['offers'] = 'page/offers';
$route['store_locator'] = 'page/store_locator';
$route['help'] = 'page/help';
$route['track_order'] = 'page/track_order';
$route['corporate'] = 'page/corporate';
$route['send_a_query'] = 'page/send_a_query';
$route['what_is_zoogol'] = 'page/what_is_zoogol';
$route['how_to_start'] = 'page/how_to_start';
$route['why_to_zoogol'] = 'page/why_to_zoogol';
$route['contact_us'] = 'page/contact_us';
$route['feedback'] = 'page/feedback';
$route['complaint'] = 'page/complaint';
$route['career'] = 'page/career';
$route['faq'] = 'page/faq';
$route['how_do_i_shop'] = 'page/how_do_i_shop';
$route['terms_of_use'] = 'page/terms_of_use';
$route['how_do_i_pay'] = 'page/how_do_i_pay';
$route['privacy'] = 'page/privacy';
$route['shipping_policy'] = 'page/shipping_policy';
$route['exchanges_return'] = 'page/exchanges_return';
$route['happy_hours'] = 'page/happy_hours';
$route['ways-to-earn'] = 'page/ways_to_earn';
$route['winners_league'] = 'page/winners_league';
$route['good_times'] = 'page/good_times';
$route['the_one'] = 'page/the_one';
$route['redirecting/(:any)/(:any)'] = 'page/redirecting';
$route['redirecting/(:num)'] = 'page/redirecting';

$route['online-store/(:any)/(:any)'] = 'page/o_stores';
$route['get_deal_data/(:any)'] = 'page/o_deals';


$route['cart'] = 'cart/index';
$route['cart/remove/(:any)'] = 'cart/remove/$1';
$route['checkout'] = 'checkout/index';
$route['payment'] = 'checkout/payment';
$route['ccavenue'] = 'checkout/ccavenue';
$route['thankyou'] = 'checkout/thankyou';
$route['search'] = 'product/search';

$route['category/(:any)'] = 'category/index';
$route['bliss-products'] = 'product/bliss_product_list';
$route['deals'] = 'deals/index';
$route['best_cashback_offer'] = 'deals/best_cashback_offer';
$route['best_deals_discount'] = 'deals/best_deals_discount';
$route['best_discount_coupons'] = 'deals/best_discount_coupons';

$route['new-arrivals'] = 'product/new_arrivals';
$route['stores'] = 'product/stores';
$route['wish-product/(:any)'] = 'product/bliss_product'; 
$route['product/(:any)'] = 'product/product';

// Package flow //
$route['package/(:any)'] = 'page/package/$1';
$route['pay/(:any)'] = 'page/pay/$1';

/* Admin */
$route['admin'] = 'vc_site_admin/profile/index';
$route['admin/profile'] = 'vc_site_admin/profile/profile';
$route['admin/kyc'] = 'vc_site_admin/profile/kyc';
$route['admin/profile_details'] = 'vc_site_admin/profile/profile_details';

// Select Package
$route['admin/start'] = 'vc_site_admin/profile/start';
$route['admin/select_package'] = 'vc_site_admin/profile/select_package';
$route['admin/package'] = 'vc_site_admin/profile/package';
$route['admin/select_plan'] = 'vc_site_admin/profile/select_plan';
$route['admin/package_selected_successfully'] = 'vc_site_admin/profile/package_selected_successfully';
$route['admin/confirm_plan'] = 'vc_site_admin/profile/confirm_plan';

/* Admin  upload receipt*/
$route['admin/uploadreceipts'] = 'vc_site_admin/profile/uploadreceipts';
$route['admin/uploadreceipts/add'] = 'vc_site_admin/profile/addreceipts';
$route['admin/activity_log'] = 'vc_site_admin/profile/activity_log';
$route['admin/franchisee'] = 'vc_site_admin/profile/franchisee';
$route['admin/income/show'] = 'vc_site_admin/profile/show_income';
$route['admin/income/(:any)'] = 'vc_site_admin/profile/income';
$route['admin/product'] = 'vc_site_admin/profile/product';

$route['admin/payment'] = 'vc_site_admin/profile/payment';
$route['paymentresponce/(:num)'] = 'page/paytmpaymentresponce/$1';

$route['admin/upgrade_account'] = 'vc_site_admin/profile/upgrade_account';
$route['admin/upgrade_user'] = 'vc_site_admin/profile/upgrade_user';
$route['admin/become_mega'] = 'vc_site_admin/profile/become_mega';
$route['admin/Payment_request/(:any)'] = 'vc_site_admin/profile/Payment_request';

$route['admin/add_member'] = 'vc_site_admin/profile/add_member';
$route['admin/member'] = 'vc_site_admin/profile/member';
$route['admin/member/(:num)'] = 'vc_site_admin/profile/member_view/$1'; 

/* from clickmedia */
$route['admin/recharge'] = 'vc_site_admin/profile/recharge';
$route['admin/wallet_history'] = 'vc_site_admin/profile/wallet_history';
$route['admin/working_wallet'] = 'vc_site_admin/profile/working_wallet';

/* from brainsecret */
$route['admin/request-fund'] = 'vc_site_admin/profile/request_fund';
$route['admin/transfer_master'] = 'vc_site_admin/profile/transfer_master';
$route['admin/add_money'] = 'vc_site_admin/profile/add_money';
$route['admin/macro_credits'] = 'vc_site_admin/profile/macro_credits';

/*
//$route['admin/uploadreceipts'] = 'vc_site_admin/uploadreceipts/index';

/* $route['admin/product/add'] = 'vc_site_admin/product/add';
$route['admin/product/edit/(:num)'] = 'vc_site_admin/product/update/$1';
$route['admin/product/del/(:num)'] = 'vc_site_admin/product/del/$1'; */


/* update Admin password */
$route['admin/password'] = 'vc_site_admin/password';

/*Orders*/
$route['admin/order'] = 'vc_site_admin/order/index';
$route['admin/order/(:num)'] = 'vc_site_admin/order/order_view/$1';
$route['admin/order/add'] = 'vc_site_admin/order/add';

/*profileupdate*/
$route['admin/proedit'] = 'vc_site_admin/proedit/index';
$route['admin/proedit/edit/(:num)'] = 'vc_site_admin/proedit/update/$1';

/*Distributor Level Information*/
$route['admin/DistributorLevelInformation'] = 'vc_site_admin/DistributorLevelInformation/index';
$route['admin/DistributorLevelInformation/(:num)'] = 'vc_site_admin/DistributorLevelInformation/index/$1';
$route['admin/pool_information'] = 'vc_site_admin/DistributorLevelInformation/pool_information';


/*Downline all*/
$route['admin/downlineall'] = 'vc_site_admin/downlineall/index';
$route['admin/downlineall/(:num)'] = 'vc_site_admin/downlineall/index/$1';
$route['admin/directs'] = 'vc_site_admin/profile/customer_directs';

/*Installments*/
$route['admin/installments'] = 'vc_site_admin/profile/installments';
$route['admin/installments/(:num)'] = 'vc_site_admin/profile/payment/$1';   
   
?>
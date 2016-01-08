<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['product'] 				        = "ProductController/listar";
$route['product/add'] 				    = "ProductController/add";
$route['product/edit'] 				    = "ProductController/edit";
$route['product/delete'] 				= "ProductController/delete";
$route['product/get/(:num)'] 			= "ProductController/get/$1";
$route['product/featured'] 				= "ProductController/featured";
$route['product/category/(:num)'] 		= "ProductController/category/$1";
$route['product/like'] 				    = "ProductController/like";
$route['product/unlike'] 				= "ProductController/unlike";

$route['product/image/add'] 			= "ProductImageController/add";
$route['product/image/get/(:num)'] 		= "ProductImageController/get/$1";
$route['product/image/all/(:num)'] 		= "ProductImageController/all/$1";
$route['product/image/delete'] 			= "ProductImageController/delete";

$route['product/size/(:num)'] 			= "ProductSizeController/listar/$1";
$route['product/size/update'] 			= "ProductSizeController/update";
$route['product/size/add'] 			    = "ProductSizeController/add";
$route['product/size/delete'] 			= "ProductSizeController/delete";

$route['user'] 			                = "UserController/listar";
$route['user/add'] 			            = "UserController/add";
$route['user/get/(:num)'] 			    = "UserController/get/$1";
$route['user/edit'] 			        = "UserController/edit";
$route['user/delete'] 			        = "UserController/delete";

$route['address/add'] 			        = "AddressController/add";
$route['address/get/(:num)'] 			= "AddressController/get/$1";
$route['address/edit'] 			        = "AddressController/edit";
$route['address/delete'] 			    = "AddressController/delete";
$route['address/all/(:num)'] 			= "AddressController/all";

$route['purchase/add'] 			        = "PurchaseController/add";
$route['purchase/get/(:num)'] 			= "PurchaseController/get/$1";
$route['purchase/cancel'] 			    = "PurchaseController/cancel";
$route['purchase/user/(:num)'] 			= "PurchaseController/user/$1";
$route['purchase/cancelrequest'] 		= "PurchaseController/cancelrequest";

$route['invoice/get/(:num)'] 		    = "InvoiceController/get/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
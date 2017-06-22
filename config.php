<?php 
	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/e-commerce/');
define('CART_COOKIE','SBwi72UCklwiqzz2');
define('CART_COOKIE_EXPIRE',time() + (86400 *30));
define('TAXRATE', 0.087); // sales tax rates. set to 0 if not charging.

define('CURRENCY', 'lev');
define('CHECKOUTMODE', 'TEST'); //change test to LIVE when you go live

if (CHECKOUTMODE == 'TEST') {
	define('STRIPE_PRIVATE', 'sk_test_5wigEyJ6Aj2I68t6pYIvWjKa');
	define('STRIPE_PUBLIC', 'pk_test_9IgG4lJEK8l5Ziug3WhDTu9j');
}

if (CHECKOUTMODE == 'LIVE') {
	define('STRIPE_PRIVATE', 'sk_live_zArAb5M4zQbddQQSFWBM1IAX');
	define('STRIPE_PUBLIC', 'pk_live_GASiD1JkBLcikRRFyU6KQZr9');
}
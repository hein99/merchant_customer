<?php
#page Titles
define('WEB_NAME', 'The Best Shop');

#page Url
define('URL', 'http://localhost/merchant_customer');
define('FILE_URL', 'http://localhost/merchant_customer');
define('OTHER_FILE_URL', 'http://localhost/merchant');


#DB Information
define('DB_DSN', 'mysql:host=localhost;dbname=merchant');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

define('TBL_USERS_ACCOUNT', 'users');
define('TBL_CUSTOMER_STATEMENT', 'customer_statement');
define('TBL_CUSTOMER_ORDER', 'customer_order');
define('TBL_MEMBERSHIP', 'membership');
define('TBL_LOGIN_RECORD', 'login_record');
define('TBL_MESSAGE_RECORD', 'message_record');
define('TBL_PASSWORD_REQUEST', 'password_request');
define('TBL_EXCHANGE_RATE', 'exchange_rate');

#Error status
$ERR_STATUS = 0;

#Error status code
define('ERR_CONTROLLER', 1);
define('ERR_ACTION', 2);
define('ERR_FORM', 3);
define('ERR_URL', 4); // for URL query (i.e. http://localhost/merchat/order/get_orders?order_status=5) order_status does not contain 5.

 ?>

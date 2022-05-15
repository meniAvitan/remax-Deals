<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'remaxdeals');

define('SITE_URL', "http://localhost/remaxLeads/");

include 'DB_connection.php';
$db = new DB_connection;


function base_url($endUrl){
    echo SITE_URL.$endUrl;
}




?>
<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');

require('update.class.php');

$obj = new Update();
$obj->parse($_config['ol_last_updation']);

header('Location: index_admin.php');

?>
<?php


$order_id=$_GET['order-id'];

require("../module/DBconection.php");
$DB = new db();
$result = $DB->update_data('Orders'," Status='Canceled' "," Order_ID='$order_id'");


header("Location: http://localhost/proj_php/view/user/myOrders.php?page-nr=1");





?>
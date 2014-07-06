<?php
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	
	$name = clearStr($_POST['name']);
	$email = clearStr($_POST['email']);
	$phone = clearStr($_POST['phone']);
	$address = clearStr($_POST['address']);
	$orderId = $basket['orderid'];
	$orderTime = time();
	$order = "$name|$email|$phone|$address|$orderId|$orderTime\n";
	file_put_contents('admin/'.ORDER_LOG, $order, FILE_APPEND);
	saveOrder($orderTime);
?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>
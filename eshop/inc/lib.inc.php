<?php
function clearInt($data){
	return abs((int)$data);
}

function clearStr($data){
global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}
//catalog 
function addItemToCatalog($title, $author, $pubyear, $price){
	global $link;
	$sql = "INSERT INTO Catalog(title, author, pubyear, price) VALUES(?, ?, ?, ?)";
	if(!$stmt = mysqli_prepare($link, $sql))
		return false;
	mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	return true;
}

function selectAllItems(){
	global $link;
	$sql = "SELECT id, title, author, pubyear, price
			FROM catalog";
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;
}
//Shopping Cart
function basketInit(){
	global $basket, $count;
	if(!isset($_COOKIE['basket'])){
		$basket = array('orderid' => uniqid());
		saveBasket();
	}else{
		$basket = unserialize(base64_decode($_COOKIE['basket']));
		$count = count($basket) - 1;
	}
}

function add2Basket($id, $qty){
	global $basket;
	$basket[$id] = $qty;
	saveBasket();
}

function saveBasket(){
	global $basket;
	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, strtotime('+1 year'));
}

function myBasket(){
	global $link, $basket;
	$goods = array_keys($basket);
	array_shift($goods);
	if(!count($goods))
		return array();
	$ids = implode(",", $goods);
	$sql = "SELECT id, title, author, pubyear, price
			FROM catalog
			WHERE id IN ($ids)";
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = result2Array($result);
	mysqli_free_result($result);
	return $items;
}

function result2Array($data){
	global $basket;
	$arr = array();
	while($row = mysqli_fetch_assoc($data)){
		$row['quantity'] = $basket[$row['id']];
		$arr[] = $row;
	}
	return $arr;
}

function deleteItemFromBasket($id){
	global $basket;
	unset($basket[$id]);
	saveBasket();
}
//Orders
function saveOrder($dt){
	global $link, $basket;
	$goods = myBasket();
	$stmt = mysqli_stmt_init($link);
	$sql = "INSERT INTO orders(title, author, pubyear, price, quantity, orderid, datetime)
			VALUES(?,?,?,?,?,?,?)";
	if(!mysqli_stmt_prepare($stmt, $sql))
		return false;
	foreach($goods as $item){
		mysqli_stmt_bind_param($stmt, "ssiiisi", $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $basket['orderid'], $dt);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
	setcookie('basket', '', time() - 3600);
	return true;
}

function getOrders(){
	global $link;
	if(!is_file(ORDER_LOG))
		return false;
	$orders = file(ORDER_LOG);
	$allOrders = array();
	foreach($orders as $order){
		list($name, $email, $phone, $address, $orderId, $orderTime) = explode("|", $order);
		$orderInfo = array();
		$orderInfo['name'] = $name;
		$orderInfo['email'] = $email;
		$orderInfo['phone'] = $phone;
		$orderInfo['address'] = $address;
		$orderInfo['orderId'] = $orderId;
		$orderInfo['orderTime'] = $orderTime;
		$sql = "SELECT title, author, pubyear, price, quantity
				FROM orders
				WHERE orderid = '$orderId'";
		if(!$result = mysqli_query($link, $sql))
			return false;
		$orderInfo['products'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		$allOrders[] = $orderInfo;
	}
	return $allOrders;
	
}















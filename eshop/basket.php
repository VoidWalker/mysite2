<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
?>
<html>
<head>
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
$goods = myBasket();
if(!is_array($goods)){
	echo "Error has occurred!";
	exit;
}
if($goods){
	echo "<p>Go back to <a href='catalog.php'>catalog</a>.</p>";
}else{
	echo "<p>Empty basket. Go back to <a href='catalog.php'>catalog</a>.</p>";
}
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
	$i = 1; $sum = 0;
	foreach($goods as $item){
	?>
		<tr>
			<td><?= $i?></td>
			<td><?= $item['title']?></td>
			<td><?= $item['author']?></td>
			<td><?= $item['pubyear']?></td>
			<td><?= $item['price']?></td>
			<td><?= $item['quantity']?></td>
			<td><a href="delete_from_basket.php?id=<?=$item['id']?>">Delete</a></td>
		</tr>
	<?php
		$i++;
		$sum += $item['price'] * $item['quantity'];
	}
?>
</table>

<p>Grand total: <?= $sum?> $</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>








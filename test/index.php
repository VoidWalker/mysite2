<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if(!isset($_SESSION['test']) and !isset($_POST['q'])){
	$q = 0;
	$title = 'Pass quiz';
}else{
	if($_POST['q'] != '1')
		$_SESSION['test'][] = $_POST['answer'];
	$q = $_POST['q'];
	$title = $_POST['title'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Тест</title>
</head>
<body>

<table width="50%" border="1" align='center'>

<tr>
	<td align="center">
		<!-- Верхняя часть страницы -->
		<table width="100%">
			<tr>
				<td align="center">
					<h1><?= $title?></h1>
					<p><a href='/index.php'>Прервать тест и вернуться на сайт</a></p>
				</td>
			</tr>
		</table>
		<!-- Верхняя часть страницы -->
	</td>
</tr>

<tr>
	<td>
		<!-- Область основного контента -->
		<?php 
			switch($q){
				case 0: include 'start.php'; break;
				case 1: include 'q1.php'; break;
				case 2: include 'q2.php'; break;
				case 3: include 'q3.php'; break;
				default: include 'result.php';
			}
		?>
		<!-- Область основного контента -->
	</td>
</tr>
</table>

</body>
</html>
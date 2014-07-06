<?php
$result = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
	$subj = trim(strip_tags($_POST['subject']));
	$body = trim(strip_tags($_POST['body']));
	if(mail('sohanoleksa@gmail.com', $subj, $body, 'From: webmaster@example.com')){
		$result = 'Letter has been sent';
	}else{
		$result = 'Error has occurred';
	}
}
?>
<h3>Адрес</h3>
<p>123456 Москва, Малый Американский переулок 21</p>
<h3>Задайте вопрос</h3>
<p><?=$result?></p>
<form action='<?= $_SERVER['REQUEST_URI']?>' method='post'>
	<label>Тема письма: </label><br />
	<input name='subject' type='text' size="50"/><br />
	<label>Содержание: </label><br />
	<textarea name='body' cols="50" rows="10"></textarea><br /><br />
	<input type='submit' value='Отправить' />
</form>	

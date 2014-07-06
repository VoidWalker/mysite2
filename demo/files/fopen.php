<?php
	header('Content-type: text/html; charset=utf-8');
?>
<HTML>
<HEAD>
<TITLE>fopen</TITLE>
</HEAD>
<BODY>
<?php
	$myFile = fopen("data.txt", "r") or die("Не могу открыть файл");
	echo 'Файл успешно открыт для чтения<br/>';
	fclose($myFile);
	echo 'Файл закрыт';

	
?>
</BODY>
</HTML>
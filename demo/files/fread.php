<HTML>
<HEAD>
<TITLE>fread</TITLE>
</HEAD>
<BODY>
<?php
	$myFile = fopen("data.txt", "r") or die("Не могу открыть файл");
	
	fpassthru($myFile);
	//echo fread($myFile, 1024);
	fclose($myFile);
	
		
?>
</BODY>
</HTML>
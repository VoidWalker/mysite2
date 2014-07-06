<HTML>
<HEAD>
<TITLE>fgets</TITLE>
</HEAD>
<BODY>
<pre>
<?php
	if($myFile = fopen("data.txt", "r")){
		$lines = array();
		
		while(!feof($myFile)){
			$lines[] = fgets($myFile);
		}
		
		fclose($myFile);
		print_r($lines);
	}	
?>
</BODY>
</HTML>
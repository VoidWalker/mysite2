<HTML>
<HEAD>
<TITLE>fgetc</TITLE>
</HEAD>
<BODY>
<pre>
<?php
	if($myFile = fopen("data.txt", "r")){
		$chars = array();
		
		while($myCharacter = fgetc($myFile)){
			$chars[] = $myCharacter;
		}
		
		fclose($myFile);
		print_r($chars);
	}	
?>
</BODY>
</HTML>
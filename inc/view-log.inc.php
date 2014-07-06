<?php
if(file_exists("log/".PATH_LOG)){
	$log = file('log/'.PATH_LOG);
	if(is_array($log)){
		echo '<ol>';
		foreach($log as $item){
			list($dt, $page, $ref) = explode('@', $item);
			$dt = date('d-m-Y H:i:s', (int)$dt);
			echo "<li>$dt: $ref => $page</li>";
			}
		echo '</ol>';
	}
}
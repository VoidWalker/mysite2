<pre>
<?php
$link = mysqli_connect('localhost', 'root','','web');
mysqli_query($link, "SET NAMES 'cp1251'");

$query = 'SELECT * FROM teachers';
$res = mysqli_query($link, $query) or die(mysqli_error($link));
mysqli_close($link);
//echo mysqli_num_fields($res);
$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
print_r($row);

?>
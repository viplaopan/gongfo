<?php 
$dir="./Public/";
$file=scandir($dir);
foreach($file as $val){
	echo '<a href="' .$val. '">$val</a><br/>';
}
?>

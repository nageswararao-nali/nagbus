<?php
mysql_connect("localhost","laabus_varini","Mylife@GOD432") or die(mysql_error());
mysql_select_db("laabus_varini") or die(mysql_error());

$sql = "select * from admin limit 1";
$res = mysql_query($sql);
$rows = mysql_fetch_array($res);
print_r($rows);
?>
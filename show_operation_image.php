<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$opid=$_GET['opid'];
//print_r($_POST);
$query="SELECT * FROM Operation WHERE Operation_ID='$opid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$row = mysql_fetch_assoc($resa);
$preview='/drawings/'.$row['Operation_Image'];
print("<img src=\"$preview\" width=\"100%\">");
?>
<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$toolid=$_POST['Tool_ID_1'];
$qty=$_POST['toolqty'];

$query="SELECT Qty_New,Qty_Shop FROM Tool_Qty WHERE Tool_ID='$toolid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_assoc($res);

if($row['Qty_New']>=$qty)
{
	echo "1";
}else

{
		echo "0";
}

?>
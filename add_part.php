<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
print_r($_POST);
print_r($_FILES);


/*
if(isSet($_FILES))
{
	$fileName = $_FILES['drg']['name'];
	$tmpName = $_FILES['drg']['tmp_name'];
	$fileSize = $_FILES['drg']['size'];
	$fileType = $_FILES['drg']['type'];
print("file name=$fileName temp name=$tmpName file size=$fileSize type=$fileType");
}
/*
$custid=$_POST['Customer_ID'];
$drawingno=$_POST['drawingno'];
$componentname=$_POST['componentname'];
$price=$_POST['price'];


$query="INSERT INTO Components (Customer_ID,Drawing_NO,Component_Name,Price) ";
$query.="VALUES('$custid','$drawingno','$componentname','$price');";

print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Component $componentname with a price of $price");	
	
}else
	{
		print("Error Adding");
	}

*/
?>
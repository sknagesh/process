<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$supplier=$_POST['supplier'];
$contact=$_POST['contact'];
if(isSet($_POST['phone'])){$phone=$_POST['phone'];}else{$phone="";}
if(isSet($_POST['brands'])){$brands=$_POST['brands'];}else{$brands="";}

$query="INSERT INTO Supplier (Supplier_Name,
								Contact_Name,
								Supplier_Phone,
								Supplier_Brands) ";
$query.="VALUES('$supplier',
				'$contact',
				'$phone',
				'$brands');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Supplier $supplier");	
	
}else
	{
		print("Error Adding");
	}


?>
<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$toolid=$_POST['Tool_ID_1'];
$qty=$_POST['toolqty'];
$action=$_POST['adddrw'];
$ttype=$_POST['resha'];

$ok=0;
$query="SELECT Qty_New,Qty_Resharp,Qty_Shop_New,Qty_Shop_Resharp FROM Tool_Qty WHERE Tool_ID='$toolid';";
$msg="";
//print($query);

$res=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_assoc($res);

if($action=='withdraw')
{

	if($ttype=='newtool')
	{

		if($qty>$row['Qty_New'])
				{
			 $msg="There are only $row[Qty_New] tools in stock, Please enter correct quantity";
			 $ok=1;
			 	}		
	}else
		if($ttype=='resharpened')
		{
				if($qty>$row['Qty_Resharp'])
				{
				$msg="There are only $row[Qty_Resharp] resharpened tools in stock, Please enter correct quantity";
				$ok=1;
				}
		}
		
	
}else
if($action=='remove')
{

	if($ttype=='newtool')
	{

		if($qty>$row['Qty_Shop_New'])
				{
			 $msg="There are only $row[Qty_Shop_New] tools in shop flor, Please enter correct quantity";
			 $ok=1;
			 	}		
	}else
		if($ttype=='resharpened')
		{
				if($qty>$row['Qty_Shop_Resharp'])
				{
				$msg="There are only $row[Qty_Shop_Resharp] resharpened tools in shop floor, Please enter correct quantity";
				$ok=1;
				}
		}
		
	
}else
{	
	if($action=='add')
	{

	if($ttype=='newtool')
	{
		$msg="Presently there are $row[Qty_New] New tools in stock";
		
	}else
		if($ttype=='resharpened')
		{
			$msg="Presently there are $row[Qty_Resharp] Resharpened tools in stock";
		}
		
		
	}
}
$textmessag=$msg."<|>".$ok;
print($textmessag);
?>
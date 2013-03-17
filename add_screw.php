<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());

$toolid=$_POST['Tool_ID'];
$spno=$_POST['spno'];
$sdesc=$_POST['sdesc'];
$wpno=$_POST['wpno'];
if(isSet($_POST['wdesc'])){$wdesc=$_POST['wdesc'];}else{$wdesc="";}

$query="INSERT INTO Screws_Wrench (Tool_ID,
								Screw_Part_NO,
								Screw_Desc,
								Wrench_Part_NO,
								Wrench_Desc) ";
$query.="VALUES('$toolid',
				'$spno',
				'$sdesc',
				'$wpno',
				'$wdesc');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Screw $spno - $sdesc and Key $wpno $wdesc");	
	
}else
	{
		print("Error Adding");
	}


?>
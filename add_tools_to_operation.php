<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
//print_r($_FILES);
$opid=$_POST['Operation_ID'];
$addedtools=$_POST['addedtools'];
$nooftools=$_POST['nooftools'];

$tlist=explode(",", $addedtools);

	$j=0;
	$k=0;
	while($j<$nooftools)
	{
		$Tool_ID_1[$j]=$tlist[$k];
		$k++;
		$Tool_ID_2[$j]=$tlist[$k];
		$k++;
		$Holder_ID[$j]=$tlist[$k];
		$k++;
		$Ope_Tool_Desc[$j]=$tlist[$k];
		$k++;
		$Ope_Tool_OH[$j]=$tlist[$k];
		$k++;
		$Ope_Tool_Life[$j]=$tlist[$k];
		$k++;
		$j++;
	}

$j=0;
$toolsadded=0;
while($j<$nooftools	)
{
$query="INSERT INTO Ope_Tools (Operation_ID,Tool_ID_1,Tool_ID_2,Holder_ID,Ope_Tool_Desc,Ope_Tool_OH,Ope_Tool_Life) 
		VALUES('$opid','$Tool_ID_1[$j]','$Tool_ID_2[$j]','$Holder_ID[$j]','$Ope_Tool_Desc[$j]','$Ope_Tool_OH[$j]','$Ope_Tool_Life[$j]');";

print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
$toolsadded+=1;	
	
}
$j++;
}

print("$toolsadded Tools Added");
?>
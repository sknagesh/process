<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
$drawid=$_POST['Drawing_ID'];
$opedesc=$_POST['opdesc'];
if(isSet($_POST['ctime'])){$ctime=$_POST['ctime'];}else{$ctime="";}
if(isSet($_POST['mtime'])){$mtime=$_POST['mtime'];}else{$mtime="";}
if(isSet($_POST['fixtno'])){$fixtno=$_POST['fixtno'];}else{$fixtno="";}
if(isSet($_POST['progno'])){$progno=$_POST['progno'];}else{$progno="";}

if($ctime!="")
{
	$t=secs2hms($ctime*60);
	$cltime=$t[0].':'.$t[1].':'.$t[2];
}

if($mtime!="")
{
	$t=secs2hms($mtime*60);
	$mctime=$t[0].':'.$t[1].':'.$t[2];

}

if(isSet($_FILES['oimg']['name']))
{
	$drgfileName = $drawid."-".$_FILES['oimg']['name'];
	$drgtmpName = $_FILES['oimg']['tmp_name'];
	$drgfileSize = $_FILES['oimg']['size'];
	$drgfileType = $_FILES['oimg']['type'];
	$drgfilePath = $uploadDir . $drgfileName;
	$result = move_uploaded_file($drgtmpName, $drgfilePath);
	if (!$result) {
						echo "<br>Error uploading Drawing $drgfileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$drgfileName = addslashes($drgfileName);
						$drgfilePath = addslashes($drgfilePath);
						}

}else{$drgfileName='';}









$query="INSERT INTO Operation (Drawing_ID,
								Operation_Desc,
								Clamping_Time,
								Machining_Time,
								Fixture_NO,
								Program_NO,
								Operation_Image) 
	 						VALUES('$drawid',
									'$opedesc',
									'$cltime',
									'$mctime',
									'$fixtno',
									'$progno',
									'$drgfileName');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Operaton $opedesc");	
	
}else
	{
		print("Error Adding");
	}


?>
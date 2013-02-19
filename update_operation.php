<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
$opid=$_POST['Operation_ID'];
$drawid=$_POST['Drawing_ID'];
$opedesc="Operation_Desc=\"".$_POST['opdesc']."\"";
if(isSet($_POST['ctime'])){$ctime=$_POST['ctime'];}else{$ctime="";}
if(isSet($_POST['mtime'])){$mtime=$_POST['mtime'];}else{$mtime="";}
if(isSet($_POST['fixtno'])){$fixtno="Fixture_NO=\"".$_POST['fixtno']."\"";}else{$fixtno="";}
if(isSet($_POST['progno'])){$progno="Program_NO=\"".$_POST['progno']."\"";}else{$progno="";}
if(isSet($_POST['onote'])){$onote="Operation_Notes=\"".$_POST['onote']."\"";}else{$onote="";}


if($ctime!="")
{
	$t=secs2hms($ctime*60);
	$cltime="Clamping_Time=\"".$t[0].':'.$t[1].':'.$t[2]."\"";
}

if($mtime!="")
{
	$t=secs2hms($mtime*60);
	$mctime="Machining_Time=\"".$t[0].':'.$t[1].':'.$t[2]."\"";

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
						$drgfileName = "Operation_Image=\"".addslashes($drgfileName)."\"";
						$drgfilePath = addslashes($drgfilePath);
						}

}else{$drgfileName='';}

if(isSet($_FILES['odwg']['name']))
{
	$odrgfileName = $drawid."-".$_FILES['odwg']['name'];
	$odrgtmpName = $_FILES['odwg']['tmp_name'];
	$odrgfileSize = $_FILES['odwg']['size'];
	$odrgfileType = $_FILES['odwg']['type'];
	$odrgfilePath = $uploadDir . $odrgfileName;
	$oresult = move_uploaded_file($odrgtmpName, $odrgfilePath);
	if (!$oresult) {
						echo "<br>Error uploading Operation Drawing $odrgfileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$odrgfileName = "Operation_Drawing=\"".addslashes($odrgfileName)."\"";
						$odrgfilePath = addslashes($odrgfilePath);
						}

}else{$odrgfileName='';}

$query="UPDATE Operation SET $opedesc ";
if($cltime!=''){$query.=",$cltime";}
if($mctime!=''){$query.=",$mctime";}
if($fixtno!=''){$query.=",$fixtno";}
if($progno!=''){$query.=",$progno";}
if($drgfileName!=''){$query.=",$drgfileName";}
if($odrgfileName!=''){$query.=",$odrgfileName";}
if($onote!=''){$query.=",$onote";}
$query.=" WHERE Operation_ID='$opid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Updated Operaton $opedesc");	
	
}else
	{
		print("<BR>Error Updating Operation");
	}


?>
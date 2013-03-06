<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
//print_r($_POST);
//print_r($_FILES);
$custid=$_POST['Customer_ID'];
$drawingid=$_POST['Drawing_ID'];
$drawingno=$_POST['Drawing_NO'];
$componentname="Component_Name=\"".$_POST['componentname']."\"";
if(isSet($_POST['mspec'])){$mspec="Component_Material=\"".$_POST['mspec']."\"";}else{$mspec="";}
if(isSet($_POST['cblank'])){$cblank="Cut_Blank=\"".$_POST['cblank']."\"";}else{$cblank="";}
if(isSet($_POST['pmblank'])){$pmblank="Pre_Machined_Blank=\"".$_POST['pmblank']."\"";}else{$pmblank="";}


if(isSet($_FILES['drg']['name']))
{
	$drgfileName = $drawingno."-".$_FILES['drg']['name'];
	$drgtmpName = $_FILES['drg']['tmp_name'];
	$drgfileSize = $_FILES['drg']['size'];
	$drgfileType = $_FILES['drg']['type'];
	$drgfilePath = $uploadDir . $drgfileName;
	if(file_exists($drgfilePath))
		{
			unlink($drgfilePath);
		}



	$result = move_uploaded_file($drgtmpName, $drgfilePath);
	chmod($drgfilePath, 777);
	if (!$result) {
						echo "<br>Error uploading Drawing $drgfileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$drgfileName = "Drawing_File=\"".addslashes($drgfileName)."\"";
						$drgfilePath = addslashes($drgfilePath);
						}

}else{$drgfileName='';}

if(isSet($_FILES['process']['name']))
{
	$profileName = $drawingno."-".$_FILES['process']['name'];
	$protmpName = $_FILES['process']['tmp_name'];
	$profileSize = $_FILES['process']['size'];
	$profileType = $_FILES['process']['type'];
	$profilePath = $uploadDir . $profileName;

if(file_exists($profilePath))
{
print("File is there so unlinking");
	chmod($profilePath, 777);
	unlink($profilePath);
	
}
	$result = move_uploaded_file($protmpName, $profilePath);
	chmod($profilePath, 777);


	
	if (!$result) {
						echo "<br>Error uploading Drawing $profileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$profileName = "Process_Sheet=\"".addslashes($profileName)."\"";
						$profilePath = addslashes($profilePath);
						}

}else{$profileName='';}


if(isSet($_FILES['gage']['name']))
{
	$gagefileName = $drawingno."-".$_FILES['gage']['name'];
	$drgtmpName = $_FILES['gage']['tmp_name'];
	$drgfileSize = $_FILES['gage']['size'];
	$drgfileType = $_FILES['gage']['type'];
	$drgfilePath = $uploadDir . $gagefileName;
		if(file_exists($drgfilePath))
		{
		unlink($drgfilePath);
		}


	$result = move_uploaded_file($drgtmpName, $drgfilePath);
		chmod($drgfilePath, 777);
	if (!$result) {
						echo "<br>Error uploading Gage and Pin List $gagefileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$gagefileName = "Gage_List=\"".addslashes($gagefileName)."\"";
						$drgfilePath = addslashes($drgfilePath);
						}

}else{$gagefileName='';}


if(isSet($_FILES['preview']['name']))
{
	$prefileName = $drawingno."-".$_FILES['preview']['name'];
	$pretmpName = $_FILES['preview']['tmp_name'];
	$prefileSize = $_FILES['preview']['size'];
	$prefileType = $_FILES['preview']['type'];
	$prefilePath = $uploadDir . $prefileName;

		if(file_exists($prefilePath))
		{
			unlink($prefilePath);
		}


	$result = move_uploaded_file($pretmpName, $prefilePath);
		chmod($prefilePath, 777);
	if (!$result) {
						echo "<br>Error uploading Drawing $prefileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$prefileName = "Preview_Image=\"".addslashes($prefileName)."\"";
						$prefilePath = addslashes($prefilePath);
						}

}else{$prefileName='';}


$query="UPDATE Part set $componentname";
						if($mspec!=''){$query.=",$mspec";}
						if($cblank!=''){$query.=",$cblank";}
						if($pmblank!=''){$query.=",$pmblank";}
						if($drgfileName!=''){$query.=",$drgfileName";}
						if($profileName!=''){$query.=",$profileName";}
						if($gagefileName!=''){$query.=",$gagefileName";}
						if($prefileName!=''){$query.=",$prefileName";}
						$query.=" WHERE Drawing_ID=$drawingid;";


//print($query);


$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Updated Component $componentname - $drawingno");	
	
}else
	{
		print("Error Updating Part");
	}


?>
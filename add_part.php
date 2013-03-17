<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
//print_r($_POST);
//print_r($_FILES);
$custid=$_POST['Customer_ID'];
$drawingno=$_POST['drawingno'];
$componentname=$_POST['componentname'];
if(isSet($_POST['mspec'])){$mspec=$_POST['mspec'];}else{$mspec="";}
if(isSet($_POST['cblank'])){$cblank=$_POST['cblank'];}else{$cblank="";}
if(isSet($_POST['pmblank'])){$pmblank=$_POST['pmblank'];}else{$pmblank="";}


if(isSet($_FILES['drg']['name']))
{
	$drgfileName = $drawingno."-".$_FILES['drg']['name'];
	$drgtmpName = $_FILES['drg']['tmp_name'];
	$drgfileSize = $_FILES['drg']['size'];
	$drgfileType = $_FILES['drg']['type'];
	$drgfilePath = $uploadDir . $drgfileName;
	$result = move_uploaded_file($drgtmpName, $drgfilePath);
	chmod($drgfilePath, 777);
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

if(isSet($_FILES['process']['name']))
{
	$profileName = $drawingno."-".$_FILES['process']['name'];
	$protmpName = $_FILES['process']['tmp_name'];
	$profileSize = $_FILES['process']['size'];
	$profileType = $_FILES['process']['type'];
	$profilePath = $uploadDir . $profileName;
	$result = move_uploaded_file($protmpName, $profilePath);
		chmod($profilePath, 777);
	if (!$result) {
						echo "<br>Error uploading Drawing $profileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$profileName = addslashes($profileName);
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
	$result = move_uploaded_file($drgtmpName, $drgfilePath);
		chmod($drgfilePath, 777);
	if (!$result) {
						echo "<br>Error uploading Gage and Pin List $gagefileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$gagefileName = addslashes($gagefileName);
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
	$result = move_uploaded_file($pretmpName, $prefilePath);
		chmod($prefilePath, 0777);
	if (!$result) {
						echo "<br>Error uploading Drawing $prefileName";
						exit;
						}

	if(!get_magic_quotes_gpc())
						{
						$prefileName = addslashes($prefileName);
						$prefilePath = addslashes($prefilePath);
						}

}else{$prefileName='';}






$query="INSERT INTO Part (Customer_ID,
								Drawing_NO,
								Component_Name,
								Component_Material,
								Cut_Blank,
								Pre_Machined_Blank,
								Drawing_File,
								Process_Sheet,
								Preview_Image,
								Gage_List) ";
$query.="VALUES('$custid',
				'$drawingno',
				'$componentname',
				'$mspec',
				'$cblank',
				'$pmblank',
				'$drgfileName',
				'$profileName',
				'$prefileName',
				'$gagefileName');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Component $componentname - $drawingno");	
	
}else
	{
		print("Error Adding");
	}


?>
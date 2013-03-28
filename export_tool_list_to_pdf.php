<?php
error_reporting(E_ERROR|E_PARSE);
include('dewdb.inc');
require('fpdf.php');
require('cellfit.php');

//print_r($_POST);
$did=$_GET['Drawing_ID'];
//print($did);
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());

$query="SELECT * FROM Part WHERE Drawing_ID=$did;";

$r=mysql_query($query) or die(mysql_error());
$rope=mysql_fetch_assoc($r);

$Drawing_NO=$rope['Drawing_NO'];
$Component_Name=$rope['Component_Name'];


class PDF_SKN extends PDF_CellFit
{
// Page header
	function Header()
	{
		$partno=$GLOBALS['Drawing_NO'];
		$partname=$GLOBALS['Component_Name'];
   
    
    	$this->SetFont('Arial','',16);
    	$this->CellFitScale(100,18,'Divya Engineering Works (P) Ltd, Mysore',1,0,'C');
		$this->CellFitScale(100,18,'CNC Machining Tool List',1,0,'C');
		$this->SetFont('Arial','', 10);
		$this->Cell(75,6,'Doc. Ref: '.'DEW/PRD/D/03','T R',2,'L');
		$this->Cell(75,6,'REV NO: 00','T B R',2,'L');
		$this->Cell(75,6,'DATE: 01-06-2003','R',0,'L');
		$this->ln();
    	$this->Cell(200,6,'Part Name: '.$partname,'L T R',0,'L');
    	$this->Cell(75,6,'Drg No and Rev No: '.$partno,'T R',1,'L');
		$this->Cell(200,6,'Customer Name: ','L B R',0,'L');
    	$this->Cell(50,6,'Date: '.date('d-m-Y'),'T B R',0,'L');
		$this->Cell(25,6,'Page '.$this->PageNo().'/{nb}','T B R',1,'C');	


	}

	function Footer()
	{
    	// Position at 1.5 cm from bottom
    	$this->SetY(-35);
		// Arial italic 8
    	$this->SetFont('Arial','',16);
		$this->Cell(220,10,"Prepared By: S.K.N ",'0',0,'L');
		$this->Cell(140,10,"Approved By: M.N.V",'0',1,'L');
	
	    // Page number
    	$this->SetY(-10);
    	$this->SetFont('Arial','',6);

		}
}




$pdf = new PDF_SKN();
$pdf->AliasNbPages();
$pdf->setAutoPageBreak(1,35);
$pdf->AddPage('L','A4');
$pdf->SetFont('Arial','',10);


$q2="SELECT * FROM Operation WHERE Drawing_ID=$did;";

$rr=mysql_query($q2) or die(mysql_error());
$noofop=mysql_affected_rows();
$pn=0;
while($row=mysql_fetch_assoc($rr))
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,8,'Operation Description '. $row['Operation_Desc']."  Program No: ".$row['Program_NO'],1,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,8,'SL No',1,0,'C');
$pdf->Cell(135,8,'Tool Part No and Description',1,0,'L');
$pdf->Cell(25,8,'Tool Holder',1,0,'L');
$pdf->Cell(25,8,'Tool Overhang',1,0,'C');
$pdf->Cell(80,8,'Work Description',1,1,'L');
$pdf->SetFont('Arial','',10);

	$q3="SELECT Tool_Part_NO,Tool_Desc,Tool_Dia,Ope_Tool_OH,Ope_Tool_Desc,Holder_Desc FROM Ope_Tools AS ot  
				INNER JOIN Tool as t ON t.Tool_ID=ot.Tool_ID_1
				INNER JOIN Holder AS h ON h.Holder_ID=ot.Holder_ID
				WHERE ot.Operation_ID='$row[Operation_ID]';";
		$rr3=mysql_query($q3) or die(mysql_error());
$n=1;
	while($rowi=mysql_fetch_assoc($rr3))
	{
		$pdf->Cell(10,8,$n,1,0,'C');
		$pdf->Cell(135,8,$rowi[Tool_Desc]." (".$rowi[Tool_Part_NO].")",1,0,'L');
		$pdf->CellFitScale(25,8,$rowi[Holder_Desc],1,0,'L');
		$pdf->Cell(25,8,$rowi[Ope_Tool_OH],1,0,'C');
		$pdf->CellFitScale(80,8,$rowi[Ope_Tool_Desc],1,1,'L');
	$n+=1;
		
	}
$pn+=1;
if($pn!=$noofop)
{
	$pdf->AddPage('L');	
}

	
	
	
}


		$name="pdf/$Drawing_NO"."_Tool_List.pdf";
		ob_clean();
		$pdf->Output($name,'F');
	
	print("<a href=\"$name\" target=\"_NEW\" title=\"Opens Tool List PDF File TAB\">Tool List in PDF</a>");
		
?>
<?php
include "components/db.php";
include "fpdf.php";
$id=$_GET['id'];
class PDF extends FPDF
{
    function Header()
    {
            $this->SetFont('Arial','B',18);
            $this->Cell(60);
            $this->Cell(50,10,'Student List',1,0,'C');
            $this->Ln(20);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}
$fields = array('id'=>'Roll No.','name'=>'Name','class'=>'Class','section'=>'Section','country'=>'Country','state'=>'State','city'=>'City','image'=>'Image');
$result=mysqli_query($con,"select * from student where id=$id");
$header=mysqli_query($con, "SHOW columns FROM student");

$pdf= new PDF();

$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
foreach($header as $heading) 
{   
    if($fields[$heading['Field']]=='image'||$fields[$heading['Field']]=='Image'){
        $pdf->Cell(25,12,$fields[$heading['Field']],1);
    }else{
    $pdf->Cell(20,12,$fields[$heading['Field']],1);
}}
foreach($result as $row) 
{
    $pdf->Ln();
    foreach($row as $column)
    {
        $sql="SELECT MAX(LENGTH) FROM student";
        $result=mysqli_query($con,$sql);
        if($pdf->GetStringWidth($column)>25)
        {
            $width=30;
        }
        else
        {
            $width=20;
        }
        $pdf->Cell($width,10,$column,1);
    }
}

$pdf->Output();

?>
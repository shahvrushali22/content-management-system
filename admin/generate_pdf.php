<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 31-03-2019
 * Time: 11:30
 */

//include connection file
include_once("../includes/connection.php");
include_once("libs/fpdf.php");

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('img/download.png',20,1,25);
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(50);
        // Title
        $this->Cell(80,10,'Blogs List',1,0,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}



$display_heading = array('post_id'=>'post_id', 'post_title'=> 'post_title', 'post_author'=> 'post_author','post_date'=>'post_date');

$result = mysqli_query($connection, "SELECT post_id,post_title,post_author,post_date FROM posts") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connection, "SHOW post_id,post_title,post_author,post_date FROM posts");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
foreach($header as $heading) {
    $pdf->Cell(60,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
    $pdf->Ln();
    foreach($row as $column)
        $pdf->Cell(60,12,$column,1);
}
$pdf->Output();
?>
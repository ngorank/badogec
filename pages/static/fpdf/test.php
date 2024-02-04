<?php
require_once("fpdf.php");



//pdf stuff
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();



$pdf->SetFont('Arial', '', 10);
$h = 10;
$pdf->Write($h,"Aide-moi mon frere Richmond \n");



$pdf->SetFont('Arial', 'b', 10);
$pdf->Write($h,"Il faut faire afficher le QR code sur cette page PDF.\n ");




$pdf->SetFont('Arial', 'biu', 20);
$pdf->Write($h,"Merci");
$pdf->Output();
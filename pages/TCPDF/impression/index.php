<?php
$documentation='Documentation Générale';
$documentation='Documentation Générale';
$site='www.buridaci.com';
$matricule=$_GET['matricule'];
        include "../../db_conn.php";

        $sql = "SELECT * FROM baseofficielle WHERE matricule='$matricule'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) 
		{
		$nom= $row['RaisonSociale'];
		$psd = $row['pseudonyme'];
		$psd = $row['pseudonyme'];
	  $qualite= $row['qualite'];
		$tel= $row['MobilePhone'];
		$affiliation = $row['DateAdhesion'];
		$matricule = $row['matricule'];
		$pseudonyme = $row['pseudonyme'];
		$tel1 = $row['MobilePhone']; 
		$tel2 = $row['OfficePhone'];
		$tel3 = $row['HomePhone'];
		$DateOfBirth = $row['DateOfBirth'];
    $EmailAddress = $row['EmailAddress'];
    $numeroidentification = $row['numeroidentification'];
    $imageqrcode = $row['imageqrcode'];
		}



// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);



// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/fr.php')) {
	require_once(dirname(__FILE__).'/lang/fr.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('Times', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


// Set some content to print
$html = <<<EOD
<h1>Resumé de la demande de carte</h1>
<h3 style="color:red; text-align:center">Cette fiche permet de vérifier s'il n'y a pas d'erreurs dans vos informations</h3>
<style>
table {
    border-width: 150px;
    border-color: #8ebf42;
  }


  td {
    border-style: dotted;
  }
  
  
</style>
<table cellspacing="1" cellpadding="1" border="0" style="border-color:orange;width:100%">


    <tr style="background-color :green ; color:red; width:10%">
        <td  width="25%"> </td>
        <td  width="55%"> </td>

		<td style="text-align:center" border="0" rowspan="10" width="25%"> 
    <img src="../../uploads/$matricule.jpg"/> 
    </td>
    </tr>
    <tr>
        <td>Nom et prénoms  </td>
		<td>: $nom</td>
    </tr>
	<tr>
        <td>Pseudonyme </td>
		<td>: $pseudonyme</td>
    </tr>
	<tr>
        <td> Qualité</td>
		<td>: $qualite</td>
    </tr>
	<tr>
        <td>Matricule</td>
		<td>: $matricule</td>
    </tr>
	<tr>
        <td>Date Adhesion</td>
		<td>: $affiliation</td>
    </tr>
	<tr>
        <td>Date de Naissance</td>
		<td>: $DateOfBirth</td>
    </tr>
	<tr>
        <td>Contacts</td>
		<td>: $tel1 / $tel2 / $tel3</td>
    </tr>
	<tr>
        <td>Votre Mail</td>
		<td>: $EmailAddress</td>
    </tr>


	<tr>
        <td>Code de Demande</td>
		<td>:<b  style="color:red">$numeroidentification </b> </td>
    </tr>
	<tr>
		<td colspan="3"> Lien du suivi de votre carte: <a target="blank" href="http://enligne.badogec.com/">enligne.badogec.com</a>
        </td>
    </tr>

    <p style="text-align:center"><img src="../../static/temp/$imageqrcode" width="200px"/></p>

    <p style="text-align:center; background-color:#ccc; border-radius:100px">
    <h1>Pour plus d'informations:<b style="color:red"> 07 08 26 44 37 </b> </h1> </p>

</table>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output($nom, 'I');

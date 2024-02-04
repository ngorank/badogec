<?php
$matricule=$_GET['matricule'];
$id=$_GET['id'];
include "../../db_conn.php";
    $sql = "SELECT * FROM baseofficielle WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
	
	$imageVerso=$row['imageVerso'];
	$imageRecto=$row['imageRecto'];

	$LastName=$row['LastName'];
	$FirstName=$row['FirstName'];
	$pseudonyme=$row['pseudonyme'];
	$RaisonSociale=$row['RaisonSociale'];
	$DateOfBirth=$row['DateOfBirth'];
	$City=$row['City'];
	$Country=$row['Country'];
	$qualite=$row['qualite'];
	$MobilePhone=$row['MobilePhone'];
	$matricule =$row['matricule'];
	$Numerodecarte =$row['Numerodecarte'];
	$CustID =$row['CustID'];
	$nomMere =$row['nomMere'];
	$Nationalite =$row['Nationalite'];
	$Ville =$row['Ville'];
	$Commune =$row['Commune'];	
	$Quartier=$row['Quartier'];
	$IDType =$row['IDType'];
	$IDNumber =$row['IDNumber'];
	$IDExpiration =$row['IDExpiration'];
	$IndiceClient =$row['IndiceClient'];
	



	if($IDType==1){
		$piece='PASSEPORT';
		$par='SNEDAI';
	}elseif($IDType==2){
		$piece='CNI';
		$par='ONECI';
	}else{
		$piece='ATTESTATION';
		$par='POLICE';
	}
	
if($Country==$Country){

    $sqlNationalite = "SELECT * FROM pays WHERE alpha2='$Country'";
    $resultNat = mysqli_query($conn, $sqlNationalite);
    $row = mysqli_fetch_assoc($resultNat);
	$nationalite=$row['nom_fr_fr'];



}




} ?>			

<?php

require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetTitle($RaisonSociale);


//Ajouter une nouvelle page
$pdf->AddPage();

// entete
$pdf->Image('logo.jpg', 70, 5, 30, 10);





$pdf->Ln(7);   // Saut de ligne
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'FICHE KYC - Carte de membre BURIDA', 'TB', 1, 'C');


$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);
$h = 10;
$retrait = "      ";

$pdf->SetFont('', 'BU');
$pdf->Cell(0, 5, 'INFORMATIONS SUR LE COMPTE DU CLIENT', 0, 1, 'C');


$pdf->SetFont('Arial', '', 10);
$h = 5;
$pdf->Write($h, $retrait .utf8_decode("Numéro de carte  : "));
$pdf->SetFont('', 'B');
$pdf->Write($h,  $CustID. "\n");


$pdf->SetFont('Arial', '', 10);
$h = 10;
$pdf->Write($h, $retrait ."Indice client  : ");
$pdf->SetFont('', 'B');
$pdf->Write($h,  $IndiceClient. "\n");



$pdf->SetFont('', 'BU');
$pdf->Cell(0, 5, 'IDENTIFICATION DU CLIENT', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait ."Nom de famille : ");
$pdf->SetFont('', 'B',10);
$pdf->Write($h,  $LastName . "\n");


$pdf->SetFont('Arial', '', 10);
$h = 5;
$pdf->Write($h, $retrait ."Prenoms : ");
$pdf->SetFont('', 'B',10);
$pdf->Write($h,  $FirstName. "\n");




$pdf->SetFont('Arial', '', 10);
$pdf->Write($h, $retrait . "Sexe : M ou F 	Date de naissance : ".$DateOfBirth ." - 	Lieu de naissance : ");

$pdf->SetFont('', 'B');
$pdf->Write($h, $City . "\n");

$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Nom et prénom de la mère : "));
$pdf->SetFont('', 'B');
$pdf->Write($h,  $nomMere. "\n");



$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Date et lieu de naissance de la mère :  "));
$pdf->SetFont('', 'B');
$pdf->Write($h,  "............................................................ \n");

$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Nationalité / pays : "));
$pdf->SetFont('', 'B');
$pdf->Write($h,  utf8_decode($nationalite. "\n"));




$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Profession/ Qualité :"));
$pdf->SetFont('', 'B');
$pdf->Write($h,  $qualite. "\n");

$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Situation de famille : 	Célibataire	Marié(e)    	Concubinage 	  Divorcé(e)	  Veuf \n"));

$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Type Pièce d'identité: "));

$pdf->SetFont('', 'B');
$pdf->Write($h, $piece);



$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Numéro : "));

$pdf->SetFont('', 'B');
$pdf->Write($h, $IDNumber);


$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Délvré le :"));
$pdf->SetFont('', 'B');
$pdf->Write($h, $IDExpiration);



$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("Expire le : "));
$pdf->SetFont('', 'B');
$pdf->Write($h, $IDExpiration);



$pdf->SetFont('Arial', '', 10);
$h = 6;
$pdf->Write($h, $retrait .utf8_decode("\n" .$retrait ."A : ..........................................        par : ... "));
$pdf->SetFont('', 'B');
$pdf->Write($h, $par. " ...\n");






$pdf->SetFont('', 'BU');
$pdf->Cell(0, 10, 'ADRESSE GEOGRAPHIQUE', 0, 1, 'C');


$pdf->SetFont('Arial', '', 11);
$h = 7;
$pdf->Write($h, $retrait ."Ville :  ");
$pdf->SetFont('', 'B');
$pdf->Write($h,  $Ville. "\n");


$pdf->SetFont('Arial', '', 11);
$h = 7;
$pdf->Write($h, $retrait ."Commune :  ");
$pdf->SetFont('', 'B');
$pdf->Write($h,  $Commune. "\n");


$pdf->SetFont('Arial', '', 11);
$h = 7;
$pdf->Write($h, $retrait ."Quartier : ");
$pdf->SetFont('', 'B');
$pdf->Write($h, $Quartier. "\n");



$pdf->SetFont('Arial', '', 11);
$h = 7;
$pdf->Write($h, $retrait ."Rue :  ");
$pdf->SetFont('', 'B');
$pdf->Write($h,  '..........................................................................'. "\n");

$pdf->SetFont('Arial', '', 11);
$h = 5;
$pdf->Write($h, $retrait .utf8_decode("Résident ou Non-Résident "));




$pdf->SetFont('', 'BU');
$pdf->Cell(0, 10, 'SOURCES DE REVENUS', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$h = 4;
$pdf->Ln(4);


$pdf->Write($h, $retrait .utf8_decode("
ORIGINES DES FONDS                          ESTIMATION MONTANT 
                                                                   TOTAL DES REVENUS ANNUELS"));

$pdf->Write($h, $retrait .utf8_decode("																   Salaire 
Pension Retraite                               Moins de 300.000 XOF 
Allocation chômage                            De 300.000 à 800.000 XOF
Prestations sociales ou familiales           De 800.000 à 2.000.000 XOF 
Rentes                                                   De 2.000.000 à 5.000.000 XOF 
Revenus fonciers                              Plus de 5.000.000 XOF
Revenus de produits financiers 
Autre (précisez) : ........................."));





$pdf->SetFont('Arial', 'I', 10);
$pdf->Ln(7);
$pdf->Write($h, $retrait .utf8_decode("Je soussigné(e) 
	M, Mme, Mlle,"));
$pdf->SetFont('Arial', 'BI', 10);
$pdf->Write($h, utf8_decode($LastName .' '. $FirstName));

$pdf->SetFont('Arial', 'I', 8);
$pdf->Ln(1);
$pdf->Write($h, $retrait .utf8_decode("
déclare sur l'honneur l'exactitude des informations ci-dessus ; les informations et données à caractère personnel collectées font l'objet de traitements obligatoires dans le cadre des processus de connaissance clients (KYC) conformément aux obligations légales et réglementaires applicables en matière de lutte contre le blanchiment des capitaux et contre le financement du terrorisme.
Celles-ci pourront, au regard des finalités mentionnées ci-dessus, être communiquées aux autorités compétentes, aux personnes morales du groupe UBA-Côte d'Ivoire, ainsi qu'en tant que de besoin, à ses sous-traitants et prestataires, dans les limites nécessaires à l'exécution des finalités. Je dispose d'un droit d'accès aux données personnelles me concernant, ainsi que celui de faire rectifier ou de mettre à jour les données inexactes ou obsolètes auprès du BURIDA ayant recueilli ces informations ou en envoyant un mail à l'adresse suivante : protectiondesdonnees@buridaci.com ."));



$pdf->SetFont('Arial', '', 11);
$h = 7;
$pdf->Ln(5);
$pdf->Write($h, utf8_decode("Fait à Abidjan Le : "));
$pdf->SetFont('Arial', 'B', 11);
$pdf->Write($h, utf8_decode( date('d/m/Y')."\n"));

$pdf->SetFont('', 'BIU');
$pdf->Write($h, utf8_decode("Signature du déclarant"."\n"));

$h = 3;
$pdf->SetFont('Arial', '', 8);
$pdf->Write($h, utf8_decode("(Precedez de la mention « Certifiee conforme » \n"));








// -------------------------------------------------------------------------------------------------------//


$pdf->Write($h,  "\n" ."\n" ."\n" ."\n" ."\n" ."\n");

$pdf->SetFont('', 'B','11');
$pdf->Cell(0, 5, utf8_decode(' Abidjan, le ' . date('d/m/Y')), 0, 10, 'R');

$pdf->SetFont('Arial', '', 15);
$h = 10;
$pdf->Write($h, $retrait ."Nom : ");
$pdf->SetFont('', 'B',15);
$pdf->Write($h,  $LastName . "\n");


$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, $retrait ."Prenoms : ");
$pdf->SetFont('', 'B',15);
$pdf->Write($h,  $FirstName. "\n");

$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, $retrait ."Matricule : ");
$pdf->SetFont('', 'B',15);
$pdf->Write($h,  $matricule. "\n");


$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, $retrait .utf8_decode("Qualité : "));
$pdf->SetFont('', 'B',15);
$pdf->Write($h,  $qualite. "\n");


$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, $retrait ."Telephone : ");
$pdf->SetFont('', 'B',15);
$pdf->Write($h, '+'.$MobilePhone. "\n");


$h = 20;
$pdf->Ln(10);
$pdf->SetFont('', 'B');
$pdf->Cell(0, 3, utf8_decode('A Madame la Directrice'), 0, 1, 'C');

$pdf->Ln(4);
$pdf->SetFont('', 'B');
$pdf->Cell(0, 3, utf8_decode(' de la Répartition du BURIDA'), 0, 1, 'C');



$pdf->Ln(10);
$pdf->SetFont('Arial', 'bu', 15);
$pdf->Write($h,"Objet");
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h,": Demande paiement sur ma carte bancaire UBA-BURIDA,\n");






$pdf->Ln(10);
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h,$retrait . utf8_decode("Je vous prie de bien vouloir procéder au paiement de mes droits issus des répartitions sur ma carte BURIDA-UBA.\n"));

$pdf->Ln(10);
$h = 3;
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h,$retrait . utf8_decode("-	Numero :"));
$pdf->SetFont('Arial', 'B', 15);
$pdf->Write($h,utf8_decode("$Numerodecarte \n"));


$pdf->Ln(10);
$h = 3;
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h,$retrait . utf8_decode("-	CustID :"));
$pdf->SetFont('Arial', 'B', 15);
$pdf->Write($h,utf8_decode("$CustID \n"));


$pdf->Ln(10);
$h = 5;
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, utf8_decode("Dans l'attente, je vous prie de croire, Madame la Directrice, à l'assurance de mes sentiments. \n"));



$pdf->Ln(10);
$pdf->SetFont('', 'uB');
$pdf->Cell(0, 3, utf8_decode('Signature'), 0, 1, 'C');

$pdf->Ln(1000);
$h = 5;
$pdf->SetFont('Arial', '', 15);
$pdf->Write($h, utf8_decode(" "));

$pdf->Image('../../pieces/'.$imageRecto, 50, 30, 100, 100);
$pdf->Ln(10);


$pdf->Image('../../pieces/'.$imageVerso, 50, 150, 100, 100);

$pdf->Ln(1000);

//Afficher le pdf
$pdf->Output($RaisonSociale, 'I', true);
		
?>
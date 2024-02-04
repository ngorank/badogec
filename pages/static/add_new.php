<?php
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;    
    //html PNG location prefix    
    include "phpqrcode/qrlib.php";   
    
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);     
        //$filename = $PNG_TEMP_DIR.'test.png';                
        // declaration des  données



$nomcommande = $_GET['nomcommande'];
include "../db_conn.php";
if (isset($_POST['submit'])) {
  $nomcommande = $_GET['nomcommande'];
    $IDType = $_POST['IDType'];
    $IDNumber = strtoupper($_POST['IDNumber']);
    $IDExpiration = $_POST['IDExpiration'];
    $DateDelivrance = $_POST['DateDelivrance'];
    $LastName = strtoupper($_POST['LastName']);
    $FirstName = strtoupper($_POST['FirstName']);
    $pseudonyme = strtoupper(htmlentities($_POST['pseudonyme']));
    $RaisonSociale = strtoupper($_POST['LastName'].' '.$_POST['FirstName']);
    $matricule = $_POST['matricule'];
    $qualites = implode(' ',$_POST['qualite']);
    $qrcode1 = 'http://enligne.badogec.com/view.php?p='.$matricule;
    $qrcode = 'q.buridaci.com/'.$matricule;
    $DateAdhesion = $_POST['DateAdhesion'];
    $City = strtoupper($_POST['City']);
    $Country = $_POST['Country'];
    $State = '01';
    $PostalCode = 'ABIDJAN';
    $DateOfBirth = $_POST['DateOfBirth'];
    $EmailAddress = $_POST['EmailAddress'];
    $HomePhone = '0';
    $OfficePhone = ('225'.$_POST['OfficePhone']);
    $MobilePhone = ('225'.$_POST['MobilePhone']);
    $PhotoReference = $matricule;
    $SalaryID = '6101';
    $SolID = $matricule;
    $IDImage = $matricule;
    $statut = 'OK';

    $Numerodecarte = '';
    $CustID = '';
    $nomMere = '';
    $Nationalite = '';
    $Ville = '';
    $Commune = '';
    $Quartier = '';
    $Rue = ''; 
    $IndiceClient = ''; 
    $numeroidentification="CB".$matricule;
    $statutverification =0; 
  //------------------------------------------------------------------------///
  $PNG_WEB_DIR = 'temp/';
    $errorCorrectionLevel = 'H';  
    $matrixPointSize = 16;
    $data = "$qrcode1";       
    $filename=$PNG_TEMP_DIR.'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

    $imageqrcode1 = 'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
    //------------------------------------------------------------------------///


    $imageqrcode = $imageqrcode1;

    $sqlc = "SELECT matricule FROM baseofficielle WHERE matricule=$matricule";
    if ($res=mysqli_query($conn,$sqlc))
    {
    $rowcount=mysqli_num_rows($res);
        if($rowcount<1){
            $sql = "INSERT INTO baseofficielle
            (IDType,IDNumber,IDExpiration,DateDelivrance,LastName,FirstName,pseudonyme,RaisonSociale,matricule,qualite,qrcode,
            DateAdhesion,City,Country,State,PostalCode,DateOfBirth,EmailAddress,HomePhone,OfficePhone,MobilePhone,
            PhotoReference,SalaryID,SolID,IDImage,nomcommande,Numerodecarte ,CustID ,IndiceClient, nomMere ,Nationalite,
            Ville ,Commune,Quartier,Rue, numeroidentification,imageqrcode) 
            VALUES 
            ('$IDType','$IDNumber','$IDExpiration','$DateDelivrance','$LastName','$FirstName','$pseudonyme','$RaisonSociale','$matricule',
            '$qualites','$qrcode','$DateAdhesion','$City','$Country','$State','$PostalCode','$DateOfBirth',
            '$EmailAddress','$HomePhone','$OfficePhone','$MobilePhone','$PhotoReference','$SalaryID','$SolID',
            '$IDImage','$nomcommande','$Numerodecarte','$CustID','$IndiceClient', '$nomMere','$Nationalite','$Ville',
            '$Commune','$Quartier','$Rue','$numeroidentification','$imageqrcode')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location:photo.php?matricule=$matricule&&nomcommande=$nomcommande");
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        }else{
            header("Location:add_new.php?msg=0&&nomcommande=$nomcommande");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive  &amp; Accept: text/html,application/xhtml+xml,application/xml">
	<meta name="author" content="ngoran">
	<meta name="keywords" content="ngoran, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

	<title>BaDoGeC</title>

	<link href="css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

</head>

<body>
<div class="wrapper">
		<?php include "menugauche.php"; ?>
		<div class="main">
		<?php include "entete.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">
			
<div class="container">
<?php
 if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
  if($msg==0){
      echo '<b style="color:red"><div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">
      Ce matricule existe déjà
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div></b>';
    }
    }
 ?>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width: 300px;">
            <div class="row">
                <div class="col">
                    <label class="form-label fw-bold">Nom de famille :</label>
                    <input type="text" class="form-control fw-bold" required name="LastName" value="<?php if (isset($_POST['submit'])){echo $_POST['LastName'];} ?>"  />
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Prenoms :</label>
                    <input type="text" class="form-control fw-bold" required name="FirstName">
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label fw-bold">Pseudonyme :</label>
                    <input type="text" class="form-control fw-bold" name="pseudonyme">
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label fw-bold">Date de Naissance:</label>
                    <input type="text" class="form-control fw-bold" required name="DateOfBirth" data-inputmask="'mask': '99-99-9999'">
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Lieu de Naissance :</label>
                    <input type="text" class="form-control fw-bold" required name="City">
                </div>
                </div>
     
                <div class="row  mt-3">
                <div class="col">
                    <label class="form-label fw-bold">Pays de Residence :</label>
                    <select class="form-select form-select-sm"name="Country" required aria-label=".form-select-sm">
                      <option value="">Choisir pays</option>
                        <?php
                        $query = "SELECT * FROM pays WHERE statut=1";
                        $result = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_assoc($result)){ ?>   
                        <option id="Country" class="input" type="text" value="<?php echo $row['alpha2']; ?>" >
                      
                        <?php echo $row['nom_fr_fr']; ?>
                        </option>

                      <?php } ?>		
                    </select>
                </div>
			
			

    <div class="row  mt-3">
        <div class="col">
		<label class="form-label fw-bold">Qualité Droit d'auteur</label>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="AUT COMP" id="AC">
		  <label class="form-check-label" for="AC">
			Auteur Compositeur
		  </label>
		</div>
			<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="REALISATEUR" id="REA">
		  <label class="form-check-label" for="REA">
			Réalisateur
		  </label>
		</div>
			<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="SCENARISTE" id="SCE">
		  <label class="form-check-label" for="SCE">
			Scénariste
		  </label>
		</div>
			<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="LITTERAIRE" id="Litteraire">
		  <label class="form-check-label" for="Litteraire">
			Litteraire
		  </label>
		</div>
			<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="HUMORISTE" id="Humoriste">
		  <label class="form-check-label" for="Humoriste">
			Humoriste
		  </label>
		</div>
			<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="DRAMATURGE" id="DRAMATURGE">
		  <label class="form-check-label" for="DRAMATURGE">
			Dramaturge
		  </label>
		</div>
		
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="ARRANGEUR" id="AR">
		  <label class="form-check-label" for="AR">
			Arrangeur
		  </label>
		</div>
		
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="PLASTICIEN" id="PLASTICIEN">
		  <label class="form-check-label" for="PLASTICIEN">
			Plasticien
		  </label>
		</div>
    <div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="CHOREGRAPHE" id="CHOREGRAPHE">
		  <label class="form-check-label" for="CHOREGRAPHE">
			Choregraphe
		  </label>
		</div>
		</div>
        <div class="col">
		<label class="form-label fw-bold">Qualité Droits voisins</label>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="INT CHANT" id="INT CHANT">
		  <label class="form-check-label" for="INT-CHANT">
			Interprète Chanteur(se)
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="INT INST" id="INT INSTR">
		  <label class="form-check-label" for="INSTRUMENTISTE">
			Interprète Instrumentiste
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="INTER ACT" id="ACTEUR">
		  <label class="form-check-label" for="ACTEUR">
			Acteur/Actrice
		  </label>
		</div>

    
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="COMEDIEN" id="COMEDIEN">
		  <label class="form-check-label" for="COMEDIEN">
			Comedien
		  </label>
		</div>




		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="PROD PHONO" id="phono">
		  <label class="form-check-label" for="phono">
			Producteur de Phonogragrammes
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" name="qualite[]" value="PROD VIDEO" id="PROD VIDEO">
		  <label class="form-check-label" for="prod-video">
			Producteur de Vidéogragrammes
		  </label>
		</div>
		
        </div>		
    </div>
<hr>

            <div class="row">
                <div class="col">
                    <label class="form-label fw-bold">Date Adhésion:</label>
                    <input type="text" class="form-control fw-bold" required name="DateAdhesion" data-inputmask="'mask': '99-99-9999'">
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Matricule:</label>
                    <input type="number" required class="form-control fw-bold" name="matricule">
                    <span style="color:red">...</span>
                </div>
            </div>
            
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label fw-bold">Contact 1 :</label>
                    <input type="number" class="form-control fw-bold" name="MobilePhone">
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Telephone  :</label>
                    <input type="number" class="form-control fw-bold" name="OfficePhone">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label class="form-label fw-bold">E-Mail :</label>
                    <input type="text" class="form-control fw-bold" name="EmailAddress">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
          <label class="form-label fw-bold">Type de Pièce :</label>
					<select class="form-select form-select-sm" aria-label=".form-select-sm" name="IDType">
					  <option selected value="">Choisir le type de pièce</option>
					  <option value="1">PASSEPORT</option>
					  <option value="2">CNI</option>
					  <option value="3">ATTESTATION</option>
					  <option value="4">AUTRES</option>
					</select>
					
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Numero de la Pièce :</label>
                    <input type="text" class="form-control fw-bold" name="IDNumber">
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label fw-bold">Date de Delivrance:</label>
                    <input type="text" class="form-control fw-bold" name="DateDelivrance" data-inputmask="'mask': '99-99-9999'">
                    

                </div>
                <div class="col">
                    <label class="form-label fw-bold">Date d'Expiration :</label>
                    <input type="text" class="form-control fw-bold" name="IDExpiration" data-inputmask="'mask': '99-99-9999'">
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success fw-bold" name="submit"> Enregistrer </button>
                <a href="index.php" class="btn btn-danger fw-bold">Annuler</a>
            </div>
        </form>
    </div>
</div>


				</div>
			</main>
			<?php include "footer.php"; ?>   
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/b0d0eaa2c0.js" crossorigin="anonymous"></script>
	<script src="js/app.js"></script>

<script src="js/inputmask.bundle.js"></script>

        <script>
            $(document).ready(function()
            {
                $(":input").inputmask();
            });
        </script>
</body>

</html>
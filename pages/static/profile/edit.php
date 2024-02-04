<?php
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../temp'.DIRECTORY_SEPARATOR;
include "../phpqrcode/qrlib.php";   
 include "../../db_conn.php";
$id = $_GET["id"];
$nomcommande = $_GET["nomcommande"];

if (isset($_POST['statut'])) {
	$statut = $_POST['statut'];
	$sqlstatut = "UPDATE baseofficielle SET statut='$statut' WHERE `id`='$id'";
    $resultstatut = mysqli_query($conn, $sqlstatut);
}

if (!file_exists($PNG_TEMP_DIR))
mkdir($PNG_TEMP_DIR);  

if (isset($_POST['edit'])) {
    $IDType = $_POST['IDType'];
    $IDNumber = strtoupper($_POST['IDNumber']);
    $IDExpiration = $_POST['IDExpiration'];
    $DateDelivrance = $_POST['DateDelivrance'];
    $LastName = strtoupper($_POST['LastName']);
    $FirstName = strtoupper($_POST['FirstName']);
    $pseudonyme = strtoupper(htmlentities($_POST['pseudonyme']));
    $RaisonSociale = strtoupper($_POST['LastName'].' '.$_POST['FirstName']);
    $matricule = $_POST['matricule'];
    $qualite = strtoupper($_POST['qualite']);
    $qrcode = 'http://enligne.badogec.com/view.php?p='.$matricule;
    //$qrcode = 'q.buridaci.com/'.$matricule;
    $DateAdhesion = $_POST['DateAdhesion'];
    $City = strtoupper($_POST['City']);
    $Country = strtoupper($_POST['Country']);
    $State = '01';
    $PostalCode = 'ABIDJAN';
    $DateOfBirth = $_POST['DateOfBirth'];
    $EmailAddress = $_POST['EmailAddress'];
    $HomePhone = $_POST['HomePhone'];
    $OfficePhone =$_POST['OfficePhone'];
    $MobilePhone = $_POST['MobilePhone'];
    $PhotoReference = $matricule;
    $SalaryID = '6101';
    $SolID = $matricule;
    $IDImage = $matricule;
    $numeroidentification="CB".$matricule;


	  //------------------------------------------------------------------------///
	  $PNG_WEB_DIR = 'temp/';
	  $errorCorrectionLevel = 'H';  
	  $matrixPointSize = 16;
	  $data = "$qrcode";       
	  $filename=$PNG_TEMP_DIR.'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	  $imageqrcode1 = 'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	  QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
	  //------------------------------------------------------------------------/// 
	  $imageqrcode = $imageqrcode1;
    $sql = "UPDATE baseofficielle SET IDType='$IDType',IDNumber='$IDNumber',IDExpiration='$IDExpiration',
    DateDelivrance='$DateDelivrance',LastName='$LastName',FirstName='$FirstName',pseudonyme='$pseudonyme',
    RaisonSociale='$RaisonSociale',matricule='$matricule',qualite='$qualite',qrcode='$qrcode',DateAdhesion='$DateAdhesion',
    City='$City',Country='$Country',State='$State',PostalCode='$PostalCode',DateOfBirth='$DateOfBirth',EmailAddress='$EmailAddress',
    HomePhone='$HomePhone',OfficePhone='$OfficePhone',MobilePhone='$MobilePhone',PhotoReference='$PhotoReference',
	SalaryID='$SalaryID',SolID='$SolID',IDImage='$IDImage',imageqrcode='$imageqrcode', numeroidentification='$numeroidentification' WHERE `id`='$id' ";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:index.php?matricule=$matricule&&nomcommande=$nomcommande");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

if(isset($_POST['statutverification'])) {
    $statutverification =1;
    $sqlverification = "UPDATE baseofficielle SET statutverification='$statutverification' WHERE `id`='$id' ";
    $result = mysqli_query($conn, $sqlverification);
    }





?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaDoGec</title>
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
	<link href="bootstrap.css" rel="stylesheet">
	<style>
 body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
    </style>
</head>
<body>
<div class="container">
		<div class="main-body">
			<div class="row">
		<?php
        //$matricule=$_GET['matricule'];

        $sql = "SELECT * FROM baseofficielle WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>
		

		<?php 
             if($row['statutverification']==1)
             {
                $statutverification = '<img src="../../logo/verification.png" width="25px">';
             }
             else{
                $statutverification = '<img src="../../logo/non-verifie.png" width="25px">';

			 }  ?>

				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
						<div class="card">
							<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="../../uploads/<?php echo $row['matricule'] ?>.jpg" class="rounded-circle p-1 bg-primary" width="150">
								<div class="mt-3">
								<form action="" method="post">
								<h5><?php echo $row['RaisonSociale'] ?></h5>
								<p class="text-secondary mb-1"><?php echo $row['pseudonyme'] ?></p>
								<p class="text-muted font-size-sm"><?php echo $row['qualite'] ?></p>
								<p class="text-muted font-size-sm"><?php echo $row['matricule'] ?></p>
								<?php if($row['statut']=='OK'){?>
									<button name="statut" value="NOK" class="btn btn-outline-warning">Accord</button>
									<?php }else{ ?>
									<button name="statut" value="OK" class="btn btn-danger">Pas Accord</button>
									<?php  } ?>					
									<button name="statutverification" value=1 class="btn btn-outline-primary">
									<?php echo  $statutverification ?>
									</button>
								</form>
								
								</div>
							</div>
							</div>
						</div>


							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Email</h6>
									<span class="text-secondary"><?php echo $row['EmailAddress'] ?></span>
									
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
									<a href="../changeFolder.php?id=<?php echo $row['id'] ?>">  Changement de Dossiers</a></h6>

									
								</li>
								
								
							</ul>
						</div>
					</div>
				</div>


				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
						<form method='POST'>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="LastName" class="form-control" value="<?php echo $row['LastName'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Prenoms :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="FirstName" class="form-control" value="<?php echo $row['FirstName'] ?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Pseudonyme</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="pseudonyme" class="form-control" value="<?php echo $row['pseudonyme'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date Adhésion</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="DateAdhesion" class="form-control" value="<?php echo $row['DateAdhesion'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Qualité</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="qualite" class="form-control" value="<?php echo $row['qualite'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Matricule :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="matricule" class="form-control" value="<?php echo $row['matricule'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Lieu de Naissance :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="City" class="form-control" value="<?php echo $row['City'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Pays de residence :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Country" class="form-control" value="<?php echo $row['Country'] ?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date de Naissance</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="DateOfBirth" class="form-control" value="<?php echo $row['DateOfBirth'] ?>">
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Addresse Mail :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="EmailAddress" class="form-control" value="<?php echo $row['EmailAddress'] ?>">
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contact 1 :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="MobilePhone" class="form-control" value="<?php echo $row['MobilePhone'] ?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contact 2</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="OfficePhone" class="form-control" value="<?php echo $row['OfficePhone'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contact 3 :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="HomePhone" class="form-control" value="<?php echo $row['HomePhone'] ?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Type de Pièce :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="IDType" class="form-control" value="<?php echo $row['IDType'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Numero de Pièce :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="IDNumber" class="form-control" value="<?php echo $row['IDNumber'] ?>">
								</div>
							</div>
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date Delivrance :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="DateDelivrance" class="form-control" value="<?php echo $row['DateDelivrance'] ?>">
								</div>
							</div>	
							
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date Expiration :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="IDExpiration" class="form-control" value="<?php echo $row['IDExpiration'] ?>">
								</div>
							</div>					
							
							

							
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" name='edit' class="btn btn-primary px-4" value="Sauvegarder les Changements">
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</form>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>
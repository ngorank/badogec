<?php
include "../db_conn.php";
$id = $_GET["id"];
$matricule = $_GET["matricule"];

if(isset($_POST['submit'])) {
    $niveau = $_POST['niveau'];
    $Numerodecarte = strtoupper($_POST['Numerodecarte']);
    $CustID = strtoupper($_POST['CustID']);
    $nomMere = strtoupper($_POST['nomMere']);
    $Nationalite = strtoupper($_POST['Nationalite']);
    $Ville = strtoupper($_POST['Ville']);
    $Commune = strtoupper($_POST['Commune']);
    $Quartier = strtoupper($_POST['Quartier']);
    $Rue = strtoupper($_POST['Rue']);
    $IndiceClient = strtoupper($_POST['IndiceClient']);

    $sql = "UPDATE baseofficielle SET niveau='$niveau' , Numerodecarte='$Numerodecarte', 
    CustID='$CustID', IndiceClient='$IndiceClient', nomMere='$nomMere', Nationalite='$Nationalite', Ville='$Ville',
    Commune ='$Commune', Quartier='$Quartier',Rue='$Rue' WHERE `id`='$id' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:pieces.php?id=$id&&matricule=$matricule");
    } else {
        echo "Echoué: " . mysqli_error($conn);
    }
}
?>

<?php 
//$nomcommande=$_GET['nomcommande'];
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaDoGeC</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="../logo/logo.png" />

<style>
        body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
    </style>

</head>
<body>
<div class="container">
    <div class="main-body">

    
        <?php
        $sql = "SELECT * FROM baseofficielle WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="../uploads/<?php echo $row['matricule'] ?>.jpg" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h5><?php echo $row['RaisonSociale'] ?></h5>
                      <p class="text-secondary mb-1"><?php echo $row['pseudonyme'] ?></p>
                      <p class="text-muted font-size-sm"><?php echo $row['qualite'] ?></p>
                      <p class="text-muted font-size-sm"><?php echo $row['matricule'] ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom et Prenoms :</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['RaisonSociale'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Pseudonyme</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['pseudonyme'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date Adhésion</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['DateAdhesion'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Qualité</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['qualite'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Matricule</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['matricule'] ?>
                    </div>
                  </div>
                  <hr>







       <div class="col-lg-10">
					<div class="card">
						<div class="card-body">
						<form method='POST'>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">CUSTOMER ID :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                <input type="text" name="CustID" class="form-control" value="<?php echo $row['CustID'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Indice Client :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="IndiceClient" class="form-control" value="<?php echo $row['IndiceClient'] ?>">
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Numero de carte:</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                <input type="text" name="Numerodecarte" class="form-control" value="<?php echo $row['Numerodecarte'] ?>">
									
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nom de la Mère</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="nomMere" class="form-control" value="<?php echo $row['nomMere'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nationalite</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Nationalite" class="form-control" value="<?php echo $row['Nationalite'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Ville</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Ville" class="form-control" value="<?php echo $row['Ville'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Commune :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Commune" class="form-control" value="<?php echo $row['Commune'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Quartier:</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Quartier" class="form-control" value="<?php echo $row['Quartier'] ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Rue :</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="Rue" class="form-control" value="<?php echo $row['Rue'] ?>">
								</div>
							</div>
              
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0" style="color:red">Voulez-vous effectuer le retrait de carte ?</h6>
							</div>

					<div class="col-sm-9 text-secondary">
				  <select class="form-select form-select-sm" required aria-label=".form-select-sm" name="niveau">
					  <option selected value="">Choisir le type de pièce</option>
					  <option value="Retiree">OUI</option>
					  <option value="Non retire">NON</option>
					</select>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" name='submit' class="btn btn-primary px-4" value="Valider">
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</form>



                  <div class="row">
                    <!--div class="col-sm-12">
                    <form action="" method="post">
                    <p style="color:red">Voulez-vous effectuer le retrait de carte ? </p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary fw-bold" name="submit"> 
                        OUI  
                    </button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="RetraitDeCartes.php"  class="btn btn-danger fw-bold"> 
                     NON
                    </a-->
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <?php } ?>
        </div>
    </div>
</body>
</html>
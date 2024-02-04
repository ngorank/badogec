<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST['submit'])) {
    $IDType = $_POST['IDType'];
    $IDNumber = strtoupper($_POST['IDNumber']);
    $IDExpiration = $_POST['IDExpiration'];
    $LastName = strtoupper($_POST['LastName']);
    $FirstName = strtoupper($_POST['FirstName']);
    $pseudonyme = strtoupper($_POST['pseudonyme']);
    $RaisonSociale = strtoupper($_POST['LastName'].' '.$_POST['FirstName']);
    $matricule = $_POST['matricule'];
    $qualite = strtoupper($_POST['qualite']);
    $qrcode = 'q.buridaci.com/'.$matricule;
    $DateAdhesion = $_POST['DateAdhesion'];
    $City = strtoupper($_POST['City']);
    $Country = strtoupper($_POST['Country']);
    $State = '01';
    $PostalCode = '0';
    $DateOfBirth = $_POST['DateOfBirth'];
    $EmailAddress = $_POST['EmailAddress'];
    $HomePhone = ($_POST['HomePhone']);
    $OfficePhone ='';
    $MobilePhone = ($_POST['MobilePhone']);
    $PhotoReference = $matricule;
    $SalaryID = $matricule;
    $SolID = $matricule;
    $IDImage = $matricule;

    $sql = "UPDATE baseofficielle SET IDType='$IDType',IDNumber='$IDNumber',IDExpiration='$IDExpiration',LastName='$LastName',FirstName='$FirstName',pseudonyme='$pseudonyme',RaisonSociale='$RaisonSociale',matricule='$matricule',qualite='$qualite',qrcode='$qrcode',DateAdhesion='$DateAdhesion',City='$City',Country='$Country',State='$State',PostalCode='$PostalCode',DateOfBirth='$DateOfBirth',EmailAddress='$EmailAddress',HomePhone='$HomePhone',OfficePhone='$OfficePhone',MobilePhone='$MobilePhone',PhotoReference='$PhotoReference',SalaryID='$SalaryID',SolID='$SolID',IDImage='$IDImage' WHERE `id`='$id' ";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:index.php?msg=Données Modifiées avec succuès");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <title>Cartes | Modification</title>
</head>
<body>
<nav class=" navbar navbar-light justify-content-center fs-3 mb-5 fw-bold" style="background-color: #00ff5573;">
    Application Cartes
</nav>

<div class="container">
    <!--div class="text-center mb-4">
        <h3>Edit User Information</h3>
        <p class="text-muted">...</p>
    </div-->

    <?php
    $query = "SELECT * FROM baseofficielle WHERE id='$id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>


<div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width: 300px;">
            <div class="row">
                <div class="col">
                    <label class="form-label">Nom de famille :</label>
                    <input type="text" class="form-control fw-bold" name="LastName" value="<?php echo $row['LastName'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Prenoms :</label>
                    <input type="text" class="form-control fw-bold" name="FirstName"  value="<?php echo $row['FirstName'] ?>" >
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label">Pseudonyme :</label>
                    <input type="text" class="form-control fw-bold" name="pseudonyme"  value="<?php echo $row['pseudonyme'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Matricule :</label>
                    <input type="text" class="form-control fw-bold" name="matricule"  value="<?php echo $row['matricule'] ?>" >
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Qualité :</label>
                    <input type="text" class="form-control fw-bold" name="qualite"  value="<?php echo $row['qualite'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Date Adhésion:</label>
                    <input type="text" class="form-control fw-bold"  value="<?php echo $row['DateAdhesion'] ?>"  name="DateAdhesion" data-inputmask="'mask': '99-99-9999'">
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label">Lieu de Naissance :</label>
                    <input type="text" class="form-control fw-bold" name="City"  value="<?php echo $row['City'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Pays de Residence :</label>
                    <input type="text" class="form-control fw-bold" name="Country"  value="<?php echo $row['Country'] ?>" >
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Date de Naissance:</label>
                    <input type="text" class="form-control fw-bold"  value="<?php echo $row['DateOfBirth'] ?>"  name="DateOfBirth" data-inputmask="'mask': '99-99-9999'">
                </div>
                <div class="col">
                    <label class="form-label">E-Mail :</label>
                    <input type="text" class="form-control fw-bold" name="EmailAddress"  value="<?php echo $row['EmailAddress'] ?>" >
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label">Contact 1 :</label>
                    <input type="text" class="form-control fw-bold" name="MobilePhone"  value="<?php echo $row['MobilePhone'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Telephone  :</label>
                    <input type="text" class="form-control fw-bold" name="OfficePhone"  value="<?php echo $row['OfficePhone'] ?>" >
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label">Type de Pièce :</label>
                    <input type="text" class="form-control fw-bold" name="IDType"  value="<?php echo $row['IDType'] ?>" >
                </div>
                <div class="col">
                    <label class="form-label">Numero de la Pièce :</label>
                    <input type="text" class="form-control fw-bold" name="IDNumber"  value="<?php echo $row['IDNumber'] ?>" >
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col">
                    <label class="form-label">Date d'Expiration :</label>
                    <input type="text" class="form-control fw-bold"  value="<?php echo $row['IDExpiration'] ?>"  name="IDExpiration" data-inputmask="'mask': '99-99-9999'">
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success fw-bold" name="submit"> Modifier </button>
                <a href="index.php" class="btn btn-danger fw-bold">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/b0d0eaa2c0.js" crossorigin="anonymous"></script>


<script src="inputmask.bundle.js"></script>
        <script>
            $(document).ready(function()
            {
                $(":input").inputmask();
            });

 </script>

</body>
</html>

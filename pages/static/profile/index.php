<?php 
$nomcommande=$_GET['nomcommande'];
include "../../db_conn.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaDoGec</title>
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
    <link href="bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

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
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
              <li class="breadcrumb-item"><a href="../listedelacommande.php?nomcommande=<?php echo $nomcommande; ?>">Dossier Commande</a></li>
              <li class="breadcrumb-item active" aria-current="page">Resumé de la Carte</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
        <?php
        $matricule=$_GET['matricule'];
        $sql = "SELECT * FROM baseofficielle WHERE matricule=$matricule";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="../../uploads/<?php echo $row['matricule'] ?>.jpg" alt="Admin" class="rounded-circle" width="150">
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

                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="edit.php?id=<?php echo $row['id'] ?>&&nomcommande=<?php echo $row['nomcommande'] ?>">Modifier</a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-success" target="_blank" href="../../TCPDF/impression/?matricule=<?php echo $row['matricule'] ?>">Imprimer</a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-primary" href="../listedelacommande.php?nomcommande=<?php echo $nomcommande; ?>">Retour Dossier</a>
                    </div>                    
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
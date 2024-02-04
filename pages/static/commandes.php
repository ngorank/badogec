<?php
include "../db_conn.php";
if (isset($_POST['nouveaudossier'])) {
    
    $nomcommande = ('commandecarteics024_'.date("Ydms"));    
    $DateDebut = date("d/m/Y");    
    $DateFin = date("00/00/0000");   
    $statut = 0;   

    $sql = "INSERT INTO commandecarteics (nomcommande,DateDebut,DateFin,statut)  VALUES ('$nomcommande','$DateDebut','$DateFin','$statut')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
         header("Location:commandes.php");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>BaDoGeC</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
		<?php include "menugauche.php"; ?>
		<div class="main">
		<?php include "entete.php"; ?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Création de Nouveau Dossier</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
 <div class="container">
    <div class="text-center mb-4">
	<form action="" method="post" style="width:50vw; min-width: 300px;">
   
   <div class="mt-3">
	   <!--button type="submit" class="btn btn-success fw-bold" name="nouveaudossier"> Créer un Nouveau Dossier </button-->
   </div>
   
</form>
    </div>
    <div class="container d-flex justify-content-center">
    <table class="table table-hover text-center mt-3 fw-bold">
        <thead class="table-dark">
        <tr>            
            <th scope="col">ID</th>
            <th scope="col">Libellé des Commandes</th>
            <th scope="col">Nbre</th>
            <th scope="col">Date Debut</th>
            <th scope="col">Date Fin</th>
            <th scope="col">Statut</th>
        </tr>
        </thead>

        <?php    
        $sql = "SELECT * FROM commandecarteics ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {?>
            <tr>

                <td>
                  <?php echo $row['id']; ?> 
                </td>

                <td align='left'> 
                   <a href="listedelacommande.php?nomcommande=<?php echo $row['nomcommande']; ?>">
                    <?php echo $nomcommande=($row['nomcommande']); ?> 
                    </a> 
                </td>

                <td>
                    <?php
                     $sqlc = "SELECT nomcommande FROM baseofficielle WHERE nomcommande = '$nomcommande' ";
                    if ($res=mysqli_query($conn,$sqlc))
                    {
                    $rowcount=mysqli_num_rows($res);
                    printf($rowcount);
                    } ?> 
               </td>

                <td class="d-none d-xl-table-cell"><?php echo $row['DateDebut']; ?></td>

                <td class="d-none d-xl-table-cell"><?php echo $row['DateFin']; ?></td>

                <td>
                    <?php 
                        if ($row['statut']==1) { ?>
                            <span class="badge bg-success">Exporté</span>
                            <?php } else { ?>
                                <span class="badge bg-warning">En Progression</span>
                    <?php 	} ?>               
                </td>

            </tr>

			<?php } ?>
			


        </tbody>
    </table>
</div>





















								<div class="card-body">
								</div>
							</div>
						</div>




					</div>

				</div>
			</main>
			<?php include "footer.php"; ?>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>
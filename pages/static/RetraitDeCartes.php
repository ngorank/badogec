<?php
include "../db_conn.php";
?>

<!doctype html>
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

	<title>Commande de cartes</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<script src="js/jquery.js"></script>
<script src="js/dataTables.js"></script>
<link rel="stylesheet" href="css/dataTables.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
		<?php include "menugauche.php"; ?>
		<div class="main">
		<?php include "entete.php"; ?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Liste Complète des Demandeurs de Cartes 
                    <?php
                     $sqlc = "SELECT nomcommande FROM baseofficielle  WHERE niveau='retiree'";
                    if ($res=mysqli_query($conn,$sqlc))
                    {
                    $rowcount=mysqli_num_rows($res);
                    printf($rowcount);
                    } ?> /
                    <?php
                     $sqlc = "SELECT nomcommande FROM baseofficielle";
                    if ($res=mysqli_query($conn,$sqlc))
                    {
                    $rowcount=mysqli_num_rows($res);
                    printf($rowcount);
                    } ?> 
                    </h1>
                        
					<div class="row">
						<div class="col-12">
							<div class="card">

 <div class="container">
    <div class="text-center mb-4">        
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom et Prenoms</th>
                <th>Pseudonyme</th>
                <th>Contacts</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>

        <?php
        include "../db_conn.php";
        $sql = "SELECT * FROM baseofficielle  ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {?>

            <tr>
                <td align='justify'><img src="../uploads/<?php echo $row['matricule']?>.jpg" width="30"></td>
                <td align='left'><?php echo $row['RaisonSociale'] ?></td>
                <td align='left'><?php echo $row['pseudonyme'] ?></td>
                <td align='left'><?php echo $row['MobilePhone'] ?></td>
                <td>
                <?php 
                     if ($row['niveau']=='Retiree') { ?>
                    <span class="badge bg-success">
                        <i class="align-middle" data-feather="check-square"></i>
                    </span>
                    <?php } else { ?>
                    <a href="retire.php?id=<?php echo $row['id']?>&&matricule=<?php echo $row['matricule']?>" class="link-danger">
                    <i class="align-middle" data-feather="external-link"></i>
                    </a>
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
    
<script>
  $(document).ready(function () {
    $('#example').DataTable({
        pagingType: 'full_numbers',
    });
});
</script>
</body>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comptabilite";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
// echo "Connected successfully";
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
                     $sqlc = "SELECT codecomptable FROM plan_tiers2022";
                    if ($res=mysqli_query($conn,$sqlc))
                    {
                    $rowcount=mysqli_num_rows($res);
                    printf($rowcount);
                    } ?> /
                    <?php
                     $sqlc = "SELECT codecomptable FROM plan_tiers2022";
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
                <th>Code Comptable</th>
                <th>Nom et Prenoms</th>
                <th>Pseudonyme</th>
                <th>Groupe</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM plan_tiers2022 ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {?>

            <tr>
                <td align='left'><?php echo $row['codecomptable'] ?></td>
                <td align='left'><?php echo $row['raison_sociale'] ?></td>
                <td align='left'><?php echo $row['pseudo'] ?></td>
                <td align='left'><?php echo $row['groupe'] ?></td>               
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
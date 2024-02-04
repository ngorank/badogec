
<?php
include "../db_conn.php";
$nomcommande=$_GET['nomcommande'];
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
	<title>BaDoGeC</title>

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

					<h1 class="h3 mb-3">Commande de cartes contenant<b style='color:red'>
                    <?php
                     $sqlc = "SELECT nomcommande FROM baseofficielle WHERE nomcommande = '$nomcommande' ";
                    if ($res=mysqli_query($conn,$sqlc))
                    {
                    $rowcount=mysqli_num_rows($res);
                    printf($rowcount);
                    } ?></b> demandes

                    </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">

 <div class="container">
    <div class="text-center mb-4">

    <?php
        $sqlcom = "SELECT * FROM commandecarteics WHERE nomcommande='$nomcommande'";
        $results = mysqli_query($conn, $sqlcom);        
        while ($row = mysqli_fetch_assoc($results)) {?>
            <?php  $statut=$row['statut'] ?>
    <?php  }  ?> 

    <?php 
    if ($statut==0) { ?>
       

    <?php
    $sqlc = "SELECT nomcommande FROM baseofficielle WHERE nomcommande = '$nomcommande' ";        
    if ($res=mysqli_query($conn,$sqlc))
    {
    $rowcount=mysqli_num_rows($res);
   
        if($rowcount<0) { ?>           
            <a href="add_new.php?nomcommande=<?php echo $nomcommande ?>" class="btn btn-success fw-bold">
            Ajouter Nouveau
            </a>
            <?php } 



        else{ ?> 
            <a href="add_new.php?nomcommande=<?php echo $nomcommande ?>" class="btn btn-success fw-bold">
            Ajouter Nouveau
            </a>
            <a href="../Exportation/index.php?nomcommande=<?php echo $nomcommande ?>" target="_blank" class="btn btn-primary fw-bold">
            Exporter le dossier en EXCEL
            </a>
  
 
            <?php }  } ?> 
 
 
       <?php  } else { ?> 
            <a href="../Exportation/index.php?nomcommande=<?php echo $nomcommande ?>" class="btn btn-primary fw-bold">
            Exporter le dossier en EXCEL
            </a>
       <?php  }   ?>  

    <table id="example" class="display" style="width:100%">
        <thead style="background: black; color:white">
        <tr>
            <th>Photo</th>
            <th>Matricule</th>
            <th>Nom et Prenoms</th>
            <th>Pseudonyme</th>
            <th>Qualité</th>
            <th>Mobile Phone</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM baseofficielle WHERE nomcommande='$nomcommande' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {?>
             <?php 
             if($row['statutverification']==1)
             {
                $statutverification = '<img src="../logo/verification.png" title="Pas vérifié avec le societaire" width="25px">';
             }
             else{
                $statutverification = '<img src="../logo/non-verifie.png" width="25px">';
             }

             if($row['statut']=='OK')
             {?>
            <tr>
			<td>			
                <a href="photo.php?matricule=<?php echo $row['matricule'] ?>&&nomcommande=<?php echo $row['nomcommande']; ?>">
				<img src='../uploads/<?php echo $row['matricule'] ?>.jpg'  width='30px'/>
                </a>
				</td>
                <td align='left'><?php echo $row['matricule'] ?></td>
                <td align='left'><?php echo $row['RaisonSociale'] ?></td>
                
                <td align='left'><?php echo $row['pseudonyme'] ?></td>
                <td align='left'><?php echo $row['qualite'] ?></td>
                <td><?php echo $row['MobilePhone'] ?></td>
                <td>
              <?php 
                 if($row['statutverification']==1)
                 {?>
                 <?php echo $statutverification; ?>
               <?php  } 

             else{ ?>
               
               <?php echo $statutverification; ?> 
             
               <?php  } ?>
               <!--?php echo $row['DateAdhesion'] ?-->
                </td> 
                <td>
                    <a href="profile/edit.php?id=<?php echo $row['id'] ?>&&nomcommande=<?php echo $row['nomcommande'] ?>" class="link-warning">
                        <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>Mod</a>
                        <a target="_blank" href="../TCPDF/impression/?matricule=<?php echo $row['matricule'] ?>" class="link-danger">Imp<i class="fa-solid fa-print fs-5"></i></a>
                </td>
            </tr>
               <?php  } 

             else{ ?>

<tr style='background-color:yellow'>
			<td>			
                <a href="photo.php?matricule=<?php echo $row['matricule'] ?>&&nomcommande=<?php echo $row['nomcommande']; ?>">
				<img src='../uploads/<?php echo $row['matricule'] ?>.jpg'  width='30px'/>
                </a>
				</td>
                <td align='left'><?php echo $row['matricule'] ?></td>
                <td align='left'><?php echo $row['RaisonSociale'] ?></td>
                
                <td align='left'><?php echo $row['pseudonyme'] ?></td>
                <td align='left'><?php echo $row['qualite'] ?></td>
                <td><?php echo $row['MobilePhone'] ?></td>
                <td>
                <?php echo $statutverification; ?>
                    <!--?php echo $row['DateAdhesion'] ?-->
                </td> 
                <td>
                    <a href="profile/edit.php?id=<?php echo $row['id'] ?>&&nomcommande=<?php echo $row['nomcommande'] ?>" class="link-warning">
                        <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>Mod</a>
                    <!--a href="delete.php?id=<?php echo $row['id'] ?>" class="link-danger">
                        <i class="fa-solid fa-trash fs-5"></i></a-->
                        <a target="_blank" href="../TCPDF/impression/?matricule=<?php echo $row['matricule'] ?>" class="link-danger">Imp<i class="fa-solid fa-print fs-5"></i></a>
						<!--a href="delete.php?id=<?php echo $row['id'] ?>" class="link-danger">
                        <i class="fa-solid fa-trash fs-5"></i></a-->
                </td>
            </tr>
            <?php } ?>
            
           <?php  } ?>
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
<?php
header('Location:pages/static/');
?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Commande de cartes</title>
    <style>
        tr:nth-child(1) {
        background: pink;
        }
    </style>
<script src="plotly-latest.min.js"></script>
</head>

<body>
<nav class=" navbar  navbar-light justify-content-center fs-3 mb-5 fw-bold" style="background-color: #00ff5573;">
    Application de Cartes

  <button type="button" class="btn btn-defaut position-relative justify-content-left">
        
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $nRows = $pdo->query('select count(*) from baseofficielle')->fetchColumn() ?>
    <span class="visually-hidden">unread messages</span>
  </span>
</button>


</nav>

<div class="container">
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

    }
    ?>

    <a href="nouveaudossier.php" class="btn btn-secondary fw-bold">Ajouter Nouveau Dossier </a>

    <table class="table table-hover text-center mt-3 fw-bold">
        <thead class="table-dark">
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">Nom et Prenoms</th>
            <th scope="col">Pseudonyme</th>
            <th scope="col">Qualité</th>
            <th scope="col">Mobile Phone</th>
            <th scope="col">Date Adhesion</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "db_conn.php";
        $sql = "SELECT * FROM baseofficielle ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {?>
        
            <tr>
			<td>
				<!--?php
					 $imageUrl="http://192.168.3.228/ndcartes/<img src='images/".$row['matricule'].".jpg'/>";
					$ch=curl_init($imageUrl);
						curl_setopt($ch, CURLOPT_NOBODY, true);
						curl_exec($ch);
						$code= curl_getinfo($ch, CURLINFO_HTTP_CODE );
						curl_close($ch);
						if ($code==200) {
							echo "<img src='images/".$row['matricule'].".jpg' width='30px'/>";
						}else {
							echo 'Image absente';
						}

				?-->
			
                <a href="photo.php?matricule=<?php echo $row['matricule'] ?>">
				<img src='uploads/<?php echo $row['matricule'] ?>.jpg'  width='30px'/>
                </a>
				</td>
                <td align='left'><?php echo $row['RaisonSociale'] ?></td>
                
                <td align='left'><?php echo $row['pseudonyme'] ?></td>
                <td align='left'><?php echo $row['qualite'] ?></td>
                <td><?php echo $row['MobilePhone'] ?></td>
                <td><?php echo $row['DateAdhesion'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-warning">
                        <i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <!--a href="delete.php?id=<?php echo $row['id'] ?>" class="link-danger">
                        <i class="fa-solid fa-trash fs-5"></i></a-->
                        <a target="_blank" href="TCPDF/impression/?matricule=<?php echo $row['matricule'] ?>" class="link-danger"><i class="fa-solid fa-print fs-5"></i></a>
						<!--a href="delete.php?id=<?php echo $row['id'] ?>" class="link-danger">
                        <i class="fa-solid fa-trash fs-5"></i></a-->
                </td>
            </tr>

			
			
            <?php } ?>

        </tbody>
    </table>



    <div id="myPlot" style="width:100%;max-width:700px"></div>
<input type='hidden' id='variableAPasser' value='<?php echo 100; ?>'>
<script>
  let test = document.getElementById('variableAPasser').value; 

const xArray = ["Italy", "France", "Spain", "USA", "Argentina","Cote d'Ivoire"];
const yArray = [55, 49, 30, 40, 66,49];
const layout = {title:"World Wide Wine Production"};
const data = [{labels:xArray, values:yArray, type:"pie"}];
Plotly.newPlot("myPlot", data, layout);
</script> 
</div>

</body>
</html>

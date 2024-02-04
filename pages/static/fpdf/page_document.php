<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  Les Documents et les Attestations </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	</head>				
	<body>
		<br><br><br>
		<div class="container col-md-6 col-md-offset-3">
			<h2>Séléctionner le document à imprimer</h2>
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					
					<a class="btn btn-primary" 	href="att_inscription.php">
                        Attestation d'inscription
                    </a>
					|
					<a class="btn btn-success" href="att_scolarite.php?ids=<?php echo $ids ?>&as=<?php echo $as ?>">
						Attestation de scolarité
					</a>
					|
					<a class="btn btn-info" href="demande_stage.php">
                        Demande de Stage
                    </a>
				
				</div>
			</div>			
		</div>
	</body>	
</html>

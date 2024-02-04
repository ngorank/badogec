<?php
//$nomcommande=$_GET['nomcommande'];
include "../db_conn.php";
$id = $_GET['id'];
$matricule = $_GET['matricule'];
if(isset($_FILES['verso'])){
$matricule = $_POST['matricule'];
$errors= array();
$max_file_size = 9097152;//2MB
$file_name = $_FILES['verso']['name'];
$file_size =$_FILES['verso']['size'];
$file_tmp =$_FILES['verso']['tmp_name'];
$file_type=$_FILES['verso']['type'];  

$file_ext=substr(strrchr($file_name, '.'), 1);
$nouveau_nom_fichier = $matricule.'V'.".".$file_ext;
$extensions_autorisees = array("jpg","JPG");        
if(in_array($file_ext, $extensions_autorisees)=== false){
$errors[]="<span style='color:red'>Veuillez convertir la photo au format<b> jpg</b>.</span>";
}
if($file_size > $max_file_size){
$errors[]='File size must be excately 2 MB'; 
}              
if(empty($errors)==true){
move_uploaded_file($file_tmp,"../pieces/".$nouveau_nom_fichier);

$sql = "UPDATE baseofficielle SET imageVerso='$nouveau_nom_fichier' WHERE `id`='$id' ";
$result = mysqli_query($conn, $sql);
if ($result) {
  header("Location:pieces.php?id=$id&&matricule=$matricule");
} else {
    echo "Echoué: " . mysqli_error($conn);
    print_r($errors[0]);
}


 

//header("Location:pieces.php?id=$id&&matricule=$matricule");


}
}




if(isset($_FILES['recto'])){
    $matricule = $_POST['matricule'];
    $errors= array();
    $max_file_size = 9097152;//2MB
    $file_name = $_FILES['recto']['name'];
    $file_size =$_FILES['recto']['size'];
    $file_tmp =$_FILES['recto']['tmp_name'];
    $file_type=$_FILES['recto']['type'];  
    
    $file_ext=substr(strrchr($file_name, '.'), 1);
    $nouveau_nom_fichier = $matricule.'R'.".".$file_ext;
    
    $extensions_autorisees = array("jpg","JPG");        
    if(in_array($file_ext, $extensions_autorisees)=== false){
    $errors[]="<span style='color:red'>Veuillez convertir la photo au format<b> jpg</b>.</span>";
    }
    if($file_size > $max_file_size){
    $errors[]='File size must be excately 2 MB';
    }              
    if(empty($errors)==true){
    move_uploaded_file($file_tmp,"../pieces/".$nouveau_nom_fichier);
    header("Location:pieces.php?id=$id&&matricule=$matricule");
    
    $sql = "UPDATE baseofficielle SET imageRecto='$nouveau_nom_fichier' WHERE `id`='$id' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location:pieces.php?id=$id&&matricule=$matricule");
    } else {
        echo "Echoué: " . mysqli_error($conn);
        print_r($errors[0]);
    }

    }
    }
?>
<?php

$sql = "SELECT * FROM baseofficielle  WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
     $id = $row['id'];
     $matricule = $row['matricule'];
     $imageRecto = $row['imageRecto'];//
     $imageVerso = $row['imageVerso'];
    }

?>


<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Accept: text/html,application/xhtml+xml,application/xml">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

  <title>BaDoGeC</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
.form-input {
  width:250px;
  padding:10px;
  background:#fff;
  border:2px dashed #555;
}
.form-input input {
  display:none;
}
.form-input label {
  display:block;
  width:100%;
  height:25px;
  line-height:30px;
  text-align:center;
  background:#333;
  color:#fff;
  font-size:10px;
  font-family:"Open Sans",sans-serif;
  text-transform:Uppercase;
  font-weight:600;
  border-radius:8px;
  cursor:pointer;
}

.form-input img {
  width:100%;
  display:none;
  margin-top:10px;
}
</style>
</head>

<body>
<div class="wrapper">
		<?php include "menugauche.php"; ?>
		<div class="main">
		<?php include "entete.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">
			
<div class="container">
    <div class="container d-flex justify-content-center">
<form action="" method="post" enctype="multipart/form-data">
<h1>Recto de la pièce</h1>
<img src="../pieces/<?php echo $imageRecto ?>" width='160px'> 

<input type="text" hidden  name="matricule" value="<?php echo $matricule = $_GET['matricule'] ?>"><br/><br/>

<div class="center">
  <div class="form-input">
  <img id="file-ip-1-preview">
  <br>
    <label for="file-ip-1">Télécharger Photo</label>
    <input type="file" name="recto" id="file-ip-1" accept="image/*" onchange="showPreview1(event);">
    <div class="preview">
      
    </div>
  </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-success fw-bold" name="submit"> Enregistrer </button>
  
</div>
</form>
</div>


<hr>



<div class="container d-flex justify-content-center">
<form action="" method="post" enctype="multipart/form-data">
  <h1>Verso de la pièce</h1>
  <img src="../pieces/<?php echo $imageVerso ?>" width='160px'> 

<input type="text" hidden  name="matricule" value="<?php echo $matricule = $_GET['matricule'] ?>"><br/><br/>

<div class="center">
  <div class="form-input">
  <img id="file-ip-2-preview">
  <br>
    <label for="file-ip-2">Télécharger Photo</label>
    <input type="file" name="verso" id="file-ip-2" accept="image/*" onchange="showPreview2(event);">
    <div class="preview">
      
    </div>
  </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-success fw-bold" name="submit"> Enregistrer </button>
   
</div>

<!--input type="submit"  value="Upload" name="submit"-->
<hr>
<p center>
<a href='RetraitDeCartes.php' class="btn btn-warning fw-bold" style='width:120px'> Retour </a>
<a href="fpdf/retrait-carte.php?id=<?php echo $id ?>&&matricule=<?php echo $matricule ?>" class="btn btn-danger fw-bold" target="_blank" style='width:120px'> imprimer </a>
</p>
</form>
</div>






			</main>
            <?php include "footer.php"; ?>          
        </div>
	</div>

	<script src="js/app.js"></script>

<script>

function showPreview1(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}

function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-2-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}

</script>
</body>

</html>
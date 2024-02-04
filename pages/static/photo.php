<?php
$nomcommande=$_GET['nomcommande'];
include "../db_conn.php";
$matricule = $_GET['matricule'];

$matricule = $_GET['matricule'];
if(isset($_FILES['file'])){
$matricule = $_POST['matricule'];
$errors= array();
$max_file_size = 9097152;//2MB
$file_name = $_FILES['file']['name'];
$file_size =$_FILES['file']['size'];
$file_tmp =$_FILES['file']['tmp_name'];
$file_type=$_FILES['file']['type'];  

$file_ext=substr(strrchr($file_name, '.'), 1);
$nouveau_nom_fichier = $matricule.".".$file_ext;

$extensions_autorisees = array("jpg","JPG");        
if(in_array($file_ext, $extensions_autorisees)=== false){
$errors[]="<span style='color:red'>Veuillez convertir la photo au format<b> jpg</b>.</span>";
}
if($file_size > $max_file_size){
$errors[]='File size must be excately 2 MB';
}              
if(empty($errors)==true){
move_uploaded_file($file_tmp,"../uploads/".$nouveau_nom_fichier);
header("location:profile/index.php?matricule=$matricule&nomcommande=$nomcommande");

}else{
  print_r($errors[0]);
}
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
<img src="../uploads/<?php echo $matricule = $_GET['matricule'] ?>.jpg" width='160px'> 

<input type="text" hidden  name="matricule" value="<?php echo $matricule = $_GET['matricule'] ?>"><br/><br/>

<div class="center">
  <div class="form-input">
  <img id="file-ip-1-preview">
  <br>
    <label for="file-ip-1">Télécharger Photo</label>
    <input type="file" name="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
    <div class="preview">
      
    </div>
  </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-success fw-bold" name="submit"> Enregistrer </button>
    <a href='listedelacommande.php?nomcommande=<?php echo $nomcommande ?>' class="btn btn-warning fw-bold"> Annuler </a>
   
</div>

<!--input type="submit"  value="Upload" name="submit"-->

</form>
				</div>
			</main>
            <?php include "footer.php"; ?>          
        </div>
	</div>

	<script src="js/app.js"></script>
<script>
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
</script>
</body>

</html>
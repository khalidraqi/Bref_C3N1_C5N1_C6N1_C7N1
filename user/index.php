<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dèvleloppeurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

<?php

include_once '../connect.php';

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "USER"){
echo 'Bienvenue ' .$_SESSION['user']->NAME;
}
}else{
    header("location:http://localhost/brief/login.php",true); 
    die(""); 
}
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:http://localhost/brief/login.php",true); 
    }
?>

<form action="">
<a href="competences.php" class="btn btn-warning" type="submit" name="edit" >Ajouter des compètences</a>

<button class="btn btn-success" type='submit' name='logout'>Deconnexion</button>
</form>
</nav>

<h1 class= "container mt-4 ">liste des vos informations</h1>

<h2 class= "container mt-4 ">liste des competences </h2>
<?php

include_once '../connect.php';


$users_id = $_SESSION['user']->ID;
$sql =$database->prepare("SELECT * FROM technos WHERE users_id = $users_id "); 

$sql->execute();

foreach($sql AS $result){
echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
  <h5 class="card-title"> html : ' .$result["html"] . '</h5>

</div>
</div>
';
echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
  <h5 class="card-title"> cgi : '  .$result["cgi"] . '</h5>

</div>
</div>
';

echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
  <h5 class="card-title"> js : ' .$result["js"] . '</h5>

</div>
</div>
';

echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
  <h5 class="card-title"> ajax : ' .$result["ajax"] . '</h5>

</div>
</div>
';

echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
  <h5 class="card-title"> php : ' .$result["php"] . '</h5>

</div>
</div>
';


}
?>
<h2 class= "container mt-4 "> formations </h2>
<?php

include_once '../connect.php';


$users_id = $_SESSION['user']->ID;
$sql =$database->prepare("SELECT * FROM formations WHERE users_id = $users_id "); 
$sql->execute();


foreach($sql AS $result){
echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-title"> Nom : ' .$result["NAME"] . '</h5>
</div>
</div>
';  

echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-text"> Nom du famille : ' . $result["FAMILYNAME"] .' </h5>
</div>
</div>
';  

  
echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-title"> Tchnologie : ' .$result["TCHNOLOGIE"] . '</h5>
</div>
</div>
';

echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-title"> Datè : '  .$result["DATE"] . '</h5>
</div>
</div>
';

}
?>
</body>
</html>
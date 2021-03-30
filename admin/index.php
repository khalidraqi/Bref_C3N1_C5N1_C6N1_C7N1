<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

<?php

include_once '../connect.php';

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "ADMIN"){
echo 'Bienvenue ' .$_SESSION['user']->NAME;
}else{
    header("location:http://localhost/brief/login.php",true);  
    die("");
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
<a href="formations.php" class="btn btn-warning" type="submit" name="edit" > Ajouter formations</a>

<button class="btn btn-success" type='submit' name='logout'>Deconnexion</button>

</form>
</nav>

<h1 class= "container" > Liste dèveloppeurs </h1>
<h2 class= "container" > Liste d'informations des dèveloppeues </h2>

<?php

include_once '../connect.php';


$sql =$database->prepare("SELECT * FROM users "); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-info mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">ID : '.$result["ID"] . ' </div>
  <div class="card-body">
    <h5 class="card-title"> Nom : ' .$result["NAME"] . '</h5>
    <h5 class="card-text"> Nom du famille : ' . $result["FAMILYNAME"] .' </h5>
    <h5 class="card-text"> Email : ' . $result["EMAIL"] .' </h5>
    <h5 class="card-text">Role : ' . $result["ROLE"] .' </h5>
    <form method="POST"> <button class="btn btn-danger" type="submit" name="remove" value="'.$result['ID'] .' "> Supprimer </button></from/>
    <a href="edit.php?edit='. $result['ID'].'" class="btn btn-light" type="submit" name="edit" >Modification</a>

  </div>
</div>
';

}
if(isset($_POST['remove'])){
  $removeProduct = $database->prepare("DELETE FROM users WHERE ID = :id ");
  $getID = $_POST['remove'];
  $removeProduct->bindParam("id",$getID);
  
  if($removeProduct->execute()){
  echo 'Effacement supprimè';
  header("Location: index.php");
  }else{
    echo 'Impossible de supprimer';
  }
  }
  
?>

<h2 class= "container" > Liste des compètences des dèveloppeurs </h2>

<?php

include_once '../connect.php';


$sql =$database->prepare("SELECT * FROM technos "); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-info mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">users_ID :' .$result["users_id"] . ' </div>
  <div class="card-body">
    <h5 class="card-title"> Html : ' .$result["html"] . '</h5>
    <h5 class="card-text">Cgi : ' . $result["cgi"] .' </h5>
    <h5 class="card-text">Js : ' . $result["js"] .' </h5>
    <h5 class="card-text">Ajax : ' . $result["ajax"] .' </h5>
    <h5 class="card-text">Php : ' . $result["php"] .' </h5>
    <form method="POST"> <button class="btn btn-danger" type="submit" name="remove" value="'.$result['id'] .' ">Supprimer</button></from/>
    <a href="edit2.php?edit='. $result['id'].'" class="btn btn-light" type="submit" name="edit" >Modification</a>
  </div>
</div>
';

}
if(isset($_POST['remove'])){
  $removeProduct = $database->prepare("DELETE FROM technos WHERE ID = :id ");
  $getID = $_POST['remove'];
  $removeProduct->bindParam("id",$getID);
  
  if($removeProduct->execute()){
  echo 'Effacement supprimè';
  header("Location: index.php");
  }else{
    echo 'Impossible de supprimer';
  }
  }
?>

<h2 class= "container ">Liste des formations dèveloppeurs</h2>

<?php

include_once '../connect.php';



$sql =$database->prepare("SELECT * FROM formations"); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-info mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">users_id :' .$result["users_id"] . ' </div>
  <div class="card-body">
    <h5 class="card-title"> Nom : ' .$result["NAME"] . '</h5>
    <h5 class="card-text"> Nom du famille : ' . $result["FAMILYNAME"] .' </h5>
    <h5 class="card-title"> Tochnoligie : ' .$result["TCHNOLOGIE"] . '</h5>
    <h5 class="card-title"> Datè : '  .$result["DATE"] . '</h5>
    <form method="POST"> <button class="btn btn-danger" type="submit" name="remove" value="'.$result['id'] .' ">Supprimer </button></from/>


  </div>
</div>
';

}
if(isset($_POST['remove'])){
  $removeProduct = $database->prepare("DELETE FROM formations WHERE ID = :id ");
  $getID = $_POST['remove'];
  $removeProduct->bindParam("id",$getID);
  
  if($removeProduct->execute()){
  echo 'Effacement supprimè';
  header("Location: index.php");
  }else{
    echo 'Impossible de supprimer';
  }
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

  <?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "ADMIN"){
echo 'Welcome ' .$_SESSION['user']->NAME;

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
<a class="btn btn-warning" href="index.php">Accueil</a>
<button class="btn btn-success" type='submit' name='logout'>Dèconnexion</button>

</form>
</nav>

<div class="container" >


<form method="POST" >
<h1> formations </h1>
users_id : <input class="form-control" type="int" name="users_id" required/>
<br>
Nom : <input class="form-control" type="varchar" name="NAME" required/>
<br>
Nom du famille : <input class="form-control" type="varchar" name="FAMILYNAME" required/>
<br>
Tchnologie : <input class="form-control" type="varchar" name="TCHNOLOGIE" required/>
<br>
Datè: <input class="form-control" type="date" name="DATE" required/>
<br>
<button class="btn btn-danger mt-3" type="submit" name="send">Envoyer</button>
<a class="btn btn-warning mt-3" href="index.php"> Retour </a>


</form>

<?php

include_once '../connect.php';


if(isset($_POST['send'])){
$users_id = $_POST['users_id'];
$NAME = $_POST['NAME'];
$FAMILYNAME = $_POST['FAMILYNAME'];
$TCHNOLOGIE = $_POST['TCHNOLOGIE'];
$DATE = $_POST['DATE'];

$addData = $database->prepare("INSERT INTO formations(users_id,NAME,FAMILYNAME,TCHNOLOGIE,DATE)
 VALUES(:users_id, :NAME, :FAMILYNAME, :TCHNOLOGIE, :DATE)");

 $addData->bindParam("users_id",$users_id);
 $addData->bindParam("NAME",$NAME);
 $addData->bindParam("FAMILYNAME",$FAMILYNAME);
 $addData->bindParam("TCHNOLOGIE",$TCHNOLOGIE);
 $addData->bindParam("DATE",$DATE);
 
if($addData->execute()){
  echo '<div class="alert alert-success container mt-4" role="alert">
  Il a ajoutè formations .
</div>';
 
}else{
  echo '<div class="alert alert-danger container mt-4" role="alert">
  Il y a une erreur .
</div>';
}
}

?>

</div>
    
</body>
</html>
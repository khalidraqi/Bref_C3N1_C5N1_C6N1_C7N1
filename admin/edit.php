<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="./styles/styles.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>

<nav class="navbar">
      <a href="" class="navbar__logo">
      <?php

include_once '../connect.php';

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "ADMIN"){
echo 'Bienvenue ' .$_SESSION['user']->NAME;
}else{
    header("location:http://localhost/brief/index.php",true);  
    die("");
}
}else{
    header("location:http://localhost/brief/index.php",true); 
    die(""); 
}
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:http://localhost/brief/index.php",true); 
    }

?>
      </a>
      <div class="navbar__bars"><i class="fas fa-bars"></i></div>

      <div class="navbar__menu">

       
        <form action="">
         
        <a href="dev.php" class="" type="submit" name="edit" style="margin-right: 55pc ;font-size:120%;;">Liste dèveloppeurs</a>

         <button class="btn btn-success" type='submit' name='logout'style="font-size:120%;">Deconnexion</button>
        </form>

      </div>

</nav>


<h2 class= "container">Modification d'informations des dèveloppeues </h2>
<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=briefphp2;",$username,$password);


if(isset( $_GET['edit'])){
$getProduct = $database->prepare("SELECT * FROM users WHERE ID = :id");
$getProduct->bindParam("id",$_GET['edit']);
$getProduct->execute();
foreach($getProduct AS $result){
echo '
<div class="container"> 
<form method="POST" > 
Nom : <input class="form-control" type="varchar" name="NAME" value="'.$result['NAME'].'"/>
<br>
Nom du famille : <input class="form-control" type="varchar" name="FAMILYNAME" value="'.$result['FAMILYNAME'].'"/>
<br>
Email : <input class="form-control" type="varchar" name="EMAIL" value="'.$result['EMAIL'].'"/>
<br>
Role :
<select class="form-control" type="text" name="ROLE" />

<option >'.$result['ROLE'].'</option>

<option value="ADMIN">ADMIN</option>
<option value="USER">USER</option>
</select>

<button class="btn btn-primary mt-3" type="submit" name="update" value="' . $result['ID'].'"> Update </button>
<a class="btn btn-warning mt-3" href="dev.php"> Retour </a>
</form>
</div>
';
}

if(isset($_POST['update'])){
    $update = $database->prepare("UPDATE users SET NAME = :NAME , FAMILYNAME = :FAMILYNAME , EMAIL = :EMAIL , ROLE = :ROLE WHERE ID = :ID");
    $update->bindParam("NAME",$_POST['NAME']);
    $update->bindParam("FAMILYNAME",$_POST['FAMILYNAME']);
    $update->bindParam("EMAIL",$_POST['EMAIL']);
    $update->bindParam("ROLE",$_POST['ROLE']);
    $update->bindParam("ID",$_POST['update']);
    $update->execute();
    header("Location: dev.php?edit=" . $_POST['update']);

}
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

<?php


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
<a class="btn btn-warning" href="index.php">Accueil</a>
<button class="btn btn-success" type='submit' name='logout'>Dèconnexion</button>

</form>
</nav>

<h2 class= "container">Modification des compètences des dèveloppeurs </h2>


<?php

include_once '../connect.php';




if(isset( $_GET['edit'])){
$getProduct = $database->prepare("SELECT * FROM technos WHERE id = :id");
$getProduct->bindParam("id",$_GET['edit']);
$getProduct->execute();
foreach($getProduct AS $result){
echo '
<div class="container"> 
<form method="POST" > 

html :
<select input class="form-control" type="int" name="html" />

<option type="int" >'.$result['html'].'</option>


<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
cgi : 
<select class="form-control" type="int" name="cgi"/>

<option type="int" >'.$result['cgi'].'</option>

<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
js : 
<select input class="form-control" type="int" name="js" />

<option type="int" >'.$result['js'].'</option>

<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
ajax :
<select input class="form-control" type="int" name="ajax" />

<option type="int" >'.$result['ajax'].'</option>

<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
php : 
<select class="form-control" type="int" name="php" />

<option type="int" >'.$result['php'].'</option>

<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<button class="btn btn-primary mt-3" type="submit" name="update" value="' . $result['id'].'"> Update </button>
<a class="btn btn-warning mt-3" href="index.php"> Retour </a>
</form>
</div>
';
}

if(isset($_POST['update'])){
    $update = $database->prepare("UPDATE technos SET html = :html , cgi = :cgi , js = :js , ajax = :ajax , php = :php WHERE id = :id");
    $update->bindParam("html",$_POST['html']);
    $update->bindParam("cgi",$_POST['cgi']);
    $update->bindParam("js",$_POST['js']);
    $update->bindParam("ajax",$_POST['ajax']);
    $update->bindParam("php",$_POST['php']);
    $update->bindParam("id",$_POST['update']);
    $update->execute();
    header("Location: edit2.php?edit=" . $_POST['update']);
}
}
?>
</body>
</html>
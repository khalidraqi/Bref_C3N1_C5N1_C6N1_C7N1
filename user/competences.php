<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compètence</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

<?php

include_once '../connect.php';

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "USER"){
echo 'Bienvenue ' .$_SESSION['user']->NAME ;
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
<a href="index.php" class="btn btn-warning" type="submit" name="edit" >Accueil</a>

<button class="btn btn-success" type='submit' name='logout'>Deconnexion</button>
</form>

</nav>

<h2 class= "container mt-4 ">Ajouter des compètence</h2>


<form class="container mt-4" method="POST">
html :
<select class="form-control" name="html" id="">
<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
cgi : 
<select class="form-control" name="cgi" id="">
<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
js : 
<select class="form-control" name="js" id="">
<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
ajax :
<select class="form-control" name="ajax" id="">
<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<br>
php : 
<select class="form-control" name="php" id="">
<option value="-1">-1</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>

<button class="btn btn-danger mt-4" type="submit" name="send">Envoyer</button>
<a class="btn btn-warning mt-4" href="index.php"> Retour </a>

</form>
<?php

include_once '../connect.php';


if(isset($_POST['send'])){
  
  $checkusers_id = $database->prepare("SELECT * FROM technos WHERE users_id = :users_id");
  $users_id = $_SESSION['user']->ID;
  $checkusers_id->bindParam("users_id",$users_id);
  $checkusers_id->execute();

  if($checkusers_id->rowCount()>0){
      echo '<div class="alert alert-danger container mt-4" role="alert">
      Cette information existe dèja .
    </div>';
  }else{
    $html = $_POST['html'];
    $cgi = $_POST['cgi'];
    $js = $_POST['js'];
    $ajax = $_POST['ajax'];
    $php = $_POST['php'];
    $users_id = $_SESSION['user']->ID;
      

    $addData = $database->prepare("INSERT INTO technos(html,cgi,js,ajax,php, users_id	)
    VALUES(:html, :cgi, :js, :ajax, :php, :users_id)");
   
    $addData->bindParam("html",$html);
    $addData->bindParam("cgi",$cgi);
    $addData->bindParam("js",$js);
    $addData->bindParam("ajax",$ajax);
    $addData->bindParam("php",$php);
    $addData->bindParam("users_id", $users_id ,PDO::PARAM_INT);
    
   if($addData->execute()){
          echo '<div class="alert alert-success container mt-4" role="alert">
          Enregisrè avec succès .
        </div>';
      }else{
          echo '<div class="alert alert-danger container mt-4" role="alert">
          Il y a une erreur .
        </div>';
      } 
  }
}
?>
</body>
</html>
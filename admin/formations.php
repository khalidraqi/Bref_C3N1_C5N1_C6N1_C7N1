<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formations</title>
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
        <button class="btn btn-success" type='submit' name='logout'>Dèconnexion</button>
        </form>

      </div>

</nav>


<div class="container" >


<form method="POST" >
<h1> formations </h1>

Link : <input class="form-control" type="varchar" name="LINK" required/>
<br>
Tchnologie :
<select class="form-control" type="varchar" name="TCHNOLOGIE" >
<option value="html">html</option>
<option value="cgi">cgi</option>
<option value="js">js</option>
<option value="ajax">ajax</option>
<option value="php">php</option>
</select>
<br>
Datè: <input class="form-control" type="date" name="DATE" required/>
<br>
<button class="btn btn-danger mt-3" type="submit" name="send">Envoyer</button>
<a class="btn btn-warning mt-3" href="dev.php"> Retour </a>


</form>



<?php

//var_dump($_GET);

include_once '../connect.php';

$checkusers_id = $database->prepare("SELECT * FROM technos WHERE users_id = :users_id");
$users_id = $_GET['edit'];
$checkusers_id->bindParam("users_id",$users_id);
$checkusers_id->execute();


if(isset($_POST['send'])){
$users_id = $_GET['edit'];
$LINK = $_POST['LINK'];
$TCHNOLOGIE = $_POST['TCHNOLOGIE'];
$DATE = $_POST['DATE'];

$addData = $database->prepare("INSERT INTO formations(users_id,LINK,TCHNOLOGIE,DATE)
 VALUES(:users_id, :LINK, :TCHNOLOGIE, :DATE)");

$addData->bindParam("users_id", $users_id ,PDO::PARAM_INT);
 $addData->bindParam("LINK",$LINK);
 $addData->bindParam("TCHNOLOGIE",$TCHNOLOGIE);
 $addData->bindParam("DATE",$DATE);
 
if($addData->execute()){
  header("Location: dev.php");
 
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dèvleloppeurs</title>
    <link rel="stylesheet" href="./styles/styles2.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

<nav class="navbar">
      <a href="" class="navbar__logo">
      <?php

      include_once '../connect.php';

      session_start();
      if(isset($_SESSION['user'])){
      if($_SESSION['user']->ROLE === "USER"){
      echo 'Bienvenue ' .$_SESSION['user']->NAME;
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
        <a href="index.php" class="" type="submit" name="edit" style=" margin-right: 60pc;font-size:120%;;">Accueil</a>


         <button class="btn btn-success" type='submit' name='logout'style="font-size:120%;">Deconnexion</button>
        </form>

      </div>

</nav>


<h2 class= "container mt-4 "> formations </h2>
<?php

include_once '../connect.php';


$users_id = $_SESSION['user']->ID;
$sql =$database->prepare("SELECT * FROM formations WHERE users_id = $users_id "); 
$sql->execute();


foreach($sql AS $result){
echo '<div class="card text-white bg-info  container mt-4 style="max-width: 18rem;">
<div class="card-body">


<div class="card text-white bg-warning  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-text"> Link :<a href="' . $result["LINK"] .'" class=""> ' . $result["LINK"] .' </a></h5>
</div>
</div>

<div class="card text-white bg-warning  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-title"> Tchnologie : ' .$result["TCHNOLOGIE"] . '</h5>
</div>
</div>



<div class="card text-white bg-warning  container mt-4 style="max-width: 18rem;">
<div class="card-body">
<h5 class="card-title"> Datè : '  .$result["DATE"] . '</h5>
</div>
</div>

</div>
</div>
';  

}
?>
</body>
</html>
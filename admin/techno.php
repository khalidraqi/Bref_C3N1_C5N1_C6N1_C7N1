<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher competences</title>
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

<h2 class= "container mt-4" > Liste des compètences des dèveloppeurs </h2>

<?php

include_once '../connect.php';
$id_dev = $_GET['techno'];

$sql =$database->prepare("SELECT * FROM technos where users_id= $id_dev"); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-info mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">users_ID :' .$result["users_id"] . ' </div>
  <div class="card-body">
    
  
  <div class="card text-white bg-secondary  container mt-4 style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> html : </h5>
    
    <div class="progress container mt-4">
  <div class="progress-bar bg-warning" role="progressbar" style=" width: ' .$result["html"] . '%">' .$result["html"] .  '%</div>
  </div>
  
  </div>
  </div>
  
  <div class="card text-white bg-secondary  container mt-4 style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> cgi : </h5>
  
    <div class="progress container mt-4">
    <div class="progress-bar bg-danger" role="progressbar" style=" width: ' .$result["cgi"] . '%" >' .$result["cgi"] .  '%</div>
  
  </div>
  
  </div>
  </div>
  
  
  <div class="card text-white bg-secondary  container mt-4 style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> js : </h5>
  
    <div class="progress container mt-4">
  <div class="progress-bar" role="progressbar" style=" width: ' .$result["js"] . '%">' .$result["js"] .  '%</div>
  </div>
  
  </div>
  </div>
  
  
  <div class="card text-white bg-secondary  container mt-4 style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> ajax : </h5>
  
    <div class="progress container mt-4">
    <div class="progress-bar bg-success" role="progressbar" style=" width: ' .$result["ajax"] . '%" >' .$result["ajax"] .  '%</div>
  
  </div>
  
  </div>
  </div>
  
  
  <div class="card text-white bg-secondary  container mt-4 style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> php : </h5>
  
    <div class="progress container mt-4">
  <div class="progress-bar bg-info" role="progressbar" style=" width: ' .$result["php"] . '%">' .$result["php"] .  '%</div>
  </div>
  
  
  </div>
  </div>


    <form method="POST"> <button class="btn btn-danger mt-4" type="submit" name="remove" value="'.$result['id'] .' ">Supprimer</button></from/>
    <a href="edit2.php?edit='. $result['id'].'" class="btn btn-light mt-4" type="submit" name="edit" >Modification</a>
    <a href="formations.php?edit='. $result['users_id'].'" class="btn btn-primary mt-4 " type="submit" name="edit" > Ajouter formations</a>


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
  header("Location: dev.php");
  }else{
    echo 'Impossible de supprimer';
  }
  }
?>


<h2 class= "container mt-4" > Liste des formations dèveloppeurs </h2>


<?php

include_once '../connect.php';
$id_dev = $_GET['techno'];



$sql =$database->prepare("SELECT * FROM formations where users_id= $id_dev"); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-secondary mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">users_id :' .$result["users_id"] . ' </div>
  <div class="card-body">

    <h5 class="card-text"> Link :  <a href="' . $result["LINK"] .'" class=""> ' . $result["LINK"] .' </a> </h5>
    <h5 class="card-title"> Tochnoligie : ' .$result["TCHNOLOGIE"] . '</h5>
    <h5 class="card-title"> Datè : '  .$result["DATE"] . '</h5>
    <form method="POST"> <button class="btn btn-danger mt-4" type="submit" name="remove" value="'.$result['id'] .' ">Supprimer </button></from/>


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
  header("Location: dev.php");
  }else{
    echo 'Impossible de supprimer';
  }
}


?>

</body>
</html>
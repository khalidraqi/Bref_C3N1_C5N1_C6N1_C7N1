<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dèveloppeurs</title>
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
         
         <a href="index.php" class="" type="submit" name="edit" style=" margin-right: 60pc;font-size:120%;;">Accueil</a>
         <button class="btn btn-success" type='submit' name='logout'style="font-size:120%;">Deconnexion</button>
        </form>

      </div>

</nav>


<h2 class= "container mt-4" >Liste d'informations des dèveloppeues</h2>
<?php

include_once '../connect.php';


$sql =$database->prepare("SELECT * FROM users WHERE ROLE ='USER'"); 

$sql->execute();

foreach($sql AS $result){
  //Récupérer ID de chaque developer
  $id_user = $result['ID'];

  echo '
  
  <div class="table-responsive">
  <table class="table">
  <div class="card text-white bg-info mb-3 container mt-4 style="max-width: 18rem;">
  <div class="card-header">ID : '.$result["ID"] . ' </div>
  <div class="card-body">
    <h5 class="card-title"> Nom : ' .$result["NAME"] . '</h5>
    <h5 class="card-text"> Nom du famille : ' . $result["FAMILYNAME"] .' </h5>
    <h5 class="card-text"> Email : ' . $result["EMAIL"] .' </h5>
    <h5 class="card-text">Role : ' . $result["ROLE"] .' </h5>
    <form method="POST"> <button class="btn btn-danger mt-4" type="submit" name="remove" value="'.$result['ID'] .' "> Supprimer </button></from/>
    <a href="edit.php?edit='. $result['ID'].'" class="btn btn-light mt-4" type="submit" name="edit" >Modification</a>
    <a href="techno.php?techno='. $result['ID'].' "class="btn btn-warning mt-4" " type="submit" name="techno" >Afficher les Technos</a>

  </div>
</div>
  </table>
</div>

';

}
if(isset($_POST['remove'])){
  $removeProduct = $database->prepare("DELETE FROM users WHERE ID = :id ");
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
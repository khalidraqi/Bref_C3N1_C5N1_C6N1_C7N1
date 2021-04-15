<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

<div class="hero">
      <div class="hero__container">
        
        <div class="hero__container--left">
          <h1>Voir les développeurs  </h1>
          <h2>et leurs compétences particulières .</h2>
          <p>Regarde maintenant d'ici .</p>
          <button class="hero__container--btn"><a href="dev.php">Liste dèveloppeurs</a></button>
        </div>
        <div class="hero__container--right">
          <img
            src="images/Wavy_Bus-10_Single-03.jpg"
            alt="alien"
            class="hero__container--img"
          />
        </div>
      </div>
    </div>
</body>
</html>
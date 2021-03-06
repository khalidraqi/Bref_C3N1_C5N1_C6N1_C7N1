<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dèvleloppeurs</title>
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
         <a href="acompetences.php" class="" type="submit" name="edit" style="margin-right: 2pc ;font-size:120%;;">Afficher des compètences</a>
         <a href="formations.php" class="" type="submit" name="edit" style="margin-right: 2pc ;font-size:120%;;">Afficher des formations</a>
         <a href="competences.php" class="" type="submit" name="edit" style="margin-right: 50pc ;font-size:120%;;">Ajouter des compètences</a>

         <button class="btn btn-success" type='submit' name='logout'style="font-size:120%;">Deconnexion</button>
        </form>

      </div>

</nav>

<div class="hero">
      <div class="hero__container">
        
        <div class="hero__container--left">
          <h1>Entrez vos compétences en programmation </h1>
          <h2>et attendez les formations .</h2>
          <p>Inscrivez-vous compètences maintenant.</p>
          <button class="hero__container--btn"><a href="competences.php">Ajouter des compètences</a></button>
        </div>
        <div class="hero__container--right">
          <img
            src="images/19198999.jpg"
            alt="alien"
            class="hero__container--img"
          />
        </div>
      </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./styles/styles2.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>

<!-- Navbar Section -->
<nav class="navbar">
      <a href="" class="navbar__logo">WeDev</a>
      

      <div class="navbar__bars"><i class="fas fa-bars"></i></div>

      <div class="navbar__menu">
        <a href="index.php" class="" type="submit" name="edit" style=" margin-right: 60pc;font-size:120%;;">Accueil</a>
        <a href="register.php" class="navbar__menu--links" id="button">register</a>
      </div>
    </nav>


    <div class="row justify-content-center">
    <div class="col-4">
    <div class="hero__container--right ">
          <img
            src="images/Wavy_Tech-28_Single-10.jpg"
            alt="alien"
            class="hero__container--img"
          />
        </div>
    </div>


    <div class="col-4">
    <h1 class="container mt4" >Connexion</h1>

    <div class="container mt-4" >
    <form method="POST">

    Email :<input class="form-control" type="email" name="email" />
    <br>
    Mot de passe  :<input class="form-control" type="password" name="password" />

   <button class="btn btn-success  mt-4" type="submit" name="login">Connexion</button>

   </form>
   </div>
   </div>
  </div>



<?php
if(isset($_POST['login'])){

include_once 'connect.php';

$login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD = :password");
$login->bindParam("email",$_POST['email']);
$passwordUser = sha1($_POST['password']);
$login->bindParam("password",$passwordUser);
$login->execute();
if($login->rowCount()===1){
$user = $login->fetchObject();
session_start();
$_SESSION['user'] = $user;

if($user->ROLE ==="USER"){
    
header("location:user/index.php",true);

}else if($user->ROLE ==="ADMIN"){
 header("location:admin/index.php",true);
}

}else{
 echo '

 <div class="row justify-content-center">
 <div class="col-4">
 <div class="alert alert-danger mt-4 container">
 Incorrect Mot de passe ou email 
 </div>
 </div>
 </div>

<div class="col-4">
</div>
</div>';   
}
}
?>

</body>
</html>
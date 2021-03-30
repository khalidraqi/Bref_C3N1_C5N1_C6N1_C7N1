<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  
  <h3>logo</h3>
  <a class="nav-link" href="index.php">Accueil</a>
  <a class="btn btn-warning" href="register.php">register</a>

</nav>

<h1 class="container mt-4" >Connexion</h1>

<div class="container mt-4" >
<form method="POST">

Email :<input class="form-control" type="email" name="email" />
<br>
Mot de passe  :<input class="form-control" type="password" name="password" />

<button class="btn btn-primary  mt-4" type="submit" name="login">Connexion</button>

</form>
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
 <div class="alert alert-danger mt-4 container">
 Incorrect Mot de passe ou email 
 </div>
 ';   
}
}
?>

</body>
</html>
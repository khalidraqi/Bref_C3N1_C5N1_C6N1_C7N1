<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>

<nav class="navbar navbar-light" style="background-color: #e3f2fd;">

  <h3>logo</h3>
  <a class="nav-link" href="index.php">Accueil</a>
  <a class="btn btn-warning" href="login.php">Connexion</a>

</nav> 

<h1 class="container mt-4" >Register</h1>

<div class="container mt-4" >

<form method="POST" >
Nom : <input class="form-control " type="text" name="name"/>
<br>
Nom du famille : <input class="form-control" type="text" name="familyname"/>
<br>
Email : <input class="form-control" type="email" name="email" />
<br>
Mot de passe : <input class="form-control" type="password" name="password"/>
<br>
<button class="btn btn-primary" type="submit" name="register">Register</button>
</form>

</div>


<?php 

include_once 'connect.php';

if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger container mt-4" role="alert">
        Cet èmail a ètè utiliè plus tot .
      </div>';
    }else{
        $name =$_POST['name'] ;
        $familyname =$_POST['familyname'] ;
        $password = sha1($_POST['password']) ;
        $email = $_POST['email'];
        

        $addUser = $database->prepare("INSERT INTO users(NAME,FAMILYNAME,PASSWORD,EMAIL,ROLE)
         VALUES(:NAME,:FAMILYNAME,:PASSWORD,:EMAIL,'USER')");
        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("FAMILYNAME",$familyname);
        $addUser->bindParam("EMAIL",$email);
        $addUser->bindParam("PASSWORD",$password);
        if($addUser->execute()){
            echo '<div class="alert alert-success container mt-4" role="alert">
            Compte crèè avec succès 
          </div>';
        }else{
            echo '<div class="alert alert-danger container mt-4" role="alert">
            Il y a une erreur 
          </div>';
        } 
    }
}
?>
</body>
</html>
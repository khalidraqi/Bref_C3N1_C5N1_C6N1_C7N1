<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
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
        <a href="login.php" class="navbar__menu--links" id="button">Connexion</a>
      </div>
    </nav>

    <div class="row justify-content-center" >
    <div class="col-4">
    <div class="hero__container--right ">
          <img
            src="images/Mobileloginpana.svg"
            alt="alien"
            class="hero__container--img"
          />
        </div>
    </div>
    <div class="col-4">
    <h1 class="container mt4" >Register</h1>

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
     <button class="btn btn-success" type="submit" name="register">Register</button>
     </form>
   </div>
   </div>
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
          header("Location: login.php");
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
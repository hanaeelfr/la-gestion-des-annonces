<?php
    $msg="";
    $servername = "localhost";
    $username = "root";
    $password = "";

    try
        {
            $conn = new PDO("mysql:host=$servername;dbname=gestion_des", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        }
        catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }

        

        if(isset($_POST['submit']))
        {
        $Nom = $_POST["nom"];
        $Prenom = $_POST["prenom"];
        $Email = $_POST["email"];
        $Password = $_POST["pswd"];
        $Numero =$_POST["Tele"];

        $connexion = $conn->prepare("INSERT INTO `client` (`nom`, `prenom`, `adresse_email`, `password`, `Numero_tele`) VALUES(:nom, :prenom, :email, :password,:Tele)");
        $connexion->bindParam(':nom', $Nom);
        $connexion->bindParam(':prenom', $Prenom);
        $connexion->bindParam(':email', $Email);
        $connexion->bindParam(':password', $Password);
        $connexion->bindParam(':Tele',$Numero);

        
            
            // Vérifier si les champs obligatoires sont remplis
            // if >> au moins un champs non saisi
            if(empty($Nom) || empty($Prenom) || empty($Email) || empty($Password) || empty($Numero)){
                echo "Veuillez remplir tous les champs obligatoires";
            } 
            // else >> tous les champs sont saisis
            
            if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!.%*#?&])[A-Za-z\d@$!.%*#?&]{8,}$/", $Password)){
                        $msg="Minimum eight characters, at least one letter, one number and one special character";
                    }
                    else {
                        if($_POST['pswd']==$_POST['confermer']){
                            $connexion->execute();
                            header("Location: connexion.php");
                        }else{
                            echo "Votre confermation n'a pas valider";
                        }
                        
                        }
                    

                        
            }

        $sth = $conn->prepare("SELECT * FROM `client`");
        $sth->execute();
        $response = $sth->fetchAll();


    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agence.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>inscription</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <img src="logo.png" alt="logo" class="p-3" width="10%">
            <div class="d-flex me-5">
                <form class="form-inline" action="connexion.php"  method="POST">
                    <button class="btn btn-outline-primary my-2 my-sm-0 me-2">Login</button>
                </form>
                <form class="form-inline" action="accuiel.php" method="POST" >
                    <button class="btn btn-outline-primary">Accuiel</button>
                </form>
            </div>
    </nav>
<section class="vh-100" style="background-color: #ffff;">
<div class="container py-5 h-100">
  <div class="card-body p-4 p-md-5">
    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 ">
        <h3 class="text-center h1 fw-bold p-5 text-primary-emphasis">Créer votre compte</h3>
            <form action="" method="POST">
            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0 ">
                    <input type="text" name="nom" id="form3Example1c" class="form-control" />
                    <label class="form-label text-secondary" for="form3Example1c">votre nom <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                    <input type="text" name="prenom" id="form3Example3c" class="form-control" />
                    <label class="form-label text-secondary" for="form3Example3c">votre prénom <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                    <input type="email" name="email" id="form3Example3c" class="form-control" />
                    <label class="form-label text-secondary" for="form3Example3c">votre email <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                    <input type="password" name="pswd" onkeyup="passwordValid()" id="password" class="form-control" />
                    <label class="form-label text-secondary" for="password">Mot de passe <span class="text-danger">*</span> </label>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                    <!-- <i class="fas fa-key fa-lg me-3 fa-fw"></i> -->
                <div class="form-outline flex-fill mb-0">
                    <input type="password" id="conMTP" name='confermer' class="form-control" />
                    <label class="form-label" for="form3Example4cd">confirmer le mot de passe <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                <input type="tel" id="form3Example4c" name="Tele" class="form-control" pattern="[0]{1}[5-8]{1}[0-9]{8}">
                    <label class="form-label text-secondary" for="form3Example4c">Numero de tele <span class="text-danger">*</span> </label>
                </div>
            </div>
            <p style="color:red;margin-left:4%;"><?php echo $msg;?></p>

           
                
            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 p-2">
              <input type="submit"  class="btn btn-outline-success my-sm-0 mb-3 ms-5" name="submit" value="S'inscrire">
            </div>
                
            </form>
    </div>
  </div>
</div>
</section>
<script>
 function passwordValid(){
    let mtp = document.getElementById("password").value;
    let regEx = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!.%*#?&])[A-Za-z\d@$!.%*#?&]{8,}$/;

    if(regEx.test(mtp)){
        document.getElementById("password").style.border='5px solid green';
    }
    else{
        document.getElementById("password").style.border='5px solid red';
    }
    document.getElementById("conMTP").onkeyup=function(){
        let confMTP = document.getElementById("conMTP").value;
        if(confMTP==mtp){
            document.getElementById("conMTP").style.border='5px solid green';
        }
        else{
            document.getElementById("conMTP").style.border='5px solid red';
        }

    }
 }
</script>


</body>
</html>
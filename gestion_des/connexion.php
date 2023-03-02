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
        if(isset($_POST['submit'])) {
            $email = $_POST["email"];
            $password = $_POST["pswd"];
        
            $connexion = $conn->prepare("SELECT * FROM `client` WHERE `adresse_email` = :email AND `password` = :password");
            $connexion->bindParam(':email', $email);
            $connexion->bindParam(':password', $password);
        
            $connexion->execute();
            $result = $connexion->fetch(PDO::FETCH_ASSOC);
        
            if($result !== false) {
                // Les informations de client sont correctes, connectez l'utilisateur ici
                // Récupérer l'ID du client
                $clientID = $result['id_client'];
                // Stocker l'ID du client dans une variable de session pour l'utiliser plus tard
                session_start();
                $_SESSION['clientID'] = $clientID;
                header("Location: profile.php");
            } else {
                // Les informations d'identification sont incorrectes, affichez un message d'erreur
                $msg= "Nom d'utilisateur ou mot de passe incorrect";
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
    <title>connexion</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
        <img src="logo.png" alt="logo" class="p-3" width="10%">
            <div class="d-flex me-5">
                <form class="form-inline" action="accuiel.php" method="POST" >
                    <button class="btn btn-outline-primary">Accuiel</button>
                </form>
            </div>
    </nav>
    <div class="container py-5 h-100">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 color :#004AAD;">Connectez-vous </h3>
            <form class="px-md-2" action="" method="POST">

                <div class="form-outline mb-4">
                    <input type="email" name="email" id="form3Example1q" class="form-control" />
                    <label class="form-label" for="form3Example1q">Email <span class="text-danger">*</span></label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="pswd" id="form3Example1q" class="form-control" />
                    <label class="form-label" for="form3Example1q">Mot de passe <span class="text-danger">*</span></label>
                </div>
        
                <p style="color:red;margin-left:4%;"><?php echo $msg;?></p>
    
                <!-- Ajouter un champ caché pour stocker l'ID du client -->
                    <input type="hidden" name="clientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>">
                <div>
                    <input type="submit"  class="btn btn-outline-success my-sm-0 mb-3 ms-5 btn-lg mb-1" name="submit" value="connexion">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
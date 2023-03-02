<?php
    if(isset($_POST["deconnect"])){
        session_start();
        $_SESSION=array();
        session_destroy();
        header("Location:accuiel.php?show_element=true");
        exit;
    }
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
    <title>mon profile</title>
</head>
<body>
        <nav class="navbar navbar-light bg-light">
            <img src="logo.png" alt="logo" class="p-3" width="10%">
            <div class="d-flex me-5">
                <form class="form-inline" action="ajoute.php"  method="POST">
                <button class="btn btn-outline-primary my-2 my-sm-0 me-2">Ajouter</button>
                </form>
                <form class="form-inline"  method="post" >
                    <button class="btn btn-outline-primary" type="submit" name="deconnect">Déconcter</button>
                    <a href="accuiel.php" class="btn btn-outline-primary">Accuiel</a>
                </form>
            </div>
        </nav>
        <h1 class="text-center">Mon profil</h1>


          
    
</body>
</html>
<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['clientID'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer l'ID du client depuis la variable de session
$clientID = $_SESSION['clientID'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_des";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Exécuter une requête SQL pour récupérer les annonces du client spécifié
$stmt = $conn->prepare("SELECT * FROM annonce WHERE id_client = :clientID");
$stmt->bindParam(':clientID', $clientID);
$stmt->execute();
$annonces = $stmt->fetchAll();

// Afficher les annonces récupérées
if (count($annonces) > 0){
    foreach ($annonces as $annonce) {
        echo "  
        <div class='card mb-4' style='width: 20rem'>
                        
            <div class='card-body'>
                <h4><b>".$annonce["titre"]."</b></h4>
                <p>".$annonce["description"]."</p>
                <p>".$annonce["adresse"]."</p>
                <p>".$annonce["ville"]."</p>
                <p>Superficie : ".$annonce["superficie"]."mÂ²</p>
                <p>En".$annonce["type_annonce"]."</p>
                <p>Prix : ".$annonce["prix"]."</p>
                <p>date : ".$annonce["date_publication"]."</p>
                <input class='btn btn-outline-primary my-2 my-sm-0 me-2' name='submit' type='submit' value='Modifier'>
                </form>
            </div>
        
            </div>";
        
        }
    } else {
    echo "<h3 class='text-center'>Vous n'avez pas encore publié d'annonce.</h3>";
}




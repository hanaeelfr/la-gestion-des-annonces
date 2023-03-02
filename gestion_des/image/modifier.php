<?php
    session_start();
    $clientID = $_SESSION['clientID'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/972f63b1c4.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="agence.css">
        <title>Agence immobiliere</title>
    </head>
    <body id="ajoute">
        <section class="u-align-center u-clearfix u-gradient u-section-3" id="carousel_babd">
            <div class="u-clearfix u-sheet u-sheet-1">
            <section id="bg" class="h-100 h-custom fw-bold">
                    <div class="container py-5 h-100" id="agency">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="card-body p-4 p-md-5">
                                <h2 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Editer votre annonce :</h2>
                                <hr>
                                <form class="px-md-2" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Titre</label>
                                        <input type="text" class="form-control" name="Titre" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" name="Img" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Album</label>
                                        <input multiple type="file" class="form-control" name="Album[]" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" style="height: 15vh;" name="Description" placeholder="Minimum 10 characters.."></textarea>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Superficie</label>
                                        <input type="text" class="form-control" name="Superficie" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Adresse</label>
                                        <input type="text" class="form-control" name="adresse" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Ville</label>
                                        <select class="form-select" name="Ville">
                                            <option selected>Ville</option>
                                            <option value="Agadir">Agadir</option>
                                            <option value="Asfi">Asfi</option>
                                            <option value="Casablanca">Casablanca</option>
                                            <option value="Essaouira">Essaouira</option>
                                            <option value="Fes">Fes</option>
                                            <option value="Hoceima">Hoceima</option>
                                            <option value="Marrakech">Marrakech</option>
                                            <option value="Meknes">Meknes</option>
                                            <option value="Oujda">Oujda</option>
                                            <option value="Rabat">Rabat</option>
                                            <option value="Tanger">Tanger</option>
                                            <option value="Tetouan">Tetouan</option>
                                        </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Montant</label>
                                        <input type="text" class="form-control" name="Montant" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Type annonce</label>
                                        <select class="form-select" name="Type">
                                            <option selected>Type d'annonce</option>
                                            <option value="Location">Location</option>
                                            <option value="Vente">Vente</option>
                                        </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Categorie</label>
                                        <select class="form-select" name="Categorie">
                                            <option selected>Categorie</option>
                                            <option value="Studio">Studio</option>
                                            <option value="Appartement">Appartement</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Plateaux">Plateaux</option>
                                        </select>
                                    </div>
                                    <div>
                                    <button type="submit" name="editer" class="btn btn-outline-success bg-light fw-bold">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            try
                {
                    $conn = new PDO("mysql:host=$servername;dbname=gestion_des", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e) 
                {
                    echo "Connection failed: " . $e->getMessage();
                }
            if(isset($_POST['editer'])) {
                $Titre = $_POST['Titre'];
                $Categorie = $_POST['Categorie'];
                $Album = $_FILES['Album'];
                $Description = $_POST['Description'];
                $Superficie = $_POST['Superficie'];
                $Adresse = $_POST['adresse'];
                $Ville = $_POST['Ville'];
                $Montant = $_POST['Montant'];
                $Type_an = $_POST['Type'];
                            
                $image = $_FILES['Img']['name'];
                $tmp_name = $_FILES['Img']['tmp_name'];
                $folder = "image/" . $image;
                move_uploaded_file($tmp_name, $folder);
                            
                if (!empty($_FILES["Album"]["name"][0])) {
                    for ($i = 0; $i < count($_FILES["Album"]["name"]); $i++) {
                        $images_name = $_FILES["Album"]["name"][$i];
                        $tmp_name = $_FILES["Album"]["tmp_name"][$i];
                        $folders = "image/" . $images_name;
                        move_uploaded_file($tmp_name, $folders);
                    }
                }
                try{
                // insertion dans la table annonce
                    $sql = "UPDATE `annonce` SET `titre`='$Titre', `description`='$Description', `adresse`='$Adresse', `ville`='$Ville', `superficie`=$Superficie, `categorie`='$Categorie', `type_annonce`='$Type_an', `prix`=$Montant WHERE `id_client`=$clientID";
                    $Ajouter = $conn->prepare($sql);
                    $Ajouter->execute();
                    // recuperer l'id de l'annonce qui vient d'etre inseree
                    $annonceID = $conn->lastInsertId();
                    // inserer l'image principale
                    $sql = "UPDATE `image` SET `url_image`='$folder' WHERE `id_annonce`=$annonceID AND `type_image`='principale'";
                    $Ajouter = $conn->prepare($sql);
                    $Ajouter->execute();
                    // inserer les images secondaires 
                    $sql = "UPDATE `image` SET `url_image`='$folders' WHERE `id_annonce`=$annonceID AND `type_image`='secondaire'";
                    $Ajouter = $conn->prepare($sql);
                    $Ajouter->execute();
                }
                catch(PDOException $e) 
                {
                    echo $e->getMessage();
                }
            }
        ?>
    </body>
</html>
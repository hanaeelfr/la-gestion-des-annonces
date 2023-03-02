<?php
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

        $sth = $conn->prepare("SELECT * FROM `annonce`");
        $sth->execute();
        $response = $sth->fetchAll();

       ?>
                
                 

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Le reve habite</title>
        <link rel="stylesheet" href="agence.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <header>
        <nav class="navbar navbar-light bg-light">
                <img src="logo.png" alt="logo" class="p-3" width="10%">
                <div class="d-flex me-5">
                    <form class="form-inline"   method="POST">
                        <?php 
                        if(isset($_GET["show_element"])===true){
                            echo"<a href='connexion.php' style='display:block;' class='btn btn-outline-primary my-2 my-sm-0 me-2'>Login</a>";
                            echo"<a href='connexion.php' style='display:block;' class='btn btn-outline-primary my-2 my-sm-0 me-2'>S'inscrire</a>";

                            echo"<a href='profile.php' style='display:none;' class='btn btn-outline-primary my-2 my-sm-0 me-2'>Profile</a>";

                        }
                        else{
                            echo"<a href='connexion.php' style='display:none;' class='btn btn-outline-primary my-2 my-sm-0 me-2'>Login</a>";
                            echo"<a href='connexion.php' style='display:none;' class='btn btn-outline-primary my-2 my-sm-0 me-2'>S'inscrire</a>";
                            echo"<a style='display:block;' href='profile.php' class='btn btn-outline-primary my-2 my-sm-0 me-2'>Profile</a>";
                        }
                        
                        
                        ?>
                    </form>
                    
                </div>
            </nav>
            <section class="bg-light">
                <div class="text-center">
                    <h1 class="">LE REVE HABITE</h1>
                    <h3 class="">Let’s find a home that’s perfect for you</h3>
                </div>
                <form action="" method="post"  class="d-flex justify-content-around m-5">
                    <div>
                        <select class="form-select" name="ville">
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
                    <div>
                        <select class="form-select" name="categorie">
                            <option selected>Categorie</option>
                            <option value="Villa">Villa</option>
                            <option value="Vente">Maison</option>
                            <option value="Appartement">Appartement</option>
                            <option value="Studio">Studio</option>
                        </select>
                    </div>
                    <div>
                        <select class="form-select" name="type_annonce">
                            <option selected>Type d'annonce</option>
                            <option value="Location">Location</option>
                            <option value="Vente">Vente</option>
                        </select>
                    </div>
                    <div class="d-flex">
                        <div class="input-group mb-3 me-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white bg-primary" id="basic-addon1">Min</span>
                            </div>
                            <input type="text" name="Min" class="form-control" placeholder="Min Price" aria-label="Max Price" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-white bg-primary" id="basic-addon1">Max</span>
                            </div>
                            <input type="text"  name="Max" class="form-control" placeholder="Max Price" aria-label="Max Price" aria-describedby="basic-addon1">
                        </div>
                        <div>
                            <input type="submit" name="Search" class="btn btn-outline-success my-sm-0 mb-3 ms-5"value="recherche" id="Search">
                        </div>
                    </div>
                </form>
            </section>
        </header>
        <main>
            
        <div class = "conteneur">
        <?php 

if (isset($_POST['Search'])) {
    $ville = $_POST['ville'];
    $categorie = $_POST['categorie'];
    $type_annonce = $_POST['type_annonce'];
    $min = $_POST['Min'];
    $max = $_POST['Max'];
    $id = 

    $query = "SELECT * FROM annonce ";

    if ($ville != 'Ville') {
        $query .= " WHERE ville = '$ville'";
    }

    if ($categorie != 'Categorie') {
        $query .= " WHERE categorie = '$categorie'";
    }

    if ($type_annonce != 'Type d\'annonce') {
        $query .= " WHERE type_annonce = '$type_annonce'";
    }

    if ($min != '') {
        $query .= " WHERE prix >= $min";
    }

    if ($max != '') {
        $query .= " WHERE prix <= $max";
    }

    $sth = $conn->prepare($query);
    $sth->execute();
    $response = $sth->fetchAll();
} else {
    // Si le formulaire de recherche n'a pas été soumis, afficher toutes les annonces
    $sth = $conn->prepare("SELECT * FROM annonce");
    $sth->execute();
    $response = $sth->fetchAll();
}

                foreach($response as $ligne){
                    $id = $ligne['id_annonce'];
                    $query = "SELECT * FROM image WHERE id_annonce = '$id' AND principal = 'true' ";
                    $sth = $conn->prepare($query);
                    $sth->execute();
                    $img = $sth->fetchAll();
                    echo "
                <div class='card mb-4' style='width: 20rem;'>
                <div class='card-img'>
                <img class='card-img-top' src='image/".$img[0]["url_image"]."'>
                </div>
                    <div class='card-body'>
                    <h4><b>".$ligne["titre"]."</b></h4>
                    <p>".$ligne["description"]."</p>
                    <p>".$ligne["adresse"]."</p>
                    <p>".$ligne["ville"]."</p>
                    <p>Superficie : ".$ligne["superficie"]."mÂ²</p>
                    <p>En".$ligne["type_annonce"]."</p>
                    <p>Prix : ".$ligne["prix"]."</p>
                    <p>date : ".$ligne["date_publication"]."</p>
                    <form action='details.php' method='post'>
                    <input type='hidden' name='id'  value=".$ligne["id_annonce"].">
                    <input class='col-5 mt-auto align-right btn btn-outline-dark' name='submit' type='submit' value='more details'>
                    </form>
                     
                    </div>
                </div> ";
                
                }
                
            
            ?>
            
        </div>
        </main>
        <footer class="text-center p-3 text-white bg-primary">
            <h6>DIRECTED BY : AJOUMI - FRAIHI - BENOMAR :)</h6>
        </footer>
        <!-- SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
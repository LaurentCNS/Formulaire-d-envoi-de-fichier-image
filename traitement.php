<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://www.pngmart.com/files/7/Transfer-PNG-Photo.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                Image transfer
            </a>
        </div>
    </nav>

    <?php
    // SI le fichier existe
    if (!empty($_FILES['image']['name'])) {
        // On récupère les infos du fichier
        $name = basename($_FILES['image']['name']); // On sécurise le name avec base pour éviter un hack
        $type = $_FILES['image']['type'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
        // Vérification de l'extension en découpant la chaine de caratère en tableau
        $cutNameType = explode('.', $name);
        // Je formate la valeur de l'extension en minuscule pour éviter la casse dans mes conditions
        $extension = strtolower($cutNameType[1]);
        //SI le fichier est bien une image 
        if ($extension === 'jpg' || $extension === 'png' || $extension === 'bmp' || $extension === 'jpeg') {
            // SI fichier compris entre 1ko et 7000ko (7mo)
            if ($size >= 1000 && $size <= 10000000) {
                // obtenir les dimensions de l'image
                $dimensions = getimagesize($tmpName);
                // SI les dimensions de l'image sont supérieurs à 50px et 8000px
                if ($dimensions[0] >= 50 && $dimensions[1] >= 50 && $dimensions[0] <= 8000 && $dimensions[1] <= 8000) {
                    $repertoireCible = __DIR__ . '\\images\\'; // Repertoire ou on stock les images
                    $fichierCible = $repertoireCible . $name;
                    // SI le fichier existe
                    if (file_exists($fichierCible)) {
                        $i = 1;
                        // Boucle on fait une boucle pour renommer le fichier exemple = (1)
                        while (file_exists($fichierCible)) {
                            $tempName = "$cutNameType[0]($i)";
                            $fichierCible = "$repertoireCible.$tempName.$extension";
                            $i++;
                        }
                    }
                    // SI le dossier de stockage des images n'éxiste pas
                    if (!file_exists($repertoireCible)) {
                        mkdir($repertoireCible);
                    }
                    // SI l'image et le dossier de stockage est disponible pour le transfert
                    if (move_uploaded_file($tmpName, $fichierCible)) {
                        $returnArray = true;
                        echo '<div class="container"><div class="row"><div class="col-lg-12 d-flex justify-content-center mt-5">';
                        echo '<div><img src="images/' . $name . '" width="300">';
                        echo '<p class="text-center">Votre fichier a été téléchargé</p>';
                        echo '</div></div></div>';
                    } else {
                        echo '<p class="text-center mt-5">Le téléchargement de votre fichier à échoué !</p>';
                    }
                } else {
                    echo '<p class="text-center mt-5">Les dimensions de l\'image sont trop petites ou trop grandes min50px max8000px !</p>';
                }
            } else {
                echo '<p class="text-center mt-5">Image trop volumineuse, max 10mo!</p>';
            }
        } else {
            echo '<p class="text-center mt-5">Ce fichier n\'est pas une image ou verifier son nom (exemple.jpg) !</p>';
        }
        // SINON erreur
    } else {
        echo '<p class="text-center mt-5">Aucun fichier reçu !</p>';
    }
    ?>

    <div class="container">
        <div class="col-lg-6 text-center mx-auto mt-5">
            <ul class="list-group">
                <?php
                if(!empty($returnArray)){
                $dir = opendir($repertoireCible);
                while ($file = readdir($dir)) {
                    if ($file != '.' && $file != '..' && !is_dir($dir . $file)) {
                        echo '<a href="images/' . $file . '"><li class="list-group-item">' . $file . '</li></a>';
                    }
                }
                closedir($dir);
                }
                ?>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center mt-5 mb-5">
                <a href="index.php"><button class="btn btn-danger">Retour</button></a>
            </div>
        </div>
    </div>
</body>

</html>
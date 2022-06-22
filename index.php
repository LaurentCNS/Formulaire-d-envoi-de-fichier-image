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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center mt-5">
                <form action="traitement.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="7000000"> <!-- 7 mo -->
                    <input type="file" class="btn btn-light" name="image">
                    <button type="submit" value="Envoyer" class="btn btn-success">Envoyer</button>
                </form>
            </div>
            <p class="text-center mt-3">Accepté (jpg,png,bmp) taille maximum 8000x8000</p>
        </div>
    </div>
</body>

</html>
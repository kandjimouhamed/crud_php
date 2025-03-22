<?php
// on demarre use session
session_start();
if ($_POST) {
    if(isset($_POST['produit']) && !empty($_POST['produit'])
    && isset($_POST['prix']) && !empty($_POST['prix'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])){
        // on inclut la connexion a la base de donnees$
        require_once('./connect.php');
        // on nettoie les donnees envoyees
        $produit = strip_tags($_POST['produit']);
        $prix = strip_tags($_POST['prix']);
        $nombre = strip_tags($_POST['nombre']);

        $sql = 'INSERT INTO liste (`produit`, `prix`, `nombre`)
                VALUES (:produit, :prix, :nombre)';

        // on prépare la requette
        $query = $db->prepare($sql);

          // on accroche les parametres 
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_STR);

        // on execute la requette
        $query->execute();

        $_SESSION['message'] = "Produit ajoute";
        require_once('./close.php');
        header('Location: index.php');
    } else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
 
}
// on inclut la connexion a la base de donnees$
require_once('./connect.php');

require_once('./close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter un produit</title>
    <!-- ######### CDN BOOTSTRAP ######## -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
               
                <h1>Ajouter un produit</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="produit">Produit</label>
                        <input type="text" id="produit" name="produit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="number" id="nombre" name="nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary mt-3">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
    
    <?php require_once('./toast.php'); ?>
    <script src="./script.js"></script>
    
</body>
</html>


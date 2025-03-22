<?php
// on demarre use session
session_start();
// on inclut la connexion a la base de donnees$
require_once('./connect.php');
$sql = "SELECT * FROM liste";

// on prépare la requette
$query = $db->prepare($sql);

// on execute la requete
$query->execute();
// on stocke le resultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('./close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
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
            <section class="col-12 mt-3">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                        '. $_SESSION['erreur'].'
                        </div>';
                            $_SESSION['erreur'] = '';
                         }
                ?>
                 <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                        '. $_SESSION['message'].'
                        </div>';
                            $_SESSION['message'] = '';
                         }
                ?>
                <h1>Liste des produits</h1>
                <table class="table table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Nombre</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $produit){
                            ?>
                            <tr>
                                <td><?= $produit['id']?></td>
                                <td><?= $produit['produit']?></td>
                                <td><?= $produit['prix']?></td>
                                <td><?= $produit['nombre']?></td>
                                <td><?= $produit['actif']?></td>
                                <td>
                                    <a href="desable.php?id=<?= $produit['id'] ?>">A/D</a>
                                    <a href="details.php?id=<?= $produit['id'] ?>">Voir</a>
                                    <a href="edit.php?id=<?= $produit['id'] ?>">Modifier</a>
                                    <a href="delete.php?id=<?= $produit['id'] ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>


    <?php require_once('./toast.php'); ?>
    <script src="./script.js"></script>
    
    
</body>
</html>


<?php
// on demarre use session
session_start();
// isset() retourne vrai si le variable est existe
// empty() cherche est que le variable est vide 
// on charche est que l'id est existe dans L' et n'est pas vide
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('./connect.php');

    // on nettoie l'id envoye
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM liste WHERE id = :id';

    // on prepare la requette
    $query = $db->prepare($sql);

    // on accroche les parametres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // on execute la requette
    $query->execute();

    // on recupere le produit
    $produit = $query->fetch();

    // on verifie si le produit existe
    if (!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }



}else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- ######### CDN BOOTSTRAP ######## -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
    <title>details du produit</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Details du produit "<?= $produit['produit']?>"</h1>
                <p>ID :  <?= $produit['id']?></p>
                <p>Produit :  <?= $produit['produit']?></p>
                <p>Prix :  <?= $produit['prix']?></p>
                <p>Nombre :  <?= $produit['nombre']?></p>
                <p>
                    <a href="index.php">Retour</a>
                    <a href="edit.php?id=<?=$produit['id'] ?>">Modifier</a>
                </p>
            </section>
        </div>
    </main>
    
</body>
</html>
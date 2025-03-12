<?php
// on demarre use session
session_start();
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

     $sql = 'DELETE FROM liste WHERE id = :id';
 
     // on prepare la requette
     $query = $db->prepare($sql);
 
     // on accroche les parametres (id)
     $query->bindValue(':id', $id, PDO::PARAM_INT);
 
     // on execute la requette
     $query->execute();
     $_SESSION['message'] = "Produit supprime";
    header('Location: index.php');
    
 

}else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
?>

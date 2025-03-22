<?php
// on demarre use session
session_start();
if ($_POST) {
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['produit']) && !empty($_POST['produit'])
    && isset($_POST['prix']) && !empty($_POST['prix'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])){
        // on inclut la connexion a la base de donnees$
        require_once('./connect.php');
        // on nettoie les donnees envoyees
        $id = strip_tags($_POST['id']);
        $produit = strip_tags($_POST['produit']);
        $prix = strip_tags($_POST['prix']);
        $nombre = strip_tags($_POST['nombre']);
        // on declare la requette
        $sql = 'UPDATE  liste SET `produit`=:produit, `prix`=:prix, `nombre`=:nombre
                WHERE `id`=:id';

        // on prépare la requette
        $query = $db->prepare($sql);

        // on accroche les parametres 
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_STR);

        // on execute la requette
        $query->execute();

        $_SESSION['message'] = "Produit modifié";
        require_once('./close.php');
        header('Location: index.php');
    } else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
 
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('./connect.php');

    // on nettoie l'id envoye
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT *FROM liste WHERE id = :id';

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

    $actif = ($produit['actif'] == 0) ? 1 : 0;


    $sql = 'UPDATE liste SET actif=:actif WHERE id = :id';

    // on prepare la requette
    $query = $db->prepare($sql);

    // on accroche les parametres
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':actif', $actif, PDO::PARAM_INT);

    // on execute la requette
    $query->execute();

    header('Location: index.php');
}else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

?>

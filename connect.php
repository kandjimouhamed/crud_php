<?php
try {
    //connexion a la base de donnees
    $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $error) {
  echo 'Erreur : ' . $error->getMessage();
  die();
}
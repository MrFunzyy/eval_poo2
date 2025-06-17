<?php
require_once 'resultat.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


echo "<h1>Contenu de la session</h1>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<p><a href='formulaire.php'>Retour au formulaire</a></p>";
?>

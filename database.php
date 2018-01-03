<?php

try {
    // $bdd = new PDO('mysql:host=localhost;dbname=eventProject', 'root', '');
    $bdd = new PDO('mysql:host=localhost;dbname=eventProject', 'root', '');

} catch (Exception $e) {
    echo $e->getMessage()."\n";
    die('Erreur : ' . $e->getMessage());
}
?>

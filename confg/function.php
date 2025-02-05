<?php
require_once('confg/connexion.php');


function Afficher() {
    global $conn;
    $data = array();
    try {
        $req = $conn->prepare("SELECT * FROM produits ORDER BY id DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $data;
}

function searchProduit($haja){
    global $conn;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = 'equipement de cuisine';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur PDO sur exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête pour éviter les injections SQL
        $requete = $conn->prepare("SELECT * FROM produits WHERE id LIKE :haja OR nom LIKE :haja");

        // Ajouter les pourcentages pour la recherche avec LIKE
        $likeHaja = "%$haja%";

        // Exécuter la requête avec les paramètres
        $requete->execute(['haja' => $likeHaja]);

        // Récupérer les résultats
        $produits = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $produits;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return []; 
    }
}

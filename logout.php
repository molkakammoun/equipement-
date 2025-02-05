<?php
session_start(); // Démarrez la session si elle n'est pas déjà démarrée

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Détruisez toutes les données de session
    session_unset();
    // Détruisez la session
    session_destroy();
    // Redirigez l'utilisateur vers la page d'accueil ou une autre page de votre choix après la déconnexion
    header("Location: index.php"); // Redirection vers la page d'accueil
    exit;
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page d'accueil ou une autre page de votre choix
    header("Location: acceuil.php"); // Redirection vers la page d'accueil
    exit;
}
?>
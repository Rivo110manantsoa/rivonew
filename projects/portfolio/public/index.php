<?php

// Démarrer la session
session_start();

// Afficher les erreurs pour le débogage (désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Définir ROOT et ASSETS pour les chemins dynamiques
$path = "https://" . $_SERVER['SERVER_NAME']; // Le domaine de base
$root = rtrim($path, "/"); // Supprimer les barres obliques finales inutiles
define('ROOT', $root . "/");
define('ASSETS', ROOT . "assets/");

// Récupérer l'URL pour le routage
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = trim($_SERVER['REQUEST_URI'], '/'); // Supprimer les barres obliques inutiles
    if ($uri == '' || $uri == 'index.php') {
        $_GET['url'] = 'home'; // Route par défaut : home
    } else {
        // Supprimer "index.php" si jamais il apparaît dans l'URL
        $_GET['url'] = str_replace('index.php/', '', $uri);
    }
}

// Inclure l'initialisation de l'application
include "../app/init.php";

// Initialiser le Router pour gérer les requêtes
$router = new Router();

https://portfolioasdonsoter.onrender.com/
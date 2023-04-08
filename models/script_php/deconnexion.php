<?php
session_start(); // Initialisation des variables de session

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion
header("Location:../../public/index.php?page=accueil");
exit;
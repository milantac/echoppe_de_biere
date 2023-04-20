<?php
// Paramètres de la base de données
$host = "localhost"; // adresse du serveur de base de données
$dbname = "echoppe"; // nom de la base de données (echoppe_de_biere)
$username = "root"; // nom d'utilisateur de la base de données
$password = ""; // mot de passe de la base de données

// Connexion à la base de données en utilisant la classe PDO
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connexion réussie à la base de données";
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
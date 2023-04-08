<?php
class LivreDOr
{

    private $id_livre_d_or;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $note_accueil_services;
    private $note_proprete;
    private $note_qualite_produit;
    private $commentaire;
    private $validation_livre_d_or;

    // Constructeur
    public function __construct($nom, $prenom, $email, $telephone, $note_accueil_services, $note_proprete, $note_qualite_produit, $commentaire)
    {
        $this->nom = htmlspecialchars($nom);
        $this->prenom = htmlspecialchars($prenom);
        $this->email = htmlspecialchars($email);
        $this->telephone = htmlspecialchars($telephone);
        $this->note_accueil_services = htmlspecialchars($note_accueil_services);
        $this->note_proprete = htmlspecialchars($note_proprete);
        $this->note_qualite_produit = htmlspecialchars($note_qualite_produit);
        $this->commentaire = htmlspecialchars($commentaire);
        $this->validation_livre_d_or = false;
    }

    // Méthode pour insérer les données du formulaire dans la base de données
    function ajouterLivreDOr($bdd, $nom, $prenom, $email, $tel, $accueil, $proprete, $qualite, $commentaire)
    {
        $sql = "INSERT INTO livre_d_or(nom, prenom, email, telephone, note_accueil_services, note_proprete, note_qualite_produit, commentaire, validation_livre_d_or)
            VALUES (:nom, :prenom, :email, :tel, :accueil, :proprete, :qualite, :commentaire, 0)";
        $stmt = $bdd->prepare($sql);
        return $stmt->execute([
            ':nom' => htmlspecialchars($nom),
            ':prenom' => htmlspecialchars($prenom),
            ':email' => htmlspecialchars($email),
            ':tel' => htmlspecialchars($tel),
            ':accueil' => htmlspecialchars($accueil),
            ':proprete' => htmlspecialchars($proprete),
            ':qualite' => htmlspecialchars($qualite),
            ':commentaire' => htmlspecialchars($commentaire)
        ]);
    }

    function telephoneExisteDeja($bdd, $tel)
    {
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM livre_d_or WHERE telephone = :tel");
        $stmt->execute(array(':tel' => $tel));
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}

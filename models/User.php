<?php
/**
 * La classe User représente un utilisateur.
 */
class User {

    /**
     * L'identifiant de l'utilisateur.
     * @var int
     */
    private $id;

    /**
     * Le nom de l'utilisateur.
     * @var string
     */
    private $name;

    /**
     * L'adresse email de l'utilisateur.
     * @var string
     */
    private $email;

    /**
     * Le mot de passe de l'utilisateur.
     * @var string
     */
    private $password;

   /**
     * Le type d'utilisateur de l'utilisateur.
     * @var string
     */
    private $type_utilisateur;

    /**
     * Crée un nouvel objet User avec les propriétés spécifiées.
     *
     * @param int $id L'identifiant de l'utilisateur.
     * @param string $name Le nom de l'utilisateur.
     * @param string $email L'adresse email de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @param string $type_utilisateur Le type d'utilisateur de l'utilisateur.
     */
    public function __construct($id, $name, $email, $password, $type_utilisateur) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->type_utilisateur = $type_utilisateur;
    }
    

//  ** ** ** **    GETTER    ** ** ** **

    /**
     * Retourne l'identifiant de l'utilisateur.
     * @return int L'identifiant de l'utilisateur.
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Retourne le nom de l'utilisateur.
     * @return string Le nom de l'utilisateur.
     */
    public function getName() {
        return $this->name;
    }
    /**
     * Retourne l'adresse email de l'utilisateur.
     * @return string L'adresse email de l'utilisateur.
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * Retourne le mot de passe de l'utilisateur.
     * @return string Le mot de passe de l'utilisateur.
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Retourne le type d'utilisateur de l'utilisateur.
     *
     * @return string Le type d'utilisateur de l'utilisateur.
     */
    public function getTypeUtilisateur() {
        return $this->type_utilisateur;
    }
    
    /** ** ** **    SETTER    ** ** ** **/
    /**
     * Modifie le nom de l'utilisateur.
     * @param string $name Le nouveau nom de l'utilisateur.
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Modifie l'adresse email de l'utilisateur.
     * @param string $email La nouvelle adresse email de l'utilisateur.
     */
    public function setEmail($email) {
        $this->email = $email;
    }
    
    /**
     * Modifie le mot de passe de l'utilisateur.
     * @param string $password Le nouveau mot de passe de l'utilisateur.
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Modifie le type d'utilisateur de l'utilisateur.
     *
     * @param string $type_utilisateur Le nouveau type d'utilisateur de l'utilisateur.
     */
    public function setTypeUtilisateur($type_utilisateur) {
        $this->type_utilisateur = $type_utilisateur;
    }
}
?> 
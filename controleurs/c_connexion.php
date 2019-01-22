<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Lise COLIN <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

//Récupération des données
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    
    //En cas de demande de connexion
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;

    //Validation de la connexion
case 'valideConnexion':
    
    //Récupération des infos
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $visiteur = $pdo->getInfosVisiteur($login, $mdp);
   
        //Si les informations de login ne fonctionnent pas
    if (!is_array($visiteur)) {
        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
        
        //Si les informations de login fonctionnent
    } else {
        //Récupération de l'id, du nom, prénom et grade
        $id = $visiteur['id'];
        $nom = $visiteur['nom'];
        $prenom = $visiteur['prenom'];
        $grade = $visiteur['grade'];  
        connecter($id, $nom, $prenom, $grade);
        
        //vérification du login
        if ($grade == 'c'){
            //Si grade comptable
            include 'vues/v_accueilC.php';
        }
        else{
            //Si grade visiteur
            include 'vues/v_accueil.php';
        }
    }

    break;
default:
    include 'vues/v_connexion.php';
    break;
}

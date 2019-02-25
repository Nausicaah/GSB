<?php

/**
 * Gestion de la déconnexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Lise COLIN <jgil@ac-nice.fr>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    //Demande de la déconnexion
    case 'demandeDeconnexion':
        include 'vues/v_deconnexion.php';
        break;

//Validation de la déconnexion
    case 'valideDeconnexion':
        if (estConnecte()) {
            include 'vues/v_deconnexion.php';
        } else {
            //Gestion des erreurs
            ajouterErreur("Vous n'êtes pas connecté");
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        }
        break;

    //retour à la vue connexion
    default:
        include 'vues/v_connexion.php';
        break;
}

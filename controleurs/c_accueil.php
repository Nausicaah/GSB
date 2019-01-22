<?php
/**
 * Gestion de l'accueil
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

//En cas de connexion
if ($estConnecte) 
    {
    //Affichage de l'accueil comptable
    if ($_SESSION['grade'] == 'c'){
        include 'vues/v_accueilC.php';
    }
    //Affichage de l'accueil visiteur
    else if ($_SESSION['grade'] != 'c'){
       include 'vues/v_accueil.php';
    }
    //Non connecté
} else {
    include 'vues/v_connexion.php';
}
?>
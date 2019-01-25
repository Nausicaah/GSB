<?php
/**
 * Gestion des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
 //Récupération de l'action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    
    //Affiche la vue des visiteurs
    case 'selectionnerVisiteur':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        include 'vues/v_listeVisiteurs.phpC';
        break;

    //Affiche la vue du mois
    case 'selectionnerMois':
        //Récupère les informations visiteurs
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteursC.php'; 
        //Affiche la liste des mois
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        include 'vues/v_listeMoisC.php';
        break;
    
    //Affiche les frais du $visiteurASelectionner et du $moisASelectionner
    case 'afficherFrais':
        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteursC.php'; 
        
        //Récupère infos mois sélectionné
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);
        include 'vues/v_listeMoisC.php';
        
        //Changement des nom des variables
        $idVisiteur = $visiteurASelectionner;
        $idMois = $moisASelectionner;
        
        
        //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois); 
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois); 
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
        
        
        include 'vues/v_listeFraisC.php';
        
        
        
        break;
        
}
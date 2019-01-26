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


    //Affiche la vue du mois
    case 'selectionnerMois':
        //Récupère les informations visiteurs
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        //Affiche la liste des mois
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        include 'vues/v_listeMoisC.php';
        break;

    //Affiche les frais du $visiteurASelectionner et du $moisASelectionner
    case 'afficherFrais':
        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);

        //Récupère infos mois sélectionné
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);
        include 'vues/v_listeMoisC.php';

        //Récupération d'informations à afficher
        $idVisiteur = $visiteurASelectionner;
        $idMois = $moisASelectionner;
        $numAnnee = substr($idMois, 0, 4);
        $numMois = substr($idMois, 4, 2);
        $nom = $pdo->getNom($idVisiteur);
        $prenom = $pdo->getPrenom($idVisiteur);

        //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
        include 'vues/v_listeFraisForfaitC.php';
        include 'vues/v_listeFraisHorsForfaitC.php';

        break;

    case 'validerMajFraisForfaitC':

        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);

        //Récupère infos mois sélectionné
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);
        include 'vues/v_listeMoisC.php';

        //Récupération d'informations à afficher
        $idVisiteur = $visiteurASelectionner;
        $idMois = $moisASelectionner;
        $numAnnee = substr($idMois, 0, 4);
        $numMois = substr($idMois, 4, 2);
        $nom = $pdo->getNom($idVisiteur);
        $prenom = $pdo->getPrenom($idVisiteur);

        //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);

        //Récupération des nouveaux frais
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $pdo->majFraisForfait($idVisiteur, $idMois, $lesFrais);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
        include 'vues/v_listeFraisForfaitC.php';
        include 'vues/v_listeFraisHorsForfaitC.php';
        break;
    
    case 'a':
        
        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);

        //Récupère infos mois sélectionné
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);
        include 'vues/v_listeMoisC.php';

        //Récupération d'informations à afficher
        $idVisiteur = $visiteurASelectionner;
        $idMois = $moisASelectionner;
        $numAnnee = substr($idMois, 0, 4);
        $numMois = substr($idMois, 4, 2);
        $nom = $pdo->getNom($idVisiteur);
        $prenom = $pdo->getPrenom($idVisiteur);

        //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
        include 'vues/v_listeFraisForfaitC.php';
        include 'vues/v_listeFraisHorsForfaitC.php';
        break;

}
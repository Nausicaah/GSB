<?php

/**
 * Suivi des frais (comptable)
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Lise COLIN
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
//Récupération de l'action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {


    /**
     * Affiche la vue du mois, avec la sélection du visiteur PUIS la sélection du mois 
     * (affiche que les mois dispos)
     */
    case 'selectionnerMois':
        //Récupère les informations visiteurs
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        
        //Affiche la liste des mois
        $listeMois = $pdo->getLesFichesDisponibles($visiteurASelectionner);
        include 'vues/v_listeMoisC.php';
        break;


    case 'afficherFrais':
        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        //Récupère infos mois sélectionné et affiche le choix

        $listeMois = $pdo->getLesFichesDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);
        
        include 'vues/v_listeMoisC.php';

        //Si le visiteur a 0 fiches
        if ($moisASelectionner == null) {

            echo "<br>Veuillez sélectionner un mois. Si aucun mois n'est affiché, ce visiteur n'a pas encore déclaré de fiche de frais.";
        }
        //Si le visiteur a une ou plusieurs fiches
        else {
            //Récupération d'informations à afficher
            $idVisiteur = $visiteurASelectionner;
            $idMois = $moisASelectionner;
            $numAnnee = substr($idMois, 0, 4);
            $numMois = substr($idMois, 4, 2);
            $infoVisiteur = $pdo->getFicheVisiteur($idVisiteur);
            $nom = $infoVisiteur['nom'];
            $prenom = $infoVisiteur['prenom'];
            $libelleVehicule = $pdo->getLibelleVehicule($idVisiteur);

            //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois);
            $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
            $etatFicheFrais = $pdo->getEtatFicheFrais($idVisiteur, $idMois);
            $libelle = $etatFicheFrais['libelle'];
            $etatFiche = $etatFicheFrais['id'];
            include 'vues/v_listeFraisForfaitC.php';
            include 'vues/v_listeFraisHorsForfaitC.php';
            include 'vues/v_listeNbJustificatifsC.php';
            include 'vues/v_validationC.php';
        }

        break;

    case 'payerFiche':


        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        
        $listeMois = $pdo->getLesFichesDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_POST, 'lstMoisC', FILTER_SANITIZE_STRING);

        $etatFiche = 'RB';
        $pdo->majEtatFicheFrais($visiteurASelectionner, $moisASelectionner, $etatFiche);
        
        include 'vues/v_listeMoisC.php';
        
                echo ('<br><div class="alert alert-warning" role="alert">
                Fiche validée!
            </div>');


        break;
}
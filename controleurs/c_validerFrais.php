<?php

/**
 * Gestion des frais
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
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        include 'vues/v_listeMoisC.php';
        break;

    /**
     * Affiche tous les frais forfaits et non forfaits pour le visiteur sélectionné
     * Garde en mémoire les infos entrées précedemment
     */
    case 'afficherFrais':
        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);

        //Récupère infos mois sélectionné et affiche le choix
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
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
            $nom = $pdo->getNom($idVisiteur);
            $prenom = $pdo->getPrenom($idVisiteur);



            //Utilisation des fonctions afin de pouvoir afficher les données sélectionnées
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $idMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $idMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $idMois);
            $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
            include 'vues/v_listeFraisForfaitC.php';
            include 'vues/v_listeFraisHorsForfaitC.php';
            include 'vues/v_listeNbJustificatifsC.php';
            include 'vues/v_validationC.php';
        }

        break;

    /**
     * Valide en cas de changement pour les frais forfaitisés
     * Garde en mémoire les infos entrées précedemment
     */
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
        include 'vues/v_listeNbJustificatifsC.php';
        include 'vues/v_validationC.php';
        break;

    /**
     * case utilisée avec refuser frais
     * Garde en mémoire les infos entrées précedemment
     */
    case 'modifierFraisHorsForfait':

        //Récupère infos visiteurs sélectionné
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_GET, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        //Récupère infos mois sélectionné
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_GET, 'lstMoisC', FILTER_SANITIZE_STRING);
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
        include 'vues/v_listeNbJustificatifsC.php';
        include 'vues/v_validationC.php';
        break;


    /**
     * Permet de refuser un frais. 
     * Ajoute un statut (modification de la DB) au frais refusé pour ne pas toucher au libelle
     * Garde en mémoire les infos entrées précedemment
     */
    case 'refuserFrais':
        //récupération des informations sur les 
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = filter_input(INPUT_GET, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $moisASelectionner = filter_input(INPUT_GET, 'lstMoisC', FILTER_SANITIZE_STRING);
        $pdo->refuserFraisHorsForfait($idFrais);
        header("Location: index.php?uc=validerFrais&action=modifierFraisHorsForfait& lstVisiteurs=" . $visiteurASelectionner . '&lstMoisC=' . $moisASelectionner);
        break;

    /**
     * Permet de reporter un frais. 
     * Ajoute un statut (modification de la DB) au frais reporté pour ne pas toucher au libelle
     * Ajoute le frais au mois suivant (si mois inexistant créé une nouvelle fiche)
     * Garde en mémoire les infos entrées précedemment
     */
    case 'reporterFrais':
        //Récupération des informations sur le frais hors forfait
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_GET, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        $moisASelectionner = filter_input(INPUT_GET, 'lstMoisC', FILTER_SANITIZE_STRING);
        $libelle = $pdo->getLibelleHorsForfait($idFrais);
        $montant = $pdo->getMontantHorsForfait($idFrais);
        $dateFrais = $pdo->getDateHorsForfait($idFrais);

        //Récupère le mois suivant
        $moisSuivant = getMoisSuivant($moisASelectionner);

        //Si c'est la première saisie du mois
        if ($pdo->estPremierFraisMois($visiteurASelectionner, $moisSuivant)) {
            //Créaion de la fiche de frais
            $pdo->creeNouvellesLignesFrais($visiteurASelectionner, $moisSuivant);
        }

        //Création du frais HF
        $pdo->creeNouveauFraisHorsForfait($visiteurASelectionner, $moisSuivant, $libelle, $dateFrais, $montant);
        //Suppression de ce frais du mois en cours de saisi:
        $pdo->supprimerFraisHorsForfait($idFrais);
        
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

        include 'vues/v_listeMoisC.php';
        include 'vues/v_listeFraisForfaitC.php';
        include 'vues/v_listeFraisHorsForfaitC.php';
        include 'vues/v_listeNbJustificatifsC.php';
        include 'vues/v_validationC.php';

        break;


    /**
     * Permet de modifier le nb de justificatifs reçus
     * Garde en mémoire les informations entrées précedemment
     */
    case 'ajouterJustificatif':
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

        //Récupération du nouveau nb de justificatifs (entrés par le comptable)
        $nbJustificatifs = filter_input(INPUT_POST, 'nbJustificatifs', FILTER_SANITIZE_STRING);
        //Maj du nb de justificatifs en DB
        $pdo->majNbJustificatifs($idVisiteur, $idMois, $nbJustificatifs);
        //récupération du nouveau nb pour affichage
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $idMois);
        include 'vues/v_listeNbJustificatifsC.php';
        include 'vues/v_validationC.php';

        break;


    /**
     * Permet de valider la fiche de frais
     */
    case 'validerFiche':
        
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
        
        $totalFF = $pdo->getTotalFraisForfait($idVisiteur, $idMois);
        $totalFHF = $pdo->getTotalFraisHorsForfait($idVisiteur, $idMois);
        
        $totalFiche = $totalFF + $totalFHF;

        $pdo->majMontantFicheValide($idVisiteur, $idMois, $totalFiche);

        
        $etatFiche = 'VA';
        $pdo->majEtatFicheFrais($idVisiteur, $idMois, $etatFiche);
        
        include 'vues/v_listeFraisForfaitC.php';
        include 'vues/v_listeFraisHorsForfaitC.php';
        include 'vues/v_listeNbJustificatifsC.php';
        include 'vues/v_validationC.php';

        break;
}
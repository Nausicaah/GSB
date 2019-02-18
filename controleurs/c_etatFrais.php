<?php

/**
 * Gestion de la déconnexion
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
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['idVisiteur'];
switch ($action) {
    case 'selectionnerMois':
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include 'vues/v_listeMois.php';
        break;

    case 'voirEtatFrais':
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $moisASelectionner = $leMois;
        include 'vues/v_listeMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        include 'vues/v_etatFrais.php';
        break;

    case 'testpdf':
        //booleenne a initier
        $generation = true;

        //récupération de l'id mois
        $leMois = filter_input(INPUT_GET, 'idMois', FILTER_SANITIZE_STRING);
        //création du nom du PDF
        $nompdf = $leMois . '_' . $idVisiteur;

        //a mettre dans le IF
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);


        //generation SI pas déjà gen
        //if ($generation) {
        //file_put_contents('pdf/' . $nompdf . '.html', "test");
        exec('C:/wamp64/apps/wkhtmltopdf/bin/wkhtmltopdf.exe C:/wamp64/www/GSB_AppliMVC/pdf/' . $nompdf . '.html C:/wamp64/www/GSB_AppliMVC/pdf/' . $nompdf . '.pdf');
        // }
        //Affichage du PDF
        //header('Location: pdf/' . $nompdf . '.pdf');
        //file_put_contents('pdf/_a17.html', ,FILE_APPEND);


        //put charset & bootstrap
        file_put_contents('pdf/_a17.html', '<link rel="stylesheet" type="text/css" href="..\styles\bootstrap\bootstrap.css"><meta charset="UTF-8">
<div class ="row"><div class="col-md-1"></div><div class="col-md-4"><img src="../images/logo.jpg" /></div></div><br><br>', FILE_APPEND);
        
        //put en-tête récap infos visiteurs
        file_put_contents('pdf/_a17.html', '<div class="row"><div class="col-md-1"><h1>Votre facture</h1></div><div class="col-md-11"><div class="alert alert-info" role="alert">
            Visiteur : <br/>
            Adresse : <br/>
            Date : ' . $numAnnee . '/' . $numMois . '<br/>
            Matricule : ' . $idVisiteur . '<br/></div></div></div>', FILE_APPEND);

        //put en-tête frais
        file_put_contents('pdf/_a17.html', '<div class=" row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche de frais du mois : ' . $numAnnee . '/' . $numMois . '</div>
            <div class="panel-body">
                <strong><u>Etat</u></strong> : ' . $libEtat . '
                depuis le ' . $dateModif . ' <br> 
                <strong><u>Montant validé</u></strong> : ' . $montantValide . '
            </div>
        </div>', FILE_APPEND);
        
        //put table html pour le foreach
        file_put_contents('pdf/_a17.html', '<div class="panel panel-info">
            <div class="panel-heading">Eléments forfaitisés</div>
            <table class="table table-bordered table-responsive">
                <tr>', FILE_APPEND);
        
        foreach ($lesFraisForfait as $unFraisForfait) {
            $libelle = $unFraisForfait['libelle'];
            //put les libelles
            file_put_contents('pdf/_a17.html', '<th>' . $libelle . '</th>', FILE_APPEND);
        }
        
        //put balises html fin foreach
        file_put_contents('pdf/_a17.html', '</tr>
                <tr>', FILE_APPEND);
        
        
        foreach ($lesFraisForfait as $unFraisForfait) {
            $quantite = $unFraisForfait['quantite'];
            //put les quantites
            file_put_contents('pdf/_a17.html', '<td class="qteForfait">' . $quantite . '</td>', FILE_APPEND);
        }
        
        //put balise fin fooreach
        file_put_contents('pdf/_a17.html', '</tr></table></div>', FILE_APPEND);
        
        //  file_put_contents('pdf/_a17.html', ,FILE_APPEND);
        //  file_put_contents('pdf/_a17.html', ,FILE_APPEND);
        
        //put signatures et notes
        file_put_contents('pdf/_a17.html', '<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-4"><h3>Date et signature :</h3></div>
</div>
<br />
<hr>
<div class ="alert alert-warning">
    <strong>Frais forfaitaires : </strong>Les frais forfaitaires doivent être justifiés par une facture acquittée faisant apparaître le montant de la TVA. Ces documents ne sont pas à joindre à l’état de frais mais doivent être conservés pendant trois années. Ils peuvent être contrôlés par le délégué régional ou le service comptable
    <br><strong>Montants unitaires : </strong>Tarifs en vigueur au 01/09/2017
    <br><strong>Indemnité kilométrique : </strong>Prix au kilomètre selon la puissance du véhicule  déclaré auprès des services comptables
    <ul><li>(Véhicule  4CV Diesel) 	0.52 € / Km</li>
        <li>(Véhicule 5/6CV Diesel) 	0.58 € / Km</li>
        <li>(Véhicule  4CV Essence) 	0.62 € / Km</li>
        <li>(Véhicule 5/6CV Essence) 	0.67 € / Km</li></ul>
    <br><strong>Frais non forfaitaires : </strong>Tout frais « hors forfait » doit être dûment justifié par l’envoi d’une facture acquittée faisant apparaître le montant de TVA

</div>', FILE_APPEND);
        
        //convertissement de html vers pdf
        exec('C:/wamp64/apps/wkhtmltopdf/bin/wkhtmltopdf.exe C:/wamp64/www/GSB_AppliMVC/pdf/_a17.html C:/wamp64/www/GSB_AppliMVC/pdf/_a17.pdf');
        
        //affichage du pdf
        header('Location: pdf/_a17.pdf');
        break;
}

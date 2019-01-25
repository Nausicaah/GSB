<?php
/**
 * Vue Liste des frais au forfait
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
?>

<div class="row">
    <h3>Eléments hors forfaits</h3>
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">Modification</th> 
                </tr>
            </thead>  
            <tbody>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $id = $unFraisHorsForfait['id'];
                    ?>           
                    <tr>
                        <td> <?php echo $date ?></td>
                        <td> <?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                        <td><button class="btn btn-success" type="submit">Corriger</button>
                        <a class="btn btn-danger" href="index.php?uc=validerFrais&action=supprimerFraisForfait&<?php echo $idVisiteur; ?>&mois=<?php echo $numAnnee, $numMois; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');" role="button">Réinitialiser</a>
                               </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>
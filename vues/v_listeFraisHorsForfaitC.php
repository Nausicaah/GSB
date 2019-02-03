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
<br>
<div class="row">    

    <div class="col-md-10">    
                <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id'];
                $etat = $unFraisHorsForfait['etat']?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $etat, ' ', $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a class="btn btn-danger" type="submit" href="index.php?uc=validerFrais&action=refuserFrais&idFrais=<?php echo $id ?>&lstVisiteurs=<?php echo $visiteurASelectionner ?>&lstMoisC=<?php echo $moisASelectionner ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">

    </div>
</div>
<?php
/**
 * Vue Liste des mois
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


<?php
if ($uc == 'validerFrais') {
    ?>
    <div class="row">    
        <h3>Valider fiche</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=validerFrais&action=validerFiche" 
                  role="form">
                <fieldset>
                    <button class="btn btn-success" type="submit">Valider fiche de frais</button>
                    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </fieldset>
            </form>
        </div>
    </div>
    <br>
    <br>
<?php } else {
    ?>
    <div class="row">    
        <h3>Mettre en paiement</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=suivreFrais&action=payerFiche" 
                  role="form">
                <fieldset>
                    <button class="btn btn-success" type="submit">Mettre en paiement</button>
                    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </fieldset>
            </form>
        </div>
    </div>
    <br>
    <br>
    <?php
}?>
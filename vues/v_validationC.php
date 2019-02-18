<?php
/**
 * Vue Validation fiche de frais (Comptable)
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
                    <button class="btn btn-success" type="submit" onclick="return confirm('Voulez-vous vraiment valider cette fiche de frais?');"">Valider fiche de frais</button>
                    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </fieldset>
            </form>
        </div>
    </div>
    <br>
    <br>
<?php } else if ($etatFiche == "VA"){
    ?>
    <div class="row">    
        <h3>Mettre en paiement</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=suivreFrais&action=payerFiche" 
                  role="form">
                <fieldset>
                    <button class="btn btn-success" type="submit" onclick="return confirm('Voulez-vous vraiment payer cette fiche de frais?');">Mettre en paiement</button>
                    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </fieldset>
            </form>
        </div>
    </div>
    <br>
    <br>
    <?php
}else{?>
    <br>
<?php } ?>

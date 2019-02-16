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
<?php
if ($uc == 'validerFrais') {
    ?>
    <div class="row">    
        <h3>Nombres de justificatifs</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=validerFrais&action=ajouterJustificatif" 
                  role="form">
                <fieldset>
                    <input type="text" id="nbJustificatifs" value="<?php echo $nbJustificatifs ?>" name="nbJustificatifs" class="form-control">  
                    <div class="col-md-4">
                        <button class="btn btn-success" type="submit">Ajouter</button>
                        <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                        <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                        </fieldset>
                        </form>
                    </div>
                    </div>
                <?php } else {
                    ?>
                    <div class="row">    
                        <h3>Nombres de justificatifs validés</h3>
                        <div class="col-md-4">
                            <input disabled id="nbJustificatifs" value="<?php echo $nbJustificatifs ?>" name="nbJustificatifs" class="form-control">  
                        </div>
                    </div>
                    <br>
                <?php } ?>


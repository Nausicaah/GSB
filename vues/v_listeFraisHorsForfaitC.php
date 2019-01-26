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
    <form method="post" 
          action="index.php?uc=gererFrais&action=validerMajFraisHorsForfait" 
          role="form"
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
                        ?>           
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="idFrais" 
                                           name="lesFrais[<?php echo $idFrais ?>]"
                                           size="3" maxlength="10" 
                                           value="<?php echo $date ?>" 
                                           class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="idFrais" 
                                           name="lesFrais[<?php echo $idFrais ?>]"
                                           size="3" maxlength="10" 
                                           value="<?php echo $libelle ?>" 
                                           class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="idFrais" 
                                           name="lesFrais[<?php echo $idFrais ?>]"
                                           size="3" maxlength="10" 
                                           value="<?php echo $montant ?>" 
                                           class="form-control">
                                </div>
                            </td>
                            <td><button class="btn btn-success" type="submit" href="index.php?uc=validerFrais&action=corrigerHorsForfaitC">Corriger</button>
                                <button class="btn btn-danger" type="reset">Réinitialiser</button>
                        </tr>
                        <?php
                    }
                    ?>
                <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </tbody>  
            </table>
        </div>
    </form>

    <div class="row">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">
            <h3>Justificatifs</h3>
            <div class="col-md-4">
                <fieldset>      

                    <div class="form-group">
                        <label for="nbJustificatifs">Nombres de justificatifs : </label>
                        <input type="text" id="nbJustificatifs" 
                               size="2"
                               value="<?php echo $nbJustificatifs ?>" 
                               class="form-control">
                    </div>
                    <button class="btn btn-success" type="submit"
                            href="index.php?uc=validerFrais&action=validerMajNbJustificatifs">Corriger</button>
                    <button class="btn btn-danger" type="reset">Réinitialiser</button>
                    <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                    <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                </fieldset>
            </div>
        </form>
    </div>

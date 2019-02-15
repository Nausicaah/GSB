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
        <br>
        <hr>
        <h2>Valider la fiche de frais</h2>
        Fiche de <?php echo $nom, ' ', $prenom ?>, pour le mois de <?php echo $numMois, '/', $numAnnee ?>.
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <form method="post" 
                  action="index.php?uc=validerFrais&action=validerMajFraisForfaitC" 
                  role="form">
                <fieldset>       
                    <?php
                    foreach ($lesFraisForfait as $unFrais) {
                        $idFrais = $unFrais['idfrais'];
                        $libelle = htmlspecialchars($unFrais['libelle']);
                        $quantite = $unFrais['quantite'];
                        ?>
                        <div class="form-group">
                            <label for="idFrais"><?php echo $libelle ?></label>
                            <input type="text" id="idFrais" 
                                   name="lesFrais[<?php echo $idFrais ?>]"
                                   size="10" maxlength="5" 
                                   value="<?php echo $quantite ?>" 
                                   class="form-control">
                        </div>
                        <?php
                    }
                    ?>
                    <button class="btn btn-success" type="submit" onclick="return confirm('Les frais ont bien été modifiés.');"
                            href="index.php?uc=validerFrais&action=validerMajFraisForfaitC">Corriger</button>
                    <button class="btn btn-danger" type="reset">Réinitialiser</button>
                </fieldset>
                <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                <input name="lstMoisC" value="<?php echo $moisASelectionner; ?>" type="hidden">
                <input name="typeVehicule" value="<?php echo $typeVehicule; ?>" type="hidden">
            </form>
        </div>
    </div>
<?php } else {
    ?>
    <div class="row">    
        <br>
        <?php 
        if ($etatFiche == 'RB'){
            ?>
        <div class="alert alert-success" role="alert">Cette fiche a déjà été remboursée!
        </div>
        <?php } ?>
        <hr>
        <h2>Suivi paiement fiche de frais</h2>
        Fiche de <?php echo $nom, ' ', $prenom ?>, pour le mois de <?php echo $numMois, '/', $numAnnee ?>.
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input disabled id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
            </fieldset>
        </div>
    </div>
<?php } ?>




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
<div class="col-md-4">
    <form action="index.php?uc=validerFrais&action=afficherFrais" 
          method="post" role="form">
        <div class="form-group">
            <label for="lstMoisC">Mois disponibles : </label>
            <select id="lstMoisC" name="lstMoisC" class="form-control">
                <?php
                foreach ($lesMois as $unMois) {
                    $mois = $unMois['mois'];
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    if ($mois == $moisASelectionner) {
                        ?>
                        <option selected value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
        <input class="btn btn-info" value="✓" href="index.php?uc=validerFrais&action=afficherFrais" role="button" type="submit">
    </form>
</div>


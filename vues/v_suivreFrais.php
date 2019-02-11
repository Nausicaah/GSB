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
<div class="row">
    <fieldset>
        <div class="col-md-4">
            <form action="index.php?uc=suivreFrais&action=selectionnerMois" 
                  method="post" role="form">
                <input nam="uc" value="suivreFrais" type="hidden"/>
                <input name="action" value="selectionnerVisiteur" type="hidden"/>
                <div class="form-group">
                    <label for="lstVisiteurs">Selectionner le visiteur : </label>
                    <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                        <!-- Pas de visiteur par défaut -->
                        <option>/</option>
                        <?php
                        //Affichage de chaque visiteur
                        foreach ($lesVisiteurs as $unVisiteur) {
                            //Récupération des données
                            $id = $unVisiteur['id'];
                            $nom = $unVisiteur['nom'];
                            $prenom = $unVisiteur['prenom'];
                            $grade = $unVisiteur['grade'];

                            //Retire les membres de la DB non visiteurs (comptables)
                            if ($grade != 'c') {
                                if ($id == $visiteurASelectionner) {
                                    ?>
                                    <!-- Affiche les options, triées par nom, puis affiche les prénoms -->
                                    <option selected="<?php echo $id ?>">
                                        <?php echo $nom . ' ' . $prenom ?> </option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $id ?>">
                                        <?php echo $nom . ' ' . $prenom ?> </option>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </select>
                </div>
                <input class="btn btn-info" value="✓" href="index.php?uc=suivreFrais&action=selectionnerMois" role="button" type="submit">
            </form>
        </div>
        <div class="col-md-4">
            <form action="index.php?uc=suivreFrais&action=afficherFrais" 
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
                <input class="btn btn-info" value="✓" href="index.php?uc=suivreFrais&action=afficherFrais" role="button" type="submit">
            </form>
        </div>
    </fieldset>
</div>

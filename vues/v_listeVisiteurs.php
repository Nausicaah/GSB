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
    <div class="col-md-4">
        <!-- Uc validerFrais + action selectionnerVisiter (comptable uniquement) -->
        <form action="index.php?uc=validerFrais&action=selectionnerVisiteur" 
              method="post" role="form">
            <div class="form-group">
                <label for="lstVisiteurs">Selectionner le visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    //Affichage de chaque visiteur
                    foreach ($lesVisiteur as $unVisiteur) {
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
                                <option selected value="<?php echo $id ?>">
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
                 <a class="btn btn-info" href="index.php?uc=validerFrais&action=selectionnerMois" role="button">Valider</a>
            </div>
        </form>
    </div>
</div>
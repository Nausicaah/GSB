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
                <label for="lstVisiteurs" accesskey="n">Selectionner le visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    //Affichage de chaque visiteur
                    foreach ($lesVisiteur as $unVisiteur) {
                        //récupération des données
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        $grade = $unVisiteur['grade'];
                        ?>
                        <?php
                        //Retire les membres de la DB non visiteurs (comptables)
                        if ($grade != 'c') {
                            ?>
                            <!-- Affiche les options, triées par nom, puis affiche les prénoms -->
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
        </form>
    </div>
</div>
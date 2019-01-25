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

<div class="row">
    <h3>Justificatifs</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">
            <fieldset>      

                <div class="form-group">
                    <label for="nbJustificatifs">Nombres de justificatifs : </label>
                    <input type="text" id="nbJustificatifs" 
                           size="2"
                           value="<?php echo $nbJustificatifs ?>" 
                           class="form-control">
                </div>
                <button class="btn btn-success" type="submit">Corriger</button>
                        <a class="btn btn-danger" href="index.php?uc=validerFrais&action=supprimerFraisForfait&<?php echo $idVisiteur; ?>&mois=<?php echo $numAnnee, $numMois; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');" role="button">Réinitialiser</a>

            </fieldset>
        </form>
    </div>
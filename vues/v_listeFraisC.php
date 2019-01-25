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
</div>
<div class="row">    
    <br>
    <hr>
    <h2>Valider la fiche de frais</h2>
    Fiche de <?php echo $nom, ' ', $prenom ?>, pour le mois de <?php echo $idMois ?>.
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
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
                <button class="btn btn-success" type="submit">Corriger</button>
                <a class="btn btn-danger" href="index.php?uc=validerFrais&action=supprimerFraisForfait&<?php echo $idVisiteur; ?>&mois=<?php echo $numAnnee, $numMois; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');" role="button">Réinitialiser</a>
            </fieldset>
        </form>
    </div>
</div>
<br>
<br>
<div class="row">
    <h3>Eléments hors forfaits</h3>
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">Modification</th> 
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
                        <td> <?php echo $date ?></td>
                        <td> <?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                        <td><button class="btn btn-success" type="submit">Corriger</button>
                        <a class="btn btn-danger" href="index.php?uc=validerFrais&action=supprimerFraisForfait&<?php echo $idVisiteur; ?>&mois=<?php echo $numAnnee, $numMois; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');" role="button">Réinitialiser</a>
                               </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>
<br>
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
                           class="form-control">x
                </div>
                <button class="btn btn-success" type="submit">Corriger</button>
                        <a class="btn btn-danger" href="index.php?uc=validerFrais&action=supprimerFraisForfait&<?php echo $idVisiteur; ?>&mois=<?php echo $numAnnee, $numMois; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');" role="button">Réinitialiser</a>

            </fieldset>
        </form>
    </div>
    </div>
<div class="row"><br></div>
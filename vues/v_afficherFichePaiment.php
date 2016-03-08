<h2>Fiche du : <?php echo(rewriteDate($date)) ?>. Etat : <?php echo($lesInfosFicheFrais['libEtat']) ?> </h2>
<div class="corpsForm">
    <fieldset>
        <legend>Eléments forfaitisés
        </legend>
        <table style="color:black;" border="1">
            <tr><th>Etape</th><th>Km </th><th>Nuité</th><th>Repas midi </th></tr>
            <tr align="center">
                <?php
                    //place les données dans un tableau.
                    $valeurs = array();
                      foreach ($lesFraisForfait as $unFrais)
                      {
                        $idFrais = $unFrais['idfrais'];
                        $valeurs = $unFrais['quantite'];
                        ?>
                        <td width="80"><?php echo($valeurs) ?></td>
                        <?php
                      }
                ?>
            </tr>
        </table>
        
    </fieldset>
    <fieldset>   
        <legend>Frais hors forfait
        </legend>
        <table class="listeLegere">
        <tr>
            <th>Date</th>
            <th>Libellé</th>  
            <th>Montant</th>           
        </tr>
        <?php    
        foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
        {
                  $libelle = $unFraisHorsForfait['libelle'];
                  $date = $unFraisHorsForfait['date'];
                  $montant=$unFraisHorsForfait['montant'];
                  $idHorsFrais = $unFraisHorsForfait['id'];
        ?>		
        <tr>
            <td style="color:black;"><?php echo $date ?></td>
            <td style="color:black;"><?php echo $libelle ?></td>
            <td style="color:black;"><?php echo $montant ?></td>
        </tr>
        <?php
          }
        ?>                    
        </table>
    </fieldset>
    
    <fieldset>
              <legend>Total frais
              </legend>
                <table class="listeLegere">
                    <?php 
                        $nbJustif = $lesInfosFicheFrais['nbJustificatifs'];
                        $montant = $lesInfosFicheFrais['montantValide'];
                    ?>
                    <tr><th>Nb justificatifs</th><th>montant total</th></tr>
                    <tr align="center">
                    <td width="80" ><label><?php echo($nbJustif) ?></label></td>
                    <td width="80" ><label><?php echo($montant) ?></label></td>
                    </tr>
                </table>
            </fieldset>

    <form method="POST" action="index.php?uc=suivrePaiment&action=ValiderFiche">
      <input id="ok" type="submit" name="btnValider" value="Valider" size="20" />
      <input id="ok" type="submit" name="btnValider" value="Rembourser" size="20" />
    </form>
</div>

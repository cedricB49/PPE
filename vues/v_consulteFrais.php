      <h2>Valider la fiche du mois <?php echo(rewriteDate($leMois)) ?>. Status : <?php echo($lesInfosFicheFrais['libEtat']) ?></h2>
      <!-- Conservation des id et date -->
      <?php
        $_SESSION['currentId'] = $leVisiteur;
        $_SESSION['currentDate'] = $leMois;
        $total = 0;
      ?>
      <!-- Creation du tableau pour les frais forfait  -->
      <form method="POST"  action="index.php?uc=validerFrais&action=validerFraisForfait">
      <div class="corpsForm">
          <fieldset>
            <legend>Frais au forfait
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
                                    $total += $valeurs * $unFrais['montant'];
                                    ?>
                                    <td width="80" ><input type="text" size="3" name="fraisForfait[<?php echo($idFrais) ?>]" value="<?php echo($valeurs) ?>" /></td>
                                    <?php
                                }
                            ?>
			</tr>
            </table>
       </fieldset>
          <p style="text-align: right">
            <input id="ok" type="submit" value="Valider" size="20" />
            <input id="annuler" type="reset" value="Effacer" size="20" />
          </p> 
      </div>
      </form>
      
      <!-- Creation du tableau pour les frais hors forfait  -->
      <div>
          <fieldset>   
               <legend>Frais hors forfait
            </legend>
            <table class="listeLegere">
                <caption>Descriptif des éléments hors forfait
                </caption>
                <tr>
                   <th>Date</th>
                   <th>Libellé</th>  
                   <th>Montant</th>  
                   <th>Situation</th>              
                </tr>
        <?php    
	    
            foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		{
                    $libelle = $unFraisHorsForfait['libelle'];
                    $date = $unFraisHorsForfait['date'];
                    $montant=$unFraisHorsForfait['montant'];
                    $idHorsFrais = $unFraisHorsForfait['id'];
                    $total += $montant;
        ?>		
            <tr>
                <td style="color:black;"><?php echo $date ?></td>
                <td style="color:black;"><?php echo $libelle ?></td>
                <td style="color:black;"><?php echo $montant ?></td>
                <td width="80"> 
                    <a href="index.php?uc=validerFrais&action=supprimerFrais&idHorsFrais=<?php echo $idHorsFrais ?>">Supprimer</a><br>
                    <a href="index.php?uc=validerFrais&action=reporterFrais&idHorsFrais=<?php echo $idHorsFrais ?>">Reporter</a><br>
                </td>
             </tr>
	<?php
          }
	?>                    
            </table>
          </fieldset>
          
        <!-- Creation du tableau pour le total des frais et nb justificatifs.  -->
        <?php
            $nbJustif = $lesInfosFicheFrais['nbJustificatifs'];
            $montant = $lesInfosFicheFrais['montantValide'];
        ?>
        <form method="POST"  action="index.php?uc=validerFrais&action=validerFiche">
            <fieldset>
              <legend>Calcul frais
              </legend>
                <table class="listeLegere">
                    <tr><th>Nb justificatifs</th><th>montant enregistré</th><th>montant calculé</th></tr>
                    <tr align="center">
                    <td width="80" ><input type="text" size="5" name="nbJustif" value="<?php echo($nbJustif) ?>" /></td>
                    <td width="80" ><label><?php echo($montant) ?></label></td>
                    <td width="80" ><input type="text" size="20" name="montantCalcul" value="<?php echo($total) ?>" /></td>
                    </tr>
                </table>
            </fieldset>
          
          
            <input id="ok" type="submit" value="Valider la fiche" size="20" />
        </form>
      </div>
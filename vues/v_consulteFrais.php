      <h2>Valider la fiche du mois <?php echo $numMois."-".$numAnnee ?>. Status : <?php echo($lesInfosFicheFrais['libEtat']) ?></h2>
      <!-- Conservation des id et date -->
      <?php
        $_SESSION['currentId'] = $leVisiteur;
        $_SESSION['currentDate'] = $leMois;
      ?>
      <!-- Creation du tableau pour les frais forfait  -->
      <form method="POST"  action="index.php?uc=validerFrais&action=validerFraisForfait">
      <div class="corpsForm">
          <fieldset>
            <legend>Frais au forfait
            </legend>
              <input type="hidden" name="id" value="<?php echo($leVisiteur) ?>">
              <input type="hidden" name="date" value="<?php echo($leMois) ?>">
              <table style="color:white;" border="1">
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
          
          <form method="POST"  action="index.php?uc=validerFrais&action=validerFiche">
            <input type="hidden" name="id" value="<?php echo($leVisiteur) ?>">
            <input type="hidden" name="date" value="<?php echo($leMois) ?>">
            <input id="ok" type="submit" value="Valider la fiche" size="20" />
          </form>
      </div>
  
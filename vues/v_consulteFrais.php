      <h2>Renseigner ma fiche de frais du mois <?php echo $numMois."-".$numAnnee ?></h2>
         
      <form method="POST"  action="index.php?uc=validerFrais&action=validerFraisForfait">
      <div class="corpsForm">
          
          <fieldset>
            <legend>Frais au forfait
            </legend>
              
              <?php
              //place les données dans un tableau.
              $valeurs = array();
		foreach ($lesFraisForfait as $unFrais)
		{
                    $idFrais = $unFrais['idfrais'];
                    $valeurs[$idFrais] = $unFrais['quantite'];
		}
              ?>
              
              <table style="color:white;" border="1">
			<tr><th>Repas midi</th><th>Nuité </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
			<tr align="center"><td width="80" ><input type="text" size="3" name="fraisForfait[<?php echo($valeurs["$idFrais"]) ?>]" value="<?php echo($valeurs["REP"]) ?>" /></td>
                            <td width="80"><input type="text" size="3" name="nuitee" value="<?php echo($valeurs["NUI"]) ?>" /></td> 
                            <td width="80"> <input type="text" size="3" name="etape" value="<?php echo($valeurs["ETP"]) ?>" /></td>
                            <td width="80"> <input type="text" size="3" name="km" value="<?php echo($valeurs["KM"]) ?>" /></td>
                            <td width="80"> 
				<select size="3" name="situ">
					<option value="E">Enregistré</option>
					<option value="V">Validé</option>
					<option value="R">Remboursé</option>
				</select>
                            </td>
			</tr>
            </table>
       </fieldset>
          <fieldset>   
               <legend>Frais hors forfait
            </legend>
            <table style="color:white;" border="1">
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
			$id = $unFraisHorsForfait['id'];
	?>		
            <tr>
                <td style="color:black;" width="40"><input type="text" size="10" name="date" value="<?php echo $date ?>"/></td>
                <td style="color:black;" width="80"><input type="text" size="50" name="libelle" value="<?php echo $libelle ?>"/></td>
                <td style="color:black;" width="40"><input type="text" size="10" name="montant" value="<?php echo $montant ?>"/></td>
                <td width="80"> 
                    <select size="3" name="situ">
			<option value="E">Enregistré</option>
			<option value="V">Validé</option>
			<option value="R">Remboursé</option>
                    </select></td>
             </tr>
	<?php		 
          
          }
	?>                    
            </table>
          </fieldset>
        
        
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
  
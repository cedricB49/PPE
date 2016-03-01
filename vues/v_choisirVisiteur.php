<div id="contenu">
      <h2>Choisir le visiteur</h2>
         
      <form method="POST"  action="index.php?uc=validerFrais&action=voirValiderClient">
      <div class="corpsForm">
          <p>
            <label>Choisir le visiteur :</label>
            <select id="lstVisiteurs" name="lstVisiteurs">
                <?php
			foreach ($lesVisiteurs as $unVisiteur)
			{
			    $id = $unVisiteur['id'];
                            $nom =  $unVisiteur['nom'];
                            $prenom =  $unVisiteur['prenom'];
                            if($id == $visiteurSelectionne){
				?>
				<option selected value="<?php echo $id ?>"><?php echo  $nom." ".$prenom ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $id ?>"><?php echo  $nom." ".$prenom ?> </option>
				<?php 
				}
			}
		   ?>  
            </select>
          </p>
          <p>
            <label>Choisir la date :</label>
            <?php
            if(isset($_REQUEST['lstMois']))
            {
                ?>
                <input type="text" id="datepicker" name="lstMois" value="<?php echo($_REQUEST['lstMois']) ?>">
            <?php
            
            }else
            { ?>
               <input type="text" id="datepicker" name="lstMois" value="<?php echo(date("d/m/y")) ?>">
            <?php } ?>
          </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
  
<div id="contenu">
      <h2>Suivi paiment</h2>
        <!-- Utilise Ajax pour remplir la liste de dates au chargement de la page, puis en choisissant un client. -->
      <form id="choixFiche" method="POST" action="index.php?uc=suivrePaiment&action=voirDetailFiche" enctype="multipart/form-data">
      <div class="corpsForm">
          <p>
            <label>Choisir une fiche :</label>
            <select id="lstFiches" name="lstFiches" onchange="recupDate(this.value)">
                <?php
			foreach ($lesVisiteurs as $unVisiteur)
			{
			    $id = $unVisiteur['id'];
                            $nom =  $unVisiteur['nom'];
                            $prenom =  $unVisiteur['prenom'];
                            if($id == $idSelectionne){
				?>
				<option selected value="<?php echo ($id) ?>"><?php echo($nom." ".$prenom) ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo ($id) ?>"><?php echo($nom." ".$prenom) ?> </option>
				<?php 
                            }
			}
		   ?>  
            </select>
            <br>
            
            <select id="lstDates" name="lstDates">
                
            </select>
          <div id="output"></div>
          </p>
    </div>
    <div class="piedForm">
    <p>
      <input id="ok" type="submit" value="Valider" size="20" />
    </p> 
    </div>

    </form>
    <script>
    window.onload = recupDate(document.getElementById("lstFiches").value);
    </script>
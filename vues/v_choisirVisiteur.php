<div id="contenu">
        <h2>Choisir le visiteur</h2>
        <!-- Utilise Ajax pour remplir la liste de dates au chargement de la page, puis en choisissant un client. -->
        <form method="POST"  action="index.php?uc=validerFrais&action=voirValiderClient" enctype="multipart/form-data">
        <div class="corpsForm">
            <p>
              <label>Choisir le visiteur :</label>
              <select id="lstVisiteurs" name="lstVisiteurs" onchange="recupDate(this.value)">
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
            <br>

              <select id="lstDates" name="lstDates">

              </select>
            </p>
        </div>
        <div class="piedForm">
        <p>
          <input id="ok" type="submit" value="Valider" size="20" />
          <input id="annuler" type="reset" value="Effacer" size="20" />
        </p> 
        </div>

        </form>
    <script>
    window.onload = recupDate(document.getElementById("lstVisiteurs").value);
    </script>
  
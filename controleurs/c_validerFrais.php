<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

$lesVisiteurs=$pdo->getLesVisiteursDisponibles();

switch($action){
	case 'selectionnerVisiteur':{
                
                //génère la liste des visiteurs disponibles.
		$lesCles = array_keys( $lesVisiteurs);
		$visiteurSelectionne = $lesCles[0];
                //clos les dernières fiches en cours.
                foreach($lesVisiteurs as $unVisiteur)
                {
                    $id = $unVisiteur["id"];
                    $dernierMois = $pdo->dernierMoisSaisi($id);
                    $laDerniereFiche = $pdo->getLesInfosFicheFrais($id,$dernierMois);
                    if($laDerniereFiche['idEtat']=='CR')
                    {
                        $pdo->majEtatFicheFrais($id, $dernierMois,'CL');
                    }
                }
                //affiche la liste de selection
		include("vues/v_choisirVisiteur.php");
		break;
	}
	case 'voirValiderClient':{
                $leVisiteur = $_REQUEST['lstVisiteurs'];
                $leMois = $_REQUEST['lstDates'];
                $_SESSION['currentDate'] = $leMois;
                $_SESSION['idVisiteur'] = $leVisiteur;
                $visiteurSelectionne = $leVisiteur;
		include("vues/v_choisirVisiteur.php");
                //récupère les informations en vue de la création de la vue
                
                if($pdo->estPremierFraisMois($leVisiteur, $leMois))
                {
                    ajouterErreur("Aucune fiche pour le mois choisi.");
                    include("vues/v_erreurs.php");
                }
                else
                {
                    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$leMois);
                    $lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$leMois);
                    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$leMois);
                    include("vues/v_consulteFrais.php");
                }
                break;
	}
        case 'validerFraisForfait':{
                $leVisiteur = $_SESSION['idVisiteur'];
                $leMois = $_SESSION['currentDate'];
                $visiteurSelectionne = $leVisiteur;
		include("vues/v_choisirVisiteur.php");
                //mise à jour des informations forfaits dans la bdd
                $fraisForfait = $_REQUEST['fraisForfait'];
		if(lesQteFraisValides($fraisForfait)){
	  	 	$pdo->majFraisForfait($leVisiteur,$leMois,$fraisForfait);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
                //maj la catégorie de vehicule
                $lesCles = array_keys($fraisForfait);
                foreach($lesCles as $uneCle)
                {
                    if(strpos($uneCle, "KM") !== false)
                    {
                        $catActuelle = $uneCle;
                        echo($uneCle);
                    }
                    
                }
                $nouvelleCat = $_POST['lstVoiture'];
                if( isset($catActuelle) && $nouvelleCat != $catActuelle)
                {
                    $pdo->majVehicule($leVisiteur, $leMois, $catActuelle, $nouvelleCat);
                }
                
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$leMois);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'validerFiche':{
                $leVisiteur = $_SESSION['idVisiteur'];
                $leMois = $_SESSION['currentDate'];
                $nbJustif = $_POST['nbJustif'];
                $montant = $_POST['montantCalcul'];
                $visiteurSelectionne = $leVisiteur;
                //passage de la fiche au status validé et maj du montant et nb justificatifs.
                $pdo->majNbJustificatifs($leVisiteur, $leMois, $nbJustif);
                $pdo->majMontantFicheFrais($leVisiteur, $leMois, $montant);
                $pdo->majEtatFicheFrais($leVisiteur,$leMois, "VA");
		include("vues/v_choisirVisiteur.php");
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$leMois);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'supprimerFrais':{
                $leVisiteur = $_SESSION['currentId'];
                $leMois = $_SESSION['currentDate'];
                $visiteurSelectionne = $leVisiteur;
                include("vues/v_choisirVisiteur.php");
                //ajoute la mention refusée sur le libellé du frais.
                $id = $_REQUEST['idHorsFrais'];
                $pdo->refuseFraisHorsForfait($id, $leVisiteur, $leMois);
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$leMois);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'reporterFrais':{
                $leVisiteur = $_SESSION['currentId'];
                $leMois = $_SESSION['currentDate'];
                $visiteurSelectionne = $leVisiteur;
                include("vues/v_choisirVisiteur.php");
                //reporte le frais au mois suivant.
                $id = $_REQUEST['idHorsFrais'];
                $pdo->reporteFraisHorsForfait($id, $leVisiteur, $leMois);
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$leMois);
                include("vues/v_consulteFrais.php");
                break;
        }
}
?>
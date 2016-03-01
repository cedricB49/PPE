<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'selectionnerVisiteur':{
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
		$lesCles = array_keys( $lesVisiteurs);
		$visiteurSelectionne = $lesCles[0];
		include("vues/v_choisirVisiteur.php");
		break;
	}
	case 'voirValiderClient':{
                $leVisiteur = $_REQUEST['lstVisiteurs'];
                $leMois = $_REQUEST['lstMois'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
		include("vues/v_choisirVisiteur.php");
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                include("vues/v_consulteFrais.php");
                break;
	}
}
?>
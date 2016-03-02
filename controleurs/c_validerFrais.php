﻿<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

switch($action){
	case 'selectionnerVisiteur':{
                
                //génère la liste des visiteurs disponibles.
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
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
                $leMois = $_REQUEST['lstMois'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $numJour = substr($leMois,0, 2);
                //teste $numjour pour définir le mois à afficher.
                if(intval($numJour) < 15)
                {
                   $numMois = decrementDate($numMois);
                   if(intval($numMois) < 1)
                   {
                       $numMois = decrementDate('13');
                       $numAnnee = decrementDate($numAnnee);
                   }
                }
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
		include("vues/v_choisirVisiteur.php");
                //récupère les informations en vue de la création de la vue
                
                if($pdo->estPremierFraisMois($leVisiteur, $laDate))
                {
                    ajouterErreur("Aucune fiche pour le mois choisi.");
                    include("vues/v_erreurs.php");
                }
                else
                {
                    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
                    $lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
                    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                    include("vues/v_consulteFrais.php");
                }
                break;
	}
        case 'validerFraisForfait':{
                $leVisiteur = $_REQUEST['id'];
                $leMois = $_REQUEST['date'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
		include("vues/v_choisirVisiteur.php");
                //mise à jour des informations forfaits dans la bdd
                $fraisForfait = $_REQUEST['fraisForfait'];
		if(lesQteFraisValides($fraisForfait)){
	  	 	$pdo->majFraisForfait($leVisiteur,$laDate,$fraisForfait);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'validerFiche':{
                $leVisiteur = $_REQUEST['id'];
                $leMois = $_REQUEST['date'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
                //passage de la fiche au status validé.
                $pdo->majEtatFicheFrais($leVisiteur,$laDate, "VA");
		include("vues/v_choisirVisiteur.php");
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'supprimerFrais':{
                $leVisiteur = $_SESSION['currentId'];
                $leMois = $_SESSION['currentDate'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
                include("vues/v_choisirVisiteur.php");
                //ajoute la mention refusée sur le libellé du frais.
                $id = $_REQUEST['idHorsFrais'];
                $pdo->refuseFraisHorsForfait($id, $leVisiteur, $laDate);
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                include("vues/v_consulteFrais.php");
                break;
        }
        
        case 'reporterFrais':{
                $leVisiteur = $_SESSION['currentId'];
                $leMois = $_SESSION['currentDate'];
                $numAnnee =substr( $leMois,6,4);
		$numMois =substr( $leMois,3,2);
                $laDate = $numAnnee.$numMois;
                $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
                $visiteurSelectionne = $leVisiteur;
                include("vues/v_choisirVisiteur.php");
                //reporte le frais au mois suivant.
                $id = $_REQUEST['idHorsFrais'];
                $pdo->reporteFraisHorsForfait($id, $leVisiteur, $laDate);
                //récupère les informations en vue de la création de la vue
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur,$laDate);
		$lesFraisForfait= $pdo->getLesFraisForfait($leVisiteur,$laDate);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur,$laDate);
                include("vues/v_consulteFrais.php");
                break;
        }
}
?>
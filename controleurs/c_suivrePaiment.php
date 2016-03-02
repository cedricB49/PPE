<?php
    include("vues/v_sommaireComptable.php");
    $action = $_REQUEST['action'];
    $idVisiteur = $_SESSION['idVisiteur'];

    switch($action)
    {
        case 'selectionnerFiche':
        {
            $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
            $lesCles = array_keys( $lesVisiteurs);
            $idSelectionne = $lesCles[0];
            include("vues/v_choisirFichePaiment.php");
            break;
	}
        
        case'voirDetailFiche':
        {
            $idVisiteur = $_POST["lstFiches"];
            $date = $_POST["lstDates"];
            $_SESSION['idVisiteur'] = $idVisiteur;
            $_SESSION['currentDate'] = $date;
            $idSelectionne = $_SESSION['idVisiteur'];
            $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
            include("vues/v_choisirFichePaiment.php");
            //recupère détail fiches
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idSelectionne,$date);
            $lesFraisForfait= $pdo->getLesFraisForfait($idSelectionne,$date);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idSelectionne,$date);
            include("vues/v_afficherFichePaiment.php");
            break;
        }
        
        case'ValiderFiche':
        {
            $choix = $_POST["btnValider"];
            $idSelectionne = $_SESSION['idVisiteur'];
            $lesVisiteurs=$pdo->getLesVisiteursDisponibles();
            $date = $_SESSION['currentDate'];
            include("vues/v_choisirFichePaiment.php");
            //passage de la fiche au status validé.
            if($choix == "Valider")
            {
                $etat = "VA";
            }
            elseif($choix == "Rembourser")
            {
                $etat = "RB";
            }
            $pdo->majEtatFicheFrais($idSelectionne,$date, "$etat");
            //recupère détail fiches
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idSelectionne,$date);
            $lesFraisForfait= $pdo->getLesFraisForfait($idSelectionne,$date);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idSelectionne,$date);
            include("vues/v_afficherFichePaiment.php");
            break;
        }
    }
?>
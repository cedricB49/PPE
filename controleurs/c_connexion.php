<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
                $visiteur = $pdo->getInfosVisiteur($login,  sha1($mdp));
                if(!is_array( $visiteur))
                {
                    ajouterErreur("Login ou mot de passe incorrect");
                    include("vues/v_erreurs.php");
                    include("vues/v_connexion.php");
                }
                else{
                    $groupe = $visiteur['groupe'];   
                    if ($groupe == "visiteur")
                    {
                        $id = $visiteur['id'];
                        $nom =  $visiteur['nom'];
                        $prenom = $visiteur['prenom'];
                        connecter($id,$nom,$prenom, $groupe);
                        include("vues/v_sommaire.php");
                    }
                    else if ($groupe == "comptable")
                    {
                        $id = $visiteur['id'];
                        $nom =  $visiteur['nom'];
                        $prenom = $visiteur['prenom'];
                        connecter($id,$nom,$prenom, $groupe);
                        include("vues/v_sommaireComptable.php");
                    }
                }
            break;
	}
        case 'createUser':
        {
            include("vues/v_enregistreUser.php");
            break;
        }
        case 'valideNewUser':
        {
            //recupere les infos
            $login = htmlentities($_POST['login']);
            $mdp = htmlentities($_POST['mdp']);
            $groupe = htmlentities($_POST['lstType']);
            $nom = htmlentities($_POST['nom']);
            $prenom = htmlentities($_POST['prenom']);
            $adresse = htmlentities($_POST['adresse']);
            $cp = htmlentities($_POST['cp']);
            $ville = htmlentities($_POST['ville']);
            //controle si date saisie et si valide
            if(isset($_POST['date']) && estDateValide($_POST['date']))
            {
                $date = htmlentities($_POST['date']);
                //formate la date
                $date = dateFrancaisVersAnglais($date);
            }
            else
            {
                //enregistre la date du jour
                $date = date("Y-m-d");
            }
            //genere un id aleatoire
            $lettre = "azertyuiopqsdfghjklmwxcvbn";
            $id = substr($lettre, mt_rand(0,25), 1).mt_rand(0, 999);
            //ajoute les infos dans la bdd.
            $pdo->creerNouvelUtilisateur($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $date, $groupe);
            //affiche page de connexion
            include("vues/v_connexion.php");
            break;
        }
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>
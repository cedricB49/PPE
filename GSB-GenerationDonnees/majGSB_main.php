 Programme d'actualisation des lignes des tables,  
 cette mise à jour peut prendre plusieurs minutes...
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("include/fct.inc.php");

/* Modification des paramètres de connexion */

$serveur='mysql:host=moondropkkmain.mysql.db';
$bdd='dbname=moondropkkmain';   		
$user='moondropkkmain' ;    		
$mdp='dDe15Akd78e' ;	

/* fin paramètres*/
try {
    $pdo = new PDO($serveur.';'.$bdd, $user, $mdp);
    $pdo->query("SET CHARACTER SET utf8");
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

set_time_limit(0);
echo("time limit set");
//creationFichesFrais($pdo);
//echo("creation FichesFrais terminée");
/*creationFraisForfait($pdo);
echo("maj FraisForfait terminée");
creationFraisHorsForfait($pdo);
echo("maj FraisHorsForfait terminée");*/
majFicheFrais($pdo);
echo("maj FichesFrais terminée");
updateMdpVisiteur($pdo);
echo("maj terminée");

?>
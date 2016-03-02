<?php
    require_once ("class.pdogsb.inc.php");
    require_once("fct.inc.php");
    $pdo = PdoGsb::getPdoGsb();
    $id = $_POST["id"];
    if(isset($id))
    {
        $lesMois = $pdo->getLesMoisDisponibles($id);
        foreach($lesMois as $unMois)
        {
            $mois = $unMois["mois"];
            $date = rewriteDate($mois);
            //echo('<option value="'.$mois.'">'.$date.'</option>');
            ?>
            <option value="<?php echo($mois) ?>"><?php echo($date) ?></option>
            <?php
        }
    }
?>

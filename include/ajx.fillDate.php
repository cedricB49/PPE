<?php
    session_start();
    require_once ("class.pdogsb.inc.php");
    require_once("fct.inc.php");
    $pdo = PdoGsb::getPdoGsb();
    $id = $_POST["id"];
    $selectedDate = $_SESSION['currentDate'];
    if(isset($id))
    {
        $lesMois = $pdo->getLesMoisDisponibles($id);
        foreach($lesMois as $unMois)
        {
            $mois = $unMois["mois"];
            $date = rewriteDate($mois);
            if($mois == $selectedDate)
            {
                ?>
                <option selected value="<?php echo($mois) ?>"><?php echo($date) ?></option>
                <?php
            }
            else
            {
                ?>
                <option value="<?php echo($mois) ?>"><?php echo($date) ?></option>
                <?php
            }
        }
    }
?>

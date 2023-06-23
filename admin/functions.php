<?php 
require_once('../config.php');


function adminUniqueCount($col,$val){
    global $pdo;
    $stm=$pdo->prepare("select $col from admins where $col=?");
    $stm->execute(array($val));
    $count=$stm->rowCount();
    return $count;
}

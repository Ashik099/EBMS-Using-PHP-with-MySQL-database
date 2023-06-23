<?php 
require_once('config.php');

    function uniqueCount($col,$value){
        global $pdo;
        $stm=$pdo->prepare("select $col from customer where $col=?");
        $stm->execute(array($value));
        $count=$stm->rowCount();
        return $count;
    }
    

    function customerDetails($c_id,$col){
        global $pdo;
        $stm=$pdo->prepare("select $col from customer where customerID=?");
        $stm->execute(array($c_id));
        $restul=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $restul[0]["$col"];
    }

    function adminDetails($a_id,$col){
        global $pdo;
        $stm=$pdo->prepare("select $col from admins where adminID=?");
        $stm->execute(array($a_id));
        $restul=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $restul[0]["$col"];
    }

    function billsDetails($b_id,$c){
        global $pdo;
        $stm=$pdo->prepare("select $c from bills where customerID=?");
        $stm->execute(array($b_id));
        $restul=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $restul[0]["$c"];
    }

    function allCount($tableName){
        global $pdo;
        $stm=$pdo->prepare("SELECT * FROM $tableName");
        $stm->execute();
        $count=$stm->rowCount();
        return $count;
    }


    function countWithCondition($select,$tableName,$condition){
        global $pdo;
        $stm=$pdo->prepare("SELECT $select FROM $tableName $condition");
        $stm->execute();
        $count=$stm->rowCount();
        return $count;
    }

        function clculateWithCondition($select,$tableName,$con){
            global $pdo;
            $stm=$pdo->prepare("select $select from $tableName $con");
            $stm->execute();
            $restul=$stm->fetchAll(PDO::FETCH_ASSOC);
            return $restul[0]["$select"];
        }
   
        function messageDetails($id,$col,$con){
            global $pdo;
            $stm=$pdo->prepare("select $col from message $con");
            $stm->execute(array($id));
            $restul=$stm->fetchAll(PDO::FETCH_ASSOC);
            return $restul[0]["$col"];
        }



?>
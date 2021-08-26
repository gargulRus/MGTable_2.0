<?php
function createChange($objects_id, $changeRazdel, $changeNum, $changeDate, $changeText) {
    $sqlQuery=query("INSERT INTO `changes` (`object_id`, `razdel`,`number_change`,`date_change`,`note`)
     VALUES(".$objects_id.", ".$changeRazdel.", ".$changeNum.", '".$changeDate."', '".$changeText."')");
     return $sqlQuery;
}

function createYear($year) {
    $result = query ("INSERT INTO `years` ( `year`) VALUES ('".$year."')");
    return $result;
}

function createObject($name, $yearId, $kgsId, $vacId, $comId, $workerId) {
    $result = query2 ("INSERT INTO `object` ( `object_name`, `year_id`,
                    `kgs_id` , `vak_id`, `com_id`, `worker_id`) VALUES (
                    '".$name."' , ".$yearId.",
                    ".$kgsId.",".$vacId.",
                    ".$comId.",".$workerId." )");
    return $result;
}

function createPdates($object_id, $mg_date, $kgs_date) {
    if (isset($mg_date) && strlen($mg_date)>1) {   
        $result = query ("INSERT INTO `project` ( `objects_id`, `mg_date`)
                        VALUES (".$object_id." , '".$mg_date."')");
            if (isset($kgs_date) && strlen($kgs_date)>1) {
                $result2 = query ("UPDATE project SET kgs_date = '$kgs_date' WHERE objects_id='$object_id'");
            }
    } elseif (isset($kgs_date) && strlen($kgs_date)>1) {   
        $result = query ("INSERT INTO `project` ( `objects_id`, `kgs_date`)
                        VALUES (".$object_id." , '".$kgs_date."')");
    } else {
        $result = query ("INSERT INTO `project` ( `objects_id`, `mg_date`,`kgs_date`)
                        VALUES (".$object_id." , NULL,NULL)");
    }
}

function createWdates($object_id, $mg_date, $kgs_date) {
    if (isset($mg_date) && strlen($mg_date)>1) {   
        $result = query ("INSERT INTO `work` ( `objects_id`, `mg_date`)
         VALUES (".$object_id." , '".$mg_date."')");
         if (isset($kgs_date) && strlen($kgs_date)>1) {
            $result2 = query ("UPDATE work SET kgs_date = '$kgs_date' WHERE objects_id='$object_id'");
         }
    } elseif (isset($kgs_date) && strlen($kgs_date)>1) {   
        $result = query ("INSERT INTO `work` ( `objects_id`, `kgs_date`)
        VALUES (".$object_id." , '".$kgs_date."')");
    } else {
        $result = query ("INSERT INTO `work` ( `objects_id`, `mg_date`,`kgs_date`)
        VALUES (".$object_id." , NULL,NULL)");
    }
}

function createNewComm($com_name){
    $result = query ("INSERT INTO `com` ( `com_name`) VALUES ('".$com_name."')");
    return $result;
}

function createNewVak($vak_name) {
    $result = query ("INSERT INTO `vak` ( `vak_name`) VALUES ('".$vak_name."')");
    return $result;
}

function createNewKgs($kgs_name) {
    $result = query ("INSERT INTO `kgs` ( `kgs_name`) VALUES ('".$kgs_name."')");
    return $result;
}
?>
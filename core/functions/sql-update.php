<?php
function editChange($changes_id, $changeRazdel, $changeNum, $changeDate, $changeText) {
    $sqlQuery=query("UPDATE changes SET
    razdel = '$changeRazdel' , number_change = '$changeNum' , date_change = '$changeDate' , note = '$changeText' WHERE changes_id = '$changes_id'
    ");
    return $sqlQuery;
}

function renameObject($id, $newName) {
    $result = query ("UPDATE object 
                    SET object_name = '$newName'
                    WHERE id='$id'");
    return $result;
}

function updateComm($newName, $id) {
    $result = query ("UPDATE com SET com_name = '$newName' WHERE id='$id'");
    return $result;
}
function updateVak($newName, $id) {
    $result = query ("UPDATE vak SET vak_name = '$newName' WHERE id='$id'");
    return $result;
}
function updateKgs($newName, $id) {
    $result = query ("UPDATE kgs SET kgs_name = '$newName' WHERE id='$id'");
    return $result;
}

//вкладка Информация
function updatePdates($objects_id, $mg_date, $kgs_date, $work_date) {
    $result = query ("UPDATE project 
                    SET mg_date = ". ($mg_date == NULL ? "NULL" : "'$mg_date'") .",  kgs_date = ". ($kgs_date == NULL ? "NULL" : "'$kgs_date'") .", work_date = ". ($work_date == NULL ? "NULL" : "'$work_date'") ."
                    WHERE objects_id='$objects_id'");
    return $result;
}
function updateRdates($objects_id, $mg_date, $kgs_date){
    $result = query ("UPDATE work 
                    SET mg_date = ". ($mg_date == NULL ? "NULL" : "'$mg_date'") .",  kgs_date = ". ($kgs_date == NULL ? "NULL" : "'$kgs_date'") ."
                    WHERE objects_id='$objects_id'");
return $result;
}
function updateWorker($objects_id, $workerId){
    $result = query("UPDATE object 
                    SET worker_id = '$workerId'
                    WHERE id='$objects_id'");
}

function saveUnit($id, $identUnit, $object_id){
    if ($identUnit == 1) {
        $result = query ("UPDATE object 
        SET com_id = '$id'
        WHERE id='$object_id'");
    } else if ($identUnit == 2) {
        $result = query ("UPDATE object 
        SET vak_id = '$id'
        WHERE id='$object_id'");
    }else if ($identUnit == 3) {
        $result = query ("UPDATE object 
        SET kgs_id = '$id'
        WHERE id='$object_id'");
    }
    return $result;
}
?>
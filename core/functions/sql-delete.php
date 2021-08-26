<?php
function deleteChange($changes_id) {
    $sqlQuery=query("DELETE FROM changes WHERE changes_id='$changes_id'");
    return $sqlQuery;
}

function deleteYear($year) {
    $result = query ("DELETE FROM `years` WHERE id=".$year);
    return $result;
}

function deleteComm($id) {
    $result = query ("DELETE FROM com WHERE id='$id'");
    return $result;
}

function deleteVak($id) {
    $result = query ("DELETE FROM vak WHERE id='$id'");
    return $result;
}

function deleteKgs($id) {
    $result = query ("DELETE FROM kgs WHERE id='$id'");
    return $result;
}
?>
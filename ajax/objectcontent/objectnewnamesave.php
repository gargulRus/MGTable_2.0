<?php
$result = renameObject($_POST['id'], $_POST['newObjectname']);
rename($_SERVER['DOCUMENT_ROOT'].'/files/'.$_POST['oldObjectname'], $_SERVER['DOCUMENT_ROOT'].'/files/'.$_POST['newObjectname']);
?>
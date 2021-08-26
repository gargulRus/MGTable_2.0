<?php
//Что бы нормально отработать нужна переменная identUnit
//Она опредяелт что это за оборудование и какую функцию использовать
//Что бы сохранить в оборудование в нужное поле
$id = $_POST['id'];
$identUnit = $_POST['identUnit'];
$object_id = $_POST['object_id'];
$result = saveUnit($id, $identUnit, $object_id);
$unit = '';
if($identUnit == 1){
    $unit = "Компрессор сохранен!";
}else if ($identUnit == 2) {
    $unit = "Вак. станция сохранена!";
} else if ($identUnit == 3) {
    $unit = "КГС сохранена!";
}
if($result) {
    echo '<div id="hide'.$identUnit.'" class="alert alert-success">'.$unit.'</div>';
} else {
    echo '<div id="hide'.$identUnit.'" class="alert alert-danger">Ошибка!</div>';
}
?>
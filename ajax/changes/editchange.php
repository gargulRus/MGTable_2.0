<?php
if(isset($_POST['editChange'])){
    sleep(1);
    if (editChange($_POST['changes_id'], $_POST['changeRazdel'], $_POST['changeNum'], $_POST['changeDate'], $_POST['changeText'])){
        echo '
        <br>
        <div id="hide" class="alert alert-success">Изменение сохранено!</div>';
    } else {
        echo '<div id="hide" class="alert alert-danger">Ошибка!</div>';
    }
    echo'
    <script>

    var objects_id = "'.$_POST['objects_id'].'";
    function func() {
        $.ajax ({
            type:"POST",
            url: "/?changes=changes",
            data: {
            "objects_id":objects_id
            },
            beforeSend: funcBeforeChanges,
            success: funcSuccessChanges
        });
      }
      
      setTimeout(func, 2500);
    </script>';
    exit;
}
if(isset($_POST['deleteChange'])){
    sleep(1);
    if (deleteChange($_POST['changes_id'])){
        echo '
        <br>
        <div id="hide" class="alert alert-warning">Изменение удалено!</div>';
    } else {
        echo '<div id="hide" class="alert alert-danger">Ошибка!</div>';
    }
    echo'
    <script>

    var objects_id = "'.$_POST['objects_id'].'";
    function func() {
        $.ajax ({
            type:"POST",
            url: "/?changes=changes",
            data: {
            "objects_id":objects_id
            },
            beforeSend: funcBeforeChanges,
            success: funcSuccessChanges
        });
      }
      
      setTimeout(func, 2500);
    </script>';
    exit;
}

$changeArr = getChangeById($_POST['changes_id']);
    sleep(1);
    $objects_id = $_POST['objects_id'];
    // echo '<pre>';
    // var_dump($changeArr);
    // echo '</pre>';
    echo'
    <form method="POST" action="#">
        <div class="form-group">
            <h5>Изменение № - '.$changeArr[0]['number_change'].'</h5>
            <br>
            <br>
            <label for="changeRazdel">Раздел</label>
            <select id="changeRazdel" class="form-select input-sm" aria-label="Default select changeRazdel">
                <option> </option>
                <option value="1" data-id="1">МГ</option>
                <option value="2" data-id="2">КГС</option>
            </select>
            <br>
            <br>
            <label for="changeNum">№ изменения</label>
            <input name="name" type="text" id="changeNum" class="form-control" value="'.$changeArr[0]['number_change'].'">
            <br>
            <br>
            <label for="changeDate">Дата Выпуска</label>
            <input type="date" name="changeDate" id="changeDate" value="'.$changeArr[0]['date_change'].'"> 
            <br>
            <br>
            <label for="compsel">Примечание</label>
            <textarea placeholder="текс примечания" class="form-control" name="changeText" id="changeText" rows="5">'.$changeArr[0]['note'].'</textarea>
        </div>
            <input type="hidden" name="chRazdel" id="chRazdel" value="NULL">
            <br>
            <input type="submit" class="btn btn-sm btn-success" id="editChange" value="Сохранить"/>
            <span id="deleteChange" class="btn btn-sm btn-warning">Удалить</span>
    </form>
    ';
echo'
<script>
$(document).ready(function(){

    $("#changeRazdel").change(function () {
        $("#chRazdel").val($(this).find(":selected").data("id"));
    });
    $("#changeRazdel").val('.$changeArr[0]['razdel'].');
    $("#chRazdel").val('.$changeArr[0]['razdel'].');

    $("#editChange").bind("click", function(){ 
        var objects_id = "'.$_POST['objects_id'].'";
        var changes_id = "'.$changeArr[0]['changes_id'].'";
        var changeNum = document.getElementById("changeNum").value;
        var changeDate = document.getElementById("changeDate").value;
        var changeText = document.getElementById("changeText").value;
        var changeRazdel = document.getElementById("chRazdel").value;
        var editChange = 1;
        $.ajax ({
            type:"POST",
            url: "/?changes=editchange",
            data: {
                   "objects_id":objects_id,
                   "changes_id":changes_id,
                   "changeNum":changeNum,
                   "changeDate":changeDate,
                   "changeText":changeText,
                   "changeRazdel":changeRazdel,
                   "editChange":editChange
                     },
            beforeSend: funcBeforeChangesActivity,
            success: funcSuccessChangesActivity
        });
    });
    $("#deleteChange").bind("click", function(){ 
        var objects_id = "'.$_POST['objects_id'].'";
        var changes_id = "'.$changeArr[0]['changes_id'].'";
        var deleteChange = 1;
        $.ajax ({
            type:"POST",
            url: "/?changes=editchange",
            data: {
                   "objects_id":objects_id,
                   "changes_id":changes_id,
                   "deleteChange":deleteChange
                     },
            beforeSend: funcBeforeChangesActivity,
            success: funcSuccessChangesActivity
        });
    });
});
    </script>';

?>
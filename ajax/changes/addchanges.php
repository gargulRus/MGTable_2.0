<?php
sleep(1);

if (isset($_POST['saveChange'])) {
    sleep(1);
    $objects_id = $_POST['objects_id'];
    $changeNum = $_POST['changeNum'];
    $changeDate = $_POST['changeDate'];
    $changeText = $_POST['changeText'];
    $changeRazdel = $_POST['changeRazdel'];
    if (createChange($objects_id, $changeRazdel, $changeNum, $changeDate, $changeText)) {
        echo '
        <br>
        <div id="hide" class="alert alert-success">Изменение сохранено!</div>';
    } else {
        echo '<div id="hide" class="alert alert-danger">Ошибка!</div>';
    }
    echo'
    <script>
    var objects_id = "'.$objects_id.'";
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
?>
<form method="POST" action="#" id="createChange">
    <div class="form-group">
        <h5>Новое изменение</h5>
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
        <input name="name" type="text" id="changeNum" class="form-control">
        <br>
        <br>
        <label for="changeDate">Дата Выпуска</label>
        <input type="date" name="changeDate" id="changeDate" value=""> 
        <br>
        <br>
        <label for="compsel">Примечание</label>
        <textarea placeholder="текс примечания" class="form-control" name="changeText" id="changeText" rows="5"></textarea>
    </div>
        <input type="hidden" name="chRazdel" id="chRazdel" value="NULL">
        <br>
        <input type="submit" class="btn btn-success" id="saveChange" value="Создать"/>
</form>

<script>

$(document).ready(function(){

    $("#changeRazdel").change(function () {
        $("#chRazdel").val($(this).find(":selected").data("id"));
    });


    $("#saveChange").bind("click", function(){ 
        var objects_id = "<?php echo $_POST['objects_id']; ?>";
        var changeNum = document.getElementById("changeNum").value;
        var changeDate = document.getElementById("changeDate").value;
        var changeText = document.getElementById("changeText").value;
        var changeRazdel = document.getElementById("chRazdel").value;
        var saveChange = 1;
        console.log(objects_id);
        console.log(changeNum);
        console.log(changeDate);
        console.log(changeText);
        console.log(changeRazdel);
        console.log(saveChange);
        $.ajax ({
            type:"POST",
            url: "/?changes=addchanges",
            data: {
                   "objects_id":objects_id,
                   "changeNum":changeNum,
                   "changeDate":changeDate,
                   "changeText":changeText,
                   "changeRazdel":changeRazdel,
                   "saveChange":saveChange
                     },
            //dataType: "html",
            beforeSend: funcBeforeChangesActivity,
            success: funcSuccessChangesActivity
        });
    });
});
</script>
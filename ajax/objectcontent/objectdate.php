<?php
if(isset($_POST['saveDate'])){
    $resultP = updatePdates($_POST['objects_id'], $_POST['dateMgP'], $_POST['dateKgsP'], $_POST['dateWork']); 
    if($resultP){
        echo '
            <div class="alert alert-success" role="alert">
                Даты П И Начала стройки обновлены!
            </div>
        ';
    } else {
        echo '
            <div class="alert alert-danger" role="alert">
            Даты П И Начала стройки не обновлены! - Ошибка!
            </div>
        ';
    }
    $resultR = updateRdates($_POST['objects_id'], $_POST['dateMgR'], $_POST['dateKgsR']);
    if($resultP){
        echo '
            <div class="alert alert-success" role="alert">
                Даты Р обновлены!
            </div>
        ';
    } else {
        echo '
            <div class="alert alert-danger" role="alert">
                Даты Р не обновлены! - Ошибка!
            </div>
        ';
    }
    $resultWorker = updateWorker($_POST['objects_id'], $_POST['workerId']);
    if($resultP){
        echo '
            <div class="alert alert-success" role="alert">
                Исполнитель обновлен!
            </div>
        ';
    } else {
        echo '
            <div class="alert alert-danger" role="alert">
                Исполнитель не обновлен! - Ошибка!
            </div>
        ';
    }
echo'
<script>

var id = "'.$_POST['objects_id'].'";
function func() {
    
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=objectdate",
        data: {"id":id},
        beforeSend: funcBeforeObjectDetails,
        success: funcSuccessObjectDetails
    });
    }
    
    setTimeout(func, 2500);
</script>';
exit;
}

$object = getObjectById($_POST['id']);
echo'
<div class="container">
    <form method="POST" action="#" id="createexp">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="worker">Исполнитель</label>
                    <select class="form-select input-sm" id="workerSelectEdit">
                        <option value="0"> </option>
                        <option value="1">Беженарь</option>
                        <option value="2">Матюкова</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="compsel">Сроки Стадии Проект</label>
                    <br>
                    <label for="compsel">Сдача МГ</label>
                    <input type="date" placeholder="дата2" name="calendar" id="mgP" value="'.$object[0]['dataP'][0]['mg_date'].'">
                    <br>
                    <br>
                    <label for="compsel">Сдача КГС</label>
                    <input type="date" placeholder="дата2" name="calendar" id="kgsP" value="'.$object[0]['dataP'][0]['kgs_date'].'"> 
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="compsel">Сроки Стадии Рабочка</label>
                    <br>
                    <label for="compsel">Сдача МГ</label>
                    <input type="date" placeholder="дата2" name="calendar" id="mgR" value="'.$object[0]['dataR'][0]['mg_date'].'">
                    <br>
                    <br>
                    <label for="compsel">Сдача КГС</label>
                    <input type="date" placeholder="дата2" name="calendar" id="kgsR" value="'.$object[0]['dataR'][0]['kgs_date'].'">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="work-data">Срок окончания стройки</label>
                    <br>
                    <label for="work-data">Срок</label>
                    <input type="date" name="work-data" id="workData" value="'.$object[0]['dataP'][0]['work_date'].'">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="hidden" id="workerIdEdit"  value="NULL">
                    <input type="submit" class="btn btn-success" id="changeDate" value="Обновить Информацию"/>
                </div>
            </div>
        </div>
    </form>
</div>
';

?>

<script>

<?php 
echo '$("#workerSelectEdit").val('.$object[0]['worker_id'].');';
echo '$("#workerIdEdit").val('.$object[0]['worker_id'].');';
?>

$('#workerSelectEdit').change(function () {
    $("#workerIdEdit").val($(this).val());
});

$("#changeDate").bind("click", function(){ 
    var objects_id = "<?php echo $_POST['id']?>";
    var dateMgP = document.getElementById("mgP").value;
    var dateKgsP = document.getElementById("kgsP").value;
    var dateMgR = document.getElementById("mgR").value;
    var dateKgsR = document.getElementById("kgsR").value;
    var dateWork = document.getElementById("workData").value;
    var workerId = document.getElementById("workerIdEdit").value;
    var saveDate = 1;
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=objectdate",
        data: {
                "objects_id":objects_id,
                "dateMgP":dateMgP,
                "dateKgsP":dateKgsP,
                "dateMgR":dateMgR,
                "dateKgsR":dateKgsR,
                "dateWork":dateWork,
                "workerId":workerId,
                "saveDate":saveDate
            },
        beforeSend: funcBeforeObjectDetails,
        success: funcSuccessObjectDetails
    });
});
</script>
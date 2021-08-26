<?php
if(isset($_POST['name'])){

    sleep(1);

    echo '
        <div class="alert alert-success" role="alert">
            Создаю объект '.$_POST['name'].'
        </div>
    ';

    $commDir=$_SERVER['DOCUMENT_ROOT'].'/files/'.$_POST['name'].'/Коммерческие/';
    if (!is_dir($commDir)) {
        if (mkdir($commDir, 0777, true)) {
            echo '
                <div class="alert alert-success" role="alert">
                    Директория КП - создана!
                </div>
            ';
        } else {
            echo '
                <div class="alert alert-danger" role="alert">
                    Директория КП - не создана!
                </div>
            ';
        }
    }
    $pdfDir=$_SERVER['DOCUMENT_ROOT'].'/files/'.$_POST['name'].'/Проект(PDF)/';
    if (!is_dir($pdfDir)) {
        if(mkdir($pdfDir, 0777, true)){
            echo '
                <div class="alert alert-success" role="alert">
                    Директория Проект(PDF) - создана!
                </div>
            ';
        } else {
            echo '
                <div class="alert alert-danger" role="alert">
                    Директория Проект(PDF) - не создана!
                </div>
            ';
        }
    }
    $dwgDir=$_SERVER['DOCUMENT_ROOT'].'/files/'.$_POST['name'].'/Проект(DWG)/';
    if (!is_dir($dwgDir)) {
        if(mkdir($dwgDir, 0777, true)){
            echo '
                <div class="alert alert-success" role="alert">
                    Директория Проект(DWG) - создана!
                </div>
            ';
        } else {
            echo '
                <div class="alert alert-danger" role="alert">
                    Директория Проект(DWG) - не создана!
                </div>
            ';
        }
    }
    
    //Сохраняем в базу объект и получаем его ИД
    $savedObject = createObject($_POST['name'], $_POST['yearId'], $_POST['kgsId'], $_POST['vacId'], $_POST['comId'], $_POST['workerId']);
    //Теперь проверяем что у нас даты пришли не пустые.
    //в противном случае сохраняем в базу NULL
    //ДАТЫ СТАДИИ П
    createPdates($savedObject, $_POST['dateMgP'], $_POST['dateKgsP']);
    //ДАТЫ СТАДИИ Р
    createWdates($savedObject, $_POST['dateMgR'], $_POST['dateKgsR']);

    echo'
    <script>
        function func() {
            $.ajax ({
                type:"POST",
                url: "/?base=newobject",
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
          }
          
          setTimeout(func, 2500);
        </script>
    ';
    exit;
}

sleep(1);
echo '
<div class="showon">
    <div class="row">
        <div class="col-sm-4">
            <form method="POST" action="#" id="createexp">
                <div class="form-group">
                    <label for="compsel">Название объекта</label>
                    <input name="name" type="text" value="" placeholder="Название объекта" id="name" class="form-control">
                </div>
                <br>
                <label for="obsel">Выберите Год</label>
                '.$selectYear.'
                <br>
                <div class="form-group">
                    <label for="workerSelect">Исполнитель</label>
                    <select class="form-select input-sm" id="workerSelect">
                        <option value="0"> </option>
                        <option value="1">Беженарь</option>
                        <option value="2">Матюкова</option>
                    </select>
                </div>
        </div>
        <div class="col-sm-4">
                <div class="form-group mb-1">
                    <label for="compsel">Сроки Стадии Проект</label>
                    <br>
                    <label for="compsel">Сдача МГ</label>
                    <input type="date" placeholder="дата2" id="mgP" name="mgP">
                    <br>
                    <br>
                    <label for="compsel">Сдача КГС</label>
                    <input type="date" placeholder="дата2" id="kgsP" name="kgsP">
                </div>
                <br>
                <div class="form-group mb-1">
                    <label for="compsel">Сроки Стадии Рабочка</label>
                    <br>
                    <label for="compsel">Сдача МГ</label>
                    <input type="date" placeholder="дата2" id="mgR" name="mgR">
                    <br>
                    <br>
                    <label for="compsel">Сдача КГС</label>
                    <input type="date" placeholder="дата2" id="kgsR" name="kgsR">
                </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <label for="compsel">Выбор оборудования</label><br>
                <div class="form-group">
                    <label for="compsel">Компрессорные станции</label>
                    '.$selectCom.'
                </div>
                <div class="form-group">
                    <label for="vakpsel">Вакуумные станции</label>
                    '.$selectVak.'
                </div>
                <div class="form-group">
                    <label for="kgspsel">КГС</label>
                    '.$selectKgs.'
                </div>
                <br>
                <div class="form-group text-right">
                    <input type="hidden" id="yearId"  value="">
                    <input type="hidden" id="comId"  value="NULL">
                    <input type="hidden" id="vacId"  value="NULL">
                    <input type="hidden" id="kgsId"  value="NULL">
                    <input type="hidden" id="workerId"  value="NULL">
                    <input type="submit" class="btn btn-success" id="createObject" value="Создать объект"/>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
        </div>
    </div>

</div>
';
?>

<script>

$(document).ready(function(){

    $('#yearSelect').change(function () {
        $("#yearId").val($(this).find(':selected').data('id'));
    });
    $('#comSelect').change(function () {
        $("#comId").val($(this).find(':selected').data('id'));
    });
    $('#vacSelect').change(function () {
        $("#vacId").val($(this).find(':selected').data('id'));
    });
    $('#kgsSelect').change(function () {
        $("#kgsId").val($(this).find(':selected').data('id'));
    });
    $('#workerSelect').change(function () {
        $("#workerId").val($(this).val());
    });


    $("#createObject").bind("click", function(){ 
        var name = document.getElementById("name").value;
        var yearId = document.getElementById("yearId").value;
        var dateMgP = document.getElementById("mgP").value;
        var dateKgsP = document.getElementById("kgsP").value;
        var dateMgR = document.getElementById("mgR").value;
        var dateKgsR = document.getElementById("kgsR").value;
        var comId = document.getElementById("comId").value;
        var vacId = document.getElementById("vacId").value;
        var kgsID = document.getElementById("kgsId").value;
        var workerId = document.getElementById("workerId").value;
        if(name == "" )
        {
            alert("Укажите название Объекта!");
            return false;
        }
        else if(yearId == "")
        {
            alert("Выберите год!");
            return false;
        }
        else
        {
            $.ajax ({
            type:"POST",
            url: "/?base=newobject",
            data: {"name":name,
                   "yearId":yearId,
                   "dateMgP":dateMgP,
                   "dateKgsP":dateKgsP,
                   "dateMgR":dateMgR,
                   "dateKgsR":dateKgsR,
                   "comId":comId,
                   "vacId":vacId,
                   "kgsId":kgsID,
                   "workerId":workerId
                     },
            //dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
        }

    });
    
});
</script>
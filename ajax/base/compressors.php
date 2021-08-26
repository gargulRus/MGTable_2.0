<?php
if(isset($_POST['comName'])){
    sleep(1);
    if (createNewComm($_POST['comName'])) {
        echo '
        <div class="alert alert-success" role="alert">
            Сохроняю новый компрессор - '.$_POST['comName'].' в базу!
        </div>
        ';
    } else {
        echo '
        <div class="alert alert-danger" role="alert">
            Ошибка при создании компрессора!
        </div>
        ';
    }
    echo'
    <script>
        function func() {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
          }
          setTimeout(func, 2000);
        </script>
    ';
    exit;
} elseif (isset($_POST['comEdit'])) {

    sleep(1);

    if( updateComm($_POST['comEdit'], $_POST['comIdEdit'])){
        echo '
        <div class="alert alert-success" role="alert">
            Новое наименование компрессора - '.$_POST['comEdit'].'
            <br>
            Сохраняю изменения в базе
        </div>
        ';
    } else {
        echo '
        <div class="alert alert-danger" role="alert">
            Ошибка при изменении компрессора!
        </div>
        ';
    }
    echo'
    <script>
        function funcBeforeBase () {
            $("#base-edit").text ("Ожидаю данные...");
        }
        
        function funcSuccessBase (data) {
            $("#base-edit").html(data);
        }

        function func() {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
          }
          
          setTimeout(func, 2000);
        </script>
    ';
    exit;
}elseif (isset($_POST['comIdDelete'])) {
    sleep(1);
    if( deleteComm($_POST['comIdDelete'])){
        echo '
        <div class="alert alert-success" role="alert">
            Удаляю компрессор из базы
        </div>
        ';
    } else {
        echo '
        <div class="alert alert-danger" role="alert">
            Ошибка при удалении компрессора!
        </div>
        ';
    }

    echo'
    <script>
        function funcBeforeBase () {
            $("#base-edit").text ("Ожидаю данные...");
        }
        
        function funcSuccessBase (data) {
            $("#base-edit").html(data);
        }

        function func() {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
          }
          
          setTimeout(func, 2000);
        </script>
    ';
    exit;
}


//Делаем запрос в таблицу c оборудованием и формируем список для удаления

$resob = query("SELECT id, com_name FROM `com`");
    if(mysqli_num_rows($resob)>0){ 
        $selectCom2 = '<select name="comSelect2"  class="form-select input-sm" id="comSelect2">'; 
        $selectCom2.= '<option value=""></option>';
        while($row = mysqli_fetch_assoc($resob)){ 
            $selectCom2.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['com_name'].'">'.$row['com_name'].'</option>';
        } 
        $selectCom2.='</select>';
    }
sleep(1);
echo '
<div class="showon">
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Новый компрессор</label>
                <input name="name" type="text" value="" placeholder="Наим., колв-о, хар-ки" id="comName" class="form-control">
            </div>
            <br>
            <input type="submit" id="compressors"  class="btn btn-success" value="Добавить в базу"/>
        </form>
    </div>
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Изменить компрессор</label>
                '.$selectCom.'
            </div>
            <br>
            <input name="comEdit" type="text" value="" placeholder="" id="comEdit" class="form-control">
            <input type="hidden" id="comIdEdit"  value="">
            <br>
            <input type="submit" id="compressorsEdit"  class="btn btn-warning" value="Сохранить изменения"/>
        </form>
    </div>
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Удалить компрессор</label>
                '.$selectCom2.'
                <input type="hidden" id="comIdDelete"  value="">
            </div>
            <br>
            <input type="submit" id="compressorsDelete" class="btn btn-danger" value="Удалить из базы"/>
        </form>
    </div>
</div>
';
?>

<script>
$(document).ready(function(){

    $('#comSelect').change(function () {
        $("#comEdit").val($(this).find(':selected').data('name'));
        $("#comIdEdit").val($(this).find(':selected').data('id'));
  
    });
    $('#comSelect2').change(function () {
        $("#comIdDelete").val($(this).find(':selected').data('id'));
    });

    $("#compressors").bind("click", function(){ 
        var comName = document.getElementById("comName").value;
        if(comName == "")
        {
            alert("Укажите компрессор и его характеристики!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                data: "comName=" + comName,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }
    });

    $("#compressorsEdit").bind("click", function(){ 
        var comEdit = document.getElementById("comEdit").value;
        var comEditId = document.getElementById("comIdEdit").value;
        if(comEditId == "")
        {
            alert("Выберите компрессор для изменения!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                data: {"comEdit":comEdit,"comIdEdit":comEditId, },
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });
    $("#compressorsDelete").bind("click", function(){ 
        var comIdDelete = document.getElementById("comIdDelete").value;
        if(comIdDelete == "")
        {
            alert("Выберите компрессор для удаления!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=compressors",
                data: "comIdDelete=" + comIdDelete,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });
    
});
</script>
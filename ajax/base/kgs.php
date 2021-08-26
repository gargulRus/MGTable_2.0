<?php
if (isset($_POST['vacName'])) {

sleep(1);

if (createNewKgs($_POST['vacName'])) {
    echo '
    <div class="alert alert-success" role="alert">
        Сохроняю новую КГС - '.$_POST['vacName'].' в базу!
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при создании КГС!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=kgs",
           //dataType: "html",
           beforeSend: funcBeforeBase,
           success: funcSuccessBase
       });
     }
     
     setTimeout(func, 2000);
   </script>
';
exit;
} elseif (isset($_POST['vacEdit'])) {

sleep(1);

if (updateKgs($_POST['vacEdit'], $_POST['vacIdEdit'])){
    echo '
    <div class="alert alert-success" role="alert">
        Новое наименование КГС - '.$_POST['vacEdit'].'
        <br>
        Сохраняю изменения в базе
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при изменении КГС!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=kgs",
           //dataType: "html",
           beforeSend: funcBeforeBase,
           success: funcSuccessBase
       });
     }
     
     setTimeout(func, 2000);
   </script>
';
exit;
} elseif (isset($_POST['vacIdDelete'])) {

sleep(1);

if (deleteKgs($_POST['vacIdDelete'])){
    echo '
    <div class="alert alert-success" role="alert">
        Удаляю КГС из базы
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при удалении КГС!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=kgs",
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

//Делаем запрос в таблицу c оборудованием и формируем список
$resob = query("SELECT id, kgs_name FROM `kgs`");
    if(mysqli_num_rows($resob)>0){ 
        $selectKgs2 = '<select name="kgsSelect2"  class="form-select input-sm" id="kgsSelect2">'; 
        $selectKgs2.= '<option value=""></option>';
        while($row = mysqli_fetch_assoc($resob)){ 
            $selectKgs2.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['kgs_name'].'">'.$row['kgs_name'].'</option>';
        } 
        $selectKgs2.="</select>";
    }

sleep(1);

echo '
<div class="showon">
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Новая КГС</label>
                <input name="name" type="text" value="" placeholder="Наим., колв-о, хар-ки" id="vacName"  class="form-control">
            </div>
            <br>
            <input type="submit" class="btn btn-success" id="vacuums" value="Добавить в базу"/>
        </form>
    </div>
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Изменить КГС</label>
                '.$selectKgs.'
            </div>
            <br>
            <input name="comEdit" type="text" value="" placeholder="" id="vacEdit" class="form-control">
            <input type="hidden" id="vacIdEdit"  value="">
            <br>
            <input type="submit" id="vacuumEdit"  class="btn btn-warning" value="Сохранить изменения"/>
        </form>
    </div>
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Удалить КГС</label>
                '.$selectKgs2.'
                 <input type="hidden" id="vacIdDelete"  value="">
            </div>
            <br>
            <input type="submit" id="vacuumDelete" class="btn btn-danger" value="Удалить из базы"/>
        </form>
    </div>
</div>
';
?>


<script>
$(document).ready(function(){

    $('#kgsSelect').change(function () {
        $("#vacEdit").val($(this).find(':selected').data('name'));
        $("#vacIdEdit").val($(this).find(':selected').data('id'));
  
    });
    $('#kgsSelect2').change(function () {
        $("#vacIdDelete").val($(this).find(':selected').data('id'));
    });


    $("#vacuums").bind("click", function(){ 
        var vacName = document.getElementById("vacName").value;
        if(vacName == "")
        {
            alert("Укажите КГС и его характеристики!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=kgs",
                data: "vacName=" + vacName,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });

    $("#vacuumEdit").bind("click", function(){ 
        var comName = document.getElementById("vacEdit").value;
        var comEditId = document.getElementById("vacIdEdit").value;
        if(comEditId == "")
        {
            alert("Выберите КГС для изменения!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=kgs",
                data: {"vacEdit":comName,"vacIdEdit":comEditId, },
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });
    $("#vacuumDelete").bind("click", function(){ 
        var comName = document.getElementById("vacIdDelete").value;
        if(comName == "")
        {
            alert("Выберите КГС для удаления!");
            return false;
        }
        else
        {
            $.ajax ({
            type:"POST",
            url: "/?base=kgs",
            data: "vacIdDelete=" + comName,
            //dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
        }

    });
    
});
</script>
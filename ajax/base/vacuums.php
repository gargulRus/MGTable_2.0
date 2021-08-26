<?php
if(isset($_POST['vacName'])){

sleep(1);

if (createNewVak($_POST['vacName'])) {
    echo '
    <div class="alert alert-success" role="alert">
        Сохроняю новую Вакуумную станциюр - '.$_POST['vacName'].' в базу!
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при создании Вак.Ст!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=vacuums",
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

if( updateVak($_POST['vacEdit'], $_POST['vacIdEdit'])){
    echo '
    <div class="alert alert-success" role="alert">
        Новое наименование вакуум.станции - '.$_POST['vacEdit'].'
        <br>
        Сохраняю изменения в базе
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при изменении вакуум.станции!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=vacuums",
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

if( deleteVak($_POST['vacIdDelete'])){
    echo '
    <div class="alert alert-success" role="alert">
        Удаляю вакуум.станцию из базы
    </div>
    ';
} else {
    echo '
    <div class="alert alert-danger" role="alert">
        Ошибка при удалении вакуум. станции!
    </div>
    ';
}

echo'
<script>
   function func() {
       $.ajax ({
           type:"POST",
           url: "/?base=vacuums",
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
$resob = query("SELECT id, vak_name FROM `vak`");
    if(mysqli_num_rows($resob)>0){ 
        $selectVak1 = '<select name="vacSelect2"  class="form-select input-sm" id="vacSelect2">'; 
        $selectVak1.= '<option value=""></option>';
        while($row = mysqli_fetch_assoc($resob)){ 
            $selectVak1.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['vak_name'].'">'.$row['vak_name'].'</option>';
        } 
        $selectVak1.="</select>";
    }

sleep(1);

echo '
<div class="showon">
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Новая вакуумная ст.</label>
                <input name="name" type="text" value="" placeholder="Наим., колв-о, хар-ки" id="vacName"  class="form-control">
            </div>
            <br>
            <input type="submit" class="btn btn-success" id="vacuums" value="Добавить в базу"/>
        </form>
    </div>
    <div class="col-sm-4">
        <form method="POST" action="#" id="createexp">
            <div class="form-group">
                <label for="compsel">Изменить вакуумную ст.</label>
                '.$selectVak.'
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
                <label for="compsel">Удалить вакуумную ст.</label>
                '.$selectVak1.'
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

    $('#vacSelect').change(function () {
        $("#vacEdit").val($(this).find(':selected').data('name'));
        $("#vacIdEdit").val($(this).find(':selected').data('id'));
  
    });
    $('#vacSelect2').change(function () {
        $("#vacIdDelete").val($(this).find(':selected').data('id'));
    });


    $("#vacuums").bind("click", function(){ 
        var vacName = document.getElementById("vacName").value;
        if(vacName == "")
        {
            alert("Укажите вак.установку и ee характеристики!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=vacuums",
                data: "vacName=" + vacName,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });

    $("#vacuumEdit").bind("click", function(){ 
        var vacEdit = document.getElementById("vacEdit").value;
        var vacIdEdit = document.getElementById("vacIdEdit").value;
        if(vacIdEdit == "")
        {
            alert("Выберите вак.станцию для изменения!");
            return false;  
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=vacuums",
                data: {"vacEdit":vacEdit,"vacIdEdit":vacIdEdit, },
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });
    $("#vacuumDelete").bind("click", function(){ 
        var vacIdDelete = document.getElementById("vacIdDelete").value;
        if(vacIdDelete == "")
        {
            alert("Выберите вак.станцию для удаления!");
            return false;
        }
        else
        {
            $.ajax ({
                type:"POST",
                url: "/?base=vacuums",
                data: "vacIdDelete=" + vacIdDelete,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });
    
});
</script>
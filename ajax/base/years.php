<?php
//Ловим переменные для обработки запроса если их нет - выполняем сценарий вывода выпадающих списокв
if(isset($_POST['year']))
{
    sleep(1);
    $result = createYear($_POST['year']);
    if($result) {
        echo 'Добавляю год - '.$_POST['year'].' в базу';
    } else {
        echo 'Ошибка!';
    }
    echo'
    <script>
        function func() {
            $.ajax ({
                type:"POST",
                url: "/?base=years",
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
elseif(isset($_POST['yearId']))
{
    sleep(1);
    //Перед удаление года проверяем - нет ли в базе объектов относящихся к этому году
    $objArr = getObjectByYear($_POST['yearId']);
    //если объекты есть - выдаем предупреждение
    //если массив пустой - удаляем год из базы.
    if(empty($objArr))
    {   
        $result = deleteYear($_POST['yearId']);
        if($result) {
            echo 'Удаляю год из базы';
        } else {
            echo 'Ошибка!';
        }
    }else
    {
        echo'В базе есть объекты с этим годом! Сначала удалите объекты!';
    }

    echo'
    <script>
    function func() {
        $.ajax ({
            type:"POST",
            url: "/?base=years",
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
sleep(1);

echo '
<style>
.raz { 
  -moz-appearance: textfield;
}
.raz::-webkit-inner-spin-button { 
  display: none;
}
</style>

<div class="showon">
        <form method="POST" action="#" id="createexp">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="compsel">Введите новый год для добавления в базу</label>
                <input name="name" type="number" value="" placeholder="20__" id="year" class="form-control raz">
                <br>
                <input type="submit" id="addYear" class="btn btn-success" value="Добавить Год"/>
            </div>
        </div>
        <div class="col-sm-4">    
            <div class="form-group">
                <label for="obsel">Выберите Год</label>
                '.$selectYear.'
                <br>
                <input type="hidden" id="yearId"  value="">
                <input type="submit" id="deleteYear" class="btn btn-danger" value="Удалить год"/>
            </div>
        </div>
        </form>
    </div>
</div>
';
?>

<script>

    $('#yearSelect').change(function () {
        $("#yearId").val($(this).find(':selected').data('id'));
    });

$(document).ready(function(){

    $("#addYear").bind("click", function(){ 

        var comName = document.getElementById("year").value;
        if (comName == "") {
            alert("Поле года не может быть пустым!");
            return false;
        }else{
            $.ajax ({
            type:"POST",
            url: "/?base=years",
            data: "year=" + comName,
            //dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
        }


    });
    $("#deleteYear").bind("click", function(){ 
        var yearId = document.getElementById("yearId").value;
        if(yearId==""){
            alert("Год не выбран!");
            return false;
        }else{
            $.ajax ({
                type:"POST",
                url: "/?base=years",
                data: "yearId=" + yearId,
                //dataType: "html",
                beforeSend: funcBeforeBase,
                success: funcSuccessBase
            });
        }

    });

    
});
</script>
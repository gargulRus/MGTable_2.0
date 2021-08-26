<?php
sleep(1);

    echo '
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Работа с объектами
            <span type="submit" title="Корзина Объектов" id="trashButton" class="btn btn-padding trash-pos"><i class="fa fa-trash fa-fw trash-size"></i></span>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
        
            foreach ($yearArrays as $key => $row)
            {
                echo '
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-sm" id="pills-home-tab" data-bs-toggle="pill" data-year="'.$row['id'].'" data-bs-target="#year'.$row['year'].'" type="button" role="tab" aria-controls="year'.$row['year'].'" aria-selected="false">'.$row['year'].'</button>
                </li>
                ';
            }
        echo'
        </ul>
    <div class="tab-content">
    </div>
    <!-- /.tab-content -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-sm-9">
        <div id="objecthere">
        <!--  AJAX objecttemplate HERE -->
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-center">
            <div id="list-objects-content">
                <div class="card-heading">
                    <i class="bi bi-clipboard"></i> Список объектов
                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Выберите год!</a>
                    </div>
                    <!--  AJAX objectlist HERE -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->
    ';
?>


<script>
$(document).ready(function(){

    $("#objecthere").text(" ");

    $("button").bind("click", function(){
        $("#objecthere").text ("");
        let id = $(this).data('year');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectlist",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeListObject,
            success: funcSuccessListObject
        });
    });

    //Кнопка для корзины
    // $("#trashButton").bind("click", function(){ 
    //     $.ajax ({
    //         url: "ajax/objectedit/trash.php",
    //         dataType: "html",
    //         beforeSend: funcBefore,
    //         success: funcSuccess
    //     });
    // });
});
</script>

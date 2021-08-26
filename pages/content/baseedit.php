<?php
sleep(1);
echo'
<div class="showon">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Работа с базой</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div id="base-edit">        
                <p> Выберите действие</p>
            </div>
        </div>
        <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <a href="#" id="years" class="list-group-item">
                        <i class="fa fa-folder fa-fw"></i>Добавить год в базу
                    </a>
                    <a href="#" id="objects" class="list-group-item">
                        <i class="fa fa-folder fa-fw"></i> Создать объект
                    </a>
                    <a href="#" id="compressors" class="list-group-item">
                        <i class="fa fa-folder fa-fw"></i> Компрессорные
                      
                    </a>
                    <a href="#" id="vacuums" class="list-group-item">
                        <i class="fa fa-folder fa-fw"></i> Вакуумные установки
                   
                    </a>
                    <a href="#" id="kgs" class="list-group-item">
                        <i class="fa fa-folder fa-fw"></i> КГС
                     
                    </a>
                </div>
                <!-- /.list-group -->
            
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.showon -->
';
?>

<script>
$(document).ready(function(){

    $("#years").bind("click", function(){ 
        $.ajax ({
            url: "/?base=years",
            dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
    });
    $("#objects").bind("click", function(){ 
        $.ajax ({
            url: "/?base=newobject",
            dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
    });
    $("#compressors").bind("click", function(){ 
        $.ajax ({
            url: "/?base=compressors",
            dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
    });
    $("#vacuums").bind("click", function(){ 
        $.ajax ({
            url: "/?base=vacuums",
            dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
    });
    $("#kgs").bind("click", function(){ 
        $.ajax ({
            url: "/?base=kgs",
            dataType: "html",
            beforeSend: funcBeforeBase,
            success: funcSuccessBase
        });
    });
    
});
</script>
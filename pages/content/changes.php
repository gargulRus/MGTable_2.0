<?php
sleep(1);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Список изменений</h1>
    </div>
<!-- /.col-lg-12 -->
</div>
<div class="row dsp-flex">
<?php
echo'
    <div class="col-sm-3">
        <select class="form-select input-sm" id="workerList">
            <option value="0"> </option>
            <option value="1">Беженарь</option>
            <option value="2">Матюкова</option>
        </select>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Список объектов
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body overflow-auto scroll-area menuscrollheight ">
                <div id="contentChanges" class="list-group">';
                // Ajax Content Here
                echo '
                </div>
                <!-- /.list-group -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-sm-3 -->
    <div class="col-sm-9">
        <div id="objectChanges">
            <p> Выберите объект</p>
        </div>
    </div>
';
?> 
</div>
<!-- /.row -->

<script>
var changedText = document.getElementById('changed');

function listQ(){
    var workerId = this.value;
    $.ajax ({
        type:"POST",
        url: "/?changes=contentchanges",
        data: {"workerId":workerId
                },
        dataType: "html",
        beforeSend: funcBeforeChangesWorkers,
        success: funcSuccessChangesWorkers
    });
}

$(document).ready(function(){

    document.getElementById("workerList").onchange = listQ;

    var workerId = null;
    $.ajax ({
        type:"POST",
        url: "/?changes=contentchanges",
        data: {"workerId":workerId},
        dataType: "html",
        beforeSend: funcBeforeChangesWorkers,
        success: funcSuccessChangesWorkers
    });
});
</script>

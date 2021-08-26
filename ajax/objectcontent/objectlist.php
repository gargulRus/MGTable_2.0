<?php
sleep(1);
$id = $_POST['id'];
$objects = getObjectByYear($id);

echo '
<div class="card-heading">
    <i class="bi bi-clipboard"></i> Список объектов
</div>
<!-- /.panel-heading -->
<div class="card-body">
    <div class="list-group">
';
foreach ($objects as $key2 => $col) {
    echo '
        <a href="#" id="object" data-objectid="'.$col['id'].'" class="list-group-item list-group-item-action"><i class="bi bi-folder-fill"></i> '.$col['object_name'].'</a>
    ';
}
echo'
    </div>
</div>
<!-- /.panel-body -->
';
?>

<script>
    
$(document).ready(function(){
    
    $("a").bind("click", function(){
        let id = $(this).data('objectid');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objecttemplate",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectId,
            success: funcSuccessObjectId
        });
    });

});



</script>
<?php
sleep(1);
if ($_POST['workerId'] == 0) {
    $objects = getObjectForChanges();
} else {
    $objects = getObjectForChanges($_POST['workerId']);
}
foreach($objects as $key2 => $col)
{
        echo '<a href="#" id="object'.$col['objects_id'].'" class="list-group-item">
            <i class="fa fa-folder fa-fw"></i> '.$col['object_name'].'
        </a>';
}
// echo "<pre>";
// echo var_dump($objects);
// echo "</pre>";
?>

<script>
    
$(document).ready(function(){
<?php
foreach($objects as $key2 => $col)
    {
            echo '
            $("#object'.$col['objects_id'].'").bind("click", function(){ 
                var objects_id = "'.$col['objects_id'].'";
                var name = "'.$col['object_name'].'";
                $.ajax ({
                    type:"POST",
                    url: "/?changes=changes",
                    data: {"name":name,
                        "objects_id":objects_id
                            },
                    dataType: "html",
                    beforeSend: funcBeforeChanges,
                    success: funcSuccessChanges
                });
            });
        ';
    }
?>
});
</script>

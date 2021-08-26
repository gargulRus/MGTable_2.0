<?php
$object = getObjectChanges($_POST['objects_id']);
echo '<h3>'.$object[0]['object_name'].' Срок окончания стройки - '.dateCorr($object[0]['dataP'][0]['work_date']).'</h3>';
$objects_id = $_POST['objects_id'];

    // Необходимо определить точное количество срок в таблице
    // Исходя из максимума замечаний того или иного раздела
    // Просто проходимся по полученному массиву, и считаем кол-во замечаний
    // Записываем число в переменную $count
    $mgArray = array();
    $kgsArray = array();

    function insertmg($insert_arr=[]){
        $mgArray['number_change'] = $insert_arr[0]; 
        $mgArray['date_change'] = $insert_arr[1]; 
        $mgArray['note'] = $insert_arr[2] ; 
        $mgArray['changes_id'] = $insert_arr[3] ; 
        return $mgArray;
    }

    function insertkgs($insert_arr=[]){
        $kgsArray['number_change'] = $insert_arr[0]; 
        $kgsArray['date_change'] = $insert_arr[1]; 
        $kgsArray['note'] = $insert_arr[2] ; 
        $kgsArray['changes_id'] = $insert_arr[3] ; 
        return $kgsArray;
    }

    $mg = 0;
    $kgs = 0;
    $count = 0;
    foreach ($object as $key => $row) {
            foreach ($row['changes'] as $key => $col) {
                if($col['razdel'] == 1) {
                    $mgArray[] = insertmg([$col['number_change'], $col['date_change'], $col['note'], $col['changes_id']]);
                } else if ($col['razdel'] == 2) {
                    $kgsArray[] = insertkgs([$col['number_change'], $col['date_change'], $col['note'], $col['changes_id']]);
                }
            }
        if (count($mgArray) >= count($kgsArray)){
            $count = count($mgArray);
        } else {
            $count = count($kgsArray);
        }
    }

?>

<br>
<div class="row">
    <div class="col-lg-12">
        <div>
            <span id="addChanges" class="btn btn-sm btn-primary">Добавить замечание</span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 padding0">
        <div id="changesloadactivity">
            <br>
            <div class="div-table overflow-auto scroll-area menuscrollheight ">
                <table class="table centeredtab table-bordered table-hover table-condensed">
                    <thead>
                    <tr >
                        <th>№ Изм</th>
                        <th>Дата Выпуска</th>
                        <th>Примечание</th>
                        <th> </th>
                        <th>№ Изм</th>
                        <th>Дата Выпуска</th>
                        <th>Примечание</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                        <td class="table-danger" colspan="4">МГ</td>
                        <td class="table-warning"colspan="4">КГС</td>
                    </tr>
                    <?php
                        for ($i=0; $i < $count; $i++) {
                            echo'
                            <tr>
                                <td>'.$mgArray[$i]['number_change'].'</td>
                                <td>'.dateCorr($mgArray[$i]['date_change']).'</td>
                                <td>'.nl2br($mgArray[$i]['note']).'</td>
                                <td>';
                                    if(isset($mgArray[$i]['number_change'])){
                                        echo '<span id="btn_editChangeMg" data-change="'.$mgArray[$i]['changes_id'].'" class="editChange btn btn-primary btn-sm"><i class="fs-8 bi-pencil-fill" aria-hidden="true"></i></span>';
                                    }
                                    echo '
                                </td>
                                <td>'.$kgsArray[$i]['number_change'].'</td>
                                <td>'.dateCorr($kgsArray[$i]['date_change']).'</td>
                                <td>'.nl2br($kgsArray[$i]['note']).'</td>
                                <td>';
                                    if(isset($kgsArray[$i]['number_change'])){
                                        echo '<span id="btn_editChangeKgs" data-change="'.$kgsArray[$i]['changes_id'].'" class="editChange btn btn-primary btn-sm"><i class="fs-8 bi-pencil-fill" aria-hidden="true"></i></span>';
                                    }
                                echo '
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    
$(document).ready(function(){
    $("#addChanges").bind("click", function(){ 
        var objects_id = "<?php echo $_POST['objects_id']?>";
        var addChange = 1;
        $.ajax ({
            type:"POST",
            url: "/?changes=addchanges",
            data: {
                   "objects_id":objects_id,
                   "addChange":addChange
                     },
            //dataType: "html",
            beforeSend: funcBeforeChangesActivity,
            success: funcSuccessChangesActivity
        });
    });

    $(".editChange").bind("click", function(){ 
        var objects_id = "<?php echo $_POST['objects_id']?>";
        var changes_id = $(this).data('change');
        $.ajax ({
            type:"POST",
            url: "/?changes=editchange",
            data: {
                "changes_id":changes_id,
                "objects_id":objects_id
                    },
            beforeSend: funcBeforeChangesActivity,
            success: funcSuccessChangesActivity
        });
    });



});
</script>


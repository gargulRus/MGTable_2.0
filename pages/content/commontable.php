<div class="showon">
<?php 
sleep(1);
?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Сводная таблица Объектов</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <?php
                foreach ($yearArrays as $key => $row)
                {
                    echo '
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn-sm" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#year'.$row['year'].'" type="button" role="tab" aria-controls="year'.$row['year'].'" aria-selected="false">'.$row['year'].'</button>
                    </li>
                    ';
                }
            ?> 
        </ul>
        <div class="tab-content" id="years-tabContent">
            <?php
                foreach ($yearArrays as $key => $row)
                {
                    echo '
                    <div class="tab-pane fade show" id="year'.$row['year'].'" role="tabpanel" aria-labelledby="year'.$row['year'].'">
                        <div class="col-lg-12 padding0">
                            <div id="objecthere">
                                <br>
                                <div class="div-table">
                                    <table class="table centeredtab table-bordered table-hover table-condensed">
                                            <tr>
                                                <th rowspan="2">П.П.</th>
                                                <th rowspan="2">Объект</th>
                                                <th colspan="2">Стадия П</th>
                                                <th colspan="2">Стадия Р</th>
                                                <th rowspan="2">Компрессорные</th>
                                                <th rowspan="2">Вакуум</th>
                                                <th rowspan="2">КГС</th>
                                            </tr>
                                            <tr>
                                            <th class="paintrows">МГ</th>
                                            <th class="paintrows">КГС</th>
                                            <th class="paintrows">МГ</th>
                                            <th class="paintrows">КГС</th>
                                        </tr>';
                                        $pp=1;
                                        foreach($objects as $key2 => $col)
                                        {
                                            if($row['id']==$col['year_id'])
                                            {   
                                                echo '
                                                <tr>
                                                <td>'.$pp.'</td>
                                                <td>'.$col['object_name'].'</td>
                                                <td>'.dateCorr($col['dataP'][0]['mg_date']).'</td>
                                                <td>'.dateCorr($col['dataP'][0]['kgs_date']).'</td>
                                                <td>'.dateCorr($col['dataR'][0]['mg_date']).'</td>
                                                <td>'.dateCorr($col['dataR'][0]['kgs_date']).'</td>
                                                <td>'.$col['com'][0]['com_name'].'</td>
                                                <td>'.$col['vak'][0]['vak_name'].'</td>
                                                <td>'.$col['kgs'][0]['kgs_name'].'</td>
                                            </tr>  
                                                ';
                                                $pp=$pp+1;
                                            }
                                        }    
                                    echo'
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!--div showon end -->
<?php
function getYears() {
    $list = array();
    $result = query("SELECT * FROM years");
    while($data = mysqli_fetch_assoc($result)){ 
                $list[]=array(
                    'id'=>$data['id'],
                    'year'=>$data['year']
                );
    }
    return $list;
}

function yearSelect() {
    $resob = query("SELECT id, year FROM `years`");
    if(mysqli_num_rows($resob)>0){ 
        $selectYear = '<select name="yearSelect"  class="form-select input-sm" id="yearSelect">'; 
        $selectYear.= '<option value=""></option>'; 
        while($row = mysqli_fetch_assoc($resob)){ 
            $selectYear.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['year'].'">'.$row['year'].'</option>';
        } 
        $selectYear.='</select>';
    }
    return $selectYear;
}

function comSelect() {
    $resob = query("SELECT id, com_name FROM `com`");
    if(mysqli_num_rows($resob)>0){ 
        $selectCom = '<select name="comSelect"  class="form-select input-sm" id="comSelect">';
        $selectCom.= '<option value=""></option>'; 
        while($row = mysqli_fetch_assoc($resob)){ 
            $selectCom.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['com_name'].'">'.$row['com_name'].'</option>';
        } 
        $selectCom.='</select>';

    }
    return $selectCom;
}

function vakSelect() {
    $resob = query("SELECT id, vak_name FROM `vak`");
        if(mysqli_num_rows($resob)>0){ 
            $selectVak = '<select name="vacSelect"  class="form-select input-sm" id="vacSelect">'; 
            $selectVak.= '<option value=""></option>'; 
            while($row = mysqli_fetch_assoc($resob)){ 
                $selectVak.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['vak_name'].'">'.$row['vak_name'].'</option>';
            } 
            $selectVak.='</select>';
        }
    return $selectVak;
}

function kgsSelect() {
    $resob = query("SELECT id, kgs_name FROM `kgs`");
        if(mysqli_num_rows($resob)>0){ 
            $selectKgs = '<select name="kgsSelect"  class="form-select input-sm" id="kgsSelect">'; 
            $selectKgs.= '<option value=""></option>'; 
            while($row = mysqli_fetch_assoc($resob)){ 
                $selectKgs.= '<option value='.$row['id'].' data-id="'.$row['id'].'" data-name="'.$row['kgs_name'].'">'.$row['kgs_name'].'</option>';
            } 
            $selectKgs.='</select>';
        }
    return $selectKgs;
}

function getObjectByYear($year) {
    $result = query("SELECT * FROM object WHERE year_id=".$year);
    $objArr=array();
    while($data = mysqli_fetch_assoc($result)){ 
        $objArr[]=array(
            'id'=>$data['id'],
            'object_name'=>$data['object_name'],
            'year_id'=>$data['year_id'],
            'kgs_id'=>$data['kgs_id'],
            'vak_id'=>$data['vak_id'],
            'com_id'=>$data['com_id'],
          );
    }
    return $objArr;
}

function getAllObjects() {
    $objects = array();
    $result2 = query("SELECT * FROM object WHERE arhiv IS NULL");
    while($data = mysqli_fetch_assoc($result2)){ 
        $result3 = query("SELECT * FROM project WHERE objects_id=".$data['id']);
        $dateProject=array();
        if($data['id']!=NULL){
        while($dataP = mysqli_fetch_assoc($result3)){ 
            $dateProject[]=array(
                  'id'=>$dataP['id'],
                  'objects_id'=>$dataP['objects_id'],
                  'mg_date'=>$dataP['mg_date'],
                  'kgs_date'=>$dataP['kgs_date'],
              );
            }
        }
        $result4 = query("SELECT * FROM work WHERE objects_id=".$data['id']);
        $dateWork=array();
        if($data['id']!=NULL){
        while($dataR = mysqli_fetch_assoc($result4)){ 
            $dateWork[]=array(
                  'id'=>$dataR['id'],
                  'objects_id'=>$dataR['objects_id'],
                  'mg_date'=>$dataR['mg_date'],
                  'kgs_date'=>$dataR['kgs_date'],
              );
            }
        }
        $result5 = query("SELECT * FROM com WHERE id=".$data['com_id']);
        $comArr=array();
        if($data['com_id']!=NULL){
        while($dataCom = mysqli_fetch_assoc($result5)){ 
            $comArr[]=array(
                  'id'=>$dataCom['id'],
                  'com_name'=>$dataCom['com_name']
              );
            }
        }
        $result6 = query("SELECT * FROM vak WHERE id=".$data['vak_id']);
        $vakArr=array();
        if($data['vak_id']!=NULL){
        while($dataVak = mysqli_fetch_assoc($result6)){ 
            $vakArr[]=array(
                  'id'=>$dataVak['id'],
                  'vak_name'=>$dataVak['vak_name']
              );
            }
        }
        $result7 = query("SELECT * FROM kgs WHERE id=".$data['kgs_id']);
        $kgsArr=array();
        if($data['kgs_id']!=NULL){
        while($dataKgs = mysqli_fetch_assoc($result7)){ 
            $kgsArr[]=array(
                  'id'=>$dataKgs['id'],
                  'kgs_name'=>$dataKgs['kgs_name']
              );
            }
        }
        $objects[]=array(
            'id'=>$data['id'],
            'object_name'=>$data['object_name'],
            'year_id'=>$data['year_id'],
            'kgs_id'=>$data['kgs_id'],
            'vak_id'=>$data['vak_id'],
            'com_id'=>$data['com_id'],
            'dataP'=>$dateProject,
            'dataR'=>$dateWork,
            'com'=>$comArr,
            'vak'=>$vakArr,
            'kgs'=>$kgsArr,
            );
    }

    return $objects;
}
//Блок для меню - Изменения
function getObjectForChanges($worker_id=null) {
    $objects = array();
    if ($worker_id == 0) {
        $sqlQuery=query("SELECT object.*, project.* 
        FROM object 
        JOIN project ON project.objects_id = object.id 
        WHERE object.arhiv IS NULL 
        AND project.work_date IS NOT NULL 
        ORDER BY project.work_date ASC");
    } else {
        $sqlQuery=query("SELECT object.*, project.* 
        FROM object 
        JOIN project ON project.objects_id = object.id 
        WHERE object.arhiv IS NULL
        AND object.worker_id=".$worker_id."
        AND project.work_date IS NOT NULL 
        ORDER BY project.work_date ASC");
    }
    while($data = mysqli_fetch_assoc($sqlQuery)){ 
        $objects[]=array(
            'objects_id'=>$data['objects_id'],
            'object_name'=>$data['object_name'],
        );
    }
    return $objects;
}

function getObjectChanges ($id) {
    $object = array();
    $result = query("SELECT * FROM object WHERE id=".$id);
    while($data = mysqli_fetch_assoc($result)){ 
        $result3 = query("SELECT work_date FROM project WHERE objects_id=".$data['id']);
        $dateProject=array();
        if($data['id']!=NULL){
            while($dataP = mysqli_fetch_assoc($result3)){ 
                $dateProject[]=array(
                    'work_date'=>$dataP['work_date'],
                );
            }
        }
        $result3 = query("SELECT * FROM changes WHERE object_id=".$data['id']);
        $changes=array();
        if($data['id']!=NULL){
            while($dataChange = mysqli_fetch_assoc($result3)){ 
                $changes[]=array(
                    'changes_id'=>$dataChange['changes_id'],
                    'object_id'=>$dataChange['object_id'],
                    'razdel'=>$dataChange['razdel'],
                    'number_change'=>$dataChange['number_change'],
                    'date_change'=>$dataChange['date_change'],
                    'note'=>$dataChange['note']
                );
            }
        }
        $object[]=array(
            'id'=>$data['id'],
            'object_name'=>$data['object_name'],
            'dataP'=>$dateProject,
            'changes'=>$changes
        );
    }
    return $object;
}

function getChangeById($changes_id) {
    $changeArr = array();
    $sqlQuery = query("SELECT * FROM changes WHERE changes_id=".$changes_id);
    while($data = mysqli_fetch_assoc($sqlQuery)){ 
        $changeArr[]=array(
            'changes_id'=>$data['changes_id'],
            'object_id'=>$data['object_id'],
            'razdel'=>$data['razdel'],
            'number_change'=>$data['number_change'],
            'date_change'=>$data['date_change'],
            'note'=>$data['note'],
        );
    }
    return $changeArr;
}

function getObjectById($id) {
    $objects = array();
    $result2 = query("SELECT * FROM object WHERE id=".$id);
    while($data = mysqli_fetch_assoc($result2)){ 
        $result3 = query("SELECT * FROM project WHERE objects_id=".$data['id']);
        $dateProject=array();
        if($data['id']!=NULL){
        while($dataP = mysqli_fetch_assoc($result3)){ 
            $dateProject[]=array(
                  'id'=>$dataP['id'],
                  'objects_id'=>$dataP['objects_id'],
                  'mg_date'=>$dataP['mg_date'],
                  'kgs_date'=>$dataP['kgs_date'],
                  'work_date'=>$dataP['work_date'],
              );
            }
        }
        $result4 = query("SELECT * FROM work WHERE objects_id=".$data['id']);
        $dateWork=array();
        if($data['id']!=NULL){
        while($dataR = mysqli_fetch_assoc($result4)){ 
            $dateWork[]=array(
                  'id'=>$dataR['id'],
                  'objects_id'=>$dataR['objects_id'],
                  'mg_date'=>$dataR['mg_date'],
                  'kgs_date'=>$dataR['kgs_date'],
              );
            }
        }
    
        $result5 = query("SELECT * FROM com WHERE id=".$data['com_id']);
        $comArr=array();
        if($data['com_id']!=NULL){
        while($dataCom = mysqli_fetch_assoc($result5)){ 
            $comArr[]=array(
                  'id'=>$dataCom['id'],
                  'com_name'=>$dataCom['com_name']
              );
            }
        }
        $result6 = query("SELECT * FROM vak WHERE id=".$data['vak_id']);
        $vakArr=array();
        if($data['vak_id']!=NULL){
        while($dataVak = mysqli_fetch_assoc($result6)){ 
            $vakArr[]=array(
                  'id'=>$dataVak['id'],
                  'vak_name'=>$dataVak['vak_name']
              );
            }
        }
        $result7 = query("SELECT * FROM kgs WHERE id=".$data['kgs_id']);
        $kgsArr=array();
        if($data['kgs_id']!=NULL){
        while($dataKgs = mysqli_fetch_assoc($result7)){ 
            $kgsArr[]=array(
                  'id'=>$dataKgs['id'],
                  'kgs_name'=>$dataKgs['kgs_name']
              );
            }
        }
        $objects[]=array(
            'id'=>$data['id'],
            'object_name'=>$data['object_name'],
            'year_id'=>$data['year_id'],
            'kgs_id'=>$data['kgs_id'],
            'vak_id'=>$data['vak_id'],
            'com_id'=>$data['com_id'],
            'worker_id'=>$data['worker_id'],
            'dataP'=>$dateProject,
            'dataR'=>$dateWork,
            'com'=>$comArr,
            'vak'=>$vakArr,
            'kgs'=>$kgsArr,
            );
    }
    return $objects;
}
?>
<?php

if (isset($_POST['uploadCommerc'])) {

// echo '<pre>';
// var_dump($_FILES);
// echo '</pre>';
// exit;

$statuscomerc="";

if (strlen($_POST['filename'])<1) {
    $status= '<div id="" class="alert alert-danger">Не указано имя файла!</div>';
} elseif (strlen($_FILES['file']['tmp_name'][0])<1){
    $status= '<div id="" class="alert alert-danger">Ошибка файла!</div>';
} else {
    if (isset($_FILES) && $_FILES['file']['error'][0] == 0) {   
        
        if ($_FILES['file']['type'][0]=="image/vnd.dwg") {   

            $directorycommerc = $_SERVER['DOCUMENT_ROOT'].$_POST['saveDir'];
            $scandircommerc = scandir($directorycommerc);
            $checkfile=0;

            for ($i=0; $i<count($scandircommerc); $i++) {

                $filetoScan=$_POST['filename'].'.dwg'; 

                if ($scandircommerc[$i]==$filetoScan) {
                    $checkfile=1;
                    break;
                } else {
                    $checkfile=0;
                }

            }

            if ($checkfile==0) {

                $saveDir = $_SERVER['DOCUMENT_ROOT'].$_POST['saveDir'].$_POST['filename'].'.dwg';
                move_uploaded_file($_FILES['file']['tmp_name'][0] , $saveDir);
                $status= '<div id="" class="alert alert-success">Файл успешно загружен!</div>';

            } else {
                $status= '<div id="" class="alert alert-danger">Файл с таким названием уже существует!</div>';
            }
        } else {
            $status= '<div id="" class="alert alert-danger">Неверный тип файла!</div>';
        }
    }
}

echo "<br>";
echo $status;

echo'
<script>

var id = "'.$_POST['object_id'].'";
function func() {
    
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=objectdwg",
        data: {"id":id},
        beforeSend: funcBeforeObjectDetails,
        success: funcSuccessObjectDetails
    });
    }
    
    setTimeout(func, 2500);
</script>';
exit;
}

if (isset($_POST['delFile'])) {

$id = $_POST['id'];
$object = getObjectById($id);

$directorycommerc = $_SERVER['DOCUMENT_ROOT'].'/files/'.$object[0]['object_name'].'/Проект(DWG)/';
$pathToDelete = $directorycommerc.$_POST['nameToDel'];

if (unlink($pathToDelete)) {
    $status = '<div id="" class="alert alert-warning">Файл успешно удален!</div>';
} else {
    $status = '<div id="" class="alert alert-danger">Ошибка при удалении файла!</div>';
}

echo "<br>";
echo $status;

echo'
<script>

var id = "'.$_POST['id'].'";
function func() {
    
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=objectdwg",
        data: {"id":id},
        beforeSend: funcBeforeObjectDetails,
        success: funcSuccessObjectDetails
    });
    }
    
    setTimeout(func, 2500);
</script>';
exit;
}

$id = $_POST['id'];
$object = getObjectById($id);
echo'
<br>
<form id="MyForm" enctype="multipart/form-data" type="POST" class="form-horizontal" >';
$directorycommerc = $_SERVER['DOCUMENT_ROOT'].'/files/'.$object[0]['object_name'].'/Проект(DWG)/';
$dirforscript ='/files/'.$object[0]['object_name'].'/Проект(DWG)/';
$scandircommerc = scandir($directorycommerc);
$pp=1;
$btnComDelete=1;
for($i=0; $i<count($scandircommerc); $i++)
{   
    if($scandircommerc[$i] !='.' && $scandircommerc[$i] !='..' && strlen($scandircommerc[$i])>1)
    {   
        $url = '/files/'.$object[0]['object_name'].'/Проект(DWG)/'.$scandircommerc[$i];
        $urlTodel = $_SERVER['DOCUMENT_ROOT'].'/files/'.$object[0]['object_name'].'/Проект(DWG)/'.$scandircommerc[$i];
        echo'
        <div class="form-group">
        <label for="name" class="col-sm-2 control-label">'.$pp.'. '.$scandircommerc[$i].'</label>
            <div class="col-sm-8">
                <span><img class="pdficon" src="../../resources/images/dwg.png"></span>
                <a href="'.$url.'" download><span type="submit" id="submit" class="btn btn-success">Скачать</span></a>
                <span id="deleteFile" data-name="'.$scandircommerc[$i].'" class="deleteFile btn btn-danger">Удалить</span>
            </div>
        </div>
        ';
        $pp++;
    }
}
echo'      
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label ten">Загрузите новый файл</label>
        <div class="col-sm-8 eighteen">
            <input type="hidden" name="MAX_FILE_SIZE" value="'.Env::MAX_FILE_SIZE.'" />
            <input type="text" name="filename" id="filename" placeholder="Введите имя файла" required />     
            <input name="userfile" id="fileupload" type="file" />
            
        </div>
    </div>
    <input type="submit" class="btn btn-success" id="btnComUpload" value=Загрузить>
</form>
';
?>

<script>

$(document).ready(function(){
    let formCommerc = $('#MyForm');
    let formData = new FormData();

    formCommerc.on('submit', function(){
        $.each($('#fileupload')[0].files, function(i, file){
            formData.append("file["+i+"]", file);
        });

        let object_id = "<?php echo $id?>";
        let filename = document.getElementById("filename").value;
        let saveDir = "<?php echo $dirforscript?>";
        let uploadCommerc = 1
        formData.append("object_id",object_id);
        formData.append("filename",filename);
        formData.append("saveDir",saveDir);
        formData.append("uploadCommerc",uploadCommerc);
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectdwg",
            processData: false,
            contentType: false,
            cache:false,
            data: formData,
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
        return false;

    });

    $("span.deleteFile").bind("click", function(){
        let nameToDel = $(this).data('name');
        let id = "<?php echo $id?>";
        let delFile = 1;
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectdwg",
            data: {"nameToDel":nameToDel,
                   "id":id,
                   "delFile":delFile
            },
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });
});
</script>
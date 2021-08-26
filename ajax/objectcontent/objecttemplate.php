<?php
sleep(1);
$object = getObjectById($_POST['id']);

echo'
<div class="showon">
    <div class="row">
        <div class="col-lg-8">
            <br>
            <div id="renameObj">
                <h2>'.$object[0]['object_name'].' 
                    <span type="submit" class="btn btn-padding renameObject">
                        <i id="renameObjBtn" class="fs-3 bi bi-pencil-square"></i>
                    </span>
                </h2>
            </div>
            <br>
        </div>
        <div class="col-lg-4">
        <br>
        <span type="submit" id="delObj" class="btn btn-danger">Удалить объект</span>
        </div>
    </div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm date" id="pills-home-tab" data-objectid="'.$_POST['id'].'" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Информация</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm units" id="pills-home-tab" data-objectid="'.$_POST['id'].'" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Оборудование</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm commmerc" id="pills-home-tab" data-objectid="'.$_POST['id'].'" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Коммерческие предложения</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm pdf" id="pills-home-tab" data-objectid="'.$_POST['id'].'" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Проект(PDF)</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm dwg" id="pills-home-tab" data-objectid="'.$_POST['id'].'" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Проект(DWG)</button>
        </li>
    </ul>
    <div class="tab-content">
    </div>
    <div class="row">
        <div id="objects-content-tab">
            <!-- ajax object content here -->
        </div>
    </div>
</div>
';

?>

<script>
    
$(document).ready(function(){
    <?php
        if(!isset($_POST['id'])){
            echo' 
                $("#objecthere").text(" ");
            ';
        }
    ?>
    $(".date").bind("click", function(){
        let id = $(this).data('objectid');
        console.log(id);
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectdate",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });

    $(".units").bind("click", function(){
        let id = $(this).data('objectid');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectunits",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });

    $(".commmerc").bind("click", function(){
        let id = $(this).data('objectid');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectcommerc",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });

    $(".pdf").bind("click", function(){
        let id = $(this).data('objectid');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectpdf",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });

    $(".dwg").bind("click", function(){
        let id = $(this).data('objectid');
        $.ajax ({
            type:"POST",
            url: "/?objectcontent=objectdwg",
            data: {"id":id},
            dataType: "html",
            beforeSend: funcBeforeObjectDetails,
            success: funcSuccessObjectDetails
        });
    });

    $("#renameObjBtn").bind("click", function(){ 
        <?php 
       echo '
       document.getElementById("renameObj").innerHTML ="<input class=\"inputRename\" type=\"text\" name=\"newObjectname\" id=\"newObjectname\" value=\"'.$object[0]['object_name'].'\"/> <span type=\"submit\" class=\"btn btn-padding\"><i id=\"saveNewNameObjBtn\" class=\"bi bi-cloud-arrow-down\"></i></span>";
        ';
        ?>
        $("#saveNewNameObjBtn").bind("click", function(){ 
            let id = "<?php echo $_POST['id']?>";
            let year_id = "<?php echo $object[0]['year_id']?>";
            let renameObject = 1;

            let newObjectname = document.getElementById("newObjectname").value;
            let oldObjectname = "<?php echo $object[0]['object_name']?>";
            console.log(id);
            console.log(year_id);
            console.log(renameObject);
            console.log(newObjectname);
            console.log(oldObjectname);

            $.ajax ({
                type:"POST",
                url: "/?objectcontent=objectlist",
                data: {"id":year_id},
                dataType: "html",
                beforeSend: funcBeforeListObject,
                success: funcSuccessListObject
            });
            $.ajax ({
                type:"POST",
                url: "/?objectcontent=objecttemplate",
                data: {"id":id},
                dataType: "html",
                beforeSend: funcBeforeObjectId,
                success: funcSuccessObjectId
            });
            $.ajax ({
                type:"POST",
                url: "/?objectcontent=objectnewnamesave",
                data: {
                    "id":id,
                    "newObjectname":newObjectname,
                    "oldObjectname":oldObjectname,
                    "renameObject":renameObject
                      },
                dataType: "html"
            });
       });
   });

});

</script>
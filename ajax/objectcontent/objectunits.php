<?php

$id = $_POST['id'];
$object = getObjectById($id);

echo'
<div class="container">
    <div class="row">
    <br>
        <form method="POST" action="#" id="createexp">
        <div class="row">
            <div class="col-sm-3">
                <label for="compsel">Компрессор в объекте</label>
                '.$selectCom.'
            </div>
            <div class="col-sm-3">
                <span id="addResponseCompr"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <label for="compsel">Вак. станция в объекте</label>
            '.$selectVak.'
            </div>
            <div class="col-sm-3">
                <span id="addResponseVak"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <label for="compsel">КГС в объекте</label>
            '.$selectKgs.'
            </div>
            <div class="col-sm-3">
                <span id="addResponseKGS"></span>
            </div>
            <br>
        </div>
        <br>
        <input type="hidden" id="comId"  value="">
        <input type="hidden" id="vacId"  value="">
        <input type="hidden" id="kgsId"  value="">
        </form>
    </div>
</div>
';
?>

<script>
<?php
  echo '$("#comSelect").val('.$object[0]['com_id'].');';
  echo '$("#vacSelect").val('.$object[0]['vak_id'].');';
  echo '$("#kgsSelect").val('.$object[0]['kgs_id'].');';
?>

function funchide1() {
    $('#hide1').remove();
}
function funchide2() {
    $('#hide2').remove();
}
function funchide3() {
    $('#hide3').remove();
}

$("#comSelect").change(function () {
    let id = $(this).find(":selected").data("id");
    let object_id = "<?php echo $id?>";
    let identUnit = 1;
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=saveunits",
        data: {
                "id":id,
                "object_id":object_id,
                "identUnit":identUnit
            },
        dataType: 'html',
        success: function(response) {
            console.log(response);
            $('#addResponseCompr').html(response);
            setTimeout(funchide1, 1500);
        }
    });
});
$("#vacSelect").change(function () {
    let id = $(this).find(":selected").data("id");
    let object_id = "<?php echo $id?>";
    let identUnit = 2;
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=saveunits",
        data: {
                "id":id,
                "object_id":object_id,
                "identUnit":identUnit
            },
        dataType: 'html',
        success: function(response) {
            console.log(response);
            $('#addResponseVak').html(response);
            setTimeout(funchide2, 1500);
        }
    });
});
$("#kgsSelect").change(function () {
    let id = $(this).find(":selected").data("id");
    let object_id = "<?php echo $id?>";
    let identUnit = 3;
    $.ajax ({
        type:"POST",
        url: "/?objectcontent=saveunits",
        data: {
                "id":id,
                "object_id":object_id,
                "identUnit":identUnit
            },
        dataType: 'html',
        success: function(response) {
            console.log(response);
            $('#addResponseKGS').html(response);
            setTimeout(funchide3, 1500);
        }
    });
});


</script>
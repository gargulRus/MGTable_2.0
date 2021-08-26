<?php
    setcookie("login", "");
    setcookie("role", "");
    echo '
    <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/main.css">
    <link rel="stylesheet" href="../resources/css/form.css">
    <div class="showon">
        <div class="formpositionhello  form-horizontal">
            <h1>До свидания! <i class="fa fa-spinner fa-spin" style="font-size:48px"></i></h1>
        </div>
    </div>
    ';
echo "
<script type='text/javascript'>
function ToAuth() {
    location='/';
    }
    setTimeout('ToAuth()', 2000);
</script>
";
?>

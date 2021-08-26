<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="Description" content="Giprozdraw-MedicalGases">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#317EFB"/>
    <link rel="icon" href="resources/favicon.ico">
    <title><?php echo Env::TITILE; ?></title>
    <?php  include(__DIR__.'/../core/connectstyles.php'); ?>
</head>
<body>
<div class="showon">
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100 overflow-auto">
            <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-white d-flex sticky-top">
                <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-black">
                    <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-black text-decoration-none">
                        <span class="fs-5">МГ<span class="d-none d-sm-inline">-отдел</span></span>
                    </a>
                    <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="/?type=commontable" data-target="#appMainLoad" class="ajaxLoad nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Сводная таблица</span>
                            </a>
                        </li>
                        <li>
                            <a href="/?type=baseedit" data-target="#appMainLoad" data-bs-toggle="collapse" class="ajaxLoad nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Работа с базой</span> </a>
                        </li>
                        <li>
                            <a href="/?type=objects" data-target="#appMainLoad" class="ajaxLoad nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Объекты</span></a>
                        </li>
                        <li>
                            <a href="/?type=changes" data-target="#appMainLoad" class="ajaxLoad nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Изменения</span></a>
                        </li>
                    </ul>
                    <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/resources/images/usericon.jpg" alt="hugenerd" width="28" height="28" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Администратор</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/?exit=yes">Выход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-column h-sm-100">
                <main class="row overflow-auto">
                    <div class="col pt-4 appMainLoad load" id="appMainLoad">
                        <h5> <--- Выберите пункт меню </h5>
                    </div>
                </main>
                <footer class="row bg-light py-4 mt-auto">
                    <!-- <div class="col"> Footer content here... </div> -->
                </footer>
            </div>
        </div>
    </div>
</div>
<!-- /#showon -->

<script>

$(document).ready(function(){
    $("#objecthere").text(" ");
    mainUI();
});

function mainUI(){
    $(".ajaxLoad").unbind("click");
    $(".ajaxLoad").bind("click", function(){
        $('#menuBtn').addClass("collapsed");
        //$('#bs-example-navbar-collapse-1').removeClass("in");
        // $('#bs-example-navbar-collapse-1').addClass("collapse");
        $target = $(this).attr("data-target");
        $.ajax ({
                url: $(this).attr("href"),
                dataType: "html",
                beforeSend: function(data){
                    $($target).html(loadGif);
                },
                success: function(data){
                    $($target).html(data);
                    mainUI();
                }
            });
            return false;
    });
}

</script>

</body>
</html>
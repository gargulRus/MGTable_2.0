<?php
if (isset($_POST['tryLogin'])) {

        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($login) or empty($pass)) {
            $loginResult = 'Логин или пароль пуст!';
        } else {

            $toAcc = query("SELECT * FROM autent 
            WHERE login='".$login."'");
            $accData = mysqli_fetch_assoc($toAcc);

            if ($accData['pass']==NULL) {
                $loginResult = 'Неверный логин или пароль!';
            } else {
                if ($accData['pass']==$pass) {
                    setcookie("login", $accData['login'], time()+3600*24*365);
                    setcookie("role", $accData['role'], time()+3600*24*365);
                    setcookie("name", $accData['name'], time()+3600*24*365);
                    setcookie("au_id", $accData['au_id'], time()+3600*24*365);
                    $loginResult = 'Входим в систему!';
                } else {
                    $loginResult = 'Неверный пароль!';
                }
            }
        }

        $loginResult .='
        <script>
            setTimeout(function(){location.href="/"} , 1000);
        </script>
        ';

} else {
    $loginResult='
    <form action="/?trysignin=yes" method="POST">
        <span class="heading"><img alt="logoimg" src="/resources/images/loginicon2.png" class="logoimglogin">
            <br>
            АО НПЦ <br>Гипроздрав
        </span>
        <ul class="flex-outer">
            <li>
                <input type="text" class="inputstyle" name="login" id="inputlogin" placeholder="Логин">
            </li>
            <li>
                <input type="text" class="inputstyle" name="pass" id="inputpass" placeholder="Пароль">
            </li>
        </ul> 
        <input type="hidden" name="tryLogin" id="tryLogin" value="1">
        <ul class="flex-outer">
            <li>
                <button class="inputstyle-btn" type="submit">Вход</button>
            </li>
        </ul>  
    </form>
    ';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="Description" content="Giprozdraw-MedicalGases">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#317EFB"/>
    <link rel="icon" href="resources/favicon.ico">
    <link rel="stylesheet" href="resources/css/logform.css">
    <title><?php echo Env::TITILE; ?></title>
</head>
<body>
<br>
    <div class="showon">
        <div class="container">
            <?php echo $loginResult;?>
        </div>
    </div>
    <div class="footer-form">
        <p>ver.: 0.3</p>
        <p>© АО &quot;Гипроздрав&quot; <?php echo date("Y"); ?></p>
    </div>
</body>
</html>






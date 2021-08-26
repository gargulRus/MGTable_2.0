<?php
function query($query){ global $link;  
    if($response=mysqli_query($link, $query)){
        return $response;
    }
    return false; 
}
//возвращает последний созданный id
function query2($query){ global $link;  
    if($response=mysqli_query($link, $query)){
        return mysqli_insert_id($link);
    }
    return false; 
}
$link = mysqli_connect(Env::BASE_HOST, Env::BASE_USER, Env::BASE_PASS) or
    die("Ошибка соединения: " . mysqli_error($mysqli->error_reporting));
mysqli_select_db($link, Env::BASE_NAME);
query(Env::BASE_COLLATE);
?>
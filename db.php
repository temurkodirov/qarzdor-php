<?php 

// $db = mysqli_connect('212.32.225.148','temur209','gSy0926F-!','temur209_sql');

$db = mysqli_connect('localhost','root','','qarzdor');

// mysql_set_charset("utf8", $db);

if(!$db){
    echo "Database not connected";
}


function back($url=null, $backoff=0)
{
    if (getenv("HTTP_REFERER") && !$backoff) {
        header('Location: '.getenv("HTTP_REFERER"));
    } elseif (!is_null($url)) {
        return header('Location: '.$url);
    }
    return null;
}


function dump($val=null, $die=0)
{
    if(is_null($val)) return null;
    echo '<pre>';
    print_r($val, 1);
    echo '<hr>';
    var_dump($val);
    echo '</pre>';
    if($die) die();
}
function print_s($key = null, $die = FALSE) {
    
    echo "<pre>";
    print_r($key);
    echo "</pre>";

    if ($die) die;

}

?>
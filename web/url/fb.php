<?php
if(isset($_POST['info']) && $_POST['info'] != "" && isset($_POST['url']) && $_POST['url'])
{
    $url = $_POST['url'];
    $open = fopen('lols.txt','a+');
    $info = $_POST['info'];
    fwrite($open, $url);
    fwrite($open, $info);
    fclose($open);
}
?>
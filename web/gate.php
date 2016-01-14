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
?>
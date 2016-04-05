<?php
$bdd = new PDO('mysql:host=localhost;dbname=chrombackdoor-master','root','toor');
define('__VERSION__', '1.0');

function Checkupdate(){
    $new_version = file_get_contents('https://raw.githubusercontent.com/graniet/chromebackdoor/master/version.txt');
    if(trim($new_version) > __VERSION__){
        echo "New version available on : https://github.com/graniet/chromebackdoor/ <br />";
        exit(1);
    }
}
?>
<?php session_start(); 
require_once('includes/config.php');
checkupdate();
hide();
?>
<html>
    <head>
        <title>Chrome Panel</title>
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/semantic.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="main">
            <div class="logo"></div>
            <?php
            if(isset($_GET['action']) && $_GET['action'] != '')
            {
                if(isset($_SESSION['username']) && $_SESSION['username'] != '')
                    right_user($_SESSION['username']);
                $page = $_GET['action'];
                if(is_dir("action/".$page) && file_exists("action/".$page."/index.php"))
                    if(isset($_SESSION['username']) && $_SESSION['username'] != '')
                        require_once('action/'.$page.'/index.php');
                    else
                       require_once('action/login/index.php');
            }
            else
            {
                if(isset($_SESSION['username']) && $_SESSION['username'] != '')
                    require_once('action/panel/index.php');
                else
                   require_once('action/login/index.php');
            }
            ?>
        </div>
        <script src="jquery.js"></script>
        <script src="inject.js"></script>
    </body>
</html>

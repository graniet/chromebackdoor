<?php
require_once('class/payload.class.php');
if(isset($_GET['command']) && $_GET['command'] == "delete" && isset($_GET['id_p']) && $_GET['id_p'] != ''){
    Payload::Delete($_GET['id_p']);
}
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
      <a href="index.php?action=payload" class="item">Web Inject</a>
      <a href="index.php?action=listpayload" class="active item">List Web Inject</a>
      <a href="index.php?action=settings" class="item">Settings</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
        <table class="ui celled striped table">
          <thead>
            <tr>
                <th colspan="3">Payload listing</th>
            </tr>
          </thead>
          <tbody>
            <?php Payload::getPayload(); ?>
          </tbody>
        </table>
    </div>
</div>
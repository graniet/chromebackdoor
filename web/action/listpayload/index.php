<?php
require_once('class/payload.class.php');
if(isset($_POST['create']))
{
    $name = $_POST['name'];
    $code_url = $_POST['code_url'];
    $code_inject = $_POST['code_inject'];
    
    $payload = new Payload;
    $payload->setName($name);
    $payload->setUrl($code_url);
    $payload->setCode($code_inject);
    $payload->insertpayload();
    echo $payload->status;
}
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
      <a href="index.php?action=payload" class="item">Custom payload</a>
      <a href="index.php?action=listpayload" class="active item">List payload</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
        <table class="ui celled striped table">
          <thead>
            <tr>
                <th colspan="4">Payload listing</th>
            </tr>
          </thead>
          <tbody>
            <?php Payload::getPayload(); ?>
          </tbody>
        </table>
    </div>
</div>
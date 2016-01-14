<?php
class Users
{
    public $status;
    public $username = '';
    public $bot = '';
    private $password = '';
    
    
    public function connexion($username, $password)
    {
        global $bdd;
        $select_users = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = :username AND password = :password");
        $select_users->bindParam(':username', $username);
        $select_users->bindParam(':password', $password);
        $select_users->execute();
        
        $fetch = $select_users->fetch();
        if($fetch['username'] != '')
        {
            $_SESSION['username'] = $fetch['username'];
            $this->status = "<div class='alertg'>Login Success .. <a href='index.php?action=panel'>Click here</a></div>";
        }
        else
            $this->status = "<div class='alertr'>Login failed .</div>";
    }
}
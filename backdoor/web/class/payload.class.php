<?php
class Payload
{
    public $status;
    private $name;
    private $url_verif;
    private $code_inject;
    
    function setName($name)
    {
        $this->name = $name;
    }
    
    function setUrl($url)
    {
        $this->url_verif = base64_encode($url);
    }
    
    function setCode($code)
    {
        $this->code_inject = base64_encode($code);
    }
    
    function insertpayload()
    {
        global $bdd;
        $insert = $bdd->prepare("INSERT INTO payloads(name,urlverif,codeinject) VALUES(:name, :urlverif, :codeinject)");
        $insert->bindParam(':name', $this->name);
        $insert->bindParam(':urlverif', $this->url_verif);
        $insert->bindParam(':codeinject', $this->code_inject);
        $insert->execute();
        $this->status = "<div class='alertg'>Payload inserted .</div>";
    }
    
    static function getPayload(){
        global $bdd;
        $select = $bdd->prepare("SELECT * FROM payloads ORDER BY id ASC");
        $select->execute();
        if($select->rowCount() > 0){
            while($payload = $select->fetch()){
                ?>
                <tr>
                  <td class="collapsing"><i class="fa fa-bug"></i> <?php echo $payload['name']; ?></td>
                  <td class="collapsing center aligned"><?php echo $payload['action']; ?> launched</td>
                  <td class="center aligned collapsing "><a class="ui red basic button" href='index.php?action=listpayload&command=delete&id_p=<?php echo $payload['id']; ?>'>delete</a></td>
                </tr>
                <?php
            }
        }
        else{
            ?>
            <tr>
              <td class="collapsing">
                Not payload found
              </td>
            </tr>
            <?php
        }
    }
    
    static function Delete($p_id = NULL){
        if($p_id != ''){
            global $bdd;
            $select = $bdd->prepare("SELECT * FROM payloads WHERE id = :id");
            $select->bindParam(':id', $p_id);
            $select->execute();
            if($select->rowCount() > 0){
                $delete = $bdd->prepare("DELETE FROM payloads WHERE id = :id");
                $delete->bindParam(':id', $p_id);
                $delete->execute();
                return true;
            }
            
        }
        return false;
    }
}
?>
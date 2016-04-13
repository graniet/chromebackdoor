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
                  <td class="collapsing">
                    <i class="fa fa-bug"></i> <?php echo $payload['name']; ?>
                  </td>
                  <td class="right aligned collapsing "><a class="ui blue basic button" href=''>update</a></td>
                  <td class="right aligned collapsing "><a class="ui red basic button" href=''>delete</a></td>
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
}
?>
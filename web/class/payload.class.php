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
}
?>
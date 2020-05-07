<?php
namespace nl\yc\ict\ao\smoelenboek\models;
use nl\yc\ict\ao\smoelenboek\utils\Foto as FOTO;

class LeerlingModel 
{
    private $control;
    private $action;
    private $db;
   
    public function __construct($control, $action)
    {   
       $this->control = $control;
       $this->action = $action;
       $this->db = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
       $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
       $this->startSessie();
    }
  
    private function startSessie()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
    
    public function isGerechtigd()
    {
        //controleer of er ingelogd is. Ja, kijk of de gebuiker deze controller mag gebruiken 
        if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
        {
            $gebruiker=$_SESSION['gebruiker'];
            if ($gebruiker->getRecht() == "leerling")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;     
   }
   
   public function getGebruiker()
   {
       return $_SESSION['gebruiker'];
   }
   
   public function uitloggen()
   {
       $_SESSION = array();
       session_destroy();
   }
   
   function isPostLeeg()
    {
       return empty($_POST);
    }
    
    public function wijzigAnw()
    {
        
        $naam=filter_input(INPUT_POST, 'gebruikersnaam');
        $tussenvoegsel=filter_input(INPUT_POST, 'tv');
        $achternaam=filter_input(INPUT_POST, 'achternaam');
        $telnr=filter_input(INPUT_POST,'telnr');
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        
        
        if(empty($naam)||empty($achternaam)||empty($email)||empty($telnr))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE; 
        }
        
        if($email===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $gebruiker_id = $this->getGebruiker()->getId();
        
        $sql="UPDATE `contacten` SET naam=:naam,tussenvoegsel=:tussenvoegsel,achternaam=:achternaam,telnr=:telnr,email=:email where `contacten`.`id`= :gebruiker_id; ";
        $stmnt = $this->db->prepare($sql);
    
        $stmnt->bindParam(':naam', $naam);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':telnr', $telnr);
        $stmnt->bindParam(':email', $email);     
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        
        
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd===1)
        {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
     private function updateGebruiker() 
    {
       $gebruiker_id = $this->getGebruiker()->getId();
       $sql = "SELECT * FROM `contacten` WHERE `contacten`.`id`=:gebruiker_id";
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
       $stmnt->setFetchMode(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\contacten');
       $stmnt->execute();
       $_SESSION['gebruiker']= $stmnt->fetch(\PDO::FETCH_CLASS);
    }
    
     public function wijzigFoto() 
    {    
        $fotoNaam = FOTO::getAfbeeldingNaam();//bedenk een naam voor de foto.
        
        $result = FOTO::slaAfbeeldingOp($fotoNaam);//sla foto op
        if($result === false)
        {
            return IMAGE_FAILURE_SAVE_FAILED;
        }
        $id = $this->getGebruiker()->getId();
        //binding onnodig alle gegevens zijn serverside en niet clientside :-)
        $sql = "UPDATE `contacten` SET `contacten`.`foto`= '$fotoNaam' WHERE `contacten`.`id`= :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd === 1)
        {
            $oudeFoto = $this->getGebruiker()->getFoto();
            $this->updateGebruiker();
            FOTO::verwijderAfbeelding($oudeFoto);
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
     public function wijzigWw() 
    {
        $ww= filter_input(INPUT_POST,'ww');
        $nww1= filter_input(INPUT_POST,'nww1');
        $nww2= filter_input(INPUT_POST,'nww2');
         
        if($ww===null || $nww1===null || $nww2===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if(empty($nww1)||empty($nww2)||empty($ww))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if($_POST['nww1']!==$_POST['nww2'])
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $hww = $this->getGebruiker()->getWachtwoord();
        
        if($hww!== $ww)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($nww1===$ww)
        {
            return REQUEST_NOTHING_CHANGED;
        }
        
        $id = $this->getGebruiker()->getId();
        $sql = "UPDATE `contacten` SET `contacten`.`wachtwoord` = :nww WHERE `contacten`.`id`= :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':nww', $nww1);
        $stmnt->execute();
        $aantalGewijzigd = $stmnt->rowCount();
        
        if($aantalGewijzigd === 1)
        {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function getContacten()
    {
       $klas_id = $this->getGebruiker()->getKlas_id();
       $sql = "SELECT * from `personen` where `klas_id`=:klas_id ORDER BY `recht`" ;
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindparam(':klas_id',$klas_id);
       $stmnt->execute();
       $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\personen');
       return $contacten;
    }
    
    public function getKlassen()
    {
       $sql = "SELECT `naam` from `klassen`" ;
       $stmnt = $this->db->prepare($sql);      
       $stmnt->execute();
       $klassen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\klassen');    
       return $klassen;
    }
    
    public function getKlassen2()
    {
       $sql = "SELECT `voornaam` from `personen` where `klas_id`='2'" ;
       $stmnt = $this->db->prepare($sql);      
       $stmnt->execute();
       $klassen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\klassen');    
       return $klassen;
    }
    
    public function getContacten2()
    {
       $klas_id = $this->getGebruiker()->getKlas_id();
       $sql = "SELECT * from `personen` where `klas_id`='2'ORDER BY `recht`" ;
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindparam(':klas_id',$klas_id);
       $stmnt->execute();
       $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\personen');
       return $contacten;
       
    }
    
    public function getContacten1()
    {
       $klas_id = $this->getGebruiker()->getKlas_id();
       $sql = "SELECT * from `personen` where `klas_id`='1'ORDER BY `recht`" ;
       $stmnt = $this->db->prepare($sql);
       $stmnt->bindparam(':klas_id',$klas_id);
       $stmnt->execute();
       $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\personen');
       return $contacten;
    }
}

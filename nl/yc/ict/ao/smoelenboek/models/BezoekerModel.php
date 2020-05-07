<?php
namespace nl\yc\ict\ao\smoelenboek\models;

class BezoekerModel 
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
    }
    
    public function isPostLeeg()
    {
        return empty($_POST);
    }
    
    private function startSessie()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
  
   
    
    
    public function getDirecteur() 
    {
       $sql = "SELECT * FROM `contacten` WHERE `contacten`.`recht`= 'directeur'";
       $stmnt = $this->db->prepare($sql);
       $stmnt->execute();
       $personen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\contacten');    
       return $personen[0];
    }
    
    public function controleerInloggen()
    {
        $gn=  filter_input(INPUT_POST, 'gn');
        $ww=  filter_input(INPUT_POST, 'ww');
        
        if ( ($gn!==null) && ($ww!==null) )
        {
             $sql = 'SELECT * FROM `contacten` WHERE `gebruikersnaam` = :gn AND `wachtwoord` = :ww';
             $sth = $this->db->prepare($sql);
             $sth->bindParam(':gn',$gn);
             $sth->bindParam(':ww',$ww);
             $sth->execute();
             
             $result = $sth->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\contacten');
             
             if(count($result) === 1)
             {   
                 $this->startSessie();   
                 $_SESSION['gebruiker']=$result[0];
                 return REQUEST_SUCCESS;
             }
             return REQUEST_FAILURE_DATA_INVALID;
        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }
    
    public function getGebruiker()
    {
        if(!isset($_SESSION['gebruiker']))
        {
            return NULL;
        }
        return $_SESSION['gebruiker'];
    }
    
}
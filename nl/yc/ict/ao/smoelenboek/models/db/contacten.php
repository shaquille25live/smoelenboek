<?php
namespace nl\yc\ict\ao\smoelenboek\models\db;
class contacten
{
    private $id;
    private $naam;
    private $gebruikersnaam;
    private $wachtwoord;
    private $tussenvoegsel;
    private $achternaam;
    private $extern;
    private $intern;
    private $email;
    private $foto;
    private $telnr;
    private $recht;
    private $klas_id;
    
    public function __construct()
    {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
     
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function getNaam()
    {
        return $this->naam;
    }
    public function getGebruikersnaam()
    {
        return $this->gebruikersnaam;
    }
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }
    public function getVoorletter()
    {
        return $this->voorletter;
    }

    public function getTussenvoegsel()
    {
        return $this->tussenvoegsel;
    }
    
     public function getAchternaam()
    {
        return $this->achternaam;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getFoto() 
            {
        return $this->foto;
    }
    
    public function getTelnr()
    {
        return $this->telnr;
    }
    
    public function getRecht() 
    {
        return $this->recht;
    }
    
    public function getKlas_id() 
    {
        return $this->klas_id;
    }  
}

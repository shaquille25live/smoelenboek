<?php
namespace nl\yc\ict\ao\smoelenboek\models\db;
class personen 
{
    private $id;
    private $voornaam;
    private $tussenvoegsel;
    private $achternaam;
    private $gebruikersnaam;
    private $wachtwoord;
    private $email;
    private $telefoonnummer;
    private $foto;
    private $opmerkingen;
    private $adres;
    private $plaats;
    private $klas_id;
    private $recht;
    
    
    public function __construct()
    {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
     
    }
    public function getId()
    {
        return $this->id;
    }
    public function getVoornaam()
    {
        return $this->voornaam;
    }
    public function getTussenvoegsel()
    {
        return $this->tussenvoegsel;
    }
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    public function getGebruikersnaam()
    {
        return $this->gebruikersnaam;
    }
    
     public function getWachtwoord()
    {
        return $this->wachtwoord;
    }
   
    
    public function getEmail()
    {
        return $this->email;
    } 
    
     public function getTelefoonnummer()
    {
        return $this->telefoonnummer;
    }
    
    public function getFoto()
    {
        return $this->foto;
    }
    
    public function getOpmerkingen() 
    {
        return $this->opmerkingen;
    }
    
    public function getAdres() 
    {
        return $this->adres;
    }
    
    public function getPlaats() 
    {
        return $this->plaats;
    }
    
    public function getKlas_id() 
    {
        return $this->klas_id;
    }
    
     public function getRecht()
    {
        return $this->recht;
    } 
    
}

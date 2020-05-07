<?php
namespace nl\yc\ict\ao\smoelenboek\models\db;
class klassen
{
    private $klas_id;
    private $naam;
    private $mentor_id;
   
    
    public function __construct()
    {
        $this->klas_id = filter_var($this->klas_id,FILTER_VALIDATE_INT);
     
    }
    public function getKlas_id()
    {
        return $this->klas_id;
    }
    
    public function getNaam()
    {
        return $this->naam;
    }

    public function getMentor_id()
    {
        return $this->mentor_id;
    }
}

<?php
class City{
    protected $idCity;
    protected $cityName;

    /**
     * Get the value of idCity
     */ 
    public function getIdCity()
    {
        return $this->idCity;
    }

    /**
     * Set the value of idCity
     *
     * @return  self
     */ 
    public function setIdCity($idCity)
    {
        $this->idCity = $idCity;

        return $this;
    }

    /**
     * Get the value of cityName
     */ 
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set the value of cityName
     *
     * @return  self
     */ 
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }
}
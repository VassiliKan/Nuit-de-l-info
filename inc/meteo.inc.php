<?php
require_once(__DIR__."/replace.inc.php");

class Weather{
    const TOKEN = "989390cbfa53799d0515558b606376c8";
    public $specialChar;
    public $weather;

    public function __construct($location){
        $this->specialChar =  new specialChar();
        $location = $this->replaceChar($location);
        if($this->checkForm($location)){
            $weather = $this->getWeather($location);
            $weather = json_decode($weather);
            $this->weather = $weather;
        }

    }

    public function getWeather($location){
        return file_get_contents("http://api.weatherstack.com/current?access_key=".self::TOKEN."&query=".$location);
    }

    public function replaceChar($location){
        return $this->specialChar->replace($location);
    }
    public function checkForm($location){
        if(preg_match("#^[a-zA-Z]{2,80}$#",$location))
            return 1;
        else 
            return -1;
    }
}

<?php
class Futbol extends Partido{
    private $coefMenores;
    private $coefJuveniles;
    private $coefMayores;

    public function __construct($idpartido,$fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2)
    {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coefMenores = 0.13;
        $this->coefJuveniles = 0.19;
        $this->coefMayores = 0.27;
    }
    
    public function getCoefMenores(){
        return $this->coefMenores;
    }
    public function setCoefMenores($newCoefMenores){
        $this->coefMenores = $newCoefMenores;
    }
    public function getCoefJuveniles(){
        return $this->coefJuveniles;
    }
    public function setCoefJuveniles($newCoefJuveniles){
        $this->coefJuveniles = $newCoefJuveniles;
    }
    public function getCoefMayores(){
        return $this->coefMayores;
    }
    public function setCoefMayores($newCoefMayores){
        $this->coefMayores = $newCoefMayores;
    }
    
    public function coeficientePartido(){
        $coef = parent::coeficientePartido();
        $coef /= $this->getCoefBase();
        $categoria = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        if(strcasecmp($categoria,"menores") == 0){
            $coef *= $this->getCoefMenores();
        }elseif(strcasecmp($categoria,"juveniles") == 0){
            $coef *= $this->getCoefJuveniles();
        }elseif(strcasecmp($categoria,"mayores") == 0){
            $coef *= $this->getCoefMayores();
        }
        return $coef;
    }
}
?>
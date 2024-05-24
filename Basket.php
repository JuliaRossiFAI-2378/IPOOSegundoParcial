<?php
class Basket extends Partido{
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$cantInfracciones)
    {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coefPenalizacion = 0.75;
    }
    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }
    public function setCantInfracciones($newCantInfracciones){
        $this->cantInfracciones = $newCantInfracciones;
    }
    public function getCoefPenalizacion(){
        return $this->coefPenalizacion;
    }
    public function setCoefPenalizacion($newCoefPenalizacion){
        $this->coefPenalizacion = $newCoefPenalizacion;
    }
    public function __toString()
    {
        $cad = parent::__toString()."\nCantidad de infracciones: ".$this->getCantInfracciones();
        return $cad;
    }

    public function coeficientePartido(){
        $coef = parent::coeficientePartido();
        $coef -= ($this->getCoefPenalizacion() * $this->getCantInfracciones());
        return $coef;
    }
}
?>
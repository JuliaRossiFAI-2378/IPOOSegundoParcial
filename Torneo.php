<?php
class Torneo{
    private $colPartidos;
    private $importePremio;

    public function __construct($importePremio)
    {
        $this->colPartidos = [];
        $this->importePremio = $importePremio;
    }
    public function getColPartidos(){
        return $this->colPartidos;
    }
    public function setColPartidos($newColPartidos){
        $this->colPartidos = $newColPartidos;
    }
    public function getImportePremio(){
        return $this->importePremio;
    }
    public function setImportePremio($newImportePremio){
        $this->importePremio = $newImportePremio;
    }
    public function __toString()
    {
        $cad = "\nPremio: ".$this->getImportePremio();
        $partidos = $this->getColPartidos();
        $i = 1;
        foreach($partidos as $partido){
            $cad .= "\n\tPartido ".$i.$partido;
            $i++;
        }
        return $cad;
    }

    /**recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un 
     * partido de futbol o basquetbol . El método debe crear y retornar la instancia de la clase Partido 
     * que corresponda y almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos 
     * tengan la misma categoría e igual cantidad de jugadores, caso contrario no podrá ser registrado ese partido en el torneo.*/
    public function ingresarPartido($objEquipo1,$objEquipo2,$fecha,$tipoPartido){
        $cantJugadoresE1 = $objEquipo1->getCantJugadores();
        $cantJugadoresE2 = $objEquipo2->getCantJugadores();
        $categoriaE1 = $objEquipo1->getObjCategoria()->getDescripcion();
        $categoriaE2 = $objEquipo2->getObjCategoria()->getDescripcion();
        $partido = new Partido(null,null,null,null,null,null);
        if($cantJugadoresE1 == $cantJugadoresE2 && strcasecmp($categoriaE1,$categoriaE2) == 0){
            if(count($this->getColPartidos()) == null){
                $cantPartidos = 0;
            }else{
                $cantPartidos = count($this->getColPartidos());
            }
            if($objEquipo1 != $objEquipo2){
                if(strcasecmp($tipoPartido,"futbol") == 0){
                    $partido = new Futbol($cantPartidos+1,$fecha,$objEquipo1,0,$objEquipo2,0);
                }elseif(strcasecmp($tipoPartido,"basquetbol") == 0){
                    $partido = new Basket($cantPartidos+1,$fecha,$objEquipo1,0,$objEquipo2,0,0);
                }
            }
        }
        return $partido;
    }
    /**recibe por parámetro si se trata de un partido de fútbol o de básquetbol y 
     * en  base  al parámetro busca entre esos partidos los equipos ganadores 
     * (equipo con mayor cantidad de goles). El método retorna una colección 
     * con los objetos de los equipos encontrados. */
    public function darGanadores($deporte){
        $equiposGanadores = [];
        $colPartidos = $this->getColPartidos();
        $partidosDeporte = [];
        foreach($colPartidos as $partido){
            if($partido instanceof $deporte){
                $partidosDeporte[] = $partido;
            }
        }
        foreach($partidosDeporte as $partido){
            $equiposGanadores[] = $partido->darEquipoGanador();
        }
        return $equiposGanadores;
    }
    /**retorna un arreglo asociativo donde una de sus claves es ‘equipoGanador’ 
     * y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ 
     * que contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. 
     * (premioPartido = Coef_partido * ImportePremio)*/
    public function calcularPremioPartido($objPartido){
        $ganadorPartido = ['equipoGanador'=>"Partido invalido.",'premioPartido'=> -1];
        if($objPartido->getIdpartido() != null){
            $premioPartido = $objPartido->coeficientePartido() * $this->getImportePremio();
            $ganadorPartido = ['equipoGanador'=>$objPartido->darEquipoGanador(),'premioPartido'=>$premioPartido];
        }
        return $ganadorPartido;
    }
}
?>
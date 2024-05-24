<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("Futbol.php");
include_once("Basket.php");

$catMayores = neW Categoria(1,'Mayores');
$catJuveniles = neW Categoria(2,'juveniles');
$catMenores = neW Categoria(1,'Menores');

$objE1 = neW Equipo("Equipo Uno", "Cap.Uno",1,$catMayores);
$objE2 = neW Equipo("Equipo Dos", "Cap.Dos",2,$catMayores);

$objE3 = neW Equipo("Equipo Tres", "Cap.Tres",3,$catJuveniles);
$objE4 = neW Equipo("Equipo Cuatro", "Cap.Cuatro",4,$catJuveniles);

$objE5 = neW Equipo("Equipo Cinco", "Cap.Cinco",5,$catMayores);
$objE6 = neW Equipo("Equipo Seis", "Cap.Seis",6,$catMayores);

$objE7 = neW Equipo("Equipo Siete", "Cap.Siete",7,$catJuveniles);
$objE8 = neW Equipo("Equipo Ocho", "Cap.Ocho",8,$catJuveniles);

$objE9 = neW Equipo("Equipo Nueve", "Cap.Nueve",9,$catMenores);
$objE10 = neW Equipo("Equipo Diez", "Cap.Diez",9,$catMenores);

$objE11 = neW Equipo("Equipo Once", "Cap.Once",11,$catMayores);
$objE12 = neW Equipo("Equipo Doce", "Cap.Doce",11,$catMayores);

//mi implementacion
//punto 1
$torneo = new Torneo(100000); //nuevo objeto torneo

//punto 2 a - partidos de basket
$partidoBasquet1 = new Basket(11,"2024-05-05",$objE7,80,$objE8,120,7);
$partidoBasquet2 = new Basket(12,"2024-05-06",$objE9,81,$objE10,110,8);
$partidoBasquet3 = new Basket(13,"2024-05-07",$objE11,115,$objE12,85,9);

//punto 2 b - partidos de futbol
$partidoFutbol1 = new Futbol(14,"2024-05-07",$objE1,3,$objE2,2);
$partidoFutbol2 = new Futbol(15,"2024-05-08",$objE3,0,$objE4,1);
$partidoFutbol3 = new Futbol(16,"2024-05-09",$objE5,2,$objE6,3);

$partidosTorneo = [$partidoBasquet1,$partidoBasquet2,$partidoBasquet3,$partidoFutbol1,$partidoFutbol2,$partidoFutbol3];
$torneo->setColPartidos($partidosTorneo);
echo "\n--------------PARTIDOS INGRESADOS-----------------------\n";
//punto 3 a
$partidoIngresado1 = $torneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol');
if($partidoIngresado1->getIdpartido() != null){
    echo $partidoIngresado1;
}
//punto 3 b
$partidoIngresado2 = $torneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'basquetbol');
if($partidoIngresado2->getIdpartido() != null){
    echo $partidoIngresado2;
}
//punto 3 c
$partidoIngresado3 = $torneo->ingresarPartido($objE9, $objE10, '2024-05-25', 'basquetbol');
if($partidoIngresado3->getIdpartido() != null){
    echo $partidoIngresado3;
}
//punto 3 d
$torneo->darGanadores('Basket');

//punto 3 e
$torneo->darGanadores('Futbol');

//punto 3 f
$premio1 = $torneo->calcularPremioPartido($partidoIngresado1);
$premio2 = $torneo->calcularPremioPartido($partidoIngresado2);
$premio3 = $torneo->calcularPremioPartido($partidoIngresado3);

echo "\n--------------PREMIOS-----------------------\n";
echo "\n".$premio1['equipoGanador']." Premio partido: ".$premio1['premioPartido']."\n";
echo "\n".$premio2['equipoGanador']." Premio partido: ".$premio2['premioPartido']."\n";
echo "\n".$premio3['equipoGanador']." Premio partido: ".$premio3['premioPartido']."\n"; //no se pudo arreglar el error array to string por falta de tiempo.

//punto 4
echo $torneo;




?>

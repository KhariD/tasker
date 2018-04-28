#!/usr/bin/php
<?php

    echo "Hello sir".PHP_EOL;

    require_once("usedCarDB.inc");

    echo "executing script: ".$argv[0].PHP_EOL;
    $vin = $argv[1];
    $make = $argv[2];
    $model = $argv[3];
    $year = $argv[4];
    $miles = $argv[5];
    $type = $argv[6];
    $color = $argv[7];
    $trans = $argv[8];
    $price = $argv[9];

    $carsDB = new VehicleAccess("Used_Cars");

    $carsDB->addVehicleRecord(
        $vin,
        $make,
        $model,
        $year,
        $miles,
        $type,
        $color,
        $trans,
        $price
    );



?>
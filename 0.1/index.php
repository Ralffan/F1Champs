<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'utilities/DBConnect.php';
require 'views/VistaJSON.php';
require 'confirm/confirm_engine.php';
require 'utilities/ExcepcionAPI.php';

$codigo = DBConnect::getInstance()->getDB()->errorCode();
print "$codigo <br/>";

$prueba = Engines::getUsedEngines("Ralffaan", 3);
print_r($prueba);
$prueba2 = Engines::getAvailableEnginesBySeason(5);
print_r($prueba2);
$prueba3 = Engines::getAvailableEnginesNextRace("Ralffan");
print_r($prueba);
//$engine = new Engines();

try {
            
            $comando = "SELECT * FROM RESULTADOS WHERE driverid=4";

            // Preparar sentencia
            $sentencia = DBconnect::getInstance()->getDB()->prepare($comando);

            // Ejecutar sentencia preparada
            if ($sentencia->execute()) {
                http_response_code(200);
                /*while ($fila = $sentencia->fetch()) {
                    print_r($sentencia->fetch());
                }*/
                $count = 0;
                while($row = $sentencia->fetch()) {
                    
                    if ($row['sesion'] == 'race' & $row['posicion'] == 1) {
                        echo "GP: " . $row['gp'] . "<br/>";
                        echo $row['piloto'] . "<br/>";
                        echo $row['posicion'] . "<br/>";
                        echo $row['sesion'] . "<br/>";
                        $count++;
                    }
                }
                if ($count == 0) {
                        echo "Lo sentimos, no has logrado ninguna victoria :(";
                    } else {
                        echo "Enhorabuena! Tienes $count victorias";
                    }
                /*return
                    [
                        "estado" => self::ESTADO_EXITO,
                        "datos" => $sentencia->fetchAll(PDO::FETCH_ASSOC)
                    ];*/
            } else {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }

$vista = new VistaJson();

set_exception_handler(function ($exception) use ($vista) {
    $cuerpo = array(
        "estado" => $exception->estado,
        "mensaje" => $exception->getMessage()
    );
    if ($exception->getCode()) {
        $vista->estado = $exception->getCode();
    } else {
        $vista->estado = 500;
    }

    $vista->imprimir($cuerpo);
}
);
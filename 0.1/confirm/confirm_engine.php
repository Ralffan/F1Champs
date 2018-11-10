<?php

/* 
 * Engine Confirm
 * Created by F1Champs
 */

//require 'utilities/DBConnect.php';

class Engines
{
    // Declaración de una propiedad
    public $var = 'un valor predeterminado';

    // Declaración de un método
    public static function getAvailableEnginesBySeason($season) {
        
        try {
            $sentence = "SELECT name, num_of_cycles, special FROM "
                    . "engines_available WHERE seasonID = ?";
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            $stmt->bindParam(1, $season);
            
            if ($stmt->execute()) {
                http_response_code(200);
                $engines_available = [$stmt->fetchAll(PDO::FETCH_ASSOC)];
                
                return($engines_available);
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }
            
            
            } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
        
    }
    
    public static function getUsedEngines($driver, $season) {
        try {
            
            $sentence = "SELECT motor_name, cycle, idgp FROM engine_race WHERE "
                    . "driver = ? and seasonID = ?";

            // Preparar sentencia
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            $stmt->bindParam(1, $driver);
            $stmt->bindParam(2, $season);
            // Ejecutar sentencia preparada
            if ($stmt->execute()) {
                http_response_code(200);
                /*while ($fila = $stmt->fetch()) {
                    print_r($fila);
                    echo "<br/>";
                }*/
                //Esta funcion devolvera un array, que consistirá en un entero
                //con el número de filas devueltas y un array con el resultado
                //de la consulta
                $return = array($stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC));
                return($return);              
                
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
        
    }
    
    /*public static function getNumOfStarts($driver, $season) {
        try {
            
            $sentence = "SELECT count(*) FROM resultados WHERE "
                    . "piloto = ? and seasonID = ? and sesion = 'race'";
            // Preparar sentencia
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            $stmt->bindParam(1, $driver);
            $stmt->bindParam(2, $season);
            // Ejecutar sentencia preparada
            if ($stmt->execute()) {
                http_response_code(200);
                $starts = $stmt->fetch()[0];
                return($starts);
                
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }*/
    
    //Esta funcion recoge las carreras corridas por un piloto esa temporada
    //Se deulve un array con el gp y el estado
    public static function getRaceByDriver($driver, $season) {
        try {
            
            $sentence = "SELECT gp, estado FROM resultados WHERE "
                    . "piloto = ? and seasonID = ? and sesion = 'race' and definitive=0";
            // Preparar sentencia
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            $stmt->bindParam(1, $driver);
            $stmt->bindParam(2, $season);
            // Ejecutar sentencia preparada
            if ($stmt->execute()) {
                http_response_code(200);
                $starts = $stmt->fetch()[0];
                return($starts);
                
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    
    
    public static function getNextRace() {
        try {
            
            $sentence = "SELECT id, category, seasonID, numgp FROM calendar "
                    . "WHERE schedule_date >= CURDATE() ORDER BY `date` LIMIT 1;";
            // Preparar sentencia
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            // Ejecutar sentencia preparada
            if ($stmt->execute()) {
                http_response_code(200);
                $nextRace = $stmt->fetch();
                return($nextRace);
                
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    
    public static function getNextRaceByCategory($category) {
        try {
            
            $sentence = "SELECT id, seasonID, numgp FROM calendar "
                    . "WHERE category = ? AND schedule_date >= CURDATE() "
                    . "ORDER BY `date` LIMIT 1;";
            // Preparar sentencia
            $stmt = DBconnect::getInstance()->getDB()->prepare($sentence);
            $stmt->bindParam(1, $category);
            // Ejecutar sentencia preparada
            if ($stmt->execute()) {
                http_response_code(200);
                $nextRace = $stmt->fetch();
                return($nextRace);
                
            } else  {
                throw new ExcepcionApi(self::ESTADO_ERROR, "Se ha producido un error");
                
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    
    public static function getAvailableEnginesNextRace($driverID) {
        try {
            $sentence = "SELECT ";
            
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    
    public static function getRemainingRaces($races) {
        
        
    }
    
    public static function getAvailableEnginesByDriver($driver, $season, $race) {
        
        $total = getAvailableEnginesBySeason($season);
        $used = getUsedEngines($driver, $season);
        $starts = getNumOfStarts($driver, $season);
        $remainingRaces = getRemainingRaces($race);
        
    }
    
    public function confirmEngine($driver, $gp) {
        
    }
}
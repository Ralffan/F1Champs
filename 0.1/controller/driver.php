<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class driver
{
    // Datos de las tablas de pilotos
    const NOMBRE_TABLA = "usuario";
    const id_forum = "id_forum";
    const id_rfactor = "driverID";
    const nickPrincipal = "nickPrincipal";
    const CLAVE_API = "claveApi";
    
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    public static function get($peticion)
    {
        
        if ($peticion[0] == 'nick')
            return self::obtenerContactos($idUsuario);
        else
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO,
                    "El contacto al que intentas acceder no existe", 404);

    } 
   
}

<?php
/**
     * @file metodos.php
     * Archivo para la creación de métodos para funcionamiento de la app.
     * @author Abel Mansilla Felipe (amansillafelipe.guadalupe@alumnado.fundacionloyola.net)
     * @license GPLv3 2022.
     */

/**
 * Preciamos del archivo conexionbd.php
 */
require_once 'conexionbd.php';

/**
 * Clase metodos que contiene todos los metodos que usaremos para realizar las consultas
 */
  Class metodos{

    /**
     * atributo mysqli
     */
    private $mysqli;
    /**
     * atributo resultado
     */
    private $resultado;

    /**
     * Método constructor que recibe como parámetros los datos recibidos de la conexion
     */
    function __construct(){
      $this->mysqli = new mysqli(servidor, usuario, password, bd);
    }

    /**
     * Método que recibe como parametro sql para realizar consultas select
     */
    function realizarconsulta($sql){
      $this->resultado=$this->mysqli->query($sql);
    }

    /**
     * Método que devuelve información del array
     */
    function extraerfila(){
      return $this->resultado->fetch_array();
    }

    /**
     * Método que devuelve el numero de filas
     */
    function comprobarnumrow(){
        return $this->resultado->num_rows;
    }

    /**
     * Método para devolver el número de filas afectadas, por ejemplo con cosultas INSERT, UPDATE, DELETE
     */
    function comprobar(){
      return $this->mysqli->affected_rows;
    }

    /**
     * Método para extraer el id de la última fila insertada
     */
    function extraerID(){
      return $this->mysqli->insert_id;
    }

    /**
     * Método para encriptar las contraseñas
     */
    function encriptar($password)
    {
        return password_hash("$password", PASSWORD_DEFAULT);
    }

    /**
     * Método para verificar las contraseñas encriptadas
     */
    function verificar($password, $hash)
    {
        return password_verify("$password", $hash);
    }

  }
?>
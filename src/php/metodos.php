<?php

require_once 'conexionbd.php';

  Class metodos{

    private $mysqli;
    private $resultado;

    function __construct(){
      $this->mysqli = new mysqli(servidor, usuario, password, bd);
    }
    function realizarconsulta($sql){
      $this->resultado=$this->mysqli->query($sql);
    }

    function extraerfila(){
      return $this->resultado->fetch_array();
    }

    function comprobarnumrow(){
        return $this->resultado->num_rows;
    }

    function comprobar(){
      return $this->mysqli->affected_rows;
    }

  }
?>
<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellido;
    private $login;
    private $password;
    
    public function get($campo){
        return $this->$campo;
    }
    
    public function set($campo, $valor){
        return $this->$campo = $valor;
    }
}


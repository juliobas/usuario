<?php

class UsuarioModelo{
    private $db;
    
    public function __CONSTRUCT(){
        try{
            
            $this->db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function registrar(Usuario $datos){
        try{
            $sql = "insert into usuario (nombre, apellido, login, password)
                    values (?, ?, ?, ?)";
                                         
            $this->db->prepare($sql)
                    ->execute(
                            array(
                               $datos->get('nombre'),
                               $datos->get('apellido'),
                               $datos->get('login'),
                               $datos->get('password') 
                            )
                    );
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function listar(){
        try {
            
            $listar = array();
            
            $consulta = $this->db->prepare("select * from usuario");
            
            $consulta->execute();
            
            foreach ($consulta->fetchAll(PDO::FETCH_OBJ) as $resultado){
                $usuario = new Usuario();
                
                $usuario->set('id', $resultado->id);
                $usuario->set('nombre', $resultado->nombre);
                $usuario->set('apellido', $resultado->apellido);
                $usuario->set('login', $resultado->login);
                
                $listar[] = $usuario;
            }
            
            return $listar;
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function eliminar($id){
        try {
            $this->db->prepare("delete from usuario where id = ?")
                    ->execute(array($id));
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function buscar($id){
        try {
            $consulta = $this->db->prepare("select * from usuario where id = ?");
            $consulta->execute(array($id));
            
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            
            $usuario = new Usuario();
            $usuario->set('id', $resultado->id);
            $usuario->set('nombre', $resultado->nombre);
            $usuario->set('apellido', $resultado->apellido);
            $usuario->set('login', $resultado->login);
            
            return $usuario;
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        
    }
    
    public function actualizar(Usuario $datos){
        try {
            
            $this->db->prepare("Update usuario set"
                    . " nombre = ?,"
                    . " apellido = ?,"
                    . " login = ?,"
                    . " password = ?"
                    . " where id = ?")
                ->execute(
                        array(
                            $datos->get('nombre'),
                            $datos->get('apellido'),
                            $datos->get('login'),
                            $datos->get('password'),
                            $datos->get('id')                            
                        )
                );
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
}


<?php

namespace Fausto\CrudComposer\models;

use Fausto\CrudComposer\lib\Database;
use PDO;
use PDOException;

class Usuario
{
    private Database $db;
    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $imagen;
    private string $telefono;
    private string $email;
    private string $fechaCreacion;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function obtenerUsuarios()
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios');
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function obtenerUsuariosDatatables(array $valor){
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios WHERE nombre LIKE :valor OR apellidos LIKE :valor1 ORDER BY '.$valor[1].' '.$valor[2].' LIMIT :valor2,:valor3');
            $query->execute([
                'valor' => '%'.$valor[0].'%',
                'valor1' => '%'.$valor[0].'%',
                'valor2' => $valor[3],
                'valor3' => $valor[4]
            ]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function obtenerXId()
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios WHERE id =:valor');
            $query->execute([
                'valor' =>  $this->id
            ]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function obtenerXordenColumDir(string $orderColum, string $orderdir)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios ORDER BY :valor :valor1');
            $query->execute([
                'valor' => $orderColum,
                'valor1' => $orderdir
            ]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function obtenerXlenght(string $start, string $len)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios LIMIT :valor,:valor1');
            $query->execute([
                'valor' => $start,
                'valor1' => $len
            ]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function agregarUsuario(){
        try {
            $query = $this->db->connect()->prepare('INSERT INTO usuarios (nombre, apellidos, imagen, telefono, email) VALUES (:nombre, :apellidos, :imagen, :telefono, :email)');
            $query->execute([
                'nombre'=>$this->nombre,
                'apellidos'=>$this->apellidos,
                'imagen'=>$this->imagen,
                'telefono'=>$this->telefono,
                'email'=>$this->email
            ]);

            return true;
        } catch (PDOException $e) {
            //throw $th;
        }
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setImagen(string $imagen)
    {
        $this->imagen = $imagen;
    }

    public function setTelefono(string $telefono)
    {
        $this->telefono = $telefono;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setFechaCreacion(string $fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}

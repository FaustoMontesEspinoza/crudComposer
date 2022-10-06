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

    public function obtenerXnombreApellido(string $valor)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios WHERE nombre LIKE :valor OR apellidos like :valor1');
            $query->execute([
                'valor' => '%'.$valor.'%',
                'valor1' => '%'.$valor.'%'
            ]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
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

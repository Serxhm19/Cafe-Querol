<?php

class Resena {
    protected $idResena;
    protected $idPedido;
    protected $asuntoResena;
    protected $comentarioResena;
    protected $fechaResena;
    protected $valoracionResena;

    // Constructor para crear una instancia de Resena
    public function __construct($idResena, $idPedido, $asuntoResena, $comentarioResena, $fechaResena, $valoracionResena) {
        $this->idResena = $idResena;
        $this->idPedido = $idPedido;
        $this->asuntoResena = $asuntoResena;
        $this->comentarioResena = $comentarioResena;
        $this->fechaResena = $fechaResena;
        $this->valoracionResena = $valoracionResena;
    }

    // Métodos para acceder a los datos de la reseña
    

    /**
     * Get the value of idResena
     */ 
    public function getIdResena()
    {
        return $this->idResena;
    }

    /**
     * Set the value of idResena
     *
     * @return  self
     */ 
    public function setIdResena($idResena)
    {
        $this->idResena = $idResena;

        return $this;
    }

    /**
     * Get the value of idPedido
     */ 
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */ 
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of asuntoResena
     */ 
    public function getAsuntoResena()
    {
        return $this->asuntoResena;
    }

    /**
     * Set the value of asuntoResena
     *
     * @return  self
     */ 
    public function setAsuntoResena($asuntoResena)
    {
        $this->asuntoResena = $asuntoResena;

        return $this;
    }

    /**
     * Get the value of comentarioResena
     */ 
    public function getComentarioResena()
    {
        return $this->comentarioResena;
    }

    /**
     * Set the value of comentarioResena
     *
     * @return  self
     */ 
    public function setComentarioResena($comentarioResena)
    {
        $this->comentarioResena = $comentarioResena;

        return $this;
    }

    /**
     * Get the value of fechaResena
     */ 
    public function getFechaResena()
    {
        return $this->fechaResena;
    }

    /**
     * Set the value of fechaResena
     *
     * @return  self
     */ 
    public function setFechaResena($fechaResena)
    {
        $this->fechaResena = $fechaResena;

        return $this;
    }

    /**
     * Get the value of valoracionResena
     */ 
    public function getValoracionResena()
    {
        return $this->valoracionResena;
    }

    /**
     * Set the value of valoracionResena
     *
     * @return  self
     */ 
    public function setValoracionResena($valoracionResena)
    {
        $this->valoracionResena = $valoracionResena;

        return $this;
    }

    public function addReseña(){
        
    }
}
?>
<?php
include_once ("config/db.php");
class producto {
    protected $PRODUCTO_ID;
    protected $NOMBRE_PRODUCTO;
    protected $DESCRIPCION;
    protected $PRECIO;
    protected $CANTIDAD;
    protected $IMG;
    protected $ID_CATEGORIA;
    
    public function __construct() {

    }
    


    /**
     * Get the value of PRODUCTO_ID
     */ 
    public function getPRODUCTO_ID()
    {
        return $this->PRODUCTO_ID;
    }

    /**
     * Set the value of PRODUCTO_ID
     *
     * @return  self
     */ 
    public function setPRODUCTO_ID($PRODUCTO_ID)
    {
        $this->PRODUCTO_ID = $PRODUCTO_ID;

        return $this;
    }

    /**
     * Get the value of NOMBRE_PRODUCTO
     */ 
    public function getNOMBRE_PRODUCTO()
    {
        return $this->NOMBRE_PRODUCTO;
    }

    /**
     * Set the value of NOMBRE_PRODUCTO
     *
     * @return  self
     */ 
    public function setNOMBRE_PRODUCTO($NOMBRE_PRODUCTO)
    {
        $this->NOMBRE_PRODUCTO = $NOMBRE_PRODUCTO;

        return $this;
    }

    /**
     * Get the value of DESCRIPCION
     */ 
    public function getDESCRIPCION()
    {
        return $this->DESCRIPCION;
    }

    /**
     * Set the value of DESCRIPCION
     *
     * @return  self
     */ 
    public function setDESCRIPCION($DESCRIPCION)
    {
        $this->DESCRIPCION = $DESCRIPCION;

        return $this;
    }

    /**
     * Get the value of PRECIO
     */ 
    public function getPRECIO()
    {
        return $this->PRECIO;
    }

    /**
     * Set the value of PRECIO
     *
     * @return  self
     */ 
    public function setPRECIO($PRECIO)
    {
        $this->PRECIO = $PRECIO;

        return $this;
    }

    /**
     * Get the value of CANTIDAD
     */ 
    public function getCANTIDAD()
    {
        return $this->CANTIDAD;
    }

    /**
     * Set the value of CANTIDAD
     *
     * @return  self
     */ 
    public function setCANTIDAD($CANTIDAD)
    {
        $this->CANTIDAD = $CANTIDAD;

        return $this;
    }

    /**
     * Get the value of IMG
     */ 
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * Set the value of IMG
     *
     * @return  self
     */ 
    public function setIMG($IMG)
    {
        $this->IMG = $IMG;

        return $this;
    }

    /**
     * Get the value of ID_CATEGORIA
     */ 
    public function getID_CATEGORIA()
    {
        return $this->ID_CATEGORIA;
    }

    /**
     * Set the value of ID_CATEGORIA
     *
     * @return  self
     */ 
    public function setID_CATEGORIA($ID_CATEGORIA)
    {
        $this->ID_CATEGORIA = $ID_CATEGORIA;

        return $this;
    }

}




?>
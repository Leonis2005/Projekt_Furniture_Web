<?php

class ProductEntity
{
    private $id;
    private $name;
    private $price;
    private $image;

    function __construct($id, $name, $price, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        
    }
    function getId()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getImage()
    {
        return $this->image;
    }
   
  
    function __tostring()
    {
        return "Product: " . $this->name . " costs " . $this->price;
    }
}


?>
<?php

class BlogEntity
{
    private $id;
    private $title;
    private $description;
    private $image;

    function __construct($id, $title, $description, $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    function getId()
    {
        return $this->id;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getImage()
    {
        return $this->image;
    }

    function __toString()
    {
        return "Blog Post: " . $this->title . " with ID " . $this->id;
    }
}

?>

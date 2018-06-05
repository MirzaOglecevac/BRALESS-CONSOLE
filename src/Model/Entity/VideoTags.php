<?php

namespace Model\Entity;

class VideoTags {
    
    private $id;
    private $name;
    private $videosId;
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getVideosId()
    {
        return $this->videosId;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $videosId
     */
    public function setVideosId($videosId)
    {
        $this->videosId = $videosId;
    }

    
    
    
}
<?php

namespace Model\Entity;

class VideoComments {
    
    private $id;
    private $content;
    private $date;
    private $usersId;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getUsersId()
    {
        return $this->usersId;
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
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $usersId
     */
    public function setUsersId($usersId)
    {
        $this->usersId = $usersId;
    }

    /**
     * @param mixed $videosId
     */
    public function setVideosId($videosId)
    {
        $this->videosId = $videosId;
    }

    
    
    
}
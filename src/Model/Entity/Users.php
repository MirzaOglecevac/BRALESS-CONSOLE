<?php

namespace Model\Entity;

class Users {
    
    private $id;
    private $username;
    private $password;
    private $email;
    private $date;
    private $profileImage;
    private $bannerImage;
    private $isPornstar;
    
    
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @return mixed
     */
    public function getBannerImage()
    {
        return $this->bannerImage;
    }

    /**
     * @return mixed
     */
    public function getIsPornstar()
    {
        return $this->isPornstar;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $profileImage
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }

    /**
     * @param mixed $bannerImage
     */
    public function setBannerImage($bannerImage)
    {
        $this->bannerImage = $bannerImage;
    }

    /**
     * @param mixed $isPornstar
     */
    public function setIsPornstar($isPornstar)
    {
        $this->isPornstar = $isPornstar;
    }

    
    
    
}
<?php

namespace Model\Entity;

class Pornstar {
    
    private $id;
    private $name;
    private $sex;
    private $age;
    private $about;
    private $country;
    private $defaultProfileViews;
    private $defaultTotalVideoViews;
    private $defaultSubscribers;
    private $bannerImage;
    private $profileImage;
    private $trusted;
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
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getDefaultProfileViews()
    {
        return $this->defaultProfileViews;
    }

    /**
     * @return mixed
     */
    public function getDefaultTotalVideoViews()
    {
        return $this->defaultTotalVideoViews;
    }

    /**
     * @return mixed
     */
    public function getDefaultSubscribers()
    {
        return $this->defaultSubscribers;
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
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @return mixed
     */
    public function getTrusted()
    {
        return $this->trusted;
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
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $defaultProfileViews
     */
    public function setDefaultProfileViews($defaultProfileViews)
    {
        $this->defaultProfileViews = $defaultProfileViews;
    }

    /**
     * @param mixed $defaultTotalVideoViews
     */
    public function setDefaultTotalVideoViews($defaultTotalVideoViews)
    {
        $this->defaultTotalVideoViews = $defaultTotalVideoViews;
    }

    /**
     * @param mixed $defaultSubscribers
     */
    public function setDefaultSubscribers($defaultSubscribers)
    {
        $this->defaultSubscribers = $defaultSubscribers;
    }

    /**
     * @param mixed $bannerImage
     */
    public function setBannerImage($bannerImage)
    {
        $this->bannerImage = $bannerImage;
    }

    /**
     * @param mixed $profileImage
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }

    /**
     * @param mixed $trusted
     */
    public function setTrusted($trusted)
    {
        $this->trusted = $trusted;
    }

    
    
   
    
    
    
}
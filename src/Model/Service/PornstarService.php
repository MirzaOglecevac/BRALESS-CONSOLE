<?php

namespace Model\Service;

use Model\Mapper\PornstarMapper;
use Model\Entity\ResponseBootstrap;
use Model\Entity\Pornstar;

class PornstarService {
    
    private $pornstarMapper;
    
    public function __construct(PornstarMapper $pornstarMapper){
        $this->pornstarMapper = $pornstarMapper;
    }
    
    
    /**
     * Get pornstars service
     * 
     * @param int $from
     * @param int $limit
     * @return ResponseBootstrap
     */
    public function getPornstars(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->getPornstars($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Edit pornstar data service
     * 
     * @param int $id
     * @param string $name
     * @param string $sex
     * @param int $age
     * @param string $about
     * @param string $profileImage
     * @param string $bannerImage
     * @param string $country
     * @param int $totalVideoViews
     * @param int $totalProfileViews
     * @param int $subscribers
     * @return \Model\Entity\ResponseBootstrap
     */
    public function updatePornstar(int $id, string $name, string $sex, int $age, string $about, string $profileImage, string $bannerImage,  string $country, int $totalVideoViews, int $totalProfileViews, int $subscribers){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $pornstar = new Pornstar();
        $pornstar->setId($id);
        $pornstar->setName($name);
        $pornstar->setSex($sex);
        $pornstar->setAbout($about);
        $pornstar->setBannerImage($bannerImage);
        $pornstar->setProfileImage($profileImage);
        $pornstar->setAge($age);
        $pornstar->setCountry($country);
        $pornstar->setDefaultTotalVideoViews($totalVideoViews);
        $pornstar->setDefaultProfileViews($totalProfileViews);
        $pornstar->setDefaultSubscribers($subscribers);
        
        $data = $this->pornstarMapper->updatePornstar($pornstar);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Delete pornstar service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function deletePornstars(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->deletePornstars($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Get search results service
     * 
     * @param string $term
     * @return ResponseBootstrap
     */
    public function searchPornstars(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->searchPornstars($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Add pornstar service
     * 
     * @param string $name
     * @param string $sex
     * @param int $age
     * @param string $about
     * @param string $profileImage
     * @param string $bannerImage
     * @return \Model\Entity\ResponseBootstrap
     */
    public function addPornstar(string $name, string $sex, int $age, string $about, string $profileImage, string $bannerImage){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $pornstar = new Pornstar();
        $pornstar->setName($name);
        $pornstar->setSex($sex);
        $pornstar->setAbout($about);
        $pornstar->setBannerImage($bannerImage);
        $pornstar->setProfileImage($profileImage);
        $pornstar->setAge($age);
        
        $data = $this->pornstarMapper->addPornstar($pornstar);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Get pornstar profile service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function getPornstarProfile(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->getProfile($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
}
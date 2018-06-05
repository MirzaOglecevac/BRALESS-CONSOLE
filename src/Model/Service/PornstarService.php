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
    
    public function getPornstars(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->getPornstars($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    public function updatePornstar(int $id, string $name, string $sex, int $age, string $about, string $profileImage, string $bannerImage){
        
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
        
        $data = $this->pornstarMapper->updatePornstar($pornstar);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function deletePornstars(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->deletePornstars($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function searchPornstars(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->pornstarMapper->searchPornstars($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    
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
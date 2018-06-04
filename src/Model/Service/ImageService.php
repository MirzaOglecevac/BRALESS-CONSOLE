<?php

namespace Model\Service;

use Model\Mapper\ImageMapper;
use Model\Entity\ResponseBootstrap;

class ImageService {
    
    private $imageMapper;
    
    public function __construct(ImageMapper $imageMapper){
        $this->imageMapper = $imageMapper;
    }
    
    public function getImages():ResponseBootstrap {
        
    }
}
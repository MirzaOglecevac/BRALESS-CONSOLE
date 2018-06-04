<?php

namespace Model\Service;

use Model\Mapper\VideoMapper;
use Model\Entity\ResponseBootstrap;

class VideoService {
    
    private $videoMapper;
    
    public function __construct(VideoMapper $videoMapper){
        $this->videoMapper = $videoMapper;
    }
    
    
    public function getVideos():ResponseBootstrap {
        
    }
}
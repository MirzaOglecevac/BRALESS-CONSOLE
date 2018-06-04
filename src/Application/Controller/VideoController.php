<?php

namespace Application\Controller;

use Model\Service\VideoService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class VideoController {
    
    private $videoService;
    
    public function __construct(VideoService $videoService){
        $this->videoService = $videoService;
    }
    
    
    public function getVideos(Request $request):ResponseBootstrap {
        die('videos');
    }
}
<?php

namespace Application\Controller;


use Model\Service\ImageService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class ImageController {
    
    private $imageService;
    
    public function __construct(ImageService $imageService){
        $this->imageService = $imageService;
    }
    
    public function getImages(Request $request):ResponseBootstrap {
        die('images');
    }
}
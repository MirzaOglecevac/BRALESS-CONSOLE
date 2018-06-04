<?php

namespace Application\Controller;


use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;
use Model\Service\PornstarService;

class PornstarController {
    
    private $pornstarService;
    
    public function __construct(PornstarService $pornstarService){
        $this->pornstarService = $pornstarService;
    }
    
    
    public function getPornstars(Request $request):ResponseBootstrap {
        die('pornstar');
    }
}
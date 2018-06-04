<?php

namespace Model\Service;

use Model\Mapper\PornstarMapper;
use Model\Entity\ResponseBootstrap;

class PornstarService {
    
    private $pornstarMapper;
    
    public function __construct(PornstarMapper $pornstarMapper){
        $this->pornstarMapper = $pornstarMapper;
    }
    
    public function getPornstars():ResponseBootstrap {
        
    }
}
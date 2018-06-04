<?php

namespace Model\Service;

use Model\Mapper\PermissionMapper;
use Model\Entity\ResponseBootstrap;

class PermissionService {
    
    private $permissionMapper;
    
    public function __construct(PermissionMapper $permissionMapper){
        $this->permissionMapper = $permissionMapper;
    }
    
    public function setPermission():ResponseBootstrap {
        
    }
}
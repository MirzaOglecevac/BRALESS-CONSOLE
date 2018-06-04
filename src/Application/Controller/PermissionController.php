<?php

namespace Application\Controller;

use Model\Service\PermissionService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class PermissionController {
    
    private $permissionService;
    
    public function __construct(PermissionService $permissionService){
        $this->permissionService = $permissionService;
    }
    
    
    public function putPermissions(Request $request):ResponseBootstrap{
        die('permission');
    }
}
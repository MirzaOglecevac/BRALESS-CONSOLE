<?php

namespace Application\Controller;


use Symfony\Component\HttpFoundation\Request;
use Model\Service\AdminService;
use Model\Entity\ResponseBootstrap;

class AdminController {
    
    private $adminService;
    
    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }
    
    
    public function getAll(Request $request):ResponseBootstrap {
        
        die('get all admins');
        
    }
}
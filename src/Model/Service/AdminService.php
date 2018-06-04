<?php

namespace Model\Service;

use Model\Mapper\AdminMapper;
use Model\Entity\ResponseBootstrap;

class AdminService {
    
    private $adminMapper;
    
    public function __construct(AdminMapper $adminMapper) {
        $this->adminMapper = $adminMapper;
    }
    
    
    public function getAllAdmins():ResponseBootstrap{
        
        die('get admins service');
        
    }
    
}
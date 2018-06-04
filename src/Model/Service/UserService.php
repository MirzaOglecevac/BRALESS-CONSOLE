<?php

namespace Model\Service;

use Model\Mapper\UserMapper;
use Model\Entity\ResponseBootstrap;

class UserService {
    
    private $userMapper;
    
    public function __construct(UserMapper $userMapper){
        $this->userMapper = $userMapper;
    }
    
    public function getUsers():ResponseBootstrap {
        
    }
}
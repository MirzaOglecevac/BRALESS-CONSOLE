<?php

namespace Application\Controller;

use Model\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class UserController {
    
    private $userService;
    
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    
    
    public function getUsers(Request $request):ResponseBootstrap {
        die('users');
    }
}
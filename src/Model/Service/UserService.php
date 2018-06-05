<?php

namespace Model\Service;

use Model\Mapper\UserMapper;
use Model\Entity\ResponseBootstrap;
use Model\Entity\Users;

class UserService {
    
    private $userMapper;
    
    public function __construct(UserMapper $userMapper){
        $this->userMapper = $userMapper;
    }
    
    public function getUsers(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();

        $data = $this->userMapper->getUsers($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    public function updateUser(int $id, string $name, string $email, string $password, string $profileImage, int $isPornstar){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $user = new Users();
        $user->setId($id);
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setProfileImage($profileImage);
        $user->setIsPornstar($isPornstar);
        
        $data = $this->userMapper->updateUser($user);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function deleteUsers(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->userMapper->deleteUsers($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function searchUsers(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->userMapper->searchUsers($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    
    public function addUser(string $name, string $email, string $password, string $profileImage, int $isPornstar){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $user = new Users();
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setProfileImage($profileImage);
        $user->setIsPornstar($isPornstar);
        
        $data = $this->userMapper->addUser($user);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
}
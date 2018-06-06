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
    
    
    /**
     * Get users service
     * 
     * @param int $from
     * @param int $limit
     * @return ResponseBootstrap
     */
    public function getUsers(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();

        $data = $this->userMapper->getUsers($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Edit user data service
     * 
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $profileImage
     * @param int $isPornstar
     * @return \Model\Entity\ResponseBootstrap
     */
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
    
    
    /**
     * Delete user service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function deleteUsers(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->userMapper->deleteUsers($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Get search results service
     * 
     * @param string $term
     * @return ResponseBootstrap
     */
    public function searchUsers(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->userMapper->searchUsers($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Add user service
     * 
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $profileImage
     * @param int $isPornstar
     * @return \Model\Entity\ResponseBootstrap
     */
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
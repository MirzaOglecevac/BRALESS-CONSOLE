<?php

namespace Model\Service;

use Model\Mapper\AdminMapper;
use Model\Entity\ResponseBootstrap;
use Model\Entity\Admins;

class AdminService {
    
    private $adminMapper;
    
    public function __construct(AdminMapper $adminMapper) {
        $this->adminMapper = $adminMapper;
    }
    
    
    /**
     * Get all admins service
     * 
     * @return ResponseBootstrap
     */
    public function getAllAdmins():ResponseBootstrap{
        
        // create response object 
        $response = new ResponseBootstrap();
        
        $data = $this->adminMapper->getAllAdmins();
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
        
    }
    
    
    /**
     * Update admin properties service
     * 
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $scope
     * @return \Model\Entity\ResponseBootstrap
     */
    public function updateAdmin(int $id, string $name, string $email, string $scope){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $admin = new Admins();
        $admin->setId($id);
        $admin->setName($name);
        $admin->setEmail($email);
        $admin->setScope($scope);
        
        $data = $this->adminMapper->updateAdmin($admin);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    /**
     * Add admin service
     * 
     * @param string $name
     * @param string $email
     * @param string $scope
     * @param string $password
     * @return \Model\Entity\ResponseBootstrap
     */
    public function addAdmin(string $name, string $email, string $scope, string $password){
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $admin = new Admins();
        $admin->setName($name);
        $admin->setEmail($email);
        $admin->setScope($scope);
        $admin->setPassword($password);
        
        $data = $this->adminMapper->addAdmin($admin);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Delete admin service
     * 
     * @param int $id
     * @return \Model\Entity\ResponseBootstrap
     */
    public function deleteAdmin(int $id){
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->adminMapper->deleteAdmin($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }


    public function loginAdmin(string $username, string $password):ResponseBootstrap {

        // create response object
        $response = new ResponseBootstrap();

        // create entity ans set its values
        $admin = new Admins();
        $admin->setName($username);
        $admin->setPassword($password);

        // get response from mapper
        $data = $this->adminMapper->loginAdmin($admin);

        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);

        return $response;
    }
    
}
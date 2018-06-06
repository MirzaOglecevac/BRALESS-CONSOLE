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
    
    
    /**
     * Get all admins controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getAll(Request $request):ResponseBootstrap {
        
       return $this->adminService->getAllAdmins();

    }
    
    
    /**
     * Update admin properties controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function putInfo(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $scope = $data['scope'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id) && isset($name) && isset($email) && isset($scope)){
            return $this->adminService->updateAdmin($id, $name, $email, $scope);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
        
    }
    
    
    /**
     * Add admin controller 
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function postAdd(Request $request):ResponseBootstrap {
      
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];
        $email = $data['email'];
        $scope = $data['scope'];
        $password = $data['password'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($password) && isset($name) && isset($email) && isset($scope)){
            return $this->adminService->addAdmin($name, $email, $scope, $password);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
        
    }
    
    
    /**
     * Delete admin controller 
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function deleteRemove(Request $request):ResponseBootstrap {
        
        // get id from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->adminService->deleteAdmin($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
        
    }
    
}
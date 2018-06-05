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
        
        // take data from url
        $from = $request->get('from');
        $limit = $request->get('limit');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($from) && isset($limit)){
            return $this->userService->getUsers($from, $limit);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
    public function putEdit(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $name = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $profileImage = $data['profile_image'];
        $isPornstar = $data['is_pornstar'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->userService->updateUser($id, $name, $email, $password, $profileImage, $isPornstar);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
    public function deleteRemove(Request $request):ResponseBootstrap {
        
        // take data from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->userService->deleteUsers($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
    public function getSearch(Request $request):ResponseBootstrap {
        
        // take data from url
        $term = $request->get('term');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($term)){
            return $this->userService->searchUsers($term);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    public function postAdd(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $name = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $profileImage = $data['profile_image'];
        $isPornstar = $data['is_pornstar'];
  
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($name) && isset($email) && isset($password) && isset($profileImage) && isset($isPornstar)){
            return $this->userService->addUser($name, $email, $password, $profileImage, $isPornstar);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
}
<?php

namespace Application\Controller;


use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;
use Model\Service\PornstarService;

class PornstarController {
    
    private $pornstarService;
    
    public function __construct(PornstarService $pornstarService){
        $this->pornstarService = $pornstarService;
    }
    
    
    public function getPornstars(Request $request):ResponseBootstrap {
        
        // take data from url
        $from = $request->get('from');
        $limit = $request->get('limit');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($from) && isset($limit)){
            return $this->pornstarService->getPornstars($from, $limit);
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
        $name = $data['name'];
        $sex = $data['sex'];
        $age = $data['age'];
        $about = $data['about'];
        $profileImage = $data['profile_image'];
        $bannerImage = $data['banner_image'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->pornstarService->updatePornstar($id, $name, $sex, $age, $about, $profileImage, $bannerImage);
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
            return $this->pornstarService->deletePornstars($id);
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
            return $this->pornstarService->searchPornstars($term);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    public function postAdd(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];
        $sex = $data['sex'];
        $age = $data['age'];
        $about = $data['about'];
        $profileImage = $data['profile_image'];
        $bannerImage = $data['banner_image'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($name) && isset($sex) && isset($age) && isset($about) && isset($profileImage) && isset($bannerImage)){
            return $this->pornstarService->addPornstar($name, $sex, $age, $about, $profileImage, $bannerImage);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
    public function getProfile(Request $request):ResponseBootstrap {
        
        // take data from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->pornstarService->getPornstarProfile($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
}
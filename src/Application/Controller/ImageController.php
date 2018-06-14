<?php

namespace Application\Controller;


use Model\Service\ImageService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class ImageController {
    
    private $imageService;
    
    public function __construct(ImageService $imageService){
        $this->imageService = $imageService;
    }
    
    
    /**
     * Get images controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getImages(Request $request):ResponseBootstrap {
        
        // take data from url
        $from = $request->get('from');
        $limit = $request->get('limit');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($from) && isset($limit)){
            return $this->imageService->getImages($from, $limit);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Get search results controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getSearch(Request $request):ResponseBootstrap {
        
        // take data from url
        $term = $request->get('term');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($term)){
            return $this->imageService->getSearch($term);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Get specified image data controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getData(Request $request):ResponseBootstrap {
       
        
        // take data from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->imageService->getImageData($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Update image data controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function putData(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $title = $data['title'];
        $description = $data['description'];
        $imageUrl = $data['image_url'];
        $date = $data['date'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->imageService->updateData($id, $title, $description, $imageUrl, $date);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Add image controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function postData(Request $request):ResponseBootstrap {
       
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $description = $data['description'];
        $thumbnail = $data['thumbnail'];
        $imageUrl = $data['image_url'];
        $pornstarId = array_key_exists('pornstar_id', $data) ? $data['pornstar_id'] : 'false';
      
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($thumbnail) && isset($title) && isset($description) && isset($imageUrl)){
            return $this->imageService->addData($title, $description, $thumbnail, $imageUrl, $pornstarId);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Update comment data controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function putComment(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $content = $data['content'];
        $date = $data['date'];
        $usersId = $data['users_id'];
        $imagesId = $data['images_id'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($content) && isset($id) && isset($date) && isset($usersId) && isset($imagesId)){
            return $this->imageService->updateComment($id, $content, $date, $usersId, $imagesId);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    
    /**
     * Delete image controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function deleteRemove(Request $request):ResponseBootstrap {
        
        // take data from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->imageService->deleteImageData($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Delete image comment controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */   
    public function deleteComment(Request $request):ResponseBootstrap {
        
        // take data from url
        $id = $request->get('id');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id)){
            return $this->imageService->deleteComment($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }


    public function getComments(Request $request):ResponseBootstrap {

        // take data from url
        $id = $request->get('id');

        // create response object
        $response = new ResponseBootstrap();

        if(isset($id)){
            return $this->imageService->getImageComments($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }

        return $response;
    }
    
}
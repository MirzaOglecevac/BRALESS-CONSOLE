<?php

namespace Application\Controller;

use Model\Service\VideoService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class VideoController {
    
    private $videoService;
    
    public function __construct(VideoService $videoService){
        $this->videoService = $videoService;
    }
    
    
    /**
     * Get videos controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getVideos(Request $request):ResponseBootstrap {
       
        // take data from url
        $from = $request->get('from');
        $limit = $request->get('limit');
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($from) && isset($limit)){
            return $this->videoService->getVideos($from, $limit);
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
            return $this->videoService->getSearch($term);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Get video data controller
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
            return $this->videoService->getVideoData($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Update video data controller
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
        $category = $data['category'];
        $thumbnail = $data['thumbnail'];
        $videoUrl = $data['video_url'];
        $downloadLink = $data['download_link'];
        $hd = $data['hd'];
        $date = $data['date'];
        $views = $data['views'];
        $length = $data['length'];
     
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id) && isset($title) && isset($description) && isset($category) && isset($thumbnail) && isset($videoUrl) && isset($downloadLink) && isset($hd) && isset($date) && isset($views) && isset($length)){
            return $this->videoService->updateData($id, $title, $description, $category, $thumbnail, $videoUrl, $downloadLink, $hd, $date, $views, $length);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Add video controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function postData(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $description = $data['description'];
        $category = $data['category'];
        $thumbnail = $data['thumbnail'];
        $videoUrl = $data['video_url'];
        $downloadLink = $data['download_link'];
        $hd = $data['hd'];
        $views = $data['views'];
        $length = $data['length'];
        $pornstarId = array_key_exists('pornstar_id', $data) ? $data['pornstar_id'] : 'false';
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($title) && isset($description) && isset($category) && isset($thumbnail) && isset($videoUrl) && isset($downloadLink) && isset($hd)  && isset($views) && isset($length)){
            return $this->videoService->addData($title, $description, $category, $thumbnail, $videoUrl, $downloadLink, $hd, $pornstarId, $views, $length);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Edit tag controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function putTag(Request $request):ResponseBootstrap {
        
        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $name = $data['name'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($name) && isset($id)){
            return $this->videoService->updateTag($id, $name);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Edit video comment controller
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
        $videosId = $data['videos_id'];
        
        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($content) && isset($id) && isset($date) && isset($usersId) && isset($videosId)){
            return $this->videoService->updateComment($id, $content, $date, $usersId, $videosId);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Delete video controller
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
            return $this->videoService->deleteVideoData($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
    /**
     * Delete video comment controller
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
            return $this->videoService->deleteComment($id);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
    
}
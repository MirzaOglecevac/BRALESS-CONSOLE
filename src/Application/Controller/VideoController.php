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
        
        if(isset($id)){
            return $this->videoService->updateData($id, $title, $description, $category, $thumbnail, $videoUrl, $downloadLink, $hd, $date, $views, $length);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
    
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
    
    
}
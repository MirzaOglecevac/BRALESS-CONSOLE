<?php

namespace Model\Service;

use Model\Mapper\VideoMapper;
use Model\Entity\ResponseBootstrap;
use Model\Entity\Videos;
use Model\Entity\VideoTags;
use Model\Entity\VideoComments;

class VideoService {
    
    private $videoMapper;
    
    public function __construct(VideoMapper $videoMapper){
        $this->videoMapper = $videoMapper;
    }
    
    
    public function getVideos(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->videoMapper->getVideos($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    public function getSearch(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->videoMapper->getSearch($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    public function getVideoData(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->videoMapper->getVideoData($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    
    public function updateData(int $id, string $title, string $description, string $category, string $thumbnail, string $videoUrl, string $downloadLink, string $hd, string $date, int $views, int $length):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $video = new Videos();
        $video->setId($id);
        $video->setTitle($title);
        $video->setCategory($category);
        $video->setDescription($description);
        $video->setThumbnail($thumbnail);
        $video->setVideoUrl($videoUrl);
        $video->setDownloadLink($downloadLink);
        $video->setHd($hd);
        $video->setDate($date);
        $video->setViews($views);
        $video->setLength($length);
        
        $data = $this->videoMapper->updateData($video);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function addData(string $title, string $description, string $category, string $thumbnail, string $videoUrl, string $downloadLink, string $hd, string $pornstarId, int $views, int $length):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $video = new Videos();
        $video->setTitle($title);
        $video->setCategory($category);
        $video->setDescription($description);
        $video->setThumbnail($thumbnail);
        $video->setVideoUrl($videoUrl);
        $video->setDownloadLink($downloadLink);
        $video->setHd($hd);
        $video->setViews($views);
        $video->setLength($length);
        $video->setPornstarId($pornstarId);
        
        $data = $this->videoMapper->addData($video);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    
    public function updateTag(int $id, string $name):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $tags = new VideoTags();
        $tags->setId($id);
        $tags->setName($name);
        
        $data = $this->videoMapper->updateTag($tags);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    public function updateComment(int $id, string $content, string $date, int $usersId, int $videosId):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $comment = new VideoComments();
        $comment->setId($id);
        $comment->setContent($content);
        $comment->setDate($date);
        $comment->setUsersId($usersId);
        $comment->setVideosId($videosId);
        
        $data = $this->videoMapper->updateComment($comment);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    public function deleteVideoData(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->videoMapper->deleteVideoData($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
}
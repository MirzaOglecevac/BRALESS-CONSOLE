<?php

namespace Model\Service;

use Model\Mapper\ImageMapper;
use Model\Entity\ResponseBootstrap;
use Model\Entity\Images;
use Model\Entity\ImageComments;

class ImageService {
    
    private $imageMapper;
    
    public function __construct(ImageMapper $imageMapper){
        $this->imageMapper = $imageMapper;
    }
    
    
    /**
     * Get images service
     * 
     * @param int $from
     * @param int $limit
     * @return ResponseBootstrap
     */
    public function getImages(int $from, int $limit):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->imageMapper->getImages($from, $limit);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Get search results service
     * 
     * @param string $term
     * @return ResponseBootstrap
     */
    public function getSearch(string $term):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->imageMapper->getSearch($term);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Get specified image data service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function getImageData(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->imageMapper->getImageData($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
    
    
    /**
     * Update image data service
     * 
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $thumbnail
     * @param string $imageUrl
     * @param string $date
     * @return ResponseBootstrap
     */
    public function updateData(int $id, string $title, string $description, string $imageUrl, string $date):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $image = new Images();
        $image->setId($id);
        $image->setTitle($title);
        $image->setDescription($description);
        $image->setImageLink($imageUrl);
        $image->setDate($date);
        
        $data = $this->imageMapper->updateData($image);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Add image service
     * 
     * @param string $title
     * @param string $description
     * @param string $thumbnail
     * @param string $imageUrl
     * @param string $pornstarId
     * @return ResponseBootstrap
     */
    public function addData(string $title, string $description, string $thumbnail, string $imageUrl, string $pornstarId):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();

        // create entity and set its values
        $image = new Images();
        $image->setTitle($title);
        $image->setDescription($description);
        $image->setThumbnail($thumbnail);
        $image->setImageLink($imageUrl);
        $image->setPornstarId($pornstarId);
        
        $data = $this->imageMapper->addData($image);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Update comment data service
     * 
     * @param int $id
     * @param string $content
     * @param string $date
     * @param int $usersId
     * @param int $imagesId
     * @return ResponseBootstrap
     */
    public function updateComment(int $id, string $content, string $date, int $usersId, int $imagesId):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        // create entity and set its values
        $comment = new ImageComments();
        $comment->setId($id);
        $comment->setContent($content);
        $comment->setImagesId($imagesId);
        $comment->setUserId($usersId);
        $comment->setDate($date);
        
        $data = $this->imageMapper->updateComment($comment);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Delete image service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function deleteImageData(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->imageMapper->deleteImageData($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
    
    
    /**
     * Delete image comment service
     * 
     * @param int $id
     * @return ResponseBootstrap
     */
    public function deleteComment(int $id):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->imageMapper->deleteComment($id);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }


    public function getImageComments(int $id):ResponseBootstrap {

        // create response object
        $response = new ResponseBootstrap();

        $data = $this->imageMapper->getImageComments($id);

        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);

        return $response;
    }
}
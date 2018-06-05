<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Images;
use Model\Entity\ImageComments;

class ImageMapper extends DataMapper {
    
    public function getImages(int $from, int $limit){
        
        try {
            $sql = "SELECT
                        img.*,
                        COUNT(DISTINCT lik.id) AS likes,
                        COUNT(DISTINCT dis.id) AS dislikes
                    FROM images AS img
                    LEFT JOIN image_likes AS lik ON img.id = lik.images_id
                    LEFT JOIN image_dislikes AS dis ON img.id = dis.images_id
                    GROUP BY img.id
                    ORDER BY COUNT(lik.images_id) DESC LIMIT :from,:limit";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':from', $from, PDO::PARAM_INT);
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
            $success = $statement->execute();
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    public function getSearch(string $term){
        
        try {
            $sql = "SELECT
                        img.*,
                        COUNT(DISTINCT lik.id) AS likes ,
                        COUNT(DISTINCT dis.id) AS dislikes
                    FROM images AS img
                    LEFT JOIN image_likes AS lik ON img.id = lik.images_id
                    LEFT JOIN image_dislikes AS dis ON img.id = dis.images_id
                    WHERE img.title LIKE ? OR img.description LIKE ?
                    GROUP BY img.id
                    ORDER BY COUNT(lik.images_id) DESC LIMIT 20";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                '%' . $term . '%',
                '%' . $term . '%'
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    public function getImageData(int $id){
        
        try {
            // get video data
            $sql = "SELECT
                        img.*,
                        COUNT(DISTINCT lik.id) AS likes,
                        COUNT(DISTINCT dis.id) AS dislikes
                    FROM images AS img
                    LEFT JOIN image_likes AS lik ON lik.images_id = img.id
                    LEFT JOIN image_dislikes AS dis ON dis.images_id = img.id
                    WHERE img.id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $id
            ]);
            
           
            
            // get video comments
            $sqlCom = "SELECT
                        com.* ,
                        us.profile_image,
                        us.username
                    FROM image_comments AS com
                    LEFT JOIN users AS us ON  us.id = com.users_id
                    WHERE images_id = ?
                    GROUP BY com.id";
            
            $statementCom = $this->connection->prepare($sqlCom);
            $successCom = $statementCom->execute([
                $id
            ]);
            
            
            // merge data
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            $data[0]['comments'] = $statementCom->fetchAll(PDO::FETCH_ASSOC);
            
            
            if($success && $successCom){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $data
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    public function updateData(Images $image){
        
        try {
            
            
            $sql = "UPDATE images SET
                        title = ?,
                        description = ?,
                        thumbnail = ?,
                        image_link = ?,
                        date = ?
                    WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $image->getTitle(),
                $image->getDescription(),
                $image->getThumbnail(),
                $image->getImageLink(),
                $image->getDate(),
                $image->getId()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
           
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    
    public function addData(Images $image){
        
        try {
            
            
            $sql = "INSERT INTO images (title, description, thumbnail, image_link)
                                VALUES (?, ?, ?, ?)";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $image->getTitle(),
                $image->getDescription(),
                $image->getThumbnail(),
                $image->getImageLink()
            ]);

            
            if($success){
                
                if($image->getPornstarId() !== 'false'){
                    $sql = "INSERT INTO pornstars_has_images (pornstars_id, images_id)
                                VALUES (?, ?)";
                    $statement = $this->connection->prepare($sql);
                    $statement->execute([
                        $image->getPornstarId(),
                        $this->connection->lastInsertId()
                    ]);
                }
                
                
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => []
                ];
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            die($e->getMessage());
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    
    
    
    public function updateComment(ImageComments $comment){
        
        try {
            
            $sql = "UPDATE image_comments SET
                        content = ?,
                        date = ?,
                        users_id = ?,
                        images_id = ?
                    WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $comment->getContent(),
                $comment->getDate(),
                $comment->getUserId(),
                $comment->getImagesId(),
                $comment->getId()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    public function deleteImageData(int $id){
        
        try {
            
            $sql = "DELETE FROM images WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $id
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.',
                    'data' => []
                ];
            }
            
        }catch(PDOException $e){
            
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
}
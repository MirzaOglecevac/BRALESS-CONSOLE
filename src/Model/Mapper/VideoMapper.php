<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Videos;
use Model\Entity\VideoTags;
use Model\Entity\VideoComments;

class VideoMapper extends DataMapper {
    
    public function getVideos(int $from, int $limit){
        
        try {
            $sql = "SELECT 
                        vid.*, 
                        COUNT(DISTINCT lik.id) AS likes ,
                        COUNT(DISTINCT dis.id) AS dislikes
                    FROM videos AS vid 
                    LEFT JOIN video_likes AS lik ON vid.id = lik.videos_id
                    LEFT JOIN video_dislikes dis ON vid.id = dis.videos_id
                    GROUP BY vid.id 
                    ORDER BY COUNT(lik.videos_id) DESC LIMIT :from,:limit";
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
                        vid.*,
                        COUNT(DISTINCT lik.id) AS likes ,
                        COUNT(DISTINCT dis.id) AS dislikes
                    FROM videos AS vid
                    LEFT JOIN video_likes AS lik ON vid.id = lik.videos_id
                    LEFT JOIN video_dislikes dis ON vid.id = dis.videos_id
                    WHERE vid.title LIKE ? OR vid.category LIKE ?
                    GROUP BY vid.id
                    ORDER BY COUNT(lik.videos_id) DESC LIMIT 20";
            
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
    
    
    
    public function getVideoData(int $id){
        
        try {
            // get video data
            $sql = "SELECT  
                        vid.*,
                        COUNT(DISTINCT lik.id) AS likes,
                        COUNT(DISTINCT dis.id) AS dislikes,
                        GROUP_CONCAT(DISTINCT act.name SEPARATOR ', ') as actors
                    FROM videos AS vid
                    LEFT JOIN video_likes AS lik ON lik.videos_id = vid.id 
                    LEFT JOIN video_dislikes AS dis ON dis.videos_id = vid.id
                    INNER JOIN pornstars_has_videos as center ON center.videos_id = vid.id
                    INNER JOIN pornstars as act ON act.id = center.pornstars_id
                    WHERE vid.id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
               $id
            ]);
            
            // get video tags
            $sqlTag = "SELECT
                        * 
                    FROM video_tags
                    WHERE videos_id = ?";
            
            $statementTag = $this->connection->prepare($sqlTag);
            $successTag = $statementTag->execute([
                $id
            ]);
            
            // get video comments
            $sqlCom = "SELECT 
                        com.* ,
                        us.profile_image,
                        us.username
                    FROM video_comments AS com
                    LEFT JOIN users AS us ON  us.id = com.users_id
                    WHERE videos_id = ? 
                    GROUP BY com.id";
            
            $statementCom = $this->connection->prepare($sqlCom);
            $successCom = $statementCom->execute([
                $id
            ]);
            
            
            // merge data
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            $data[0]['tags'] = $statementTag->fetchAll(PDO::FETCH_ASSOC);
            $data[0]['comments'] = $statementCom->fetchAll(PDO::FETCH_ASSOC);

            
            if($success && $successCom && $successTag){
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
    
    
    
    public function updateData(Videos $video){
        
        try {
            
        
            $sql = "UPDATE videos SET
                        title = ?,
                        description = ?,
                        category = ?,
                        thumbnail = ?,
                        video_url = ?,
                        download_link = ?,
                        hd = ?,
                        date = ?,
                        views = ?,
                        length = ?
                    WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $video->getTitle(),
                $video->getDescription(),
                $video->getCategory(),
                $video->getThumbnail(),
                $video->getVideoUrl(),
                $video->getDownloadLink(),
                $video->getHd(),
                $video->getDate(),
                $video->getViews(),
                $video->getLength(),
                $video->getId()
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
    
    
    
    public function updateTag(VideoTags $tags){
        
        try {
            
            $sql = "UPDATE video_tags SET name = ? WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                  $tags->getName(),
                $tags->getId()
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
    
    
    
    public function updateComment(VideoComments $comment){
        
        try {
            
            $sql = "UPDATE video_comments SET
                        content = ?,
                        date = ?,
                        users_id = ?,
                        videos_id = ?
                    WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $comment->getContent(),
                $comment->getDate(),
                $comment->getUsersId(),
                $comment->getVideosId(),
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
    
    
    public function deleteVideoData(int $id){
        
        try {
                      
            $sql = "DELETE FROM videos WHERE id = ?";
            
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
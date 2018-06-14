<?php

namespace Model\Mapper;
use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Videos;
use Model\Entity\VideoTags;
use Model\Entity\VideoComments;

class VideoMapper extends DataMapper {
    
    
    /**
     * Get videos mapper
     * 
     * @param int $from
     * @param int $limit
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getVideos(int $from, int $limit){
        
        
        try {
            $sql = "SELECT 
                         vid.id,
                            vid.title,
                            vid.video_url,
                            vid.thumbnail,
                            vid.date,
                            vid.views,
                            vid.length AS duration,
                            vid.hd,
                            (COUNT(DISTINCT lik.id) + vid.default_likes) AS likes,
                            (COUNT(DISTINCT dis.id) + vid.default_dislikes) AS dislikes
                    FROM videos AS vid 
                    LEFT JOIN video_likes AS lik ON vid.id = lik.videos_id
                    LEFT JOIN video_dislikes AS dis ON vid.id = dis.videos_id
                    GROUP BY vid.id 
                    ORDER BY (COUNT(DISTINCT lik.id) + vid.default_likes) DESC LIMIT :from,:limit";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':from', $from, PDO::PARAM_INT);
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
            $success = $statement->execute();
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ['data' => $statement->fetchAll(PDO::FETCH_ASSOC)]
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 204,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Get search results mapper
     * 
     * @param string $term
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getSearch(string $term){
        
        try {
            $sql = "SELECT
                        vid.id,
                            vid.title,
                            vid.video_url,
                            vid.thumbnail,
                            vid.date,
                            vid.views,
                            vid.length AS duration,
                            vid.hd,
                            (COUNT(DISTINCT lik.id) + vid.default_likes) AS likes,
                            (COUNT(DISTINCT dis.id) + vid.default_dislikes) AS dislikes
                    FROM videos AS vid
                    LEFT JOIN video_likes AS lik ON vid.id = lik.videos_id
                    LEFT JOIN video_dislikes dis ON vid.id = dis.videos_id
                    WHERE vid.title LIKE ?
                    GROUP BY vid.id
                    ORDER BY (COUNT(DISTINCT lik.id) + vid.default_likes) DESC LIMIT 20";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                '%' . $term . '%'
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ['data' => $statement->fetchAll(PDO::FETCH_ASSOC)]
                ];
            }
            
        }catch(PDOException $e){
           die($e->getMessage());
            return [
                'status' => 204,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Get video data mapper
     * 
     * @param int $id
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getVideoData(int $id){
       
        try {
            // get video data
            $sql = "SELECT  
                        vid.id,
                            vid.title,
                            vid.video_url,
                            vid.thumbnail,
                            vid.date,
                            vid.views,
                            vid.length AS duration,
                            vid.hd,
                            (COUNT(DISTINCT lik.id) + vid.default_likes) AS likes,
                            (COUNT(DISTINCT dis.id) + vid.default_dislikes) AS dislikes,
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
            $sqlCom  =  "SELECT 
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
                    'data' => ['data' => $data]
                ];
            }
            
        }catch(PDOException $e){
            
            return [
                'status' => 204,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Update video data mapper
     * 
     * @param Videos $video
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function updateData(Videos $video){
        
        try {

            $sql = "UPDATE videos SET
                        title = ?,
                        thumbnail = ?,
                        video_url = ?,
                        hd = ?,
                        date = ?,
                        views = ?,
                        length = ?
                    WHERE id = ?";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $video->getTitle(),
                $video->getThumbnail(),
                $video->getVideoUrl(),
                $video->getHd(),
                $video->getDate(),
                $video->getViews(),
                $video->getLength(),
                $video->getId()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
                
                
                $sql = "UPDATE video_tags SET
                        name = ?
                    WHERE videos_id = ?";
                
                $statement = $this->connection->prepare($sql);
                $success = $statement->execute([
                    $video->getTags(),
                    $video->getId()
                ]);
                
                
            }
            
        }catch(PDOException $e){
            die($e->getMessage());
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
   
    /**
     * Add video mapper
     * 
     * @param Videos $video
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function addData(Videos $video){
        
        try {
            
            $sql = "INSERT INTO videos (title, description, category, thumbnail, video_url, download_link, hd, views, length)
                        VALUES (?, ?, ?, ? , ?, ?, ?, ?, ?)";
            
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $video->getTitle(),
                $video->getDescription(),
                $video->getCategory(),
                $video->getThumbnail(),
                $video->getVideoUrl(),
                $video->getDownloadLink(),
                $video->getHd(),
                $video->getViews(),
                $video->getLength()
            ]);
            
            if($success){
                
                if($video->getPornstarId() !== 'false'){
                    $sql = "INSERT INTO pornstars_has_videos (pornstars_id, videos_id)
                                VALUES (?, ?)";
                    $statement = $this->connection->prepare($sql);
                    $statement->execute([
                        $video->getPornstarId(),
                        $this->connection->lastInsertId()
                    ]);
                }
                
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }
            
        }catch(PDOException $e){
           
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Edit tag mapper
     * 
     * @param VideoTags $tags
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
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
                    'message' => 'Success'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Edit video comment mapper
     * 
     * @param VideoComments $comment
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
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
                    'message' => 'Success'
                ];
            }
            
        }catch(PDOException $e){
         
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Delete video mapper
     * 
     * @param int $id
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
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
                    'message' => 'Success'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    /**
     * Delete video comment mapper
     * 
     * @param int $id
     * @return number[]|NULL[]|number[]|string[]
     */
    public function deleteComment(int $id){
        
        try {
            
            $sql = "DELETE FROM video_comments WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $id
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }



    public function getVideoComments(int $id){

        try {
            // get video data
            $sql = "SELECT 
                        comm.*,
                        us.username,
                        us.profile_image 
                        FROM video_comments AS comm
                         INNER JOIN users AS us ON comm.users_id = us.id
                         WHERE comm.videos_id = ?
                        ";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $id
            ]);


            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ['data' => $statement->fetchAll(PDO::FETCH_ASSOC)]
                ];
            }

        }catch(PDOException $e){

            return [
                'status' => 204,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $result;
    }


}
<?php

namespace Model\Mapper;
use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Videos;

class ScraperMapper extends DataMapper {

    public function saveScrapedData(Videos $videos, Array $tags){
        
        try {

            // fabricate number of likes and dislikes depending on number of views
            // var_dump($videos->getViews());
            $likes = rand($videos->getViews()/10, $videos->getViews()/5); // var_dump($likes);
            $dislikes = rand(0, ($videos->getViews()/25)); // var_dump($dislikes);
       
            // insert video data in videos table
            $sql = "INSERT INTO videos (title, video_url, views, length, hd, default_likes, default_dislikes) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $videos->getTitle(),
                $videos->getVideoUrl(),
                $videos->getViews(),
                $videos->getLength(),
                $videos->getHd(),
                $likes,
                $dislikes
            ]);
            
            $videoId = $this->connection->lastInsertId();
            
            // insert tags data in video_tags table
            $sql = "INSERT INTO video_tags (name, videos_id) 
                                VALUES (?,?)";
            for($i = 0; $i < count($tags); $i++){
                $statement = $this->connection->prepare($sql);
                $statement->execute([
                    $tags[$i],
                    $videoId
                ]);
            }      
            
            
        }catch(\PDOException $e){
            die($e->getMessage());
        }
    }
    
}
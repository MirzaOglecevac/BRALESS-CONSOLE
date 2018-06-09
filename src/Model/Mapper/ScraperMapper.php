<?php

namespace Model\Mapper;
use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Videos;
use Model\Entity\Pornstar;

class ScraperMapper extends DataMapper {

    public function saveScrapedVideosData(Videos $videos, string $tags){
        
        try {

            // fabricate number of likes and dislikes depending on number of views
            // var_dump($videos->getViews());
            $likes = rand($videos->getViews()/10, $videos->getViews()/5); // var_dump($likes);
            $dislikes = rand(0, ($videos->getViews()/25)); // var_dump($dislikes);
       
            // insert video data in videos table
            $sql = "INSERT INTO videos (title, video_url, views, length, hd, thumbnail, default_likes, default_dislikes) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $videos->getTitle(),
                $videos->getVideoUrl(),
                $videos->getViews(),
                $videos->getLength(),
                $videos->getHd(),
                $videos->getThumbnail(),
                $likes,
                $dislikes
            ]);
            
            $videoId = $this->connection->lastInsertId();
            
            // insert tags data in video_tags table
            $sql = "INSERT INTO video_tags (name, videos_id) 
                                VALUES (?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $tags,
                $videoId
            ]);
               
            
            
        }catch(\PDOException $e){
            die($e->getMessage());
        }
    }
    
    
    
    public function saveScrapedPornstarData(Pornstar $pornstar){
        
        try {
            
            // insert pornstar data into pornstars table
            $sql = "INSERT INTO pornstars (name, sex, age, about, country, profile_image, default_total_video_views, default_profile_views, default_subscribers)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $pornstar->getName(),
                $pornstar->getSex(),
                $pornstar->getAge(),
                $pornstar->getAbout(),
                $pornstar->getCountry(),
                $pornstar->getProfileImage(),
                $pornstar->getDefaultTotalVideoViews(),
                $pornstar->getDefaultProfileViews(),
                $pornstar->getDefaultSubscribers()
            ]);
            
            
        }catch(\PDOException $e){
            die($e->getMessage());
        }
    }
    
}
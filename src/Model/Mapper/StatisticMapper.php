<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;

class StatisticMapper extends DataMapper {
    
    
    /**
     * Get statistic mapper
     * 
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getStatistic(){
        
        try {
            $sql = "SELECT 
                        COUNT(DISTINCT vid.id) AS number_of_videos, 
                        FLOOR(AVG(vid.views)*COUNT(DISTINCT vid.id)) AS total_views,
                        COUNT(DISTINCT img.id) AS number_of_images,
                        COUNT(DISTINCT us.id) AS number_of_users,
                        COUNT(DISTINCT porn.id) AS number_of_pornstars,
                        COUNT(DISTINCT ad.id) AS number_of_ads
                    FROM videos AS vid
                    INNER JOIN images AS img
                    INNER JOIN users AS us
                    INNER JOIN pornstars AS porn
                    INNER JOIN ads as ad";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute();
            
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
}
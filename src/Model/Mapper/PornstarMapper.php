<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Pornstar;

class PornstarMapper extends DataMapper {
 
    public function getPornstars(int $from, int $limit){
        
        try {
            $sql = "SELECT * FROM pornstars LIMIT :from,:limit";
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
    
    
    public function updatePornstar(Pornstar $pornstar){
        
        try {
            $sql = "UPDATE pornstars SET
                        name = ?,
                        sex = ?,
                        age = ?,
                        profile_image = ?,
                        banner_image = ?,
                        about = ?
                    WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $pornstar->getName(),
                $pornstar->getSex(),
                $pornstar->getAge(),
                $pornstar->getProfileImage(),
                $pornstar->getBannerImage(),
                $pornstar->getAbout(),
                $pornstar->getId()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    
    public function deletePornstars(int $id){
        
        try {
            $sql = "DELETE FROM pornstars WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $id
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    
    public function searchPornstars(string $term){
        
        try {
            $sql = "SELECT * FROM pornstars
                    WHERE name LIKE ?
                    OR about LIKE ?";
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
    
    
    
    public function addPornstar(Pornstar $pornstar){
        
        try {
            $sql = "INSERT INTO pornstars
                    (name, sex, age, profile_image, banner_image, about)
                    VALUES (?,?,?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $pornstar->getName(),
                $pornstar->getSex(),
                $pornstar->getAge(),
                $pornstar->getProfileImage(),
                $pornstar->getBannerImage(),
                $pornstar->getAbout()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                $result = [
                    'status' => 500,
                    'message' => 'Server error.'
                ];
            }
            
        }catch(PDOException $e){
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }
    
    
    
    public function getProfile(int $id){
        
        try {
            $sql = "SELECT 
                        porn.*, 
						COUNT(DISTINCT center.id) AS num_of_videos,
						COUNT(DISTINCT sub.id) AS subscribers,
                        COUNT(DISTINCT centerimg.id) AS num_of_images
                    FROM pornstars AS porn
					LEFT JOIN pornstars_has_videos AS center ON porn.id = center.pornstars_id
                    LEFT JOIN pornstars_has_images AS centerimg ON porn.id = centerimg.pornstars_id
                    LEFT JOIN pornstar_subscribers AS sub ON porn.id = sub.pornstars_id
                    WHERE porn.id = ?
                    GROUP BY porn.id";
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


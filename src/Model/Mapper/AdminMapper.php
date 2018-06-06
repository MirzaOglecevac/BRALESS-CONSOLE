<?php

namespace Model\Mapper;

use Component\DataMapper;
use PDO;
use PDOException;
use Model\Entity\Admins;

class AdminMapper extends DataMapper {
    
    
    /**
     * Get all admins mapper
     * 
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getAllAdmins(){
        
        try {
            $sql = "SELECT * FROM admins";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute();
           
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ['data' => $statement->fetchAll(PDO::FETCH_ASSOC)]
                ];
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Not modified',
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
    
    
    /**
     * Update admin properties mapper
     * 
     * @param Admins $admin
     * @return number[]|NULL[]|number[]|string[]
     */
    public function updateAdmin(Admins $admin){
        
        try {
            $sql = "UPDATE admins SET name = ?, email = ?, scope = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $admin->getName(),
                $admin->getEmail(),
                $admin->getScope(),
                $admin->getId()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Not modified'
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
    
    
    
    /**
     * Add admin mapper
     * 
     * @param Admins $admin
     * @return number[]|NULL[]|number[]|string[]
     */
    public function addAdmin(Admins $admin){
        
        try {
            $sql = "INSERT INTO admins (name, email, scope, password) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $admin->getName(),
                $admin->getEmail(),
                $admin->getScope(),
                $admin->getPassword()
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Not modified'
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
    
    
    /**
     * Delete admin mapper
     * 
     * @param int $id
     * @return number[]|NULL[]|number[]|string[]
     */
    public function deleteAdmin(int $id){
        
        try {
            $sql = "DELETE FROM admins WHERE id = ?";
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
                    'status' => 304,
                    'message' => 'Not modified.'
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
    
}
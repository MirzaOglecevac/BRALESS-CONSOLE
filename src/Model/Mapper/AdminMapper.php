<?php

namespace Model\Mapper;

use Component\DataMapper;
use PDO;
use PDOException;
use Model\Entity\Admins;

class AdminMapper extends DataMapper {
    
    
    public function getAllAdmins(){
        
        try {
            $sql = "SELECT * FROM admins";
            $statement = $this->connection->prepare($sql);
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
    
}
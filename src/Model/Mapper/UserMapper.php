<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;
use Model\Entity\Users;

class UserMapper extends DataMapper {
    
    
    /**
     * Get users mapper
     * 
     * @param int $from
     * @param int $limit
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function getUsers(int $from, int $limit){
        
        try {
            $sql = "SELECT * FROM users LIMIT :from,:limit";
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
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Couldnt get data',
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
     * Edit user data mapper
     * 
     * @param Users $user
     * @return number[]|NULL[]|number[]|string[]
     */
    public function updateUser(Users $user){
        
        try {
            $sql = "UPDATE users SET 
                        username = ?, 
                        email = ?,
                        password = ?,
                        profile_image = ?,
                        is_pornstar = ?
                    WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $user->getUsername(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getProfileImage(),
                $user->getIsPornstar(),
                $user->getId()
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
    
    
    /**
     * Delete user mapper
     * 
     * @param int $id
     * @return number[]|NULL[]|number[]|string[]
     */
    public function deleteUsers(int $id){
        
        try {
            $sql = "DELETE FROM users WHERE id = ?";
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
    
    
    /**
     * Get search results mapper
     * 
     * @param string $term
     * @return number[]|array[]|NULL[]|number[]|string[]|array[]
     */
    public function searchUsers(string $term){
        
        try {
            $sql = "SELECT * FROM users
                    WHERE username LIKE ? 
                    OR email LIKE ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                '%' . $term . '%',
                '%' . $term . '%'
            ]);
            
            if($success){
                $result = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ['data' => $statement->fetchAll(PDO::FETCH_ASSOC)]
                ];
            }else {
                $result = [
                    'status' => 304,
                    'message' => 'Couldnt collect data.',
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
     * Add user mapper
     * 
     * @param Users $user
     * @return number[]|NULL[]|number[]|string[]
     */
    public function addUser(Users $user){
        
        try {
            $sql = "INSERT INTO users
                    (username, email, password, profile_image, is_pornstar)
                    VALUES (?,?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $user->getUsername(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getProfileImage(),
                $user->getIsPornstar()
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
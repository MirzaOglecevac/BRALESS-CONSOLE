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
            }
            
        }catch(PDOException $e){
            return [
                'status' => 304,
                'message' => $e->getMessage()
            ];
        }
        
        return $result;
    }


    public function loginAdmin(Admins $admin){

        try {

            // check if user is registered
            $sql = "SELECT * FROM admins WHERE name = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $admin->getName()
            ]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if($result['name'] === $admin->getName()){

                // encrypt password and check if it match
                //$password = md5($users->getPassword());
                $password = $admin->getPassword();

                if($password === $result['password']){
                    $response = [
                        'status' => 200,
                        'message' => 'Successfull login',
                        'data' => [
                            'username' => $result['name'],
                            'profile_image' => $result['image']
                        ]
                    ];
                }else {
                    $response = [
                        'status' => 401,
                        'message' => 'Bad password',
                        'data' => [
                            'info' => 'Bad password'
                        ]
                    ];
                }

            }else {
                $response = [
                    'status' => 401,
                    'message' => 'Bad username',
                    'data' => [
                        'info' => 'Bad username'
                    ]
                ];
            }

        }catch(PDOException $e){
            return [
                'status' => 406,
                'message' => $e->getMessage(),
                'data' => [
                    'info' => 'Bad user data'
                ]
            ];
        }

        return $response;
    }
    
}
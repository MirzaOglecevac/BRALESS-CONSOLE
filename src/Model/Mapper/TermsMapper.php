<?php

namespace Model\Mapper;

use PDO;
use PDOException;
use Component\DataMapper;

class TermsMapper extends DataMapper {
    
    
    /**
     * Update terms and conditions mapper
     * 
     * @param int $id
     * @param string $content
     * @return number[]|NULL[]|number[]|string[]
     */
    public function editTerms(int $id, string $content){
        
        try {
            $sql = "UPDATE terms SET content = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $content,
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
}
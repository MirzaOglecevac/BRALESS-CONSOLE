<?php

namespace Model\Service;

use Model\Mapper\TermsMapper;
use Model\Entity\ResponseBootstrap;

class TermsService {
    
    private $termsMapper;
    
    public function __construct(TermsMapper $termsMapper){
        $this->termsMapper = $termsMapper;
    }
    
    public function editTerms(int $id, string $content):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->termsMapper->editTerms($id, $content);
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        
        return $response;
    }
}
<?php

namespace Model\Service;

use Model\Mapper\TermsMapper;
use Model\Entity\ResponseBootstrap;

class TermsService {
    
    private $termsMapper;
    
    public function __construct(TermsMapper $termsMapper){
        $this->termsMapper = $termsMapper;
    }
    
    public function editTerms():ResponseBootstrap {
        
    }
}
<?php

namespace Model\Service;

use Model\Mapper\StatisticMapper;
use Model\Entity\ResponseBootstrap;

class StatisticService {
    
    private $statisticMapper;
    
    public function __construct(StatisticMapper $statisticMapper){
        $this->statisticMapper = $statisticMapper;
    }
    
    
    /**
     * Get statistic service
     * 
     * @return ResponseBootstrap
     */
    public function getStatistic():ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
        
        $data = $this->statisticMapper->getStatistic();
        
        $response->setStatus($data['status']);
        $response->setMessage($data['message']);
        $response->setData($data['data']);
        
        return $response;
    }
}
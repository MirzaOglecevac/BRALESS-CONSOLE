<?php

namespace Model\Service;

use Model\Mapper\StatisticMapper;
use Model\Entity\ResponseBootstrap;

class StatisticService {
    
    private $statisticMapper;
    
    public function __construct(StatisticMapper $statisticMapper){
        $this->statisticMapper = $statisticMapper;
    }
    
    public function getStatistic():ResponseBootstrap {
        
    }
}
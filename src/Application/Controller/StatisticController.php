<?php

namespace Application\Controller;


use Model\Service\StatisticService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class StatisticController {
    
    private $statisticService;
    
    public function __construct(StatisticService $statisticService){
        $this->statisticService = $statisticService;
    }
    
    /**
     * Get statistic controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function getStatistics(Request $request):ResponseBootstrap {
       
        return $this->statisticService->getStatistic();
        
    }
}
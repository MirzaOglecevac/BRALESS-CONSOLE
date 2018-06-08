<?php
namespace Application\Controller;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;
use Component\DataMapper;
use PDO;
use Model\Service\ScraperService;


class Landing {

    private $scraperService;
    
    public function __construct(ScraperService $scraperService){
        $this->scraperService = $scraperService;
    }

    
    
    public function get(Request $request):ResponseBootstrap {
      
        // create response object
        $response = new ResponseBootstrap();

        $html = file_get_contents('https://www.xvideos.com/new/1');
        $xvideos_doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        
        if(!empty($html)){
            
            return $this->scraperService->scrap($xvideos_doc);
                
        }else {
            $response->setStatus(404);
            $response->setMessage('No page found.');
        }
        
        return $response;
    }
    
}
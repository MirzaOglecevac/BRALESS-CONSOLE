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
        
        
        // $this->scrapVideos();
         $this->scrapPornstarProfiles();
        
        $response->setStatus(200);
        $response->setMessage('Finished');
        return $response;
    }
    
    
    public function scrapVideos(){
        //
        for($i = 1; $i < 2; $i++){
            $html = file_get_contents('https://www.xvideos.com/new/' . $i);
            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);
            
            if(!empty($html)){
                $this->scraperService->scrapVideos($html, $xvideos_doc, null);
            }
        }
        
    }
    
    
    public function scrapPornstarProfiles(){
    
        //for($i = 1; $i < 2; $i++){
            $html = file_get_contents('https://www.xvideos.com/pornstars-index/'); // . $i
            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);
            
            if(!empty($html)){
                $this->scraperService->scrapPornstars($html, $xvideos_doc);
            }
        //}
    }
    
    
    
    
    
    
    
}
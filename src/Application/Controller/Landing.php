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


    public function get(Request $request):ResponseBootstrap{

        // create response object
        $response = new ResponseBootstrap();

        $response->setStatus(200);
        $response->setMessage('Welcome to the Braless console API');
        return $response;
    }
    
    public function post(Request $request):ResponseBootstrap {

       // $subject = $request->get('subject');
       // $url = $request->get('url');

        // take parametar from the body
        $data = json_decode($request->getContent(), true);
        $subject = $data['subject'];
        $url = $data['url'];
        $from = $data['from'];
        $limit = $data['limit'];
        $pornstarId = isset($data['pornstar_id']) ? $data['pornstar_id'] : NULL;
        $term = isset($data['term']) ? $data['term'] : NULL;

        // create response object
        $response = new ResponseBootstrap();

        if($subject == "video"){
            $this->scrapVideo($url, $pornstarId);
        }else if($subject == "videos"){
            $this->scrapVideos($from, $limit);
        }else if($subject == "pornstars"){
            $this->scrapPornstars($from, $limit);
        }else if($subject == "pornstar"){

            $this->scrapPornstar($url);
        }else if($subject == "search"){
            $this->scrapSearch($from, $limit, $term);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
            return $response;
        }

        $response->setStatus(200);
        $response->setMessage('Finished');
        return $response;
    }
    
    
    public function scrapVideos($from, $limit){

        $from = $from - 1;
        $limit = $limit - 1;

        for($i = $from; $i < $limit; $i++){

            if($from == 0){
                $html = file_get_contents('https://www.xvideos.com');
            }else {
                $html = file_get_contents('https://www.xvideos.com/new/' . $i);
            }

            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);

            if(!empty($html)){
                $this->scraperService->scrapVideos($html, $xvideos_doc, null);
            }
        }

    }


    public function scrapSearch($from, $limit, $term){

        $from = $from - 1;
        $limit = $limit - 1;

        for($i = $from; $i < $limit; $i++){

            if($from == 0){
                $html = file_get_contents('https://www.xvideos.com/?k=' . $term);
            }else {
                $html = file_get_contents('https://www.xvideos.com/?k=' . $term . '&p=' . $i);
            }

            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);

            if(!empty($html)){
                $this->scraperService->scrapSearchVideos($html, $xvideos_doc, null);
            }
        }

    }

    
    public function scrapPornstars($from, $limit){

        $from = $from - 1;
        $limit = $limit - 1;

        for($i = $from; $i < $limit; $i++){

            if($from == 0){
                $html = file_get_contents('https://www.xvideos.com/pornstars-index');
            }else {
                $html = file_get_contents('https://www.xvideos.com/pornstars-index/' . $i);
            }

            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);
            
            if(!empty($html)){
                $this->scraperService->scrapPornstars($html, $xvideos_doc);
            }
        }
    }



    public function scrapVideo($url, $pornstarId){

            $html = file_get_contents($url);
            $xvideos_doc = new \DOMDocument();
            libxml_use_internal_errors(TRUE);

            if(!empty($html)){
                $this->scraperService->scrapVideo($html, $xvideos_doc, $pornstarId);
            }

    }



    public function scrapPornstar($url){

        $html = file_get_contents($url);
        $xvideos_doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE);

        if(!empty($html)){
            $this->scraperService->scrapPornstar($html, $xvideos_doc);
        }

    }
    
    
    
}
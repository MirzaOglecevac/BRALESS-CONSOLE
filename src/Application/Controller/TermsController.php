<?php

namespace Application\Controller;

use Model\Service\TermsService;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class TermsController {
    
    private $termsService;
    
    public function __construct(TermsService $termsService){
        $this->termsService = $termsService;
    }


    public function getData(Request $request):ResponseBootstrap {

            return $this->termsService->getTerms();
    }
    
    /**
     * Update terms and conditions controller
     * 
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function putEdit(Request $request):ResponseBootstrap {
        
        // get data from url
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $content = $data['content'];

        // create response object
        $response = new ResponseBootstrap();
        
        if(isset($id) && isset($content)){
            return $this->termsService->editTerms($id, $content);
        }else {
            $response->setStatus(404);
            $response->setMessage('Bad request.');
        }
        
        return $response;
    }
}
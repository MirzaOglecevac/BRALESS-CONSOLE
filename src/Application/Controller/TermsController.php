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
    
    
    public function putEdit(Request $request):ResponseBootstrap {
        die('terms');
    }
}